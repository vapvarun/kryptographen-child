<?php

if ( ! class_exists( 'KGN_News' ) ) {
    class KGN_News {
        public function __construct()
        {
            add_filter('query_vars', [ $this, 'custom_query_vars' ] );
            add_action('parse_request', [ $this, 'custom_parse_request' ] );

            add_filter( 'post_link', [ $this, 'remove_news_subcategory_slug' ], 10, 2 );
            add_filter( 'post_type_link', [ $this, 'remove_news_subcategory_slug' ], 10, 2 );
            add_action( 'init', [ $this, 'news_rewrite_rules' ] );
            add_action( 'template_redirect', [ $this, 'redirect_old_news_urls' ] );
            add_filter( 'wpseo_breadcrumb_links', [ $this, 'remove_child_category_breadcrumb' ]);
//            add_filter( 'pre_handle_404', [ $this, 'handle_custom_404' ], 10, 2 );

        }

        public function custom_query_vars($vars) {
            $vars[] = 'nyheter';
            return $vars;
        }

        public function custom_parse_request($wp) {
            if (array_key_exists('nyheter', $wp->query_vars)) {
                $term = get_term_by('slug', $wp->query_vars['nyheter'], 'category');
                if ($term !== false) {
                    $wp->query_vars['category_name'] = $wp->query_vars['nyheter'];
                    if (array_key_exists('paged', $wp->query_vars)) {
                        $wp->query_vars['paged'] = $wp->query_vars['paged'];
                    }
                } else {
                    $wp->query_vars['name'] = $wp->query_vars['nyheter'];
                }
                unset($wp->query_vars['nyheter']);
            }
        }

        public function remove_child_category_breadcrumb( $crumbs ) {
            unset($crumbs[0]);

            return $crumbs;
        }

        public function remove_news_subcategory_slug( $post_link, $post ) {
            if ( 'post' === $post->post_type ) {
                $primary_category = '';
                $categories       = get_the_category( $post->ID );

                $has_subcategory  = false;

                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $category ) {
                        if ( $category->category_parent ) {
                            $primary_category = $category->slug;
                            $has_subcategory  = true;
                            break;
                        }
                    }

                    if ( $has_subcategory && get_term($category->category_parent)->slug === 'nyheter' ) {
                        $post_link = str_replace( '/' . $primary_category . '/', '/', $post_link );
                    }
                }
            }
            return $post_link;
        }

        public function news_rewrite_rules() {
//            add_rewrite_rule(
//                '^nyheter/([^/]+)(/page/([0-9]+))?/?$',
//                'index.php?post_type=post&name=$matches[1]&paged=$matches[3]',
//                'top'
//            );
            add_rewrite_rule(
                '^nyheter/([^/]+)?/?$',
                'index.php?nyheter=$matches[1]',
                'top'
            );

        }

        public function redirect_old_news_urls() {
            if ( is_singular( 'post' ) ) {
                global $post, $wp;
                $primary_category = '';
                $categories       = get_the_category( $post->ID );
                $has_subcategory  = false;

                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $category ) {
                        if ( $category->category_parent ) {
                            $primary_category = $category->slug;
                            $has_subcategory  = true;
                            break;
                        }
                    }

                    if ( $has_subcategory && get_term($category->category_parent)->slug === 'nyheter' ) {
                        $new_url     = home_url( user_trailingslashit( 'nyheter/' . $post->post_name));
                        $current_url = home_url( add_query_arg( [], $wp->request ) );

                        if ( strpos( $current_url, '/' . $primary_category . '/' ) !== false ) {
                            if ( untrailingslashit( $current_url ) !== untrailingslashit( $new_url ) ) {
                                wp_safe_redirect( $new_url, 301 );
                                exit();
                            }
                        }
                    }
                }
            }
        }

        public function handle_custom_404( $is_404, $wp_query ) {
            global $wp;
            $request = $wp->request;

            if ( preg_match( '#^nyheter/([^/]+)$#', $request, $matches ) ) {
                $category_slug = $matches[1];
                $parent_category = get_term_by( 'slug', 'nyheter', 'category' );

                if ( $parent_category ) {
                    $category = get_term_by( 'slug', $category_slug, 'category' );

                    if ( $category && (int) $category->parent === (int) $parent_category->term_id ) {

                        $new_query = new WP_Query([
                            'category_name' => $category->slug
                        ]);

                        global $wp_query;

                        // Override the global $wp_query with our custom query
                        $wp_query = $new_query;

                        // Set up post data
                        wp_reset_postdata();

                        // Set the status to 200
                        status_header( 200 );

                        return false;
                    }
                }
            }

            return $is_404;
        }
    }

    new KGN_News();
}
