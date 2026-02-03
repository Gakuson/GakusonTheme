<?php get_header();?>
    <div class="l-empty"></div>
    <main id="main" class="l-main">
        <div class="backBoard">
            <div class="backBoard_item backBoard_item__1"></div>
            <div class="backBoard_item backBoard_item__2"></div>
            <div class="backBoard_item backBoard_item__3"></div>
        </div>
        <div class="l-mainContent">
        <div class="l-mainVisual">
            <img src="<?php echo get_template_directory_uri();?>/img/TopiBannerV2.png" class="topi-banner">
        </div>
        <article class="l-bestTopics">
            <h2 class="bestTopics_title">＃BestTopics!</h2>
            <div class="feature-wrapper feature-wrapper__bestTopics">
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
                    <a href="<?php echo $href; ?>" class="feature feature__bestTopics" <?php echo $style; ?>>
                        <div class="Thumbnail">
                            <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('post_thumbnails'); ?> 
                            <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                            <?php endif; ?>
                        </div>
                        <h3 class="feature_text"><?php the_title(); ?></h3>
                        <div class="feature_text__small">
                            <p class="feature_textDate"><?php echo get_the_date(); ?></p>
                            <div class="feature_textAcount"> 
                                <img class="feature_textIcon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                <p class="feature_textAuthor"><?php echo get_the_author(); ?></p>
                           </div>
                        </div>
                    </a>
                <?php endwhile; ?>
                <?php else: ?>
                    <p>投稿がありません</p>
                <?php endif; ?>
                <?php wp_reset_postdata(); // クエリをリセット ?>
            </div>
            <a class="bestTopics_button" href="<?php echo home_url( '/newindex' );?>" >
                <div class="bestTopics_buttonContent" >
                    <p class="bestTopics_buttonText">記事一覧はコチラ</p>
                    <img class="bestTopics_buttonIcon" src="<?php echo get_template_directory_uri();?>/icon/右向きの矢印のアイコン素材.png">
                </div>
            </a>
        </article>
    
        <section class="l-popular">
            <div class="popular_content">
                <h2 class="popular_title">#人気記事ランキング</h2>
                <div class="feature-wrapper feature-wrapper__popular">
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
                                <a href="<?php the_permalink(); ?>" class="feature feature__popular">
                                    <h3 class="feature_popularTitle feature_popularTitle__st">1st.TIPS</h3>
                                    <div class="Thumbnail">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('post_thumbnails'); ?> 
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="feature_text"><?php the_title(); ?></h3>
                                    <div class="feature_text__small">
                                        <p class="feature_textDate"><?php echo get_the_date(); ?></p>
                                        <div class="feature_textAcount"> 
                                            <img class="feature_textIcon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                            <p class="feature_textAuthor"><?php echo get_the_author(); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php elseif ($count == 2): ?>
                                <a href="<?php the_permalink(); ?>" class="feature">
                                    <h3 class="feature_popularTitle feature_popularTitle__nd">2nd.TIPS</h3>
                                    <div class="Thumbnail">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('post_thumbnails'); ?> 
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="feature_text"><?php the_title(); ?></h3>
                                    <div class="feature_text__small">
                                        <p class="feature_textDate"><?php echo get_the_date(); ?></p>
                                        <div class="feature_textAcount"> 
                                            <img class="feature_textIcon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                            <p class="feature_textAuthor"><?php echo get_the_author(); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php elseif ($count == 3): ?>
                                <a href="<?php the_permalink(); ?>" class="feature">
                                    <h3 class="feature_popularTitle feature_popularTitle__rd">3rd.TIPS</h3>
                                    <div class="Thumbnail">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('post_thumbnails'); ?> 
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="feature_text"><?php the_title(); ?></h3>
                                    <div class="feature_text__small">
                                        <p class="feature_textDate"><?php echo get_the_date(); ?></p>
                                        <div class="feature_textAcount"> 
                                            <img class="feature_textIcon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                            <p class="feature_textAuthor"><?php echo get_the_author(); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php else: ?>
                                <a href="<?php the_permalink(); ?>" class="feature">
                                    <h3 class="feature_popularTitle"><?php echo $count;?>th.TIPS</h3>
                                    <div class="Thumbnail">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('post_thumbnails'); ?> 
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="No Image">
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="feature_text"><?php the_title(); ?></h3>
                                    <div class="feature_text__small">
                                        <p class="feature_textDate"><?php echo get_the_date(); ?></p>
                                        <div class="feature_textAcount"> 
                                            <img class="feature_textIcon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                            <p class="feature_textAuthor"><?php echo get_the_author(); ?></p>
                                        </div>
                                    </div>
                                </a>                        
                           <?php endif; ?>
                           <?php $count++;?>
                        <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?> <!-- WP_Query のデータをリセット -->
                    <?php endif; ?>
                </div>
            </div>
        </section>

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
                    'orderby' => 'count',//タグ内の記事数が多ければ多いほど左に来る
                    'order' => 'DESC',//降順
                    'number' => 0,//０は表示数に上限がないということ
                    )); ?>
                </div>
            </div>
        </section>
        <section class="l-about">
            <h2 class="about_title">#Nan トピ！とは？</h2>
            <div class="about_contentContainer">
                <div class="about_contentWrapper">
                    <div class="about_content">
                        <h3 class="about_contentTitle">#Nanトピ! の目標</h3>
                        <p class="about_contentText">
                        Nanzan Topics！(通称Nanトピ！)は南山大学生によって運営されている、南山大学生の為のメディアサイトです！南山の大学生活について、今まで知らなかったことに加え、既存の情報を新しい視点から見ることもできます！現在はがくそん編集部の記事のみですが、将来的には有志の学生による寄稿も募集していく予定です！<br>がくそん代表 鈴木 海斗
                <!--この文章も適切かどうか見極める必要がある。-->
                        </p>
                    </div>
                </div>
                <div class="about_contentWrapper">
                    <div class="about_content">
                        <h3 class="about_contentTitle">#運営団体について</h3>
                        <p class="about_contentText">
                        がくそんは、「学生の尊厳の為に」をモットーに活動している南山大学の有志団体です！Nanトピ！の他には南山大学でよく使うリンクを一括管理したサイト、「がくそん」の運営を始め、SNSにおける情報発信も行っています！2025年度は、南山大学生にとっての望遠鏡のような存在となり、より近くの情報、遠くの情報にピントを当てることをビジョンとして掲げています！一緒に望遠鏡を作っていくメンバーもがくそんでは募集しています！<br>ご連絡はgakuson23@gmail.comまで！
                        </p>
                    </div>
                </div>
            </div>
        </section>
        </div>
    </main>
<?php get_footer();?> 