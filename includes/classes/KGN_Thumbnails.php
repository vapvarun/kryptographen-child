<?php

class KGN_Thumbnails {
    public function __construct()
    {
        add_filter('post_thumbnail_html', [ $this, 'add_annonse_wrapper_to_thumbnail'], 10, 5 );
    }

    public function add_annonse_wrapper_to_thumbnail( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
        if (get_post_meta($post_id, 'show_annonse_label', true)) {
            $html = '<div class="info-label" >' . $html . '</div>';
        }

        return $html;
    }
}

new KGN_Thumbnails();
