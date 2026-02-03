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
                <div class="header_mainContent">
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
                    <button class="headerMain_humburgerContainer" aria-label="メニューを開く" aria-expanded="true">
                        <div class="headerMain_hamburger">
                            <span class="hamburgerLine hamburgerLine__1"></span>
                            <span class="hamburgerLine hamburgerLine__2"></span>
                            <span class="hamburgerLine hamburgerLine__3"></span>
                        </div>
                    </button>
                </div>
            </div>
            <div class="dropdown-wrapper">   
                <nav class="dropdown">
                <?php
                // フィルタ処理は functions.php に移動しました
        
                wp_nav_menu(
                array(
                    'menu' => 'mainmenu',
                    'container' => '',
                    'container_id' => '',
                    'container_class' => 'headerMain_list',
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