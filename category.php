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
                        <h2 class="article_title">カテゴリ：『<?php single_cat_title(); ?>』の記事一覧</h2>
                        <div class="feature-wrapper">
                            <?php if( have_posts() ):?>
                                <?php while( have_posts() ):the_post();?>
                                    <a href="<?php the_permalink();?>" class="feature">
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
                        <?php   function custom_wp_tag_cloud($tag_string) {
                            // liタグにclass="Hashtag_text"を適用し、aタグの余分なclassを削除
                            $tag_string = preg_replace('/<li(.*?)>/', '<li class="Hashtag_text"$1>', $tag_string);
                            $tag_string = preg_replace('/<a (.*?)class="(.*?)"(.*?)>/', '<a $1$3>', $tag_string);
                            return $tag_string;
                        }
                        add_filter('wp_tag_cloud', 'custom_wp_tag_cloud');?>
                        <div class="wp_tag_cloud-wrapper">
                            <?php wp_tag_cloud(array(
                                'format' => 'list', // li形式
                                'smallest' => 1,    // 最小フォントサイズ（無効化）
                                'largest' => 1,     // 最大フォントサイズ（無効化）
                                'unit' => 'em',     // サイズ単位（無効化目的）
                                'orderby' => 'count',
                                'order' => 'DESC',
                                'number' => 0,
                            )); ?>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <?php get_footer();?>
   