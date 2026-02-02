<?php get_header();?>
        <div class="l-empty"></div>
        <main id="main" class="l-main">
            <div class="backBoard">
                <div class="backBoard_item backBoard_item__1"></div>
            </div>
            <div class="l-mainContent">
                <article class="l-article">
                    <div class="content">
                        <?php the_content(); wp_link_pages();?>
                    </div>
                </article>
                <section class="l-wantToRead">
                    <h2 class="wantToRead_title">#あわせて読みたいTopics</h2>
                    <?php
                        // 現在の投稿のタグを取得
                        $current_tags = wp_get_post_tags(get_the_ID());
                        if ($current_tags) {
                            // タグIDを取得
                            $tag_ids = array_map(function($tag) {
                                return $tag->term_id;
                            }, $current_tags);

                            // タグに関連する記事を取得
                            $args = array(
                                'tag__in' => $tag_ids, // 現在のタグに一致する記事
                                'post__not_in' => array(get_the_ID()), // 現在の投稿を除外
                                'posts_per_page' => 3, // 最大3件
                                'orderby' => 'date', // 日付順
                                'order' => 'DESC', // 新しい順
                            );
                        } else {
                            // タグがない場合は新着順で取得
                            $args = array(
                                'post__not_in' => array(get_the_ID()), // 現在の投稿を除外
                                'posts_per_page' => 3, // 最大3件
                                'orderby' => 'date', // 日付順
                                'order' => 'DESC', // 新しい順
                            );
                        }

                        $query = new WP_Query($args);
                    ?>

                    <div class="feature-wrapper">
                        <?php if ($query->have_posts()): ?>
                            <?php while ($query->have_posts()): $query->the_post(); ?>
                                <a href="<?php the_permalink(); ?>" class="feature">
                                    <div class="Thumbnail">
                                        <?php the_post_thumbnail('post_thumbnails'); ?> 
                                    </div>
                                    <p class="feature_text"><?php the_title(); ?></p>
                                    <div class="feature_text__small">
                                        <p><?php echo get_the_date(); ?></p>
                                        <div class="feature_textAcount"> 
                                            <img class="feature_textIcon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
                                            <p><?php echo get_the_author(); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>投稿がありません</p>
                        <?php endif; ?>
                    </div>
                    <?php wp_reset_postdata(); // クエリをリセット ?>
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