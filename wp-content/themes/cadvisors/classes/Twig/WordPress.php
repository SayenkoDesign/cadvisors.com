<?php
namespace App\Twig;

class WordPress
{
    public function header()
    {
        ob_start();
        wp_head();
        return ob_get_clean();
    }

    public function footer()
    {
        ob_start();
        wp_footer();
        return ob_get_clean();
    }

    public function site_uri()
    {
        return get_site_url();
    }

    public function nav_menu($args = [])
    {
        $args['echo'] = false;
        return wp_nav_menu($args);
    }

    public function body_class()
    {
        return join( ' ', get_body_class() );
    }
}