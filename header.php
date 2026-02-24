<!--           
    | |       \ \  []    / /    [_______]        / /
[___ _____ ]   \ \  []  / /           / /       / /
    | |  | |    \ \    / /           / /       / /
    | |  | |     \_\  / /    [___________]    / /
    | |  | |          \ \           / /      /   /\ \
    | |  | |           \ \         / /      /  /   \ \　  / /
    |_|  | |            \ \        \ \     /  /     \ \　/ /
       [___]             \_\        \ \   /_/        \____/ 
                                     \_\
-->
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class();?>>  
        <header id="header" class="l-header">
            <div class="header_main">
                <a class="header_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img class="header_logoImg" src="<?php echo get_template_directory_uri();?>/img/nantopiTitleLogo.png" alt="NanTopiのバナーロゴ">
                </a>
                <div class="header_side">
                    <nav class="header_menu">
                        <?php
                            wp_nav_menu(
                            array(
                                'menu' => 'mainmenu',
                                'container' => '',
                                'menu_class' => 'header_list',
                                'menu_id' => '',
                                'fallback_cb' => ''
                            )
                            );
                        ?>
                    </nav>
                    <div class="header_search">
                        <input class="header_searchInput" type="text">
                        <button class="kensakuButton">
                            <img class="header_searchIcon" src="<?php echo get_template_directory_uri();?>/icon/searchIcon.png" alt="検索アイコン">
                        </button>
                    </div>
                    <div class="header_spMenu">
                        <button class="header_searchButton">
                            <img class="header_searchBttonIcon" src="<?php echo get_template_directory_uri();?>/icon/searchIcon.png" alt="検索アイコン">
                        </button>
                        <button class="headerMain_humburgerContainer" aria-label="メニューを開く" aria-expanded="true">
                            <div class="headerMain_hamburger">
                                <span class="hamburgerLine hamburgerLine__1"></span>
                                <span class="hamburgerLine hamburgerLine__2"></span>
                                <span class="hamburgerLine hamburgerLine__3"></span>
                            </div>
                        </button>
                        <div class="slideInput">
                            <input class="header_searchInput header_searchInput__sp" type="text">
                            <button class="kensakuButton kensakuButton__sp">
                                <img class="header_searchIcon header_searchIcon__sp" src="<?php echo get_template_directory_uri();?>/icon/searchIcon.png" alt="検索アイコン">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown-wrapper">   
                <nav class="dropdown">
                    <?php
                    wp_nav_menu(
                    array(
                        'menu' => 'mainmenu',
                        'container' => '',
                        'container_id' => '',
                        'container_class' => 'header_list',
                        'menu_id' => '',
                        'menu_class' => 'dropdown', // functions.php でこのクラスを検知してフィルタを適用
                        'fallback_cb' => ''
                    )
                    );
                    ?>
                    <div class="dropdown_closeButton">
                        <div class="dropdown_closeButtonArrow">
                            <span class="arrow_line arrow_line__1"></span>
                            <span class="arrow_line arrow_line__2"></span>
                        </div>
                        <button class="dropdown_closeButtonText">メニューを閉じる</button>
                    </div>
                </nav>
            </div>
        </header>
        