<?php
	$color_mode = get_field('color_mode');
	$image_position = get_field('image_position');
	$image_type = get_field('image_type');
	$image = get_field('image');
	$content = get_field('content');
	$link = get_field('link');
	$block_shadow = get_field('block_shadow');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block towcol-block';
	$class_name .= ' ' . $color_mode;
	$class_name .= ' ' . $image_position;
	$class_name .= ' ' . $image_type;
	$class_name .= ' ' . $block_shadow;

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container twocol-box">
		<div class="twocol-img">
			<?php echo wp_get_attachment_image($image, 'full'); ?>
		</div>
		<div class="twocol-content">
			<?php echo $content; ?>
			<?php if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self'; ?>
				<a class="button red" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>