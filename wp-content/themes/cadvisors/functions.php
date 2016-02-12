<?php
require_once 'vendor/autoload.php';

$asset_path = get_stylesheet_directory_uri() . '/assets/build';


//styles
$slick_css = new \App\WordPress\Stylesheet('slick', $asset_path . '/../lib/slick/slick/slick.css');
$slick_theme_css = new \App\WordPress\Stylesheet('slick-theme', $asset_path . '/../lib/slick/slick/slick-theme.css', ['slick']);
$foundation_css = new \App\WordPress\Stylesheet('foundation',  $asset_path . '/stylesheets/app.css', ['slick-theme']);

//scripts
$slick_js = new \App\WordPress\Script('slick', $asset_path . '/../lib/slick/slick/slick.js', ['jquery']);
$foundation_js = new \App\WordPress\Script('foudnation', $asset_path . '/js/app.js', ['slick']);

add_action('wp_enqueue_scripts', function() use($slick_css, $slick_theme_css, $foundation_css, $slick_js, $foundation_js) {
    $slick_css->register();
    $slick_theme_css->register();
    $foundation_css->register();
    $slick_js->register();
    $foundation_js->register();
});

add_action( 'init', function() {
    register_nav_menu( 'primary', __( 'Primary Menu' ) );
    add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );
});
