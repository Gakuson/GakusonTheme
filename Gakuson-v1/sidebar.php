<aside class="popular">
                <h2 class="popular-title">#人気記事ランキング</h2>
                <div class="news-content-wrapper">
                    <?php
                    // 人気記事ランキング用のクエリ
                    $args = array(
                        'meta_key'       => 'post_views_count', // ビュー数のカスタムフィールド
                        'orderby'        => 'meta_value_num',   // 数値としてソート
                        'posts_per_page' => 3,                  // 取得する記事数
                        'order'          => 'DESC',             // 降順（閲覧数が多い順）
                        'ignore_sticky_posts' => true           // スティッキーポストを除外
                    );

                    $popular_posts = new WP_Query($args);
                    $count = 1;
                    if ($popular_posts->have_posts()): ?>

                        <?php while ($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                            <?php if ($count == 1): ?>
                                <a href="<?php the_permalink(); ?>" class="news-content">
                                    <h3 class="popular-news-title st">1st.TIPS</h3>
                                    <div class="Thumbnail">
                                        <?php the_post_thumbnail('post_thumbnails'); ?> 
                                    </div>
                                    <h3 class="news_text"><?php the_title(); ?></h3>
                                    <div class="news_text__small">
                                        <p><?php echo get_the_date(); ?></p>
                                        <div class="news_text__acount"> 
                                            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                            <p><?php echo get_the_author(); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php elseif ($count == 2): ?>
                                <a href="<?php the_permalink(); ?>" class="news-content">
                                    <h3 class="popular-news-title nd">2nd.TIPS</h3>
                                    <div class="Thumbnail">
                                        <?php the_post_thumbnail('post_thumbnails'); ?> 
                                    </div>
                                    <h3 class="news_text"><?php the_title(); ?></h3>
                                    <div class="news_text__small">
                                        <p><?php echo get_the_date(); ?></p>
                                        <div class="news_text__acount"> 
                                            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                            <p><?php echo get_the_author(); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php elseif ($count == 3): ?>
                                <a href="<?php the_permalink(); ?>" class="news-content">
                                    <h3 class="popular-news-title rd">3rd.TIPS</h3>
                                    <div class="Thumbnail">
                                        <?php the_post_thumbnail('post_thumbnails'); ?> 
                                    </div>
                                    <h3 class="news_text"><?php the_title(); ?></h3>
                                    <div class="news_text__small">
                                        <p><?php echo get_the_date(); ?></p>
                                        <div class="news_text__acount"> 
                                            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                            <p><?php echo get_the_author(); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php else: ?>
                                <a href="<?php the_permalink(); ?>" class="news-content">
                                    <h3 class="popular-news-title"><?php echo $count;?>th.TIPS</h3>
                                    <div class="Thumbnail">
                                        <?php the_post_thumbnail('post_thumbnails'); ?> 
                                    </div>
                                    <h3 class="news_text"><?php the_title(); ?></h3>
                                    <div class="news_text__small">
                                        <p><?php echo get_the_date(); ?></p>
                                        <div class="news_text__acount"> 
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
                <div class="advertisement">
                    <a href="https://x.com/nanzan_gakuson" class="advertisement-content"><img src="<?php echo get_template_directory_uri(); ?>/poster/gakuson.png" class="advertisement-content"></a>
                    <a href="https://www.instagram.com/activate_nrl/" class="advertisement-content"><img src="<?php echo get_template_directory_uri(); ?>/poster/nrl.png" class="advertisement-content"></a>
                </div>
</aside>