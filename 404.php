<?php get_header(); ?>

	<main class="main-content error-404 not-found">
		<div class="container">
			<h1>404</h1>
			<h2>Page not found.</h2>
			<a class="button red" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Back To Homepage</a>
		</div>
	</main>

<?php get_footer(); ?>