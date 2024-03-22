<?php
/**
 * umova functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package umova
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
function umova_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Breket second, use a find and replace
		* to change 'breket_second' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'umova', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'breket_second' ),
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
			'breket_second_custom_background_args',
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
add_action( 'after_setup_theme', 'breket_second_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function umova_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'umova_content_width', 640 );
}
add_action( 'after_setup_theme', 'umova_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

// ACF Pro Options Page

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

}

function my_custom_scripts() {
    wp_enqueue_script('my-ajax-script', get_template_directory_uri() . '/js/my-ajax-script.js', array('jquery'));
    wp_localize_script('my-ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'my_custom_scripts');

function my_ajax_function() {
    $to = 'farerskyidev@gmail.com';

    $form_data = isset($_POST['data']) ? $_POST['data'] : '';
    parse_str($form_data, $form_array);
    $name = isset($form_array['name']) ? sanitize_text_field($form_array['name']) : '';
    $email = isset($form_array['email']) ? sanitize_email($form_array['email']) : '';
    $phone = isset($form_array['phone']) ? sanitize_text_field($form_array['phone']) : '';
    $password = isset($form_array['password']) ? $_POST['password'] : '';
    $city = isset($form_array['city']) ? sanitize_text_field($form_array['city']) : '';

    $subject = 'Новий запит з форми';
    $message = "<p><strong>Ім'я:</strong> $name</p><p><strong>Електронна пошта:</strong> $email</p><p><strong>Телефон:</strong> $phone</p><p><strong>Місто:</strong> $city</p><p><strong>Пароль:</strong> $password</p>";

    $headers[] = 'Content-Type: text/html; charset=UTF-8';

    wp_mail($to, $subject, $message, $headers);

    echo 'Дякуємо за ваш запит!';
    die();
}


add_action('wp_ajax_my_ajax_action', 'my_ajax_function');
add_action('wp_ajax_nopriv_my_ajax_action', 'my_ajax_function');


/**
 * Enqueue scripts and styles.
 */
function umova_scripts_and_stryles () {
	wp_style_add_data( 'umova-style', 'rtl', 'replace' );

    wp_enqueue_style('style-umova', get_template_directory_uri() . '/sass/main.css', null, null);

	wp_enqueue_script( 'umova-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'umova_scripts_and_stryles' );
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

function my_acf_block_render_callback( $block ) {

    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/template-parts/block/content-{$slug}.php") ) ) {
        include( get_theme_file_path("/template-parts/block/content-{$slug}.php") );
    }
}