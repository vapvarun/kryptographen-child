<?php
// Your code to enqueue parent theme styles
function enqueue_parent_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['parent-style'],
        time()
    );
    
}

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

require_once 'includes/modules/acf.php';
require_once 'includes/classes/KGN_Thumbnails.php';

require_once 'includes/classes/KGN_News.php';
require_once 'includes/classes/KGN_Assets.php';
require_once 'includes/classes/KGN_Load_More.php';
require_once 'includes/classes/KGN_Category.php';

function unregister_custom_post_type() {
    unregister_post_type('guider');
    unregister_post_type('erfaringer');
}

add_action('init', 'unregister_custom_post_type', 20);

add_action('wp_head', 'kgn_add_meta_to_head');

function kgn_add_meta_to_head() {
    if (isset($_GET['new_cat_page'])) {
        echo '<meta name="robots" content="noindex">';
    }
}
