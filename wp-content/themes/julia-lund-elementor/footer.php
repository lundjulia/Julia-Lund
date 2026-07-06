<?php
/**
 * @package Julia_Lund_Elementor
 */
?>
	<footer class="site-footer">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. Alle rettigheder forbeholdes.</span>
		<ul>
			<li><a href="https://instagram.com">Instagram</a></li>
			<li><a href="https://linkedin.com">LinkedIn</a></li>
			<li><a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Kontakt', 'julia-lund-elementor' ); ?></a></li>
		</ul>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
