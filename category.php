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
                <div class="l-mainBody">
                    <article class="l-article">
                        <h2 class="article_title">カテゴリ：『<?php echo esc_html(single_cat_title('', false)); ?>』の記事一覧</h2>
                        <div class="feature-wrapper">
                            <?php if( have_posts() ):?>
                                <?php while( have_posts() ):the_post();?>
                                    <a href="<?php the_permalink();?>" <?php post_class('feature'); ?>>
                                        <div class="Thumbnail">
                                            <?php the_post_thumbnail('post_thumbnails');?> 
                                        </div>
                                        <h3 class="feature_text"><?php the_title();?></h3>
                                        <div class="feature_text__small">
                                            <p><?php echo get_the_date();?></p>
                                            <div class="feature_textAcount"> 
                                                <img class="feature_textIcon" src="<?php echo get_template_directory_uri();?>/img/GakusonLogo.png">
                                                <p> <?php echo get_the_author();?></p>
                                            </div>
                                        </div>
                                    </a>
                                <?php endwhile;else:?>
                                <p>投稿がありません</p>
                            <?php endif;?>    
                        </div>
                    </article>
                   <?php get_sidebar();?>
                </div>
                <section class="l-Hashtag">
                    <div class="Hashtag_content">
                        <div class="Hashtag_title">
                            <img class="Hashtag_titleIcon" src="<?php echo get_template_directory_uri();?>/icon/線画のフォルダアイコン 2.png">
                            <h2 class="Hashtag_titleText">#ハッシュタグ一覧</h2>
                        </div>
                        <div class="wp_tag_cloud-wrapper">
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
                                    'item_class' => 'Hashtag_text',
                                )
                            );
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <?php get_footer();?>
