<?php
require_once 'vendor/autoload.php';
require_once 'acf.php';
$asset_path = get_stylesheet_directory_uri() . '/assets/build';

//styles
$fontawesome_css = new \App\WordPress\Stylesheet('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
$slick_css = new \App\WordPress\Stylesheet('slick', $asset_path . '/../lib/slick/slick/slick.css');
$slick_theme_css = new \App\WordPress\Stylesheet('slick-theme', $asset_path . '/../lib/slick/slick/slick-theme.css', ['slick']);
$foundation_css = new \App\WordPress\Stylesheet('foundation',  $asset_path . '/stylesheets/app.css', ['slick-theme']);

//scripts
$slick_js = new \App\WordPress\Script('slick', $asset_path . '/../lib/slick/slick/slick.js', ['jquery']);
$foundation_js = new \App\WordPress\Script('foudnation', $asset_path . '/js/app.js', ['slick']);

if(function_exists('acf_add_options_page'))
{
    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

add_action('wp_enqueue_scripts', function() use($fontawesome_css, $slick_css, $slick_theme_css, $foundation_css, $slick_js, $foundation_js) {
    $fontawesome_css->register();
    $slick_css->register();
    $slick_theme_css->register();
    $foundation_css->register();
    $slick_js->register();
    $foundation_js->register();
});

add_action( 'init', function() {
    register_nav_menu( 'primary', __( 'Primary Menu' ) );
    add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );
    add_theme_support( 'admin-bar', array( 'callback' => '__return_false') );
});