<?php

class KGF_ACF {
    public function __construct()
    {
        add_action( 'acf/init', [ $this, 'register_acf_blocks' ] );
    }

    /**
     * Get file version based on modification time
     */
    private function get_file_version($file_path)
    {
        $full_path = get_stylesheet_directory() . $file_path;

        if (file_exists($full_path)) {
            return filemtime($full_path);
        }

        $theme_version = wp_get_theme()->get('Version');
        return $theme_version ? $theme_version : '2.0.0';
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
                $version = $this->get_file_version('/assets/css/table-of-contents-block.css');
                wp_enqueue_style( 'table-of-contents-block-style', get_stylesheet_directory_uri() . '/assets/css/table-of-contents-block.css', [], $version );
                wp_enqueue_style( 'add-contents-block-style', get_stylesheet_directory_uri() . '/assets/css/add-contents.css', [], $this->get_file_version('/assets/css/add-contents.css') );
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
                $version = $this->get_file_version('/assets/css/info-box-block.css');
                wp_enqueue_style( 'info-block-style', get_stylesheet_directory_uri() . '/assets/css/info-box-block.css', [], $version );
            },
        ] );
    }
}

new KGF_ACF();
