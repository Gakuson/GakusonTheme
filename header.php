<!--           
    | |       \ \  []    / /    [_______]        / /
[___ _____ ]   \ \  []  / /           / /       / /
    | |  | |    \ \    / /           / /       / /
    | |  | |     \_\  / /    [___________]    / /
    | |  | |          \ \           / /      /   /\ \
    |_|  | |           \ \         / /      /  /   \ \　  / /
         | |            \ \        \ \     /  /     \ \　/ /
       [___]             \_\        \ \   /_/        \____/ 
                                     \_\
-->
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Nanzan Topics！(通称Nanトピ！)は南山大学生によって運営されている、南山大学生の為のメディアサイトです！">
        <!--リセットCSS-->
        <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
        <!--viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php if(is_front_page()):?>
        <title>Nanzan Topics !</title>
        <!--オリジナルcss(pc)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/style-33(pc).css">
        <!--オリジナルcss(sp)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/style-33(sp).css">

        <?php elseif(is_page('newindex')):?>
        <title>Nanzan Topics !</title>
        <!--オリジナルcss(pc)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-category-tag/style-37(pc).css">
        <!--オリジナルcss(sp)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-category-tag/style-37(sp).css">

        <?php elseif(is_page()):?>
        <title><?php the_title(); ?></title>
        <!--オリジナルcss(pc)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-fixed/style-35(pc).css">
        <!--オリジナルcss(sp)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-fixed/style-35(sp).css">

        <?php elseif(is_single()):?>
        <title><?php the_title(); ?></title>
        <!--オリジナルcss(pc)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-post/style-34(pc).css">
        <!--オリジナルcss(sp)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-post/style-34(sp).css">

        <?php elseif(is_404()):?>
        <!--オリジナルcss(pc)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-404/style-36(pc).css">
        <!--オリジナルcss(sp)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-404/style-36(sp).css">

        <?php elseif(is_category()):?>
        <title>『<?php single_cat_title(); ?>』の記事一覧</title>
        <!--オリジナルcss(pc)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-category-tag/style-37(pc).css">
        <!--オリジナルcss(sp)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-category-tag/style-37(sp).css">

        <?php elseif(is_tag()):?>
        <title>『<?php single_cat_title(); ?>』の記事一覧</title>
        <!--オリジナルcss(pc)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-category-tag/style-37(pc).css">
        <!--オリジナルcss(sp)(sass)-->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css-category-tag/style-37(sp).css">

        <?php endif; ?>


        <!--googleFonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&family=Lora:ital@0;1&display=swap" rel="stylesheet">

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon.svg" />
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon.png" />
        <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/favicon/site.webmanifest" />

    </head>
    <body <?php body_class();?>>
        <?php if(is_front_page()): ?>
            <div class="transformSkewY">
                <div class="transformSkewY_1"></div>
                <div class="transformSkewY_2"></div>
                <div class="transformSkewY_3"></div>
            </div>
        <?php else:?>
            <div class="transformSkewY">
                <div class="transformSkewY_1"></div>
            </div>
        <?php endif;?>        
    
        <div class="positionAbsolute">
        <header>
            <div class="headerMain">
                <a  class="headerMain_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                 <img class="headerMain_logoImg" src="<?php echo get_template_directory_uri();?>/icon/NanTopi_logo (5).png"  alt="souzou">
                </a>
            <nav class="headerMain_list">   
            <?php
                wp_nav_menu(
                array(
                        'menu' => 'mainmenu',
                        'container' => '',
                        'container_id' => '',
                        'container_class' => 'headerMain_list',
                        'menu_id' => '',
                        'fallback_cb' => ''
                    )
                );
                ?>
            </nav>

           <div class="headerMain_spMenu">
                <div class="headerMain_spMenuContent">
                    <img class="headerMain_spMenuImg" src="<?php echo get_template_directory_uri();?>/icon/bars_hoso.png" alt="asd">
                </div>
            </div>
        </div>

        <div class="dropdown-wrapper">   
        <div class="dropdown">
        <?php
        function limit_wp_nav_menu_items($items, $args) {
            return array_slice($items, 0, 4); // 最初の4つのメニューアイテムのみ取得
        }
        add_filter('wp_nav_menu_objects', 'limit_wp_nav_menu_items', 10, 2);

        wp_nav_menu(
            array(
                'menu' => 'mainmenu',
                'container' => '',
                'container_id' => '',
                'container_class' => 'headerMain_list',
                'menu_id' => '',
                'menu_class' => 'dropdown', // ulタグに適用
                'fallback_cb' => ''
            )
        );
        ?>
        <?php wp_head();?>
        </header>