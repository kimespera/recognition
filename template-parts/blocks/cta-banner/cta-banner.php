<?php
	$heading = get_field('heading');
	$button = get_field('button');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block ctabanner-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="triangle-gradient"></div>
	<img src="<?php echo get_template_directory_uri(); ?>/images/hex.png" alt="Banner Hexagons">
	<div class="container">
		<h2><?php echo $heading; ?></h2>
		<?php if( $button ): 
			$button_url = $button['url'];
			$button_title = $button['title'];
			$button_target = $button['target'] ? $button['target'] : '_self'; ?>
			<a class="button red" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
		<?php endif; ?>
	</div>
</div>