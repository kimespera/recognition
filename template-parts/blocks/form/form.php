<?php
	$content = get_field('content');
	$form_code = get_field('form_code');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block form-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container form-box">
		<div class="form-content"><?php echo $content; ?></div>
		<div class="form-code"><?php echo $form_code; ?></div>
	</div>
</div>