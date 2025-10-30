<?php

class KGF_ACF {
    public function __construct()
    {
        add_action( 'acf/init', [ $this, 'register_acf_blocks' ] );
    }

    public function register_acf_blocks () {

        /**
         * Create gutenberg block featured articles
         */
        acf_register_block_type( [
            'name'        => 'featured-articles-block',
            'title'       => __( 'Featured articles', 'cv' ),
            'description' => __( 'Featured articles', 'cv' ),
            'category'    => 'sections',
            'supports'    => [
                'align'  => false,
                'anchor' => true,
            ],
            'mode'        => 'auto',
        ] );

        /**
         * Create gutenberg block table of contents
         */
        acf_register_block_type( [
            'name'           => 'table-of-contents-block',
            'title'          => __( 'Table of contents', 'cv' ),
            'description'    => __( 'Table of contents', 'cv' ),
            'category'       => 'sections',
            'supports'       => [
                'align'  => false,
                'anchor' => true,
            ],
            'mode'           => 'auto',
            'enqueue_assets' => function() {
                $theme_version = wp_get_theme()->get('Version');

                // Only load scripts on frontend, not in editor
                if (!is_admin() && !wp_is_json_request()) {
                    wp_enqueue_script(
                        'table-of-contents-block-js',
                        get_stylesheet_directory_uri() . '/assets/js/table-of-contents-block.js',
                        [],
                        $theme_version,
                        true
                    );
                }
                // Styles can be loaded in both contexts
                wp_enqueue_style(
                    'table-of-contents-block-style',
                    get_stylesheet_directory_uri() . '/assets/css/table-of-contents-block.css',
                    [],
                    $theme_version
                );
                wp_enqueue_style(
                    'add-contents-block-style',
                    get_stylesheet_directory_uri() . '/assets/css/add-contents.css',
                    [],
                    $theme_version
                );
            },
        ] );

        acf_register_block_type( [
            'name'           => 'advertisement-block',
            'title'          => __( 'Advertisement', 'cv' ),
            'description'    => __( 'Advertisement contents', 'cv' ),
            'category'       => 'sections',
            'supports'       => [
                'align'  => false,
                'anchor' => true,
            ],
            'mode'           => 'auto',
            'enqueue_assets' => function() {
                $theme_version = wp_get_theme()->get('Version');
                wp_enqueue_style(
                    'advertisement-block-style',
                    get_stylesheet_directory_uri() . '/assets/css/advertisement-block.css',
                    [],
                    $theme_version
                );
            },
        ] );

        acf_register_block_type( [
            'name'           => 'info-box-block',
            'title'          => __( 'Info Box', 'cv' ),
            'description'    => __( 'Info contents', 'cv' ),
            'category'       => 'sections',
            'supports'       => [
                'align'  => false,
                'anchor' => true,
            ],
            'mode'           => 'auto',
            'enqueue_assets' => function() {
                $theme_version = wp_get_theme()->get('Version');
                wp_enqueue_style(
                    'info-block-style',
                    get_stylesheet_directory_uri() . '/assets/css/info-box-block.css',
                    [],
                    $theme_version
                );
            },
        ] );
    }
}

new KGF_ACF();

//wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', [], '5.15.4' );
