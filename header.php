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
        </header>