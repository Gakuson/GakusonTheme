<?php get_header();?>
<!-- singleをベースに作成開始 sidebarはそのままに、左側すべてに記事を並べる機能を実装 -->
        <div class="empty"></div>
        <main>
            
            <div class="main-body">
                <section class="article">
                <h2 class="site-title">タグ：『<?php single_cat_title(); ?>』の記事一覧</h1></h2>
                    <div class="article-content-wrapper">
                        <?php if( have_posts() ):?>
                            <?php while( have_posts() ):the_post();?>
                            <a href="<?php the_permalink();?>" class="article-content">
                                <div class="Thumbnail">
                                <?php the_post_thumbnail('post_thumbnails');?> 
                                </div>
                                <h3 class="article_text"><?php the_title();?></h3>
                                <div class="article_text__small">
                                    <p><?php echo get_the_date();?></p>
                                    <div class="article_text__acount"> 
                                    <img class="icon" src="<?php echo get_template_directory_uri();?>/img/GakusonLogo.png">
                                    <p> <?php echo get_the_author();?></p>
                                    </div>
                                </div>
                            </a>
                            <?php endwhile;else:?>
                            <p>投稿がありません</p>
                            <?php endif;?>    
                    </div>

                </section>
                <?php get_sidebar();?>
            </div>


            <section class="Hashtag">
            <div class="Hashtag-content">
            <div class="Hashtag_title">
            <img class="Hashtag_title__icon" src="<?php echo get_template_directory_uri();?>/icon/線画のフォルダアイコン 2.png">
            <h2 class="Hashtag_title__text">#ハッシュタグ一覧</h2>
           </div>
           <?php   function custom_wp_tag_cloud($tag_string) {
            // liタグにclass="Hashtag-text"を適用し、aタグの余分なclassを削除
            $tag_string = preg_replace('/<li(.*?)>/', '<li class="Hashtag-text"$1>', $tag_string);
            $tag_string = preg_replace('/<a (.*?)class="(.*?)"(.*?)>/', '<a $1$3>', $tag_string);
            return $tag_string;
        }
        add_filter('wp_tag_cloud', 'custom_wp_tag_cloud');?>

        <ul class="Hashtag-wrapper">
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
        </section>
        </main>
        <?php get_footer();?>
   