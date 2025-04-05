<?php get_header();?>
        <div class="empty"></div>
        <main>

        <img src="<?php echo get_template_directory_uri();?>/img/TopiBannerV2.png" class="topi-banner">

        <section class="article">
            <h2 class="article-title">＃BestTopics</h2>
            <div class="article-content-wrapper">
        <?php
        // 投稿を9件に制限
        $args = array(
            'posts_per_page' => 9, // 表示する投稿数を9件に設定
        );
        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <?php
                // 投稿のIDを取得
                $post_id = get_the_ID();

                // 条件に応じて href を空白にし、pointer-events: none を追加
                $href = (in_array($post_id, array(555, 553, 551))) ? '' : get_permalink();
                $style = (in_array($post_id, array(555, 553, 551))) ? 'style="pointer-events: none;"' : '';
                ?>
                <a href="<?php echo $href; ?>" class="article-content" <?php echo $style; ?>>
                    <div class="Thumbnail">
                        <?php the_post_thumbnail('post_thumbnails'); ?> 
                    </div>
                    <h3 class="article_text"><?php the_title(); ?></h3>
                    <div class="article_text__small">
                        <p><?php echo get_the_date(); ?></p>
                        <div class="article_text__acount"> 
                            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                            <p><?php echo get_the_author(); ?></p>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p>投稿がありません</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); // クエリをリセット ?>
    </div>
            <a class="article_button" href="<?php echo home_url( '/newindex' );?>" >
            <div class="article_button-content" >
                <p class="article_button__text">記事一覧はコチラ</p>
                <img class="article_button__icon" src="<?php echo get_template_directory_uri();?>/icon/右向きの矢印のアイコン素材.png">
            </div>
            </a>
        </section>
    
        <section class="popular">
            <h2 class="popular-title">#人気記事ランキング</h2>
            <div class="article-content-wrapper">
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
                            <a href="<?php the_permalink(); ?>" class="article-content">
                                <h3 class="popular-article-title st">1st.TIPS</h3>
                                <div class="Thumbnail">
                                    <?php the_post_thumbnail('post_thumbnails'); ?> 
                                </div>
                                <h3 class="article_text"><?php the_title(); ?></h3>
                                <div class="article_text__small">
                                    <p><?php echo get_the_date(); ?></p>
                                    <div class="article_text__acount"> 
                                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                        <p><?php echo get_the_author(); ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php elseif ($count == 2): ?>
                            <a href="<?php the_permalink(); ?>" class="article-content">
                                <h3 class="popular-article-title nd">2nd.TIPS</h3>
                                <div class="Thumbnail">
                                    <?php the_post_thumbnail('post_thumbnails'); ?> 
                                </div>
                                <h3 class="article_text"><?php the_title(); ?></h3>
                                <div class="article_text__small">
                                    <p><?php echo get_the_date(); ?></p>
                                    <div class="article_text__acount"> 
                                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                        <p><?php echo get_the_author(); ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php elseif ($count == 3): ?>
                            <a href="<?php the_permalink(); ?>" class="article-content">
                                <h3 class="popular-article-title rd">3rd.TIPS</h3>
                                <div class="Thumbnail">
                                    <?php the_post_thumbnail('post_thumbnails'); ?> 
                                </div>
                                <h3 class="article_text"><?php the_title(); ?></h3>
                                <div class="article_text__small">
                                    <p><?php echo get_the_date(); ?></p>
                                    <div class="article_text__acount"> 
                                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                        <p><?php echo get_the_author(); ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php else: ?>
                            <a href="<?php the_permalink(); ?>" class="article-content">
                                <h3 class="popular-article-title"><?php echo $count;?>th.TIPS</h3>
                                <div class="Thumbnail">
                                    <?php the_post_thumbnail('post_thumbnails'); ?> 
                                </div>
                                <h3 class="article_text"><?php the_title(); ?></h3>
                                <div class="article_text__small">
                                    <p><?php echo get_the_date(); ?></p>
                                    <div class="article_text__acount"> 
                                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                        <p><?php echo get_the_author(); ?></p>
                                    </div>
                                </div>
                            </a>                        
                        <?php endif; ?>
                        <?php $count++;?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?> <!-- WP_Query のデータをリセット -->
                    
                <?php endif; ?>
            </div>
        </section>

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
        <section class="about">
            <h2 class="about-title">#Nan トピ！とは？</h2>
            <div class="about-container">
            <div class="about-content-wrapper">
                <div class="about-content">
                <h3 class="about-content-title">#Nanトピ! の目標</h3>
                <p class="about-content-text">
                Nanzan Topics！(通称Nanトピ！)は南山大学生によって運営されている、南山大学生の為のメディアサイトです！
南山の大学生活について、今まで知らなかったことに加え、既存の情報を新しい視点から見ることもできます！
現在はがくそん編集部の記事のみですが、将来的には有志の学生による寄稿も募集していく予定です！
<br>
がくそん代表 鈴木 海斗
                </p>
            </div>
        </div>

        <div class="about-content-wrapper">
            <div class="about-content">
            <h3 class="about-content-title">#運営団体について</h3>
            <p class="about-content-text">
            がくそんは、「学生の尊厳の為に」をモットーに活動している南山大学の有志団体です！
Nanトピ！の他には南山大学でよく使うリンクを一括管理したサイト、「がくそん」の運営を始め、SNSにおける情報発信も行っています！
2025年度は、南山大学生にとっての望遠鏡のような存在となり、より近くの情報、遠くの情報にピントを当てることをビジョンとして掲げています！
一緒に望遠鏡を作っていくメンバーもがくそんでは募集しています！<br>ご連絡はgakuson23@gmail.comまで！
            </p>
        </div>
    </div>
        </div>
        </section>
    </main>
<?php get_footer();?>
        