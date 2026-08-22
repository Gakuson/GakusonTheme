<footer class="l-footer" id="footer">
    <div class="footer_inner">
        <h2 class="footer_title">Nanzan Topics!</h2>
        <div class="footer_main">
            <ul class="footer_list" aria-label="Nanzan Topics social links">
                <li class="footer_item">
                    <a class="footer_itemLink footer_itemLink__instagram" href="<?php echo esc_url('https://www.instagram.com/gakuson24/'); ?> " aria-label="Instagram">
                        <img class="footer_itemIcon" src="<?php echo esc_url( get_template_directory_uri() . '/icon/InstagramIcon.png' ); ?>" alt="" aria-hidden="true">
                    </a>
                </li>
                <li class="footer_item">
                    <a class="footer_itemLink footer_itemLink__x" href="<?php echo esc_url('https://x.com/nanzan_gakuson'); ?> " aria-label="X">
                        <img class="footer_itemIcon" src="<?php echo esc_url( get_template_directory_uri() . '/icon/xIcon.png' ); ?>" alt="" aria-hidden="true">
                    </a>
                </li>
                <li class="footer_item footer_item__gakuson">
                    <a class="footer_itemLink footer_itemLink__gakuson" href="<?php echo esc_url( 'https://gakuson.com/' ); ?>" aria-label="がくそん公式サイト">
                        <img class="footer_itemIcon footer_itemIcon__gakuson" src="<?php echo esc_url( get_template_directory_uri() . '/icon/logo.png' ); ?>" alt="" aria-hidden="true">
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer_copyRight">
            <small>&copy;<?php echo esc_html( wp_date( 'Y' ) ); ?> Nanzan Topics!</small>
        </div>
    </div>
</footer>        
<?php wp_footer();?>
</body>
</html>
