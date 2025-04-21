<?php  
add_theme_support('post_thumbnails');
register_nav_menu('footer-nav', 'フッター');
function myTheme_enqueue_style_script() {
    wp_enqueue_script('navbutton_script', get_template_directory_uri().'/js/navbutton.js', array('jquery'), '', true);
  }
  add_action('wp_enqueue_scripts', 'myTheme_enqueue_style_script');

/* 人気記事一覧
---------------------------------------------------------- */
//記事閲覧数を取得する
function getPostViews($postID){
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
  function setPostViews($postID) {
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
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  add_filter('manage_posts_columns', 'posts_column_views');
  add_action('manage_posts_custom_column', 'posts_custom_column_views', 5, 2);
  function posts_column_views($defaults){
  $defaults['post_views'] = __('Views');
  return $defaults;
  }function posts_custom_column_views($column_name, $id)
  {
  if ($column_name === 'post_views') {
  echo getPostViews(get_the_ID());
  }
  }


