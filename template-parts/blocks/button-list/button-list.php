<?php
	$image_position = get_field('image_position');
	$image_type = get_field('image_type');
	$heading = get_field('heading');
	$buttons = get_field('buttons');
	$image = get_field('image');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block buttons-block';
	$class_name .= ' ' . $image_position;
	$class_name .= ' ' . $image_type;

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container buttons-wrap">
		<div class="button-img">
			<?php echo wp_get_attachment_image($image, 'full'); ?>
		</div>
		<div class="buttons-box">
			<h2><?php echo $heading; ?></h2>
			<?php if( have_rows('buttons') ): ?>
				<div class="button-list">
					<?php while( have_rows('buttons') ): the_row();
						$link = get_sub_field('button'); ?>
						<div class="button-item">
							<?php if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self'; ?>
								<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>