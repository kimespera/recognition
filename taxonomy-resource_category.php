<?php
get_header();

$term = get_queried_object(); // current taxonomy term

// Get the selected subcategory from the URL (?subcat=sub-slug)
$selected_sub = isset($_GET['subcat']) ? sanitize_text_field($_GET['subcat']) : '';

// Get all subcategories of the current category
$subcategories = get_terms([
	'taxonomy'   => 'resource_category',
	'parent'     => $term->term_id,
	'hide_empty' => false,
	'orderby'    => 'name',
	'order'      => 'ASC',
]);

// Build the query for posts
$args = [
	'post_type'      => 'resource',
	'posts_per_page' => -1, // you can control number of posts here
	'tax_query'      => [[
		'taxonomy' => 'resource_category',
		'field'    => 'term_id',
		'terms'    => $term->term_id,
		'include_children' => true,
	]],
];

// If a subcategory is selected, filter by that instead
if ($selected_sub !== '') {
	$args['tax_query'][0] = [
		'taxonomy' => 'resource_category',
		'field'    => 'slug',
		'terms'    => $selected_sub,
	];
}

$query = new WP_Query($args);

$featured_image = get_field('featured_image', 'term_' . $term->term_id);
$hero_link = get_field('hero_link', 'term_' . $term->term_id);
$cta_banner_heading = get_field('cta_banner_heading', 'term_' . $term->term_id);
$cta_banner_link = get_field('cta_banner_link', 'term_' . $term->term_id);
?>

<div class="resource-category">
	<div class="section-block hero-block">
		<?php echo wp_get_attachment_image($featured_image, 'full'); ?>
		<div class="container hero-box">
			<h1><?php echo esc_html($term->name ?? 'Resources'); ?></h1>
			<?php if (!empty($term->description)) : ?>
				<p class="page-description"><?php echo esc_html(wp_strip_all_tags($term->description)); ?></p>
			<?php endif; ?>
			<?php if( $hero_link ): 
				$hero_link_url = $hero_link['url'];
				$hero_link_title = $hero_link['title'];
				$hero_link_target = $hero_link['target'] ? $hero_link['target'] : '_self'; ?>
				<a class="button red" href="<?php echo esc_url( $hero_link_url ); ?>" target="<?php echo esc_attr( $hero_link_target ); ?>"><?php echo esc_html( $hero_link_title ); ?></a>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="tax-resources">
		<div class="container">
			<!-- Dropdown filter -->
			<?php if (!empty($subcategories)) : ?>
				<form method="get" id="subcategory-filter" class="subcategory-filter">
					<label for="subcat" class="screen-reader-text">Filter by subcategory</label>
					<select id="subcat" name="subcat" onchange="document.getElementById('subcategory-filter').submit();">
						<option value="">View news about...</option>
						<?php foreach ($subcategories as $sub) : ?>
							<option value="<?php echo esc_attr($sub->slug); ?>"
								<?php selected($selected_sub, $sub->slug); ?>>
								<?php echo esc_html($sub->name); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</form>
			<?php endif; ?>

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
							$badge = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : ($term->name ?? '');
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
			<?php else : ?>
				<p>No posts found in <?php echo esc_html($selected_sub ? $selected_sub : $term->name); ?>.</p>
			<?php endif; ?>

		</div>
	</div>
	
	<?php if($cta_banner_heading): ?>
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
</div>

<?php
wp_reset_postdata();
get_footer();
