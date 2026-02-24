<?php get_header();?>
    <div class="l-empty"></div>
    <main id="main" class="l-main">
        <section class="l-article">
            <div class="section_TitleConteiner">
                <img class="section_titleIcon article_titleIcon__latest" src="<?php echo get_template_directory_uri();?>/icon/watchIcon.png">
                <h2 class="section_title">新着記事</h2>
            </div>
            <div class="article_content">
                <?php
                    // 投稿を9件に制限
                    $args = array(
                        'posts_per_page' => 5, // 表示する投稿数を9件に設定
                    );
                    $query = new WP_Query($args);
                    ?>
                    <?php if ($query->have_posts()): ?>
                        <?php while ($query->have_posts()): $query->the_post(); ?>
                            <?php
                            $post_id = get_the_ID();

                            $href = (in_array($post_id, array(555, 553, 551))) ? '' : get_permalink();
                            $style = (in_array($post_id, array(555, 553, 551))) ? 'style="pointer-events: none;"' : '';
                            ?>
                            <a href="<?php echo $href; ?>" class="article_item" <?php echo $style; ?>>
                                <div class="article_main">
                                    <div class="article_itemThumbnail">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('post_thumbnails'); ?> 
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="article_text">
                                        <h3 class="article_title"><?php the_title(); ?></h3>
                                        <div class="article_desc">
                                            <p class="article_date"><?php echo get_the_date(); ?></p>
                                            <p class="article_author"><?php echo get_the_author(); ?></p>
                                        </div>
                                        <div class="article_taxonomy article_taxonomy__pc">
                                            <div class="article_taxonomyInner">
                                                <div class="article_taxonomyItem">
                                                    <span class="article_taxonomyItemText">
                                                        <?php
                                                        $categories = get_the_category();
                                                        if ( ! empty( $categories ) ) {
                                                            $cateName = $categories[0]->name;
                                                            echo esc_html('#' . $cateName);
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                                <div class="article_taxonomyItem article_taxonomyItem__category">
                                                    <?php
                                                    $tags = get_the_tags();
                                                    if(empty($tags)){
                                                        echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                                    }else{
                                                        foreach ( $tags as $tagName ) {
                                                        echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                    }
                                                }
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>        
                                </div>
                                <div class="article_taxonomy article_taxonomy__sp">
                                    <div class="article_taxonomyInner">
                                        <div class="article_taxonomyItem">
                                            <span class="article_taxonomyItemText">
                                               <?php
                                               $categories = get_the_category();
                                                if ( ! empty( $categories ) ) {
                                                    $cateName = $categories[0]->name;
                                                    echo esc_html('#' . $cateName);
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="article_taxonomyItem article_taxonomyItem__category">
                                           <?php
                                            $tags = get_the_tags();
                                            if(empty($tags)){
                                                echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                            }else{
                                                foreach ( $tags as $tagName ) {
                                                    echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>投稿がありません</p>
                    <?php endif; ?>
                <?php wp_reset_postdata(); // クエリをリセット ?>
                <a class="article_moreLink" href="#">もっと見る</a>
            </div>
        </section>
        <section class="l-article">
            <div class=section_TitleConteiner>
                <img class="section_titleIcon article_titleIcon__popu" src="<?php echo get_template_directory_uri();?>/icon/graphIcon.png">
                <h2 class="section_title">人気記事</h2>
            </div>
            <div class="article_content">
                <?php
                    // 人気記事ランキング用のクエリ
                    $args = array(
                        'meta_key'       => 'post_views_count', // ビュー数のカスタムフィールド
                        'orderby'        => 'meta_value_num',   // 数値としてソート
                        'posts_per_page' => 5,                  // 取得する記事数
                        'order'          => 'DESC',             // 降順（閲覧数が多い順）
                        'ignore_sticky_posts' => true           // スティッキーポストを除外
                    );

                    $popular_posts = new WP_Query($args);
                    $count = 1;
                    if ($popular_posts->have_posts()): ?>
                        <?php while ($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                            <?php if ($count == 1): ?>
                                <a href="<?php the_permalink(); ?>" class="article_item article_item__popu">
                                    <p class="article_num article_num__1st"><?php echo $count; ?></p> 
                                    <div class="article_main">
                                        <div class="article_itemThumbnail">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('post_thumbnails'); ?> 
                                            <?php else: ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                                            <?php endif; ?>
                                        </div>
                                        <div class="article_text">
                                            <h3 class="article_title"><?php the_title(); ?></h3>
                                            <div class="article_desc">
                                                <p class="article_date"><?php echo get_the_date(); ?></p>
                                                <p class="article_author"><?php echo get_the_author(); ?></p>
                                            </div>
                                            <div class="article_taxonomy article_taxonomy__pc">
                                                <div class="article_taxonomyInner">
                                                    <div class="article_taxonomyItem">
                                                        <span class="article_taxonomyItemText">
                                                            <?php
                                                            $categories = get_the_category();
                                                            if ( ! empty( $categories ) ) {
                                                                $cateName = $categories[0]->name;
                                                                echo esc_html('#' . $cateName);
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="article_taxonomyItem article_taxonomyItem__category">
                                                        <?php
                                                        $tags = get_the_tags();
                                                        if(empty($tags)){
                                                            echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                                        }else{
                                                            foreach ( $tags as $tagName ) {
                                                                echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article_taxonomy article_taxonomy__sp">
                                        <div class="article_taxonomyInner">
                                            <div class="article_taxonomyItem">
                                                <span class="article_taxonomyItemText">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories ) ) {
                                                        $cateName = $categories[0]->name;
                                                        echo esc_html('#' . $cateName);
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="article_taxonomyItem article_taxonomyItem__category">
                                                <?php
                                                $tags = get_the_tags();
                                                if(empty($tags)){
                                                   echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                                }else{
                                                    foreach ( $tags as $tagName ) {
                                                        echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>                                
                                </a>
                            <?php elseif ($count == 2): ?>
                                <a href="<?php the_permalink(); ?>" class="article_item article_item__popu">
                                    <p class="article_num"><?php echo $count; ?></p>
                                    <div class="article_main">
                                        <div class="article_itemThumbnail">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('post_thumbnails'); ?> 
                                            <?php else: ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                                            <?php endif; ?>
                                        </div>
                                        <div class="article_text">
                                            <h3 class="article_title"><?php the_title(); ?></h3>
                                            <div class="article_desc">
                                                <p class="article_date"><?php echo get_the_date(); ?></p>
                                                <p class="article_author"><?php echo get_the_author(); ?></p>
                                            </div>
                                            <div class="article_taxonomy article_taxonomy__pc">
                                                <div class="article_taxonomyInner">
                                                    <div class="article_taxonomyItem">
                                                        <span class="article_taxonomyItemText">
                                                            <?php
                                                            $categories = get_the_category();
                                                            if ( ! empty( $categories ) ) {
                                                                $cateName = $categories[0]->name;
                                                                echo esc_html('#' . $cateName);
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="article_taxonomyItem article_taxonomyItem__category">
                                                        <?php
                                                        $tags = get_the_tags();
                                                        if(empty($tags)){
                                                            echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                                        }else{
                                                            foreach ( $tags as $tagName ) {
                                                                echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article_taxonomy article_taxonomy__sp">
                                        <div class="article_taxonomyInner">
                                            <div class="article_taxonomyItem">
                                                <span class="article_taxonomyItemText">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories ) ) {
                                                        $cateName = $categories[0]->name;
                                                        echo esc_html('#' . $cateName);
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="article_taxonomyItem article_taxonomyItem__category">
                                                <?php
                                                $tags = get_the_tags();
                                                if(empty($tags)){
                                                   echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                                }else{
                                                    foreach ( $tags as $tagName ) {
                                                        echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php elseif ($count == 3): ?>
                                <a href="<?php the_permalink(); ?>" class="article_item article_item__popu">
                                    <p class="article_num"><?php echo $count; ?></p>
                                    <div class="article_main">
                                        <div class="article_itemThumbnail">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('post_thumbnails'); ?> 
                                            <?php else: ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                                            <?php endif; ?>
                                        </div>
                                        <div class="article_text">
                                            <h3 class="article_title"><?php the_title(); ?></h3>
                                            <div class="article_desc">
                                                <p class="article_date"><?php echo get_the_date(); ?></p>
                                                <p class="article_author"><?php echo get_the_author(); ?></p>
                                            </div>
                                            <div class="article_taxonomy article_taxonomy__pc">
                                                <div class="article_taxonomyInner">
                                                    <div class="article_taxonomyItem">
                                                        <span class="article_taxonomyItemText">
                                                            <?php
                                                            $categories = get_the_category();
                                                            if ( ! empty( $categories ) ) {
                                                                $cateName = $categories[0]->name;
                                                                echo esc_html('#' . $cateName);
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="article_taxonomyItem article_taxonomyItem__category">
                                                        <?php
                                                        $tags = get_the_tags();
                                                        if(empty($tags)){
                                                            echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                                        }else{
                                                            foreach ( $tags as $tagName ) {
                                                                echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article_taxonomy article_taxonomy__sp">
                                        <div class="article_taxonomyInner">
                                            <div class="article_taxonomyItem">
                                                <span class="article_taxonomyItemText">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories ) ) {
                                                        $cateName = $categories[0]->name;
                                                    echo esc_html('#' . $cateName);
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="article_taxonomyItem article_taxonomyItem__category">
                                                <?php
                                                $tags = get_the_tags();
                                                if(empty($tags)){
                                                    echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                                }else{
                                                    foreach ( $tags as $tagName ) {
                                                        echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php else: ?>
                                <a href="<?php the_permalink(); ?>" class="article_item article_item__popu">
                                    <p class="article_num"><?php echo $count; ?></p>
                                    <div class="article_main">
                                        <div class="article_itemThumbnail">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('post_thumbnails'); ?> 
                                            <?php else: ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                                            <?php endif; ?>
                                        </div>
                                        <div class="article_text">
                                            <h3 class="article_title"><?php the_title(); ?></h3>
                                            <div class="article_desc">
                                                <p class="article_date"><?php echo get_the_date(); ?></p>
                                                <p class="article_author"><?php echo get_the_author(); ?></p>
                                            </div>
                                            <div class="article_taxonomy article_taxonomy__pc">
                                                <div class="article_taxonomyInner">
                                                    <div class="article_taxonomyItem">
                                                        <span class="article_taxonomyItemText">
                                                            <?php
                                                            $categories = get_the_category();
                                                            if ( ! empty( $categories ) ) {
                                                                $cateName = $categories[0]->name;
                                                                echo esc_html('#' . $cateName);
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="article_taxonomyItem article_taxonomyItem__category">
                                                        <?php
                                                        $tags = get_the_tags();
                                                        if(empty($tags)){
                                                            echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                                        }else{
                                                            foreach ( $tags as $tagName ) {
                                                                echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article_taxonomy article_taxonomy__sp">
                                        <div class="article_taxonomyInner">
                                            <div class="article_taxonomyItem">
                                                <span class="article_taxonomyItemText">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories ) ) {
                                                        $cateName = $categories[0]->name;
                                                        echo esc_html('#' . $cateName);
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="article_taxonomyItem article_taxonomyItem__category">
                                                <?php
                                                $tags = get_the_tags();
                                                if(empty($tags)){
                                                   echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html('タグなし') . '</span> ';
                                                }else{
                                                    foreach ( $tags as $tagName ) {
                                                        echo '<span class="article_taxonomyItemText article_taxonomyItemText__category">' . esc_html( $tagName->name ) . '</span> ';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>                        
                           <?php endif; ?>
                           <?php $count++;?>
                        <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?> <!-- WP_Query のデータをリセット -->
                <?php endif; ?>
                <a class="article_moreLink" href="#">もっと見る</a>
            </div>
        </section>
        <section class="l-tag">
            <div class="section_TitleConteiner">
                <img class="section_titleIcon article_titleIcon__tag" src="<?php echo get_template_directory_uri();?>/icon/tagIcon.png">
                <h2 class="section_title">タグ一覧</h2>
            </div>
            <?php   function custom_wp_tag_cloud($tag_string) {
            $countNum = 0;
            // liタグ、ulタグ、aタグに任意のclassを適用
            $tag_string = preg_replace('/<ul(.*?)>/', '<ul class="tag_list"$1>', $tag_string);
            $tag_string = preg_replace_callback('/<li(.*?)>/', function($matches) use (&$countNum) {
                $countNum++;
                $classes = "tag_listItem";
                if ($countNum % 2 == 0) {
                    $classes .= " tag_listItem__yellow";
                } else {
                    $classes .= " tag_listItem__blue";
                }
                return '<li class="' . $classes . '"' . $matches[1] . '>';
            }, $tag_string);
            $tag_string = preg_replace('/<a(.*?)>/', '<a class="tag_itemLink"$1>', $tag_string);
            return $tag_string;
            }
            add_filter('wp_tag_cloud', 'custom_wp_tag_cloud');?>
            <?php wp_tag_cloud(array(
                'format' => 'list', // li形式
                'smallest' => 1,    // 最小フォントサイズ（無効化）
                'largest' => 1,     // 最大フォントサイズ（無効化）
                'unit' => 'em',     // サイズ単位（無効化目的）
                'orderby' => 'count',//タグ内の記事数が多ければ多いほど左に来る
                'order' => 'DESC',//降順
                'number' => 0,//０は表示数に上限がないということ
            )); ?>    
        </section>
    </main>
<?php get_footer();?> 