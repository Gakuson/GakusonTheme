    initFeaturedCarousels();
    initLoadMoreSections();


    initFeaturedCarousels();
    initLoadMoreSections();


jQuery(window).on('load', function(){

    function initFeaturedCarousels() {
        jQuery('[data-featured-carousel]').each(function () {
            const $carousel = jQuery(this);
            const $viewport = $carousel.find('[data-carousel-viewport]');
            const $track = $carousel.find('[data-carousel-track]');
            const $originalSlides = $track.children('[data-carousel-slide]');

            if (!$originalSlides.length) {
                return;
            }

            const $dots = $carousel.find('[data-carousel-dot]');
            const $prevButton = $carousel.find('[data-carousel-prev]');
            const $nextButton = $carousel.find('[data-carousel-next]');
            const preferredStartIndex = Number($carousel.attr('data-carousel-start-index'));
            const slideCount = $originalSlides.length;
            const canLoop = slideCount > 1;
            const middleSetStartIndex = canLoop ? slideCount : 0;
            let currentIndex = Number.isNaN(preferredStartIndex) ? 0 : preferredStartIndex;
            let currentRenderIndex = currentIndex;

            function normalizeIndex(index) {
                return (index + slideCount) % slideCount;
            }

            function buildCloneSet($slides, groupLabel) {
                return $slides.map(function (slideIndex) {
                    const $clone = jQuery(this).clone();

                    $clone
                        .addClass('is-clone')
                        .attr({
                            id: ($clone.attr('id') || 'featured-slide') + '-clone-' + groupLabel + '-' + slideIndex,
                            'aria-hidden': 'true',
                            'aria-current': 'false'
                        })
                        .find('a')
                        .attr('tabindex', '-1');

                    return $clone.get(0);
                });
            }

            function getMiddleRenderIndex(logicalIndex) {
                return logicalIndex + middleSetStartIndex;
            }

            function getStableRenderIndex(renderIndex) {
                if (!canLoop) {
                    return renderIndex;
                }

                if (renderIndex < middleSetStartIndex) {
                    return renderIndex + slideCount;
                }

                if (renderIndex >= middleSetStartIndex + slideCount) {
                    return renderIndex - slideCount;
                }

                return renderIndex;
            }

            if (canLoop) {
                $track.prepend(buildCloneSet($originalSlides, 'before'));
                $track.append(buildCloneSet($originalSlides, 'after'));
                currentRenderIndex = getMiddleRenderIndex(currentIndex);
            }

            let $renderSlides = $track.children('[data-carousel-slide]');

            function syncTrackInsets(referenceIndex) {
                if (!$viewport.length || !$renderSlides.length) {
                    return;
                }

                const viewportWidth = $viewport.get(0).clientWidth;
                const $referenceSlide = $renderSlides.eq(referenceIndex);
                const slideWidth = $referenceSlide.length ? $referenceSlide.outerWidth() : 0;
                const sideInset = Math.max((viewportWidth - slideWidth) / 2, 0);

                $track.css({
                    paddingLeft: sideInset + 'px',
                    paddingRight: sideInset + 'px'
                });
            }

            function syncFeaturedCarouselState(renderIndex, logicalIndex) {
                $renderSlides
                    .removeClass('is-active')
                    .attr('aria-current', 'false');

                $renderSlides.eq(renderIndex)
                    .addClass('is-active');

                $originalSlides.each(function (slideIndex) {
                    jQuery(this).attr('aria-current', slideIndex === logicalIndex ? 'true' : 'false');
                });

                $dots.each(function (dotIndex) {
                    const isActive = dotIndex === logicalIndex;

                    jQuery(this)
                        .toggleClass('is-active', isActive)
                        .attr('aria-current', isActive ? 'true' : 'false');
                });

            }

            function setFeaturedCarouselAnimationEnabled(shouldAnimate) {
                $track.toggleClass('is-no-transition', !shouldAnimate);
            }

            function positionFeaturedCarousel(renderIndex) {
                if ($track.length && $viewport.length) {
                    const viewportElement = $viewport.get(0);
                    const trackElement = $track.get(0);
                    const activeSlideElement = $renderSlides.eq(renderIndex).get(0);

                    if (viewportElement && trackElement && activeSlideElement) {
                        syncTrackInsets(renderIndex);
                        const rawOffset = activeSlideElement.offsetLeft + (activeSlideElement.offsetWidth / 2) - (viewportElement.clientWidth / 2);
                        const maxOffset = Math.max(trackElement.scrollWidth - viewportElement.clientWidth, 0);
                        const clampedOffset = Math.min(Math.max(rawOffset, 0), maxOffset);

                        $track.css('transform', 'translateX(-' + clampedOffset + 'px)');
                    }
                }
            }

            function jumpToRenderIndex(renderIndex) {
                setFeaturedCarouselAnimationEnabled(false);
                currentRenderIndex = renderIndex;
                syncFeaturedCarouselState(currentRenderIndex, currentIndex);
                positionFeaturedCarousel(currentRenderIndex);
            }

            function syncFeaturedCarouselLoop() {
                const stableRenderIndex = getStableRenderIndex(currentRenderIndex);

                if (stableRenderIndex === currentRenderIndex) {
                    return;
                }

                jumpToRenderIndex(stableRenderIndex);
            }

            function updateFeaturedCarousel(nextIndex) {
                if (!canLoop) {
                    setFeaturedCarouselAnimationEnabled(true);
                    currentIndex = normalizeIndex(nextIndex);
                    currentRenderIndex = currentIndex;
                    syncFeaturedCarouselState(currentRenderIndex, currentIndex);
                    positionFeaturedCarousel(currentRenderIndex);
                    return;
                }

                const previousIndex = currentIndex;
                currentIndex = normalizeIndex(nextIndex);
                setFeaturedCarouselAnimationEnabled(true);

                if (nextIndex === previousIndex + 1) {
                    currentRenderIndex += 1;
                } else if (nextIndex === previousIndex - 1) {
                    currentRenderIndex -= 1;
                } else {
                    currentRenderIndex = getMiddleRenderIndex(currentIndex);
                }

                syncFeaturedCarouselState(currentRenderIndex, currentIndex);
                positionFeaturedCarousel(currentRenderIndex);
            }

            if (currentIndex < 0 || currentIndex >= slideCount) {
                currentIndex = 0;
                currentRenderIndex = canLoop ? getMiddleRenderIndex(currentIndex) : 0;
            }

            $track.on('transitionend', function (event) {
                const originalEvent = event.originalEvent;

                if (event.target !== $track.get(0)) {
                    return;
                }

                if (originalEvent && 'transform' !== originalEvent.propertyName) {
                    return;
                }

                syncFeaturedCarouselLoop();
            });

            $dots.on('click', function () {
                const nextIndex = Number(jQuery(this).attr('data-slide-index'));

                if (!Number.isNaN(nextIndex)) {
                    updateFeaturedCarousel(nextIndex);
                }
            });

            $prevButton.on('click', function () {
                updateFeaturedCarousel(currentIndex - 1);
            });

            $nextButton.on('click', function () {
                updateFeaturedCarousel(currentIndex + 1);
            });

            $carousel.on('keydown', function (event) {
                if ('ArrowLeft' !== event.key && 'ArrowRight' !== event.key) {
                    return;
                }

                event.preventDefault();
                updateFeaturedCarousel('ArrowLeft' === event.key ? currentIndex - 1 : currentIndex + 1);
            });

            jQuery(window).on('resize', function () {
                $renderSlides = $track.children('[data-carousel-slide]');
                currentRenderIndex = canLoop ? getMiddleRenderIndex(currentIndex) : currentIndex;
                setFeaturedCarouselAnimationEnabled(false);
                syncFeaturedCarouselState(currentRenderIndex, currentIndex);
                positionFeaturedCarousel(currentRenderIndex);
            });

            setFeaturedCarouselAnimationEnabled(false);
            syncFeaturedCarouselState(currentRenderIndex, currentIndex);
            positionFeaturedCarousel(currentRenderIndex);
        });
    }

    function initLoadMoreSections() {
        jQuery('[data-load-more-list]').each(function () {
            const $list = jQuery(this);
            const $items = $list.find('[data-load-more-item]');
            const $button = $list.find('[data-load-more-button]');
            const batchSize = Number($list.attr('data-load-more-initial')) || 5;
            let visibleCount = batchSize;

            function syncLoadMoreVisibility() {
                $items.each(function (index) {
                    jQuery(this).prop('hidden', index >= visibleCount);
                });

                if (visibleCount >= $items.length) {
                    $button.prop('hidden', true).attr('aria-expanded', 'true');
                    return;
                }

                $button.prop('hidden', false).attr('aria-expanded', 'false');
            }

            if (!$button.length || $items.length <= batchSize) {
                $button.prop('hidden', true);
                return;
            }

            syncLoadMoreVisibility();

            $button.on('click', function () {
                visibleCount = Math.min(visibleCount + batchSize, $items.length);
                syncLoadMoreVisibility();
            });
        });
    }

    //背景部分の高さ調整-----------------------
    const surHeight = jQuery('.l-mainContent').height();
    jQuery('.backBoard').css({
        'height': surHeight + 'px'
    });

    //l-emptyの高さ調整-----------------------
    const headerHeight = jQuery('.l-header').height();
    jQuery('.l-empty').css({
        'height': headerHeight + 'px'
    });

    //.slideInputの高さ位置調整-----------------------
    jQuery('.slideInput').css({
        'top': headerHeight + '10' +'px'
    });

    //フォーカス・クリックによる各種変化-----------------------
    initFeaturedCarousels();
    initLoadMoreSections();

    //.header_searchButtonのクリックによる.slideInputの開閉
    jQuery('.header_searchButton').click(
        function(){
            jQuery('.slideInput').toggleClass('slideInput__is-open');

            if(jQuery('.slideInput').hasClass('slideInput__is-open')){
                jQuery('.slideInput').attr("aria-hidden", "false");
            }else{
                jQuery('.slideInput').attr("aria-hidden", "ture");
            }
        }
    )

    //ハンバーガーメニューフォーカスによる.slideInputの閉鎖
    jQuery('.headerMain_humburgerContainer').focus(
        function(){
            jQuery('.slideInput').removeClass('slideInput__is-open');
            jQuery('.slideInput').attr("aria-hidden", "ture");
        }
    )

    //ハンバーガーメニューのクリックによるドロップダウンメニュー開閉
    jQuery('.headerMain_humburgerContainer').click(
        function(){
            jQuery('.headerMain_humburgerContainer').toggleClass('active');

            if(jQuery(this).hasClass('active')){
                jQuery('.hamburgerLine__1').addClass('hamburgerLine__1__is-active');
                jQuery('.hamburgerLine__2').addClass('hamburgerLine__2__is-active');
                jQuery('.hamburgerLine__3').addClass('hamburgerLine__3__is-active');
                jQuery('.dropdown-wrapper').slideDown();

                jQuery(this).attr("aria-expanded", "false");
                jQuery('.navSp_dropdown').attr("aria-hidden", "false");
            }else{
                jQuery('.hamburgerLine__1').removeClass('hamburgerLine__1__is-active');
                jQuery('.hamburgerLine__2').removeClass('hamburgerLine__2__is-active');
                jQuery('.hamburgerLine__3').removeClass('hamburgerLine__3__is-active');
                jQuery('.dropdown-wrapper').slideUp();

                jQuery(this).attr("aria-expanded", "true");
                jQuery('.navSp_dropdown').attr("aria-hidden", "true");
            }
        }
    );
    
    
    //ドロップダウンメニュー内ボタンのクリックによるドロップダウンメニュー閉鎖
    jQuery('.dropdown_closeButton').click(
        function(){
            jQuery('.headerMain_humburgerContainer').removeClass('active');

            if(!jQuery('.headerMain_humburgerContainer').hasClass('active')){
                jQuery('.hamburgerLine__1').removeClass('hamburgerLine__1__is-active');
                jQuery('.hamburgerLine__2').removeClass('hamburgerLine__2__is-active');
                jQuery('.hamburgerLine__3').removeClass('hamburgerLine__3__is-active');
                jQuery('.dropdown-wrapper').slideUp();

                jQuery(this).attr("aria-expanded", "true");
                jQuery('.navSp_dropdown').attr("aria-hidden", "true");
            }
        }
    );
})

