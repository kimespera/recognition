<?php get_header(); ?>

<div class="all-resources">
	<div class="archive-title">
		<div class="container">
			<h1 class="page-title">Resources</h1>
		</div>
	</div>

	<?php
	$cats = get_terms([
		'taxonomy'   => 'resource_category',
		'hide_empty' => false,
		'parent'     => 0,
		'orderby'    => 'name',
		'order'      => 'ASC',
	]);

	if (!is_wp_error($cats) && $cats) :
		foreach ($cats as $cat) :
			$q = new WP_Query([
			'post_type'      => 'resource',
			'posts_per_page' => 3,
			'tax_query'      => [[
				'taxonomy'         => 'resource_category',
				'field'            => 'term_id',
				'terms'            => $cat->term_id,
				'include_children' => true,
			]],
				'no_found_rows'   => true,
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
										<?php
											if (has_post_thumbnail()) {
												the_post_thumbnail('medium_large');
											} else {
										?>
											<img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" alt="Placeholder">
										<?php } ?>

										
									</div>
									<?php
										$terms = get_the_terms(get_the_ID(), 'resource_category');
										$badge = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : $cat->name;
									?>
									<div class="resource-card__badge"><?php echo esc_html($badge); ?></div>
									<div class="resource-card__body">
										<div class="resource-card__date">
											<?php echo esc_html(get_the_date('F j, Y')); ?>
										</div>
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
		<?php endforeach;
		else :
			echo '<p>No categories found.</p>';
		endif;
	?>
</div>

<?php get_footer(); ?>