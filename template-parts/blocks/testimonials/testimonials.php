<?php
	$heading = get_field('heading');
	$testimonials_list = get_field('testimonials_list');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block testimonials-block';

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
		<?php if( have_rows('testimonials_list') ): ?>
			<div class="testimonials">
				<?php while( have_rows('testimonials_list') ): the_row(); 
					$testimonial = get_sub_field('testimonial');
					$author = get_sub_field('author'); ?>
					<div class="testimonial">
						<p><?php echo $testimonial; ?></p>
						<p><b><?php echo $author; ?></b></p>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>