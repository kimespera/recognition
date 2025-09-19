<?php
/**
 * recognition functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package recognition
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function recognition_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on recognition, use a find and replace
		* to change 'recognition' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'recognition', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'recognition' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'recognition_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'recognition_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function recognition_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'recognition_content_width', 640 );
}
add_action( 'after_setup_theme', 'recognition_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function recognition_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'recognition' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'recognition' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'recognition_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function recognition_scripts() {
	wp_enqueue_style( 'recognition-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/all.css', array(), _S_VERSION );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), _S_VERSION );
	wp_style_add_data( 'recognition-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script( 'recognition-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery' ), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'recognition_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action('after_setup_theme', function () {
	register_nav_menus([
		'primary' => __('Primary Menu', 'mytheme'),
	]);
});

function custom_style_formats( $init_array ) {
	$init_array['block_formats'] = 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Preformatted=pre';
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'custom_style_formats' );

function register_acf_block_types() {

	// Hero Block
	acf_register_block_type(array(
		'name'              => 'hero',
		'title'             => __('Hero Custom Block'),
		'description'       => __('A custom hero block. This block is designed to be used only once per page to maintain proper SEO structure and prevent multiple H1 headings on the same page.'),
		'category'          => 'common',
		'icon'              => 'heading',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/hero/hero.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/hero/hero.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => false
		),
		'keywords'          => array('title', 'headline', 'hero'),
	));

	// Two Columns Block
	acf_register_block_type(array(
		'name'              => 'two-columns',
		'title'             => __('Two Columns Custom Block'),
		'description'       => __('A custom two columns block.'),
		'category'          => 'common',
		'icon'              => 'image-flip-horizontal',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/two-columns/two-columns.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/two-columns/two-columns.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('two', 'column'),
	));

	// Logo Slider Block
	acf_register_block_type(array(
		'name'              => 'logo-slider',
		'title'             => __('Logo Slider Custom Block'),
		'description'       => __('A custom logo slider block.'),
		'category'          => 'common',
		'icon'              => 'ellipsis',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/logo-slider/logo-slider.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/logo-slider/logo-slider.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('logo', 'slider', 'slide'),
	));

	// Icon and Text Block
	acf_register_block_type(array(
		'name'              => 'icon-text',
		'title'             => __('Icon and Text Custom Block'),
		'description'       => __('A custom icon and text block.'),
		'category'          => 'common',
		'icon'              => 'editor-aligncenter',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/icon-text/icon-text.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/icon-text/icon-text.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('icon', 'text'),
	));

	// Image Tiles Block
	acf_register_block_type(array(
		'name'              => 'image-tiles',
		'title'             => __('Image Tiles Custom Block'),
		'description'       => __('A custom image tiles block.'),
		'category'          => 'common',
		'icon'              => 'images-alt',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/image-tiles/image-tiles.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/image-tiles/image-tiles.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('image', 'tiles'),
	));

	// Testimonials Block
	acf_register_block_type(array(
		'name'              => 'testimonials',
		'title'             => __('Testimonials Custom Block'),
		'description'       => __('A custom testimonials block.'),
		'category'          => 'common',
		'icon'              => 'format-status',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/testimonials/testimonials.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/testimonials/testimonials.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('testimonial'),
	));

	// Form Block
	acf_register_block_type(array(
		'name'              => 'form',
		'title'             => __('Form Custom Block'),
		'description'       => __('A custom form block.'),
		'category'          => 'common',
		'icon'              => 'forms',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/form/form.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/form/form.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('form'),
	));

	// WYSIWYG Block
	acf_register_block_type(array(
		'name'              => 'wysiwyg',
		'title'             => __('WYSIWYG Custom Block'),
		'description'       => __('A custom wysiwyg block.'),
		'category'          => 'common',
		'icon'              => 'text',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/wysiwyg/wysiwyg.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/wysiwyg/wysiwyg.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('wysiwyg', 'text editor'),
	));

	// Button List Block
	acf_register_block_type(array(
		'name'              => 'button-list',
		'title'             => __('Button List Custom Block'),
		'description'       => __('A custom button list block.'),
		'category'          => 'common',
		'icon'              => 'button',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/button-list/button-list.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/button-list/button-list.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('button', 'list'),
	));

	// CTA Banner
	acf_register_block_type(array(
		'name'              => 'cta-banner',
		'title'             => __('CTA Banner Custom Block'),
		'description'       => __('A custom cta banner block.'),
		'category'          => 'common',
		'icon'              => 'align-wide',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/cta-banner/cta-banner.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/cta-banner/cta-banner.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('cta', 'banner'),
	));

	// Image Cards
	acf_register_block_type(array(
		'name'              => 'image-cards',
		'title'             => __('Image Cards Custom Block'),
		'description'       => __('A custom image cards block.'),
		'category'          => 'common',
		'icon'              => 'format-image',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/image-cards/image-cards.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/image-cards/image-cards.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('image', 'card'),
	));

	// Story
	acf_register_block_type(array(
		'name'              => 'story',
		'title'             => __('Story Custom Block'),
		'description'       => __('A custom story block.'),
		'category'          => 'common',
		'icon'              => 'networking',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/story/story.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/story/story.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => true
		),
		'keywords'          => array('story'),
	));
}

if ( function_exists('acf_register_block_type') ) {
	add_action('acf/init', 'register_acf_block_types');
}

// HEAD (global)
add_action('wp_head', function () {
	if ( ! current_user_can('unfiltered_html') ) return;
	$code = get_field('header_scripts', 'option');
	if ($code) {
		echo "\n<!-- ACF: Header Scripts -->\n{$code}\n<!-- /ACF: Header Scripts -->\n";
	}
}, 20);

// RIGHT AFTER <body> (for GTM <noscript>, etc.)
add_action('wp_body_open', function () {
	if ( ! current_user_can('unfiltered_html') ) return;
	$code = get_field('body_open_scripts', 'option');
	if ($code) {
		echo "\n<!-- ACF: Body Open Scripts -->\n{$code}\n<!-- /ACF: Body Open Scripts -->\n";
	}
}, 10);

// FOOTER (global)
add_action('wp_footer', function () {
	if ( ! current_user_can('unfiltered_html') ) return;
	$code = get_field('footer_scripts', 'option');
	if ($code) {
		echo "\n<!-- ACF: Footer Scripts -->\n{$code}\n<!-- /ACF: Footer Scripts -->\n";
	}
}, 20);