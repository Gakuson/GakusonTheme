<footer id="footer" class="l-footer">
    <div class="footer_content">
        <div class="pcFooter">
            <img class="pcFooter_logo__nantopi" src="<?php echo get_template_directory_uri();?>/icon/NanTopi_logo (5).png">
            <ul class="pcFooter_list">
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
            <div class="pcFooter_textIcon">
                <a class="pcFooter_logo__sns" href="https://www.instagram.com/gakuson25/?igsh=NWd3YW45NG41Yzd2#"><img src="<?php echo get_template_directory_uri();?>/icon/Instagram_Glyph_Gradient.png"></a>
                <a class="pcFooter_logo__sns" href="https://x.com/nanzan_gakuson"><img src="<?php echo get_template_directory_uri();?>/icon/logo-black.png"></a>
                <a class="pcFooter_logo__gakuson" href="https://www.gakuson.com/"><img src="<?php echo get_template_directory_uri();?>/icon/logo.png"></a>
                </div>
            <div class="pcFooter_copyRight">
                <small>&copy;2025 Nanzan Topics !</small>
            </div>
        </div>
        <div class="spFooter">
            <div class="spFooter_content">
                <div class="spFooter_list">
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
                </div>   
                <a href="https://www.gakuson.com/"><img class="spFooter_logo__nantopi" src="<?php echo get_template_directory_uri();?>/icon/logo.png"></a>
            </div>
            <div class="spFooter_copyRight">
                <small>&copy;2025 Nanzan Topics !</small>
            </div>
        </div>
    </div>
</footer>        
<?php wp_footer();?>
</body>
</html>