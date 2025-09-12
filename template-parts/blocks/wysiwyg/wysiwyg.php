<?php
	$wysiwyg = get_field('wysiwyg');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block wysiwyg-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<div class="wysiwyg-box"><?php echo $wysiwyg; ?></div>
	</div>
</div>