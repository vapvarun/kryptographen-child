<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress sites may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CIG
 */

get_header();
?>
    <main class="page-content">
        <section class="breadcrumbs">
            <div class="container">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
                    yoast_breadcrumb( '<p id="breadcrumbs-green" class="breadcrumbs-green">', '</p>' );
				}
				?>
            </div>
        </section>
        <div class="container page-info">
            <h1 class="mb-10"><?php the_title()?></h1>
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			endif;
			?>
        </div>

<?php

get_footer();
