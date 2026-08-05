<?php get_header();?>
<!-- singleをベースに作成開始 sidebarはそのままに、左側すべてに記事を並べる機能を実装 -->
<div class="l-empty"></div>
<main id="main" class="l-main">        

    <div class="backBoard">
        <div class="backBoard_item backBoard_item__1"></div>
        <div class="backBoard_item backBoard_item__2"></div>
        <div class="backBoard_item backBoard_item__3"></div>
    </div>
    <div class="l-mainContent">
        <section class="l-article">
            <div class="section_TitleConteiner">
                <img class="section_titleIcon article_titleIcon__latest" src="<?php echo get_template_directory_uri();?>/icon/watchIcon.png">
                <h2 class="section_title">新着記事一覧</h2>
            </div>
            <div id="front-page-latest-list" class="article_content" data-load-more-list data-load-more-initial="<?php echo esc_attr((string) $front_page_list_step); ?>">
                <?php
                $args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC', 
                );
                $query = new WP_Query($args);
                $latest_index = 0;
                ?>
                

                <?php if ($query->have_posts()): ?>
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                        <?php
                            $post_id = get_the_ID();
                            $is_disabled_article = in_array($post_id, array(555, 553, 551), true);
                            $href = $is_disabled_article ? '' : get_permalink();
                        ?>
                        <a
                            href="<?php echo esc_url($href); ?>"
                            <?php post_class('article_item'); ?>
                            data-load-more-item
                            <?php if ($latest_index >= $front_page_list_step) : ?>hidden<?php endif; ?>
                            <?php if ($is_disabled_article) : ?>style="pointer-events: none;"<?php endif; ?>
                        >
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
                                        <?php echo gakuson_get_post_stats_markup($post_id, array('wrapper_class' => 'postStats--card')); ?>
                                        <?php echo gakuson_get_article_taxonomy_markup($post_id, 'pc'); ?>
                                    </div>
                                </div>
                                <?php echo gakuson_get_article_taxonomy_markup($post_id, 'sp'); ?>
                            </a>
                            <?php $latest_index++; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>投稿がありません</p>
                    <?php endif; ?>
                <?php wp_reset_postdata(); // クエリをリセット ?>
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
