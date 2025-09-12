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
		<p><?php echo $subheading; ?></p>
		<?php if( have_rows('image_tiles') ): ?>
			<div class="image-tiles">
				<?php while( have_rows('image_tiles') ): the_row(); 
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$link = get_sub_field('link');
					$button_color = get_sub_field('button_color'); ?>
					<div class="tile-item">
						<div class="tile-img"><?php echo wp_get_attachment_image( $image, 'full' ); ?></div>
						<h3><?php echo $title; ?></h3>
						<?php if( $link ): 
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self'; ?>
							<a class="button <?php echo $button_color; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>