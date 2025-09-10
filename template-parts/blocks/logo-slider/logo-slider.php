<?php
	$heading = get_field('heading');
	$logo_list = get_field('logo_list');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block logoslider-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<h2><?php echo $heading; ?></h2>
		<?php if( have_rows('logo_list') ): ?>
			<div class="logo-list">
				<?php while( have_rows('logo_list') ): the_row(); 
					$image = get_sub_field('image'); ?>
					<div class="logo-item">
						<?php echo wp_get_attachment_image( $image, 'full' ); ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>