<?php
	$heading = get_field('heading');
	$link = get_field('link');
	$background_image = get_field('background_image');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block hero-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<?php echo wp_get_attachment_image($background_image, 'full'); ?>
	<div class="container hero-box">
		<h1><?php echo $heading; ?></h1>
		<?php if( $link ): 
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self'; ?>
			<a class="button red" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
		<?php endif; ?>
	</div>
</div>