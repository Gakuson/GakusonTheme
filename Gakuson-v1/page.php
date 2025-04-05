
<?php get_header();?>
        <div class="empty"></div>
        <main>
            <article>
                <h2 class="site-title"><?php the_title();?></h2>
                <div class="content">
                      <?php the_content(); wp_link_pages();?>
                </div>
            </article>
        

        <section class="wanttoread">
        <h2 class="news-title">#あわせて読みたいTopics</h2>
        <div class="news-content-wrapper">
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

        $query = new WP_Query($args);?>

            <div class="news-content-wrapper">
                <?php if ($query->have_posts()): ?>
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="news-content">
                            <div class="Thumbnail">
                                <?php the_post_thumbnail('post_thumbnails'); ?> 
                            </div>
                            <p class="news_text"><?php the_title(); ?></p>
                            <div class="news_text__small">
                                <p><?php echo get_the_date(); ?></p>
                                <div class="news_text__acount"> 
                                    <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/GakusonLogo.png">
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
        </main>
        <?php get_footer();?>
        