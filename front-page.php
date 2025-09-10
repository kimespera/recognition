<?php /* Template Name: Front Page */ ?>
<?php get_header(); ?>

<main class="main-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile;
		else :
			echo '<p>No content found.</p>';
		endif;
	?>
</main>

<?php get_footer(); ?>