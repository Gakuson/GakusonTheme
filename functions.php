<?php  
/*
 * GakusonTheme Functions
 */

/**
 * テーマのセットアップ
 */
function gakuson_theme_setup() {
    // アイキャッチ画像のサポート
    add_theme_support('post_thumbnails');
    // タイトルタグのサポート（header.phpの<title>タグを置き換えるため）
    add_theme_support('title-tag');
    // HTML5フォーム等のサポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'gakuson_theme_setup');

/**
 * ナビゲーションメニューの登録
 */
function gakuson_register_menus() {
    register_nav_menu('footer-nav', 'フッター');
    // header.phpで使用されている 'mainmenu' も登録しておくことを推奨
    register_nav_menu('mainmenu', 'メインメニュー');
}
add_action('init', 'gakuson_register_menus');

/**
 * CSSとJavaScriptの読み込み
 */
function gakuson_enqueue_assets() {
    $uri = get_template_directory_uri();

    // リセットCSS
    wp_enqueue_style('ress', 'https://unpkg.com/ress/dist/ress.min.css', array(), '1.0.0');

    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Kosugi+Maru&family=Lora:ital@0;1&display=swap', array(), null);

    // メインのスタイルシート（条件分岐）
    $css_path = '';
    
    if (is_front_page()) {
        wp_enqueue_style('gakuson-style-pc', $uri . '/css/style-33(pc).css', array('ress'), '1.0.1');
        wp_enqueue_style('gakuson-style-sp', $uri . '/css/style-33(sp).css', array('ress', 'gakuson-style-pc'), '1.0.1', 'screen and (max-width: 768px)');
    } elseif (is_page('newindex')) {
        wp_enqueue_style('gakuson-style-cat-pc', $uri . '/css-category-tag/style-37(pc).css', array('ress'), '1.0.0');
        wp_enqueue_style('gakuson-style-cat-sp', $uri . '/css-category-tag/style-37(sp).css', array('ress', 'gakuson-style-cat-pc'), '1.0.0', 'screen and (max-width: 768px)');
    } elseif (is_page()) {
        wp_enqueue_style('gakuson-style-fixed-pc', $uri . '/css-fixed/style-35(pc).css', array('ress'), '1.0.0');
        wp_enqueue_style('gakuson-style-fixed-sp', $uri . '/css-fixed/style-35(sp).css', array('ress', 'gakuson-style-fixed-pc'), '1.0.0', 'screen and (max-width: 768px)');
    } elseif (is_single()) {
        wp_enqueue_style('gakuson-style-post-pc', $uri . '/css-post/style-34(pc).css', array('ress'), '1.0.2');
        wp_enqueue_style('gakuson-style-post-sp', $uri . '/css-post/style-34(sp).css', array('ress', 'gakuson-style-post-pc'), '1.0.2', 'screen and (max-width: 768px)');
    } elseif (is_404()) {
        wp_enqueue_style('gakuson-style-404-pc', $uri . '/css-404/style-36(pc).css', array('ress'), '1.0.0');
        wp_enqueue_style('gakuson-style-404-sp', $uri . '/css-404/style-36(sp).css', array('ress', 'gakuson-style-404-pc'), '1.0.0', 'screen and (max-width: 768px)');
    } elseif (is_category() || is_tag()) {
        wp_enqueue_style('gakuson-style-cat-pc', $uri . '/css-category-tag/style-37(pc).css', array('ress'), '1.0.0');
        wp_enqueue_style('gakuson-style-cat-sp', $uri . '/css-category-tag/style-37(sp).css', array('ress', 'gakuson-style-cat-pc'), '1.0.0', 'screen and (max-width: 768px)');
    }

    // JavaScript
    // jQueryはWordPress同梱のものを使用
    wp_enqueue_script('gakuson-navbutton', $uri . '/js/navbutton.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'gakuson_enqueue_assets');


/* 人気記事一覧
---------------------------------------------------------- */
//記事閲覧数を取得する
function gakuson_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

//記事閲覧数を保存する
function gakuson_set_post_views($postID) {
    if (!is_single()) return; // 投稿ページのみでカウント
    
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// 閲覧数カウントのフック（wp_headで実行されていたものを適切なフックへ。通常はwp_headで良いが、条件分岐が必要）
add_action('wp_head', function() {
    if (is_single()) {
        gakuson_set_post_views(get_the_ID());
    }
});

// ヘッドから隣接する投稿リンクを削除
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// 管理画面の記事一覧に閲覧数を表示
function gakuson_posts_column_views($defaults){
    $defaults['post_views'] = __('Views');
    return $defaults;
}
add_filter('manage_posts_columns', 'gakuson_posts_column_views');

function gakuson_posts_custom_column_views($column_name, $id){
    if ($column_name === 'post_views') {
        echo gakuson_get_post_views(get_the_ID());
    }
}
add_action('manage_posts_custom_column', 'gakuson_posts_custom_column_views', 5, 2);

/**
 * ナビゲーションメニューの項目数を制限するフィルタ
 * header.phpから移動
 */
function gakuson_limit_wp_nav_menu_items($items, $args) {
    // 特定のメニュー位置やメニューIDに対してのみ適用する場合の条件を追加することを推奨
    // ここではheader.phpの実装に合わせて、単純に全てのwp_nav_menu_objectsに適用される書き方になっているが、
    // 影響範囲を限定するために、argsのmenu_classなどをチェックするほうが安全。
    // header.phpの呼び出し: 'menu_class' => 'dropdown' の場合のみなど。
    
    if (isset($args->menu_class) && $args->menu_class === 'dropdown') {
         return array_slice($items, 0, 4); // 最初の4つのメニューアイテムのみ取得
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'gakuson_limit_wp_nav_menu_items', 10, 2);

/**
 * タグクラウドのカスタマイズ
 * liタグにclass="Hashtag_text"を適用し、aタグの余分なclassを削除
 * 
 * @param string $tag_string タグクラウドのHTML文字列
 * @return string カスタマイズされたHTML文字列
 */
function custom_wp_tag_cloud($tag_string) {
    $tag_string = preg_replace('/<li(.*?)>/', '<li class="Hashtag_text"$1>', $tag_string);
    $tag_string = preg_replace('/<a (.*?)class="(.*?)"(.*?)>/', '<a $1$3>', $tag_string);
    return $tag_string;
}
add_filter('wp_tag_cloud', 'custom_wp_tag_cloud');
