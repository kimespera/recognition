<?php
	$heading = get_field('heading');
	$subheading = get_field('subheading');
	$cards = get_field('cards');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block imgcards-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<h2 class="heading"><?php echo $heading; ?></h2>
		<p class="subheading"><?php echo $subheading; ?></p>
		<?php if( have_rows('cards') ): ?>
			<div class="cards">
				<?php while( have_rows('cards') ): the_row();
					$color_mode = get_sub_field('color_mode');
					$image = get_sub_field('image');
					$heading = get_sub_field('heading');
					$description = get_sub_field('description');
					$link = get_sub_field('button'); ?>
					<div class="card-item">
						<div class="card-content">
							<h3 class="<?php echo $color_mode; ?>"><?php echo $heading ?></h3>
							<?php echo $description; ?>
							<?php if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self'; ?>
								<a class="button <?php echo $color_mode; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
						</div>
						<div class="card-image">
							<?php echo wp_get_attachment_image( $image, 'full' ); ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>