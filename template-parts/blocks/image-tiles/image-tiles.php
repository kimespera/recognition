<?php
	$heading = get_field('heading');
	$subheading = get_field('subheading');
	$image_tiles = get_field('image_tiles');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block imagetiles-block';

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
		<?php if( have_rows('image_tiles') ): ?>
			<div class="image-tiles">
				<?php while( have_rows('image_tiles') ): the_row(); 
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$link = get_sub_field('link');
					$button_color = get_sub_field('button_color'); ?>
					<div class="tile-item">
						<?php echo wp_get_attachment_image( $image, 'full' ); ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>