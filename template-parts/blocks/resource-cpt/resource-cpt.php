<?php
	$heading = get_field('heading');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'section-block resourcecpt-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<?php
		// Inside your custom block template file
		$title     = get_field('title') ?: 'Resources';
		$per_term  = get_field('posts_per_category') ?: 3;
		$hide_empty = false;

		$cats = get_terms([
			'taxonomy'   => 'resource_category',
			'hide_empty' => $hide_empty,
			'parent'     => 0,
			'orderby'    => 'name',
			'order'      => 'ASC',
		]);
	?>

	<div class="resources-block">
		<?php if (!is_wp_error($cats) && $cats) : ?>
			<?php foreach ($cats as $cat) :
				$q = new WP_Query([
					'post_type'      => 'resource',
					'posts_per_page' => $per_term,
					'no_found_rows'  => true,
					'tax_query'      => [[
						'taxonomy'         => 'resource_category',
						'field'            => 'term_id',
						'terms'            => $cat->term_id,
						'include_children' => true,
					]],
				]); ?>
				
				<section class="resource-section">
					<div class="container">
						<header class="resource-section__head">
							<h3 class="resource-section__title"><?php echo esc_html($cat->name); ?></h3>
							<?php if (!empty($cat->description)) : ?>
								<p class="resource-section__desc"><?php echo esc_html(wp_strip_all_tags($cat->description)); ?></p>
							<?php endif; ?>
						</header>

						<?php if ($q->have_posts()) : ?>
							<div class="resource-grid">
								<?php while ($q->have_posts()) : $q->the_post(); ?>
									<div class="resource-grid__item">
										<div class="resource-card__media">
											<?php if (has_post_thumbnail()) {
												the_post_thumbnail('medium_large');
											} else { ?>
												<img src="<?php echo esc_url(get_template_directory_uri() . '/images/placeholder.jpg'); ?>" alt="Placeholder">
											<?php } ?>
										</div>

										<div class="resource-card__badge"><?php echo esc_html($cat->name); ?></div>
										<div class="resource-card__body">
											<div class="resource-card__date"><?php echo esc_html(get_the_date('F j, Y')); ?></div>
											<h4 class="resource-card__title"><?php the_title(); ?></h4>
											<a class="resource-card__link" href="<?php the_permalink(); ?>">Read more</a>
										</div>
									</div>
								<?php endwhile; wp_reset_postdata(); ?>
							</div>

							<div class="resource-section__footer">
								<a class="resource-view-all button red" href="<?php echo esc_url(get_term_link($cat)); ?>">
									Read all <?php echo esc_html(strtolower($cat->name)); ?>
								</a>
							</div>
						<?php else : ?>
							<p>No posts found in <?php echo esc_html($cat->name); ?>.</p>
						<?php endif; ?>
					</div>
				</section>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="container">No categories found.</p>
		<?php endif; ?>
	</div>
</div>