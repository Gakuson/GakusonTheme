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
                            $is_disabled_article = in_array($post_id, array(555, 553, 551), true);
                            $href                = $is_disabled_article ? '' : get_permalink();
                            ?>
                            <a href="<?php echo esc_url($href); ?>" <?php post_class('article_item'); ?><?php if ($is_disabled_article) : ?> style="pointer-events: none;"<?php endif; ?>>
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
                                        <?php echo gakuson_get_article_taxonomy_markup($post_id, 'pc'); ?>
                                    </div>
                                </div>
                                <?php echo gakuson_get_article_taxonomy_markup($post_id, 'sp'); ?>
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
                            <?php
                            $taxonomy_pc = gakuson_get_article_taxonomy_markup(get_the_ID(), 'pc');
                            $taxonomy_sp = gakuson_get_article_taxonomy_markup(get_the_ID(), 'sp');
                            ?>
                            <?php if ($count == 1): ?>
                                <a href="<?php the_permalink(); ?>" <?php post_class(array('article_item', 'article_item__popu')); ?>>
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
                                            <?php echo $taxonomy_pc; ?>
                                        </div>
                                    </div>
                                    <?php echo $taxonomy_sp; ?>
                                </a>
                            <?php elseif ($count == 2): ?>
                                <a href="<?php the_permalink(); ?>" <?php post_class(array('article_item', 'article_item__popu')); ?>>
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
                                            <?php echo $taxonomy_pc; ?>
                                        </div>
                                    </div>
                                    <?php echo $taxonomy_sp; ?>
                                </a>
                            <?php elseif ($count == 3): ?>
                                <a href="<?php the_permalink(); ?>" <?php post_class(array('article_item', 'article_item__popu')); ?>>
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
                                            <?php echo $taxonomy_pc; ?>
                                        </div>
                                    </div>
                                    <?php echo $taxonomy_sp; ?>
                                </a>
                            <?php else: ?>
                                <a href="<?php the_permalink(); ?>" <?php post_class(array('article_item', 'article_item__popu')); ?>>
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
                                            <?php echo $taxonomy_pc; ?>
                                        </div>
                                    </div>
                                    <?php echo $taxonomy_sp; ?>
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
            <?php
            $tag_cloud_markup = wp_tag_cloud(
                gakuson_get_tag_cloud_args(
                    array(
                        'echo' => false,
                    )
                )
            );

            echo gakuson_format_tag_cloud_markup(
                $tag_cloud_markup,
                array(
                    'list_class'   => 'tag_list',
                    'item_class'   => 'tag_listItem',
                    'item_classes' => array(
                        'tag_listItem__blue',
                        'tag_listItem__yellow',
                    ),
                    'link_class'   => 'tag_itemLink',
                )
            );
            ?>
        </section>
    </main>
<?php get_footer();?>
