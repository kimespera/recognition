<?php
	$heading = get_field('heading');
	$subheading = get_field('subheading');
	$color_mode = get_field('color_mode');
	$column_count = get_field('column_count');
	$column_content_alignment = get_field('column_content_alignment');
	$item_list = get_field('item_list');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block icontext-block';
	$class_name .= ' ' . $color_mode;
	$class_name .= ' ' . $column_count;
	$class_name .= ' ' . $column_content_alignment;

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
		<?php if( have_rows('item_list') ): ?>
			<div class="icon-list">
				<?php while( have_rows('item_list') ): the_row();
					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					$description = get_sub_field('description');
					$link = get_sub_field('link'); ?>
					<?php if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self'; ?>
						<a class="icon-item" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
							<?php echo wp_get_attachment_image( $icon, 'full' ); ?>
							<h3><?php echo $title; ?></h3>
							<p><?php echo $description; ?></p>
						</a>
					<?php else: ?>
						<div class="icon-item">
							<?php echo wp_get_attachment_image( $icon, 'full' ); ?>
							<h3><?php echo $title; ?></h3>
							<p><?php echo $description; ?></p>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>