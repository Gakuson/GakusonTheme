<?php
get_header();

global $wp_query;

$current_keyword       = get_search_query();
$current_category_slug = (string) get_query_var('category_name');
$current_tag_slug      = (string) get_query_var('tag');

if ( in_array( $current_tag_slug, gakuson_get_internal_only_tag_slugs(), true ) ) {
    $current_tag_slug = '';
}

$current_category      = '' !== $current_category_slug ? get_category_by_slug($current_category_slug) : null;
$current_tag           = '' !== $current_tag_slug ? get_term_by('slug', $current_tag_slug, 'post_tag') : null;
$active_filters        = array();

if ('' !== $current_keyword) {
    $active_filters[] = array(
        'label' => 'キーワード',
        'value' => $current_keyword,
    );
}

if ($current_category instanceof WP_Term) {
    $active_filters[] = array(
        'label' => 'カテゴリ',
        'value' => $current_category->name,
    );
}

if ($current_tag instanceof WP_Term) {
    $active_filters[] = array(
        'label' => 'タグ',
        'value' => $current_tag->name,
    );
}
?>
<div class="l-empty"></div>
<main id="main" class="l-main">
    <div class="backBoard">
        <div class="backBoard_item backBoard_item__1"></div>
        <div class="backBoard_item backBoard_item__2"></div>
        <div class="backBoard_item backBoard_item__3"></div>
    </div>
    <div class="l-mainContent">
        <div class="l-mainBody">
            <article class="l-article search_results">
                <h1 class="article_title">検索結果</h1>
                <p class="search_resultsCount">
                    <?php echo esc_html(number_format_i18n((int) $wp_query->found_posts)); ?>件の記事が見つかりました
                </p>

                <section class="search_resultsSummary" aria-labelledby="search-current-filters-title">
                    <h2 class="search_resultsSectionTitle" id="search-current-filters-title">現在の条件</h2>
                    <?php if (! empty($active_filters)) : ?>
                        <ul class="search_resultsConditions">
                            <?php foreach ($active_filters as $active_filter) : ?>
                                <li class="search_resultsCondition">
                                    <span class="search_resultsConditionLabel"><?php echo esc_html($active_filter['label']); ?></span>
                                    <span class="search_resultsConditionValue"><?php echo esc_html($active_filter['value']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p class="search_resultsConditionFallback">キーワード・カテゴリ・タグの指定なしで検索しています。</p>
                    <?php endif; ?>
                </section>

                <?php if (have_posts()) : ?>
                    <div class="feature-wrapper">
                        <?php while (have_posts()) : the_post(); ?>
                            <a href="<?php the_permalink(); ?>" <?php post_class('feature'); ?>>
                                <div class="Thumbnail">
                                    <?php the_post_thumbnail('post_thumbnails'); ?>
                                </div>
                                <h2 class="feature_text"><?php the_title(); ?></h2>
                                <div class="feature_text__small">
                                    <p><?php echo esc_html(get_the_date()); ?></p>
                                    <div class="feature_textAcount">
                                        <img class="feature_textIcon" src="<?php echo esc_url(get_template_directory_uri() . '/img/GakusonLogo.png'); ?>" alt="">
                                        <p><?php echo esc_html(get_the_author()); ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="search_resultsEmpty">
                        <p class="search_resultsEmptyText">条件に一致する記事は見つかりませんでした。</p>
                        <p class="search_resultsEmptyNote">キーワードやカテゴリ、タグを変更してもう一度検索してください。</p>
                    </div>
                <?php endif; ?>

                <?php if ($wp_query->max_num_pages > 1) : ?>
                    <div class="search_resultsPagination">
                        <?php
                        the_posts_pagination(
                            array(
                                'mid_size'           => 1,
                                'prev_text'          => '前へ',
                                'next_text'          => '次へ',
                                'screen_reader_text' => '検索結果のページ移動',
                            )
                        );
                        ?>
                    </div>
                <?php endif; ?>
            </article>
            <?php get_sidebar(); ?>
        </div>
        <section class="l-Hashtag">
            <div class="Hashtag_content">
                <div class="Hashtag_title">
                    <img class="Hashtag_titleIcon" src="<?php echo esc_url(get_template_directory_uri() . '/icon/線画のフォルダアイコン 2.png'); ?>" alt="">
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
<?php get_footer(); ?>
