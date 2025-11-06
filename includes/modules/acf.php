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
            'enqueue_style'  => get_stylesheet_directory_uri() . '/assets/css/table-of-contents-block.css',
            'enqueue_script' => get_stylesheet_directory_uri() . '/assets/js/table-of-contents-block.js',
            'supports'       => [
                'align'  => false,
                'anchor' => true,
            ],
            'mode'           => 'auto',
            'enqueue_assets' => function() {
                wp_enqueue_style( 'add-contents-block-style', get_stylesheet_directory_uri() . '/assets/css/add-contents.css', [], time() );
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
                wp_enqueue_style( 'advertisement-block-style', get_stylesheet_directory_uri() . '/assets/css/advertisement-block.css', [], time() );
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
                wp_enqueue_style( 'info-block-style', get_stylesheet_directory_uri() . '/assets/css/info-box-block.css', [], time() );
            },
        ] );
    }
}

new KGF_ACF();

//wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', [], '5.15.4' );
