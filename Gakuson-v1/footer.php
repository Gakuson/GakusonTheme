<footer>
            <div class="pc-footer">
            <div class="footer-content">
            <img class="footer-logo" src="<?php echo get_template_directory_uri();?>/icon/NanTopi_logo (5).png">
            <ul class="footer-list">
            <?php
                wp_nav_menu(
                array(
                        'menu' => 'mainmenu',
                        'container' => '',
                        'container_id' => '',
                        'container_class' => 'header-list',
                        'menu_id' => '',
                        'fallback_cb' => ''
                    )
                );
                ?>
            </ul>
            <div class="footer_icon">
                <a class="footer-icon_sns" href="https://www.instagram.com/gakuson25/?igsh=NWd3YW45NG41Yzd2#"><img src="<?php echo get_template_directory_uri();?>/icon/Instagram_Glyph_Gradient.png"></a>
                <a class="footer-icon_sns" href="https://x.com/nanzan_gakuson"><img src="<?php echo get_template_directory_uri();?>/icon/logo-black.png"></a>
                <a class="footer-icon_gakuson" href="https://www.gakuson.com/"><img src="<?php echo get_template_directory_uri();?>/icon/logo.png"></a>
                </div>
            <div class="copy-right">
                <small>&copy;2025 Nanzan Topics !</small>
            </div>
        </div>
    </div>
    <div class="sp-footer">
        <div class="sp-footer-content">
        <ul class="sp-footer-list">
        <?php
                wp_nav_menu(
                array(
                        'menu' => 'mainmenu',
                        'container' => '',
                        'container_id' => '',
                        'container_class' => 'header-list',
                        'menu_id' => '',
                        'fallback_cb' => ''
                    )
                );
                ?>
        </ul>   
            <a href="https://www.gakuson.com/"><img class="sp-footer-logo" src="<?php echo get_template_directory_uri();?>/icon/logo.png"></a>
        </div>
        <div class="sm-copy-right">
            <small>&copy;2025 Nanzan Topics !</small>
        </div>
    </div>
        </footer>
        
    </div>
     <!--オリジナルjs(jquery)-->
     <?php wp_footer();?>
    </body>
    </html>