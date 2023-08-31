<?php

namespace App;

use App\Base\Singleton;
use App\PostType\Reviews;
use App\Taxonomy\ReviewsCategory;
use App\Translation\Translation;


/**
 * Core theme class
 *
 * @package App
 * @method static Theme getInstance()
 * @var Theme $instance
 */
final class Theme extends Singleton
{
    /**
     * Core constructor.
     */
    protected function __construct()
    {
        parent::__construct();

        add_action('init', [$this, 'themeSetup']);
        add_action('wp_enqueue_scripts', [$this, 'themeEnqueueScripts']);
        add_action('after_setup_theme', [$this, 'registerNavMenus']);
        add_filter('upload_mimes', [$this, 'registerMimeTypes']);
        add_action('init', [Translation::class, 'registerString']);
        add_filter('theme_mod_copyright_text', [$this, 'copyright']);

            $this->postTypeSetup();

    }

    public function themeSetup(): void
    {

        add_theme_support('menus');
        add_theme_support('widgets');
        add_theme_support('custom-logo');
        add_theme_support('post-thumbnails');

        # Example of image sizes:
        add_image_size('hd-size', 1920, 1080, ['center', 'center']);

    }

    public function postTypeSetup():void
    {

        /**
         * Post type Reviews
         */
        new Reviews();
        new ReviewsCategory();

    }

    public function themeEnqueueScripts(): void
    {

        wp_enqueue_style( 'tbc-style', get_stylesheet_directory_uri() . '/dist/app.css' );
        wp_enqueue_script( 'tbc-script', get_stylesheet_directory_uri() . '/dist/app.js', [], '1.0.0', true);

    }

    public function registerNavMenus(): void
    {

        $menus = [
            'primary' => esc_html__('Primary', 'tbc')
        ];

        register_nav_menus($menus);

    }

    public function registerMimeTypes(): array
    {

        $mimes['svg'] = 'image/svg+xml';
        return $mimes;

    }

    public function copyright( $mods ): string
    {

        $copyright = pll__('Copyright');
        $reserved = pll__('All rights reserved.');
        return $copyright . ' @' . date('Y') . '. ' . $reserved;

    }

}
