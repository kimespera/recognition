<?php get_header(); ?>

<div class="section-block hero-block">
	<img src="<?php echo get_template_directory_uri(); ?>/images/single-hero.jpg" alt="Banner Hexagons">
	<div class="container hero-box">
		<div class="resource-date"><?php echo esc_html(get_the_date('F j, Y')); ?></div>
		<h1><?php the_title(); ?></h1>
		<div class="resource-meta">
			<?php
				$terms = get_the_terms(get_the_ID(), 'resource_category');

				if (!empty($terms) && !is_wp_error($terms)) {

					// Keep only child terms (those that have a parent)
					$child_terms = array_filter($terms, function($t) {
						return !empty($t->parent);
					});

					// If there are child terms, display those; otherwise display whatever terms exist
					$display_terms = !empty($child_terms) ? $child_terms : $terms;

					// Build comma-separated list of linked term names
					$links = array_map(function($t) {
						return '<a href="' . esc_url(get_term_link($t)) . '">' . esc_html($t->name) . '</a>';
					}, $display_terms);

					echo implode(', ', $links);
				}
			?>
		</div>
	</div>
</div>

<main class="single-content">

	<div class="container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('resource-article'); ?>>

				<?php if (has_post_thumbnail()) : ?>
					<div class="resource-featured">
						<?php the_post_thumbnail('full'); ?>
					</div>
				<?php endif; ?>

				<div class="resource-content">
					<?php the_content(); ?>
					<?php echo do_shortcode('[Sassy_Social_Share title="Share:"]') ?>
				</div>

				<!-- <div class="resource-footer">
					<?php
						// the_post_navigation([
						// 	'prev_text' => '← %title',
						// 	'next_text' => '%title →',
						// ]);
					?>
				</div> -->

			</article>

		<?php endwhile; endif; ?>
	</div>
</main>

<?php
	if (!empty($terms) && !is_wp_error($terms)) :
		$term_ids = wp_list_pluck($terms, 'term_id');

		$related_query = new WP_Query([
			'post_type'      => 'resource',
			'posts_per_page' => 3,
			'post__not_in'   => [get_the_ID()],
			'tax_query'      => [[
				'taxonomy' => 'resource_category',
				'field'    => 'term_id',
				'terms'    => $term_ids,
			]],
		]);

		if ($related_query->have_posts()) :
			$first_term     = $terms[0];
			$category_name  = $first_term->name;
			?>
			<section class="related-resources">
				<div class="container">
					<h2 class="related-title">Recent <?php echo esc_html($category_name); ?></h2>

					<div class="resource-grid">
						<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
							<div class="resource-grid__item">
								<div class="resource-card__media">
									<?php if (has_post_thumbnail()) : ?>
										<?php the_post_thumbnail('full'); ?>
									<?php else : ?>
										<img src="<?php echo esc_url(get_template_directory_uri() . '/images/placeholder.jpg'); ?>" alt="Placeholder">
									<?php endif; ?>
								</div>

								<?php
									$card_terms = get_the_terms(get_the_ID(), 'resource_category');
									$badge      = (!empty($card_terms) && !is_wp_error($card_terms)) ? $card_terms[0]->name : '';
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
				</div>
			</section>
		<?php
		endif;
		wp_reset_postdata();
	endif;
?>

<?php
	$cta_banner_heading = get_field('cta_banner_heading', get_the_ID());
	$cta_banner_link = get_field('cta_banner_link', get_the_ID());
	if($cta_banner_heading): ?>
	<div class="section-block ctabanner-block">
		<div class="triangle-gradient"></div>
		<img src="<?php echo get_template_directory_uri(); ?>/images/banner-hex.png" alt="Banner Hexagons">
		<div class="container">
			<h2><?php echo $cta_banner_heading; ?></h2>
			<?php if( $cta_banner_link ): 
				$cta_banner_link_url = $cta_banner_link['url'];
				$cta_banner_link_title = $cta_banner_link['title'];
				$cta_banner_link_target = $cta_banner_link['target'] ? $cta_banner_link['target'] : '_self'; ?>
				<a class="button red" href="<?php echo esc_url( $cta_banner_link_url ); ?>" target="<?php echo esc_attr( $cta_banner_link_target ); ?>"><?php echo esc_html( $cta_banner_link_title ); ?></a>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
