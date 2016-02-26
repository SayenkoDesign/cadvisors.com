<?php
require_once 'vendor/autoload.php';

use App\App;
use App\Provider\TwigProvider;

$app = new App([
    'debug' => WP_DEBUG,
    'twig.paths' => __DIR__ . '/views',
    'asset_path' => get_stylesheet_directory_uri() . '/assets/build',
]);
$app->register(new TwigProvider());

// prep data used on all pages
$data = [
    'WP' => new \App\Twig\WordPress(),
    'ACF' => new \App\Twig\AdvancedCustomFields(),
    'Post' => new \App\Twig\Post(),
];

// select template and load template specific data
setup_postdata($post);
if(is_front_page()) {
    $template = 'pages/home.html.twig';
} else if(is_single()) {
    $template = 'pages/article.html.twig';
} else if (is_home()) {
    global $wp_query;
    $template = 'pages/archives.html.twig';
    $data['large_background'] = get_field('large_background', get_option('page_for_posts'));
    $data['small_background'] = get_field('small_background', get_option('page_for_posts'));
    while(have_posts()) {
        the_post();
        $data['posts'][] = $app['twig']->render('posts-types/post.html.twig', [
            'WP' => new \App\Twig\WordPress(),
            'ACF' => new \App\Twig\AdvancedCustomFields(),
            'Post' => new \App\Twig\Post(),
        ]);
    }
    wp_reset_query();
} else if (get_page_template_slug() == 'template-alt-landing-page.php') {
    $template = 'pages/home-alt.html.twig';
} else if (get_page_template_slug() == 'template-cyber.php') {
    $template = 'pages/cyber.html.twig';
} else if (get_page_template_slug() == 'template-expertise.php') {
    $template = 'pages/expertise.html.twig';
} else if (get_page_template_slug() == 'template-landing-page.php') {
    $template = 'pages/home.html.twig';
} else {
    $template = 'layout/page.html.twig';
}

// render
$app->render($template, $data);