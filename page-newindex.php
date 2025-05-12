<?php get_header();?>
<!-- singleをベースに作成開始 sidebarはそのままに、左側すべてに記事を並べる機能を実装 -->
        <div class="empty"></div>
        <main>
            
            <div class="mainBody">
                <section class="article">
                <h2 class="site-title">新着記事一覧</h2>
                <?php
$args = array(
    'post_type' => 'post', // 投稿タイプを指定
    'posts_per_page' => -1, // すべての投稿を取得
    'orderby' => 'date', // 日付順に並べる
    'order' => 'DESC', // 新しい順に並べる
);
$query = new WP_Query($args);
?>

<div class="feature-wrapper">
    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="feature">
                <div class="Thumbnail">
                    <?php the_post_thumbnail('post_thumbnails'); ?> 
                </div>
                <h3 class="feature_text"><?php the_title(); ?></h3>
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
                <?php get_sidebar();?>
            </div>


        <section class="Hashtag">
            <div class="Hashtag_content">
            <div class="Hashtag_title">
            <img class="Hashtag_titleIcon" src="<?php echo get_template_directory_uri();?>/feature_textIcon/線画のフォルダアイコン 2.png">
            <h2 class="Hashtag_titleText">#ハッシュタグ一覧</h2>
           </div>
           <?php   function custom_wp_tag_cloud($tag_string) {
            // liタグにclass="Hashtag_text"を適用し、aタグの余分なclassを削除
            $tag_string = preg_replace('/<li(.*?)>/', '<li class="Hashtag_text"$1>', $tag_string);
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
   