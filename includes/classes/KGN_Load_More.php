<?php
if ( ! class_exists( 'KGN_Load_More' ) ) {
    class KGN_Load_More
    {
        public function __construct()
        {
            add_action('wp_ajax_kgn_load_more', [ $this, 'loadmore_ajax_handler' ]);
            add_action('wp_ajax_nopriv_kgn_load_more', [ $this, 'loadmore_ajax_handler' ]);
        }

        /**
         * Enqueue load more script with nonce
         * Call this method where you want to enable load more functionality
         */
        public function enqueue_load_more_script()
        {
            global $wp_query;

            $theme_version = wp_get_theme()->get('Version');

            wp_enqueue_script(
                'kgn_load_more',
                get_stylesheet_directory_uri() . '/assets/js/kgn_load_more.js',
                [],
                $theme_version,
                true
            );

            wp_localize_script(
                'kgn_load_more',
                'load_more_params',
                [
                    'ajax_url' => admin_url( 'admin-ajax.php' ),
                    'posts' => json_encode( $wp_query->query_vars ),
                    'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
                    'max_page' => $wp_query->max_num_pages,
                    'nonce' => wp_create_nonce('kgn_load_more_nonce'),
                ]
            );
        }

        public function loadmore_ajax_handler()
        {
            // Verify nonce for security
            check_ajax_referer('kgn_load_more_nonce', 'nonce');

            // Sanitize and validate inputs
            if (!isset($_POST['query']) || !isset($_POST['page'])) {
                wp_send_json_error(['message' => 'Missing required parameters']);
                return;
            }

            $args = json_decode(stripslashes($_POST['query']), true);

            if (!is_array($args)) {
                wp_send_json_error(['message' => 'Invalid query parameters']);
                return;
            }

            $args['paged'] = absint($_POST['page']) + 1;
            $args['post_status'] = 'publish';

            $posts = new WP_Query($args);

            ob_start();
            get_template_part(
                'template-parts/articles-block',
                'articles-block',
                ['posts' => $posts]
            );

            $html = ob_get_clean();

            wp_send_json_success(['html' => $html]);
        }
    }

    new KGN_Load_More();
}
