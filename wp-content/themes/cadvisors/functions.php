<?php
require_once 'vendor/autoload.php';
require_once 'acf.php';
$asset_path = get_stylesheet_directory_uri() . '/assets/build';

//styles
$foundation_css = new \App\WordPress\Stylesheet('foundation',  $asset_path . '/stylesheets/app.css');

//scripts
$foundation_js = new \App\WordPress\Script('foudnation', $asset_path . '/js/app.min.js');

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

add_action('wp_enqueue_scripts', function() use($foundation_css, $foundation_js) {
    $foundation_css->register();
    $foundation_js->register();
});

add_action( 'init', function() {
    register_nav_menu( 'primary', __( 'Primary Menu' ) );
    add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );
    add_theme_support( 'admin-bar', array( 'callback' => '__return_false') );
});

add_action('wp_dashboard_setup', function () {
    wp_add_dashboard_widget(
        'referral_dashboard_widget',
        'RECEIVE $500 in CASH FOR A WEBSITE REFERRAL!!',
        function () {
            echo <<<HTML
                <a href='http://www.sayenkodesign.com'>
                    <img alt='Seattle Web Design' src='http://www.sayenkodesign.com/wp-content/uploads/2014/08/Sayenko-Design-WP-Referral-Bonus-460.jpg' width='100%'>
                </a>
                </br>
                </br>
                Simply introduce us via email along with the prospects phone number.
                Email introductions can be sent to
                <a href='mailto:mike@sayenkodesign.com'>mike@sayenkodesign.com</a>
HTML;
        }
    );
});