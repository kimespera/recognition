<?php
	$content = get_field('content');
	$logo_list = get_field('logo_list');
	$main_logo = get_field('main_logo');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block story-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<div class="story-content">
			<?php echo $content; ?>
		</div>
		<?php if( have_rows('logo_list') ): ?>
			<div class="old-logos">
				<?php while( have_rows('logo_list') ): the_row();
					$logo = get_sub_field('logo'); ?>
					<div class="old-logo-item">
						<?php echo wp_get_attachment_image( $logo, 'full' ); ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<div class="new-logo">
			<?php echo wp_get_attachment_image( $main_logo, 'full' ); ?>
		</div>
	</div>
</div>