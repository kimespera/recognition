<?php
	$heading = get_field('heading');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block custompost-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<h2><?php echo esc_html($heading); ?></h2>

		<?php
		// Get selected posts (ACF Post Object field)
		$selected_posts = get_field('select_a_post');

		if ($selected_posts) :
			// Normalize to array of IDs
			$post_ids = array_map(function($p) {
				return is_object($p) ? $p->ID : (int) $p;
			}, $selected_posts);

			$query = new WP_Query([
				'post_type'      => 'resource',
				'post__in'       => $post_ids,
				'orderby'        => 'post__in',
				'posts_per_page' => -1,
				'no_found_rows'  => true,
			]);
		?>

			<?php if ($query->have_posts()) : ?>
				<div class="resource-grid">
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<div class="resource-grid__item">
							<div class="resource-card__media">
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('medium_large'); ?>
								<?php else : ?>
									<img src="<?php echo esc_url(get_template_directory_uri() . '/images/placeholder.jpg'); ?>" alt="Placeholder">
								<?php endif; ?>
							</div>

							<?php
							$terms = get_the_terms(get_the_ID(), 'resource_category');
							$badge = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : '';
							?>
							<div class="resource-card__badge"><?php echo esc_html($badge); ?></div>

							<div class="resource-card__body">
								<div class="resource-card__date"><?php echo esc_html(get_the_date('F j, Y')); ?></div>
								<h4 class="resource-card__title"><?php the_title(); ?></h4>
								<a class="resource-card__link" href="<?php the_permalink(); ?>">Read more</a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

		<?php else : ?>
			<p>No posts selected.</p>
		<?php endif; ?>
	</div>
</div>
