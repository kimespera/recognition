	<?php
		$footer_logo = get_field('footer_logo','option');
		$linkedin_url = get_field('linkedin_url','option');
		$acknowledgement_box = get_field('acknowledgement_box','option');
		$company_info = get_field('company_info','option');
	?>

	<footer id="footer" class="footer section-block">
		<div class="footer-container container">
			<div class="footer-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php echo wp_get_attachment_image($footer_logo, 'full'); ?>
				</a>
			</div>
			<div class="footer-content">
				<div class="footer-content-box">
					<div class="footer-nav">
						<?php
							wp_nav_menu(array(
								'container' => 'nav',
								'link_after' => '<span class="link-border"></span>',
								'menu' => 'Footer Menu',
								'menu_id' => 'footer-menu',
								'menu_class' => 'footer-menu'
							));
						?>
					</div>
					<div class="acknowledgement-box">
						<?php if($linkedin_url): ?>
							<a class="footer-linkedin" href="<?php echo $linkedin_url; ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
						<?php endif; ?>
						<div class="acknowledgement">
							<?php echo $acknowledgement_box; ?>
						</div>
					</div>
				</div>
				<div class="footer-info">
					<p><?php echo $company_info; ?></p>
					<?php
						wp_nav_menu(array(
							'container' => 'nav',
							'menu' => 'Policies',
							'menu_id' => 'policies-menu',
							'menu_class' => 'policies-menu'
						));
					?>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>