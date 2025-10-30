<?php
if ( ! class_exists( 'KGN_Load_More' ) ) {
    class KGN_Load_More
    {
        public function __construct()
        {
            add_action('wp_ajax_kgn_load_more', [ $this, 'loadmore_ajax_handler' ]);
            add_action('wp_ajax_nopriv_kgn_load_more', [ $this, 'loadmore_ajax_handler' ]);
        }

        public function loadmore_ajax_handler()
        {
            $args = json_decode(stripslashes($_POST['query']), true);
            $args['paged'] = $_POST['page'] + 1;
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
