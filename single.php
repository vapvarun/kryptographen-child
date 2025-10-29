<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CIG
 */

get_header();

$post_view_type = get_field('post_template_type');



switch ( $post_view_type ) {
    case 'page':
        ?>
        <main class="page-content">
        <div class="container page-info">
            <h1><?php the_title(); ?></h1>
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>

        <?php
    break;
    case 'pages_no_image':
        ?>
        <main class="page-content article-no-image">
        <section class="hero-post white article-no-image">
            <div class="container  article-container" style="margin-top: 63px !important;">
                <?php
                if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
                    yoast_breadcrumb( '<p id="breadcrumbs-green" class="breadcrumbs-green">', '</p>' );
                }
                ?>
                </p>
                <h1><?php the_title() ?></h1>
                <p class="hero-post_description">
                    <?php the_field( 'description' ); ?>
                </p>
                <div class="hero__slider-item-header">
                    <div class="hero__slider-item-author">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
                        <span><?php echo get_the_author_meta( 'display_name' ) ?></span>
                    </div>
                    <div class="hero__slider-item-date">
                        <span class="kgn-capitalize"><?php echo esc_html__('Oppdatert ', 'cigtextdomain'); ?></span>
                        <span><?php echo get_the_date( 'd,F Y' ) ?></span>
                    </div>
                </div>
            </div>
        </section>
        <div class="container article-container article-info">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>

        <?php
    break;
    case 'post_no_date_author':
        
    ?>
        <main>
        <section class="hero-post white">
            <div class="container">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
					yoast_breadcrumb( '<p id="breadcrumbs-green" class="breadcrumbs-green">', '</p>' );
				}
				?>
                </p>
                <h1><?php the_title() ?></h1>
                <p class="hero-post_description">
                    <?php the_field( 'description' ); ?>
                </p>
               
            </div>
        </section>
        <section class="article-block">
            <div class="container">
                <div class="guider-blocks-wrapper">
                    <div class="guider-blocks-info">
                        <div class="thumbnail-img">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                        </div>
                        <?php
                            while ( have_posts() ) : the_post();

                            $post_id               = get_the_ID();
                                $show_ads              = false;
                                $show_post_ads         = false;
                                $post_categories       = get_the_category( $post_id );
                                $cat_id                = isset( $post_categories[0] ) ? $post_categories[0]->cat_ID : '';
                                $ads_default_image_url = 'https://kryptografen.no/wp-content/uploads/2023/11/gratis-bitcoin.webp';
                                $ads_categories        = [];

                                $ads_image_url = get_field('ngn_advertisement_image', 'options') ? get_field(
                                    'ngn_advertisement_image',
                                    'options'
                                ) : $ads_default_image_url;
                                $ads_title       = get_field('ngn_advertisement_title', 'options');
                                $ads_content     = get_field('ngn_advertisement_content', 'options');
                                $ads_button_text = get_field('ngn_advertisement_button_text', 'options');
                                $ads_link_url    = get_field('ngn_advertisement__link', 'options') ? get_field(
                                    'ngn_advertisement__link',
                                    'options'
                                ) : '/';
                                $ads_categories  = get_field('ngn_krypto_categories', 'options');
                                $ads_text_under_btn = get_field('ngn_category_ads_text_under_button', 'options');

                                $post_ads_image_url = get_field('kgn_post_ads_image', 'options') ? get_field(
                                    'kgn_post_ads_image',
                                    'options'
                                ) : $ads_default_image_url;
                                $post_ads_title          = get_field('kgn_post_ads_title', 'options');
                                $post_ads_content        = get_field('kgn_post_ads_content', 'options');
                                $post_ads_link_url       = get_field('kgn_post_ads_link', 'options');
                                $post_ads_posts          = get_field('kgn_post_ads_posts', 'options');
                                $post_ads_text_under_btn = get_field('kgn_post_ads_text_under_button', 'options');

                                if ( in_array( $cat_id, $ads_categories ) ) {
                                    $show_ads = true;
                                }

                                if ( in_array($post_id, $post_ads_posts) ) {
                                    $show_post_ads = true;
                                }
                        if ( $show_ads ) :  ?>
                            <div class="mobile-prom-block" data-nosnippet="true" >
                                <div class="prom_image-block"><img src="<?php echo esc_url( $ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                <div class="mobile_prom_title"><?php echo esc_html( $ads_title ) ?></div>
                                <div class="mobile_prom_content"><?php echo esc_html( $ads_content ) ?></div>
                                <div class="abs_button"><?php echo esc_html( $ads_button_text ) ?></div>
                                <?php if ( $ads_text_under_btn ) : ?>
                                    <span class="abs_btn-notice"><?php echo esc_html( $ads_text_under_btn ); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $ads_link_url ) ?>" rel="nofollow"></a>
                            </div>
                        <?php endif; ?>
                        <?php if ( $show_post_ads ) : ?>
                            <div class="mobile-prom-block" data-nosnippet="true">
                                <div class="prom_image-block"><img src="<?php echo esc_url( $post_ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                <div class="mobile_prom_title"><?php echo esc_html( $post_ads_title ) ?></div>
                                <div class="mobile_prom_content"><?php echo esc_html( $post_ads_content ) ?></div>
                                <div class="abs_button"><?php echo esc_html( $post_ads_link_url['title'] ) ?></div>
                                <?php if ( $post_ads_text_under_btn ) : ?>
                                    <span class="abs_btn-notice"><?php echo esc_html( $post_ads_text_under_btn ); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $post_ads_link_url['url'] ) ?>" rel="nofollow"></a>
                            </div>
                        <?php endif; ?>
<!--                       End of Mobile adv block-->
                        <?php endwhile; ?>            
                        <div class="guider-blocks-text">
							<?php the_content(); ?>
                        </div>
                        <a href="/" class="back-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12"
                                 fill="none">
                                <path d="M14.6665 6.22875C14.6665 6.54517 14.4314 6.80666 14.1263 6.84805L14.0415 6.85375L3.05484 6.85325L7.02399 10.8062C7.2686 11.0497 7.26945 11.4455 7.0259 11.6901C6.80449 11.9124 6.45731 11.9334 6.21225 11.7523L6.14202 11.692L1.10035 6.67198C1.06811 6.63987 1.0401 6.60513 1.01633 6.56844C1.00962 6.55739 1.00279 6.5461 0.996308 6.53457C0.990349 6.52469 0.984965 6.51443 0.979885 6.50406C0.972828 6.48897 0.965935 6.47338 0.959676 6.45747C0.95459 6.4452 0.950344 6.43327 0.946471 6.42125C0.941866 6.40633 0.937392 6.39044 0.933544 6.37431C0.930683 6.36305 0.928417 6.35221 0.926441 6.34132C0.923661 6.32513 0.921296 6.30838 0.919608 6.29142C0.918149 6.27849 0.917272 6.26567 0.916788 6.25285C0.916663 6.24507 0.916504 6.23693 0.916504 6.22875L0.916818 6.20454C0.917297 6.19228 0.918134 6.18002 0.919332 6.16779L0.916504 6.22875C0.916504 6.18931 0.920158 6.15073 0.927145 6.11331C0.928765 6.10438 0.930695 6.0952 0.932833 6.08607C0.937273 6.06725 0.942403 6.04913 0.948311 6.03137C0.951211 6.02255 0.954589 6.01312 0.958199 6.00376C0.965503 5.98495 0.973442 5.96703 0.982174 5.94956C0.986232 5.94135 0.990776 5.93276 0.995534 5.92425C1.00334 5.91036 1.01139 5.89717 1.0199 5.88431C1.0259 5.87521 1.03255 5.86574 1.03949 5.85642L1.0449 5.84921C1.06174 5.82722 1.08001 5.80637 1.09956 5.78681L1.10031 5.78623L6.14198 0.765397C6.38656 0.521825 6.78229 0.522644 7.02586 0.767227C7.24729 0.989575 7.26674 1.33684 7.08469 1.58114L7.02403 1.65111L3.0565 5.60325L14.0415 5.60375C14.3867 5.60375 14.6665 5.88357 14.6665 6.22875Z"
                                      fill="#00D084"/>
                            </svg>
                            <?php _e('Back', 'cigtextdomain')?>
                        </a>
                    </div>
                    <div class="guider-blocks-widget guider-blocks-flex">
                        <ul class="shared-list">
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3333 3102"
                                         shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                         image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                                         width="20" height="20"
                                    >
                                        <path d="M1204 925h640c26 0 47 21 47 47v196c52-57 118-109 199-151 107-56 240-92 395-92 356 0 569 113 693 299 122 183 155 433 155 715v1114c0 26-21 47-47 47h-667c-26 0-47-21-47-47v-988c0-113-1-243-42-340-37-88-111-152-258-152-154 0-241 55-290 138-52 88-64 211-64 336v1005c0 26-21 47-47 47h-667c-26 0-47-21-47-47V970c0-26 21-47 47-47zm593 94h-546v1988h572v-958c0-140 15-278 77-384 65-111 178-185 371-185 195 0 294 88 345 210 48 114 49 254 49 376v941h573V1940c0-265-30-499-139-663-107-161-295-258-615-258-139 0-257 32-352 82-114 59-194 142-239 222-8 14-23 24-41 24h-9c-26 0-47-21-47-47v-281zM789 393c0 109-44 207-116 279-71 71-170 116-279 116s-207-44-279-116C44 601-1 502-1 393s44-207 116-279C186 43 285-2 394-2s207 44 279 116c71 71 116 170 116 279zM607 605c54-54 88-129 88-212s-34-158-88-212-129-88-212-88-158 34-212 88-88 129-88 212 34 158 88 212 129 88 212 88 158-34 212-88zM48 924h694c26 0 47 21 47 47v2082c0 26-21 47-47 47H48c-26 0-47-21-47-47V971c0-26 21-47 47-47zm647 94H95v1988h600V1018z"
                                              fill-rule="nonzero"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_63_16657)">
                                            <path d="M11.3281 19.9609H8.12531C7.59033 19.9609 7.15515 19.5258 7.15515 18.9908V11.7667H5.28656C4.75159 11.7667 4.31641 11.3313 4.31641 10.7965V7.70096C4.31641 7.16599 4.75159 6.7308 5.28656 6.7308H7.15515V5.18066C7.15515 3.64365 7.63779 2.33597 8.55072 1.39923C9.46777 0.458221 10.7494 -0.0390625 12.2569 -0.0390625L14.6996 -0.0350952C15.2336 -0.0341797 15.668 0.401001 15.668 0.935059V3.8092C15.668 4.34418 15.233 4.77936 14.6982 4.77936L13.0536 4.77997C12.552 4.77997 12.4243 4.88052 12.397 4.91135C12.352 4.96246 12.2984 5.10696 12.2984 5.50598V6.73065H14.5746C14.7459 6.73065 14.912 6.77292 15.0546 6.85257C15.3624 7.02454 15.5537 7.3497 15.5537 7.70111L15.5525 10.7967C15.5525 11.3313 15.1173 11.7665 14.5824 11.7665H12.2984V18.9908C12.2984 19.5258 11.8631 19.9609 11.3281 19.9609ZM8.32764 18.7885H11.1258V11.2418C11.1258 10.8846 11.4165 10.594 11.7735 10.594H14.38L14.3811 7.90329H11.7734C11.4163 7.90329 11.1258 7.61276 11.1258 7.25555V5.50598C11.1258 5.04791 11.1723 4.52698 11.5181 4.13544C11.9359 3.66211 12.5943 3.60748 13.0533 3.60748L14.4955 3.60687V1.13709L12.256 1.13342C9.83322 1.13342 8.32764 2.68433 8.32764 5.18066V7.25555C8.32764 7.61261 8.03711 7.90329 7.68005 7.90329H5.48889V10.594H7.68005C8.03711 10.594 8.32764 10.8846 8.32764 11.2418V18.7885ZM14.6973 1.13739H14.6974H14.6973Z"
                                                  fill="#181818" fill-opacity="0.6"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_63_16657">
                                                <rect width="19.9609" height="20" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/share/url?&text=<?php the_title() ?>&url=<?php the_permalink(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#181818" viewBox="0 0 50 50"
                                         width="20px" height="20px">
                                        <path d="M 44.376953 5.9863281 C 43.889905 6.0076957 43.415817 6.1432497 42.988281 6.3144531 C 42.565113 6.4845113 40.128883 7.5243408 36.53125 9.0625 C 32.933617 10.600659 28.256963 12.603668 23.621094 14.589844 C 14.349356 18.562196 5.2382813 22.470703 5.2382812 22.470703 L 5.3046875 22.445312 C 5.3046875 22.445312 4.7547875 22.629122 4.1972656 23.017578 C 3.9185047 23.211806 3.6186028 23.462555 3.3730469 23.828125 C 3.127491 24.193695 2.9479735 24.711788 3.015625 25.259766 C 3.2532479 27.184511 5.2480469 27.730469 5.2480469 27.730469 L 5.2558594 27.734375 L 14.158203 30.78125 C 14.385177 31.538434 16.858319 39.792923 17.402344 41.541016 C 17.702797 42.507484 17.984013 43.064995 18.277344 43.445312 C 18.424133 43.635633 18.577962 43.782915 18.748047 43.890625 C 18.815627 43.933415 18.8867 43.965525 18.957031 43.994141 C 18.958531 43.994806 18.959437 43.99348 18.960938 43.994141 C 18.969579 43.997952 18.977708 43.998295 18.986328 44.001953 L 18.962891 43.996094 C 18.979231 44.002694 18.995359 44.013801 19.011719 44.019531 C 19.043456 44.030655 19.062905 44.030268 19.103516 44.039062 C 20.123059 44.395042 20.966797 43.734375 20.966797 43.734375 L 21.001953 43.707031 L 26.470703 38.634766 L 35.345703 45.554688 L 35.457031 45.605469 C 37.010484 46.295216 38.415349 45.910403 39.193359 45.277344 C 39.97137 44.644284 40.277344 43.828125 40.277344 43.828125 L 40.310547 43.742188 L 46.832031 9.7519531 C 46.998903 8.9915162 47.022612 8.334202 46.865234 7.7402344 C 46.707857 7.1462668 46.325492 6.6299361 45.845703 6.34375 C 45.365914 6.0575639 44.864001 5.9649605 44.376953 5.9863281 z M 44.429688 8.0195312 C 44.627491 8.0103707 44.774102 8.032983 44.820312 8.0605469 C 44.866523 8.0881109 44.887272 8.0844829 44.931641 8.2519531 C 44.976011 8.419423 45.000036 8.7721605 44.878906 9.3242188 L 44.875 9.3359375 L 38.390625 43.128906 C 38.375275 43.162926 38.240151 43.475531 37.931641 43.726562 C 37.616914 43.982653 37.266874 44.182554 36.337891 43.792969 L 26.632812 36.224609 L 26.359375 36.009766 L 26.353516 36.015625 L 23.451172 33.837891 L 39.761719 14.648438 A 1.0001 1.0001 0 0 0 38.974609 13 A 1.0001 1.0001 0 0 0 38.445312 13.167969 L 14.84375 28.902344 L 5.9277344 25.849609 C 5.9277344 25.849609 5.0423771 25.356927 5 25.013672 C 4.99765 24.994652 4.9871961 25.011869 5.0332031 24.943359 C 5.0792101 24.874869 5.1948546 24.759225 5.3398438 24.658203 C 5.6298218 24.456159 5.9609375 24.333984 5.9609375 24.333984 L 5.9941406 24.322266 L 6.0273438 24.308594 C 6.0273438 24.308594 15.138894 20.399882 24.410156 16.427734 C 29.045787 14.44166 33.721617 12.440122 37.318359 10.902344 C 40.914175 9.3649615 43.512419 8.2583658 43.732422 8.1699219 C 43.982886 8.0696253 44.231884 8.0286918 44.429688 8.0195312 z M 33.613281 18.792969 L 21.244141 33.345703 L 21.238281 33.351562 A 1.0001 1.0001 0 0 0 21.183594 33.423828 A 1.0001 1.0001 0 0 0 21.128906 33.507812 A 1.0001 1.0001 0 0 0 20.998047 33.892578 A 1.0001 1.0001 0 0 0 20.998047 33.900391 L 19.386719 41.146484 C 19.35993 41.068197 19.341173 41.039555 19.3125 40.947266 L 19.3125 40.945312 C 18.800713 39.30085 16.467362 31.5161 16.144531 30.439453 L 33.613281 18.792969 z M 22.640625 35.730469 L 24.863281 37.398438 L 21.597656 40.425781 L 22.640625 35.730469 z"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?&text=<?php the_title() ?>&via=kryptografen&url=<?php the_permalink(); ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.394018 16.3291C2.24568 17.5041 4.40068 18.125 6.62569 18.125C9.88402 18.125 12.8699 16.8733 15.034 14.6008C17.1049 12.4258 18.244 9.5033 18.1874 6.53747C18.9724 5.8658 19.8957 4.5833 19.8957 3.3333C19.8957 2.85414 19.3757 2.54997 18.954 2.79414C18.2165 3.22747 17.544 3.3408 16.8524 3.14664C15.4399 1.76997 13.3374 1.47997 11.5657 2.43497C10.0174 3.2683 9.15652 4.7933 9.23402 6.45997C6.61819 6.1408 4.20152 4.82914 2.51652 2.7908C2.23985 2.4583 1.71485 2.49747 1.49485 2.87414C0.683185 4.26414 0.691518 5.87497 1.39735 7.1758C1.06152 7.23497 0.854018 7.51747 0.854018 7.8233C0.854018 9.1308 1.44235 10.3325 2.38985 11.1525C2.21318 11.3225 2.15485 11.575 2.22985 11.8C2.64652 13.0516 3.58985 14.03 4.76902 14.52C3.48652 15.1325 2.06818 15.3366 0.805685 15.1816C0.152351 15.0933 -0.170149 15.9716 0.394018 16.3291ZM6.79652 14.7341C7.26402 14.375 7.01569 13.6266 6.42902 13.6141C5.39568 13.5925 4.45485 13.0833 3.86902 12.2825C4.15152 12.2641 4.44402 12.2208 4.72235 12.1458C5.35652 11.9741 5.32652 11.0591 4.68235 10.93C3.51318 10.695 2.59568 9.8433 2.25152 8.74664C2.56568 8.82414 2.88568 8.86747 3.20485 8.8733C3.83735 8.87664 4.07652 8.0658 3.56068 7.72664C2.39818 6.9608 1.90235 5.6083 2.23068 4.33664C4.26068 6.3933 7.01485 7.63247 9.92818 7.77247C10.3457 7.7983 10.659 7.4058 10.5674 7.0083C10.1715 5.29247 11.1299 4.08997 12.159 3.5358C13.1774 2.9858 14.8124 2.81414 16.0657 4.12914C16.4382 4.52164 17.6949 4.53664 18.334 4.38747C18.0474 4.92747 17.6065 5.43997 17.194 5.7283C17.0182 5.85164 16.9174 6.05664 16.9282 6.2708C17.0624 9.0083 16.0424 11.73 14.1299 13.7375C12.2032 15.76 9.53902 16.8741 6.62652 16.8741C5.46818 16.8741 4.33235 16.6858 3.25902 16.3225C4.54235 16.0741 5.76152 15.5308 6.79652 14.7341Z"
                                              fill="#181818" fill-opacity="0.7"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <?php if ( have_rows( 'widget_info' ) ) : ?>
                        <div class="visible-lg sticky-head token-info-block__wrapper" data-margin-top="75" data-nosnippet="true">
                            <div class="token-info-block ">
                                <div class="token-info-block__head">
                                    <div class="token-info-block__head-desc">
                                        <div class="token-info-block__title"><?php the_title() ?></div>
                                    </div>
                                    <div class="token-info-block__img shadow_img">
                                        <?php $logo = get_field( 'logo' ); ?>
                                        <?php $size = 'full'; ?>
                                        <?php if ( $logo ) : ?>
                                            <?php echo wp_get_attachment_image( $logo, $size, '',
                                                [ "class" => "attachment-post-thumbnail size-post-thumbnail wp-post-image" ] ); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="token-info-block__body">
                                    <?php while ( have_rows( 'widget_info' ) ) : the_row(); ?>
                                        <div class="token-info-block__body-inner">
                                            <div class="token-info-block__body-inner-left">
                                                <div class="token-info-block__body-title"><?php the_sub_field( 'text' ); ?>
                                                    <span class="tooltip">
                                                    <i class="icon-info"></i>
                                                    <span class="tooltip__inner"><?php the_sub_field( 'tooltip' ); ?></span>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="token-info-block__body-inner-right">
                                                <?php if ( ! get_sub_field( 'description' ) ) { ?>
                                                    <div class="token-info-block__payment-method">
                                                        <?php if ( have_rows( 'icons_card' ) ) : ?>
                                                            <?php while ( have_rows( 'icons_card' ) ) : the_row(); ?>
                                                                <?php $icon_card = get_sub_field( 'icon_card' ); ?>
                                                                <?php $size = 'full'; ?>
                                                                <?php if ( $icon_card ) : ?>
                                                                    <?php echo wp_get_attachment_image( $icon_card,
                                                                        $size ); ?>
                                                                <?php endif; ?>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="token-info-block__price"><?php the_sub_field( 'description' ); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    <?php endwhile; ?>

                                    <div class="token-info-block__footer">
                                        <?php $custom_link = get_field( 'custom_link' ); ?>
                                        <?php if ( $custom_link ) : ?>
                                            <a href="<?php echo esc_url( $custom_link['url'] ); ?>"
                                               class="btn btn-primary btn-block"
                                               target="<?php echo esc_attr( $custom_link['target'] ); ?>"
                                               rel="nofollow"><?php echo $custom_link['title']; ?></a>
                                        <?php endif; ?>
                                        <span class="btn-notice">Annonselenke</span>
                                    </div>

                                </div><!-- /.token-info-block -->
                            </div>
                            <?php endif; ?>

                            <?php if ( get_field( 'show_sidebar_promo' ) == 1 ) : ?>

                            <div class="sidebar-promo">
                                <?php $image = get_field( 'image' ); ?>
                                <?php $size = 'full'; ?>
                                <?php if ( $image ) : ?>
                                    <?php echo wp_get_attachment_image( $image, $size ); ?>
                                <?php endif; ?>
                                <div class="text">
                                    <?php the_field( 'text' ); ?>
                                </div>
                                <div class="button-wrapper">
                                    <?php $button = get_field( 'button' ); ?>
                                    <?php if ( $button ) : ?>
                                        <a href="<?php echo esc_url( $button['url'] ); ?>" rel="nofollow" class="button" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endif; ?>
                        <?php
                            while ( have_posts() ) : the_post();

                            $post_id               = get_the_ID();
                                $show_ads              = false;
                                $show_post_ads         = false;
                                $post_categories       = get_the_category( $post_id );
                                $cat_id                = isset( $post_categories[0] ) ? $post_categories[0]->cat_ID : '';
                                $ads_default_image_url = 'https://kryptografen.no/wp-content/uploads/2023/11/gratis-bitcoin.webp';
                                $ads_categories        = [];

                                $ads_image_url = get_field('ngn_advertisement_image', 'options') ? get_field(
                                    'ngn_advertisement_image',
                                    'options'
                                ) : $ads_default_image_url;
                                $ads_title       = get_field('ngn_advertisement_title', 'options');
                                $ads_content     = get_field('ngn_advertisement_content', 'options');
                                $ads_button_text = get_field('ngn_advertisement_button_text', 'options');
                                $ads_link_url    = get_field('ngn_advertisement__link', 'options') ? get_field(
                                    'ngn_advertisement__link',
                                    'options'
                                ) : '/';
                                $ads_categories  = get_field('ngn_krypto_categories', 'options');
                                $ads_text_under_btn = get_field('ngn_category_ads_text_under_button', 'options');

                                $post_ads_image_url = get_field('kgn_post_ads_image', 'options') ? get_field(
                                    'kgn_post_ads_image',
                                    'options'
                                ) : $ads_default_image_url;
                                $post_ads_title          = get_field('kgn_post_ads_title', 'options');
                                $post_ads_content        = get_field('kgn_post_ads_content', 'options');
                                $post_ads_link_url       = get_field('kgn_post_ads_link', 'options');
                                $post_ads_posts          = get_field('kgn_post_ads_posts', 'options');
                                $post_ads_text_under_btn = get_field('kgn_post_ads_text_under_button', 'options');

                                if ( in_array( $cat_id, $ads_categories ) ) {
                                    $show_ads = true;
                                }

                                if ( in_array($post_id, $post_ads_posts) ) {
                                    $show_post_ads = true;
                                }



                        if ( $show_ads || $show_post_ads) : ?>
                            <div class="prom-blocks">
                                <?php if ( $show_ads ) : ?>
                                    <div class="prom-block" data-nosnippet="true">
                                        <div class="prom_image-block"><img src="<?php echo esc_url( $ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                        <div class="prom_title"><?php echo esc_html( $ads_title ) ?></div>
                                        <div class="prom_content"><?php echo esc_html( $ads_content ) ?></div>
                                        <div class="abs_button"><?php echo esc_html( $ads_button_text ) ?></div>
                                        <?php if ( $ads_text_under_btn ) : ?>
                                            <span class="abs_btn-notice"><?php echo esc_html( $ads_text_under_btn ); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( $ads_link_url ) ?>" rel="nofollow"></a>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $show_post_ads ) : ?>
                                    <div class="prom-block" data-nosnippet="true">
                                        <div class="prom_image-block"><img src="<?php echo esc_url( $post_ads_image_url ) ?>" alt="ads-image" class="ads_image"></div>
                                        <div class="prom_title"><?php echo esc_html( $post_ads_title ) ?></div>
                                        <div class="prom_content"><?php echo esc_html( $post_ads_content ) ?></div>
                                        <div class="abs_button"><?php echo esc_html( $post_ads_link_url['title'] ); ?></div>
                                        <?php if ( $post_ads_text_under_btn ) : ?>
                                            <span class="abs_btn-notice"><?php echo esc_html( $post_ads_text_under_btn ); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( $post_ads_link_url['url'] ) ?>" target="<?php echo esc_attr( $post_ads_link_url['target'] ); ?>" rel="nofollow"></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php get_template_part('template-parts/featured-articles', 'featured-articles', []); ?>

        <?php
    break;
    case 'post_no_featured_image_author_date':
        ?>
        <main>
        <section class="hero-post white">
            <div class="container noimage__noauthor_container">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
					yoast_breadcrumb( '<p id="breadcrumbs-green" class="breadcrumbs-green">', '</p>' );
				}
				?>
                </p>
                <h1><?php the_title() ?></h1>
                <p class="hero-post_description">
                    <?php the_field( 'description' ); ?>
                </p>
               
            </div>
        </section>
        <section class="article-block noimage__noauthor_article">
            <div class="container">
                <div class="guider-blocks-wrapper">
                    <div class="guider-blocks-info">
                        <!-- <div class="thumbnail-img">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                        </div> -->

                        <?php
                            while ( have_posts() ) : the_post();

                            $post_id               = get_the_ID();
                                $show_ads              = false;
                                $show_post_ads         = false;
                                $post_categories       = get_the_category( $post_id );
                                $cat_id                = isset( $post_categories[0] ) ? $post_categories[0]->cat_ID : '';
                                $ads_default_image_url = 'https://kryptografen.no/wp-content/uploads/2023/11/gratis-bitcoin.webp';
                                $ads_categories        = [];

                                $ads_image_url = get_field('ngn_advertisement_image', 'options') ? get_field(
                                    'ngn_advertisement_image',
                                    'options'
                                ) : $ads_default_image_url;
                                $ads_title       = get_field('ngn_advertisement_title', 'options');
                                $ads_content     = get_field('ngn_advertisement_content', 'options');
                                $ads_button_text = get_field('ngn_advertisement_button_text', 'options');
                                $ads_link_url    = get_field('ngn_advertisement__link', 'options') ? get_field(
                                    'ngn_advertisement__link',
                                    'options'
                                ) : '/';
                                $ads_categories  = get_field('ngn_krypto_categories', 'options');
                                $ads_text_under_btn = get_field('ngn_category_ads_text_under_button', 'options');

                                $post_ads_image_url = get_field('kgn_post_ads_image', 'options') ? get_field(
                                    'kgn_post_ads_image',
                                    'options'
                                ) : $ads_default_image_url;
                                $post_ads_title          = get_field('kgn_post_ads_title', 'options');
                                $post_ads_content        = get_field('kgn_post_ads_content', 'options');
                                $post_ads_link_url       = get_field('kgn_post_ads_link', 'options');
                                $post_ads_posts          = get_field('kgn_post_ads_posts', 'options');
                                $post_ads_text_under_btn = get_field('kgn_post_ads_text_under_button', 'options');

                                if ( in_array( $cat_id, $ads_categories ) ) {
                                    $show_ads = true;
                                }

                                if ( in_array($post_id, $post_ads_posts) ) {
                                    $show_post_ads = true;
                                }

                         if ( $show_ads ) :  ?>
                            <div class="mobile-prom-block" data-nosnippet="true" >
                                <div class="prom_image-block"><img src="<?php echo esc_url( $ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                <div class="mobile_prom_title"><?php echo esc_html( $ads_title ) ?></div>
                                <div class="mobile_prom_content"><?php echo esc_html( $ads_content ) ?></div>
                                <div class="abs_button"><?php echo esc_html( $ads_button_text ) ?></div>
                                <?php if ( $ads_text_under_btn ) : ?>
                                    <span class="abs_btn-notice"><?php echo esc_html( $ads_text_under_btn ); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $ads_link_url ) ?>" rel="nofollow"></a>
                            </div>
                        <?php endif; ?>
                        <?php if ( $show_post_ads ) : ?>
                            <div class="mobile-prom-block" data-nosnippet="true">
                                <div class="prom_image-block"><img src="<?php echo esc_url( $post_ads_image_url ) ?>" alt="ads-image" class="ads_image"></div>
                                <div class="mobile_prom_title"><?php echo esc_html( $post_ads_title ) ?></div>
                                <div class="mobile_prom_content"><?php echo esc_html( $post_ads_content ) ?></div>
                                <div class="abs_button"><?php echo esc_html( $post_ads_link_url['title'] ) ?></div>
                                <?php if ( $post_ads_text_under_btn ) : ?>
                                    <span class="abs_btn-notice"><?php echo esc_html( $post_ads_text_under_btn ); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $post_ads_link_url['url'] ) ?>" rel="nofollow"></a>
                            </div>
                        <?php endif; ?>
<!--                       End of Mobile adv block-->
                       <?php endwhile; ?>

                        <div class="guider-blocks-text">
							<?php the_content(); ?>
                        </div>
                        <a href="/" class="back-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12"
                                 fill="none">
                                <path d="M14.6665 6.22875C14.6665 6.54517 14.4314 6.80666 14.1263 6.84805L14.0415 6.85375L3.05484 6.85325L7.02399 10.8062C7.2686 11.0497 7.26945 11.4455 7.0259 11.6901C6.80449 11.9124 6.45731 11.9334 6.21225 11.7523L6.14202 11.692L1.10035 6.67198C1.06811 6.63987 1.0401 6.60513 1.01633 6.56844C1.00962 6.55739 1.00279 6.5461 0.996308 6.53457C0.990349 6.52469 0.984965 6.51443 0.979885 6.50406C0.972828 6.48897 0.965935 6.47338 0.959676 6.45747C0.95459 6.4452 0.950344 6.43327 0.946471 6.42125C0.941866 6.40633 0.937392 6.39044 0.933544 6.37431C0.930683 6.36305 0.928417 6.35221 0.926441 6.34132C0.923661 6.32513 0.921296 6.30838 0.919608 6.29142C0.918149 6.27849 0.917272 6.26567 0.916788 6.25285C0.916663 6.24507 0.916504 6.23693 0.916504 6.22875L0.916818 6.20454C0.917297 6.19228 0.918134 6.18002 0.919332 6.16779L0.916504 6.22875C0.916504 6.18931 0.920158 6.15073 0.927145 6.11331C0.928765 6.10438 0.930695 6.0952 0.932833 6.08607C0.937273 6.06725 0.942403 6.04913 0.948311 6.03137C0.951211 6.02255 0.954589 6.01312 0.958199 6.00376C0.965503 5.98495 0.973442 5.96703 0.982174 5.94956C0.986232 5.94135 0.990776 5.93276 0.995534 5.92425C1.00334 5.91036 1.01139 5.89717 1.0199 5.88431C1.0259 5.87521 1.03255 5.86574 1.03949 5.85642L1.0449 5.84921C1.06174 5.82722 1.08001 5.80637 1.09956 5.78681L1.10031 5.78623L6.14198 0.765397C6.38656 0.521825 6.78229 0.522644 7.02586 0.767227C7.24729 0.989575 7.26674 1.33684 7.08469 1.58114L7.02403 1.65111L3.0565 5.60325L14.0415 5.60375C14.3867 5.60375 14.6665 5.88357 14.6665 6.22875Z"
                                      fill="#00D084"/>
                            </svg>
                            <?php _e('Back', 'cigtextdomain')?>
                        </a>
                    </div>
                    <div class="guider-blocks-widget guider-blocks-flex">
                        <ul class="shared-list">
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3333 3102"
                                         shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                         image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                                         width="20" height="20"
                                    >
                                        <path d="M1204 925h640c26 0 47 21 47 47v196c52-57 118-109 199-151 107-56 240-92 395-92 356 0 569 113 693 299 122 183 155 433 155 715v1114c0 26-21 47-47 47h-667c-26 0-47-21-47-47v-988c0-113-1-243-42-340-37-88-111-152-258-152-154 0-241 55-290 138-52 88-64 211-64 336v1005c0 26-21 47-47 47h-667c-26 0-47-21-47-47V970c0-26 21-47 47-47zm593 94h-546v1988h572v-958c0-140 15-278 77-384 65-111 178-185 371-185 195 0 294 88 345 210 48 114 49 254 49 376v941h573V1940c0-265-30-499-139-663-107-161-295-258-615-258-139 0-257 32-352 82-114 59-194 142-239 222-8 14-23 24-41 24h-9c-26 0-47-21-47-47v-281zM789 393c0 109-44 207-116 279-71 71-170 116-279 116s-207-44-279-116C44 601-1 502-1 393s44-207 116-279C186 43 285-2 394-2s207 44 279 116c71 71 116 170 116 279zM607 605c54-54 88-129 88-212s-34-158-88-212-129-88-212-88-158 34-212 88-88 129-88 212 34 158 88 212 129 88 212 88 158-34 212-88zM48 924h694c26 0 47 21 47 47v2082c0 26-21 47-47 47H48c-26 0-47-21-47-47V971c0-26 21-47 47-47zm647 94H95v1988h600V1018z"
                                              fill-rule="nonzero"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_63_16657)">
                                            <path d="M11.3281 19.9609H8.12531C7.59033 19.9609 7.15515 19.5258 7.15515 18.9908V11.7667H5.28656C4.75159 11.7667 4.31641 11.3313 4.31641 10.7965V7.70096C4.31641 7.16599 4.75159 6.7308 5.28656 6.7308H7.15515V5.18066C7.15515 3.64365 7.63779 2.33597 8.55072 1.39923C9.46777 0.458221 10.7494 -0.0390625 12.2569 -0.0390625L14.6996 -0.0350952C15.2336 -0.0341797 15.668 0.401001 15.668 0.935059V3.8092C15.668 4.34418 15.233 4.77936 14.6982 4.77936L13.0536 4.77997C12.552 4.77997 12.4243 4.88052 12.397 4.91135C12.352 4.96246 12.2984 5.10696 12.2984 5.50598V6.73065H14.5746C14.7459 6.73065 14.912 6.77292 15.0546 6.85257C15.3624 7.02454 15.5537 7.3497 15.5537 7.70111L15.5525 10.7967C15.5525 11.3313 15.1173 11.7665 14.5824 11.7665H12.2984V18.9908C12.2984 19.5258 11.8631 19.9609 11.3281 19.9609ZM8.32764 18.7885H11.1258V11.2418C11.1258 10.8846 11.4165 10.594 11.7735 10.594H14.38L14.3811 7.90329H11.7734C11.4163 7.90329 11.1258 7.61276 11.1258 7.25555V5.50598C11.1258 5.04791 11.1723 4.52698 11.5181 4.13544C11.9359 3.66211 12.5943 3.60748 13.0533 3.60748L14.4955 3.60687V1.13709L12.256 1.13342C9.83322 1.13342 8.32764 2.68433 8.32764 5.18066V7.25555C8.32764 7.61261 8.03711 7.90329 7.68005 7.90329H5.48889V10.594H7.68005C8.03711 10.594 8.32764 10.8846 8.32764 11.2418V18.7885ZM14.6973 1.13739H14.6974H14.6973Z"
                                                  fill="#181818" fill-opacity="0.6"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_63_16657">
                                                <rect width="19.9609" height="20" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/share/url?&text=<?php the_title() ?>&url=<?php the_permalink(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#181818" viewBox="0 0 50 50"
                                         width="20px" height="20px">
                                        <path d="M 44.376953 5.9863281 C 43.889905 6.0076957 43.415817 6.1432497 42.988281 6.3144531 C 42.565113 6.4845113 40.128883 7.5243408 36.53125 9.0625 C 32.933617 10.600659 28.256963 12.603668 23.621094 14.589844 C 14.349356 18.562196 5.2382813 22.470703 5.2382812 22.470703 L 5.3046875 22.445312 C 5.3046875 22.445312 4.7547875 22.629122 4.1972656 23.017578 C 3.9185047 23.211806 3.6186028 23.462555 3.3730469 23.828125 C 3.127491 24.193695 2.9479735 24.711788 3.015625 25.259766 C 3.2532479 27.184511 5.2480469 27.730469 5.2480469 27.730469 L 5.2558594 27.734375 L 14.158203 30.78125 C 14.385177 31.538434 16.858319 39.792923 17.402344 41.541016 C 17.702797 42.507484 17.984013 43.064995 18.277344 43.445312 C 18.424133 43.635633 18.577962 43.782915 18.748047 43.890625 C 18.815627 43.933415 18.8867 43.965525 18.957031 43.994141 C 18.958531 43.994806 18.959437 43.99348 18.960938 43.994141 C 18.969579 43.997952 18.977708 43.998295 18.986328 44.001953 L 18.962891 43.996094 C 18.979231 44.002694 18.995359 44.013801 19.011719 44.019531 C 19.043456 44.030655 19.062905 44.030268 19.103516 44.039062 C 20.123059 44.395042 20.966797 43.734375 20.966797 43.734375 L 21.001953 43.707031 L 26.470703 38.634766 L 35.345703 45.554688 L 35.457031 45.605469 C 37.010484 46.295216 38.415349 45.910403 39.193359 45.277344 C 39.97137 44.644284 40.277344 43.828125 40.277344 43.828125 L 40.310547 43.742188 L 46.832031 9.7519531 C 46.998903 8.9915162 47.022612 8.334202 46.865234 7.7402344 C 46.707857 7.1462668 46.325492 6.6299361 45.845703 6.34375 C 45.365914 6.0575639 44.864001 5.9649605 44.376953 5.9863281 z M 44.429688 8.0195312 C 44.627491 8.0103707 44.774102 8.032983 44.820312 8.0605469 C 44.866523 8.0881109 44.887272 8.0844829 44.931641 8.2519531 C 44.976011 8.419423 45.000036 8.7721605 44.878906 9.3242188 L 44.875 9.3359375 L 38.390625 43.128906 C 38.375275 43.162926 38.240151 43.475531 37.931641 43.726562 C 37.616914 43.982653 37.266874 44.182554 36.337891 43.792969 L 26.632812 36.224609 L 26.359375 36.009766 L 26.353516 36.015625 L 23.451172 33.837891 L 39.761719 14.648438 A 1.0001 1.0001 0 0 0 38.974609 13 A 1.0001 1.0001 0 0 0 38.445312 13.167969 L 14.84375 28.902344 L 5.9277344 25.849609 C 5.9277344 25.849609 5.0423771 25.356927 5 25.013672 C 4.99765 24.994652 4.9871961 25.011869 5.0332031 24.943359 C 5.0792101 24.874869 5.1948546 24.759225 5.3398438 24.658203 C 5.6298218 24.456159 5.9609375 24.333984 5.9609375 24.333984 L 5.9941406 24.322266 L 6.0273438 24.308594 C 6.0273438 24.308594 15.138894 20.399882 24.410156 16.427734 C 29.045787 14.44166 33.721617 12.440122 37.318359 10.902344 C 40.914175 9.3649615 43.512419 8.2583658 43.732422 8.1699219 C 43.982886 8.0696253 44.231884 8.0286918 44.429688 8.0195312 z M 33.613281 18.792969 L 21.244141 33.345703 L 21.238281 33.351562 A 1.0001 1.0001 0 0 0 21.183594 33.423828 A 1.0001 1.0001 0 0 0 21.128906 33.507812 A 1.0001 1.0001 0 0 0 20.998047 33.892578 A 1.0001 1.0001 0 0 0 20.998047 33.900391 L 19.386719 41.146484 C 19.35993 41.068197 19.341173 41.039555 19.3125 40.947266 L 19.3125 40.945312 C 18.800713 39.30085 16.467362 31.5161 16.144531 30.439453 L 33.613281 18.792969 z M 22.640625 35.730469 L 24.863281 37.398438 L 21.597656 40.425781 L 22.640625 35.730469 z"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?&text=<?php the_title() ?>&via=kryptografen&url=<?php the_permalink(); ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.394018 16.3291C2.24568 17.5041 4.40068 18.125 6.62569 18.125C9.88402 18.125 12.8699 16.8733 15.034 14.6008C17.1049 12.4258 18.244 9.5033 18.1874 6.53747C18.9724 5.8658 19.8957 4.5833 19.8957 3.3333C19.8957 2.85414 19.3757 2.54997 18.954 2.79414C18.2165 3.22747 17.544 3.3408 16.8524 3.14664C15.4399 1.76997 13.3374 1.47997 11.5657 2.43497C10.0174 3.2683 9.15652 4.7933 9.23402 6.45997C6.61819 6.1408 4.20152 4.82914 2.51652 2.7908C2.23985 2.4583 1.71485 2.49747 1.49485 2.87414C0.683185 4.26414 0.691518 5.87497 1.39735 7.1758C1.06152 7.23497 0.854018 7.51747 0.854018 7.8233C0.854018 9.1308 1.44235 10.3325 2.38985 11.1525C2.21318 11.3225 2.15485 11.575 2.22985 11.8C2.64652 13.0516 3.58985 14.03 4.76902 14.52C3.48652 15.1325 2.06818 15.3366 0.805685 15.1816C0.152351 15.0933 -0.170149 15.9716 0.394018 16.3291ZM6.79652 14.7341C7.26402 14.375 7.01569 13.6266 6.42902 13.6141C5.39568 13.5925 4.45485 13.0833 3.86902 12.2825C4.15152 12.2641 4.44402 12.2208 4.72235 12.1458C5.35652 11.9741 5.32652 11.0591 4.68235 10.93C3.51318 10.695 2.59568 9.8433 2.25152 8.74664C2.56568 8.82414 2.88568 8.86747 3.20485 8.8733C3.83735 8.87664 4.07652 8.0658 3.56068 7.72664C2.39818 6.9608 1.90235 5.6083 2.23068 4.33664C4.26068 6.3933 7.01485 7.63247 9.92818 7.77247C10.3457 7.7983 10.659 7.4058 10.5674 7.0083C10.1715 5.29247 11.1299 4.08997 12.159 3.5358C13.1774 2.9858 14.8124 2.81414 16.0657 4.12914C16.4382 4.52164 17.6949 4.53664 18.334 4.38747C18.0474 4.92747 17.6065 5.43997 17.194 5.7283C17.0182 5.85164 16.9174 6.05664 16.9282 6.2708C17.0624 9.0083 16.0424 11.73 14.1299 13.7375C12.2032 15.76 9.53902 16.8741 6.62652 16.8741C5.46818 16.8741 4.33235 16.6858 3.25902 16.3225C4.54235 16.0741 5.76152 15.5308 6.79652 14.7341Z"
                                              fill="#181818" fill-opacity="0.7"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <?php if ( have_rows( 'widget_info' ) ) : ?>
                        <div class="visible-lg sticky-head token-info-block__wrapper" data-margin-top="75" data-nosnippet="true">
                            <div class="token-info-block ">
                                <div class="token-info-block__head">
                                    <div class="token-info-block__head-desc">
                                        <div class="token-info-block__title"><?php the_title() ?></div>
                                    </div>
                                    <div class="token-info-block__img shadow_img">
                                        <?php $logo = get_field( 'logo' ); ?>
                                        <?php $size = 'full'; ?>
                                        <?php if ( $logo ) : ?>
                                            <?php echo wp_get_attachment_image( $logo, $size, '',
                                                [ "class" => "attachment-post-thumbnail size-post-thumbnail wp-post-image" ] ); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="token-info-block__body">
                                    <?php while ( have_rows( 'widget_info' ) ) : the_row(); ?>
                                        <div class="token-info-block__body-inner">
                                            <div class="token-info-block__body-inner-left">
                                                <div class="token-info-block__body-title"><?php the_sub_field( 'text' ); ?>
                                                    <span class="tooltip">
                                                    <i class="icon-info"></i>
                                                    <span class="tooltip__inner"><?php the_sub_field( 'tooltip' ); ?></span>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="token-info-block__body-inner-right">
                                                <?php if ( ! get_sub_field( 'description' ) ) { ?>
                                                    <div class="token-info-block__payment-method">
                                                        <?php if ( have_rows( 'icons_card' ) ) : ?>
                                                            <?php while ( have_rows( 'icons_card' ) ) : the_row(); ?>
                                                                <?php $icon_card = get_sub_field( 'icon_card' ); ?>
                                                                <?php $size = 'full'; ?>
                                                                <?php if ( $icon_card ) : ?>
                                                                    <?php echo wp_get_attachment_image( $icon_card,
                                                                        $size ); ?>
                                                                <?php endif; ?>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="token-info-block__price"><?php the_sub_field( 'description' ); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    <?php endwhile; ?>

                                    <div class="token-info-block__footer">
                                        <?php $custom_link = get_field( 'custom_link' ); ?>
                                        <?php if ( $custom_link ) : ?>
                                            <a href="<?php echo esc_url( $custom_link['url'] ); ?>"
                                               class="btn btn-primary btn-block"
                                               target="<?php echo esc_attr( $custom_link['target'] ); ?>"
                                               rel="nofollow"><?php echo $custom_link['title']; ?></a>
                                        <?php endif; ?>
                                        <span class="btn-notice">Annonselenke</span>
                                    </div>

                                </div><!-- /.token-info-block -->
                            </div>
                            <?php endif; ?>

                            <?php if ( get_field( 'show_sidebar_promo' ) == 1 ) : ?>

                            <div class="sidebar-promo">
                                <?php $image = get_field( 'image' ); ?>
                                <?php $size = 'full'; ?>
                                <?php if ( $image ) : ?>
                                    <?php echo wp_get_attachment_image( $image, $size ); ?>
                                <?php endif; ?>
                                <div class="text">
                                    <?php the_field( 'text' ); ?>
                                </div>
                                <div class="button-wrapper">
                                    <?php $button = get_field( 'button' ); ?>
                                    <?php if ( $button ) : ?>
                                        <a href="<?php echo esc_url( $button['url'] ); ?>" rel="nofollow" class="button" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endif; ?>

                        <?php
                            while ( have_posts() ) : the_post();

                            $post_id               = get_the_ID();
                                $show_ads              = false;
                                $show_post_ads         = false;
                                $post_categories       = get_the_category( $post_id );
                                $cat_id                = isset( $post_categories[0] ) ? $post_categories[0]->cat_ID : '';
                                $ads_default_image_url = 'https://kryptografen.no/wp-content/uploads/2023/11/gratis-bitcoin.webp';
                                $ads_categories        = [];

                                $ads_image_url = get_field('ngn_advertisement_image', 'options') ? get_field(
                                    'ngn_advertisement_image',
                                    'options'
                                ) : $ads_default_image_url;
                                $ads_title       = get_field('ngn_advertisement_title', 'options');
                                $ads_content     = get_field('ngn_advertisement_content', 'options');
                                $ads_button_text = get_field('ngn_advertisement_button_text', 'options');
                                $ads_link_url    = get_field('ngn_advertisement__link', 'options') ? get_field(
                                    'ngn_advertisement__link',
                                    'options'
                                ) : '/';
                                $ads_categories  = get_field('ngn_krypto_categories', 'options');
                                $ads_text_under_btn = get_field('ngn_category_ads_text_under_button', 'options');

                                $post_ads_image_url = get_field('kgn_post_ads_image', 'options') ? get_field(
                                    'kgn_post_ads_image',
                                    'options'
                                ) : $ads_default_image_url;
                                $post_ads_title          = get_field('kgn_post_ads_title', 'options');
                                $post_ads_content        = get_field('kgn_post_ads_content', 'options');
                                $post_ads_link_url       = get_field('kgn_post_ads_link', 'options');
                                $post_ads_posts          = get_field('kgn_post_ads_posts', 'options');
                                $post_ads_text_under_btn = get_field('kgn_post_ads_text_under_button', 'options');

                                if ( in_array( $cat_id, $ads_categories ) ) {
                                    $show_ads = true;
                                }

                                if ( in_array($post_id, $post_ads_posts) ) {
                                    $show_post_ads = true;
                                }



                        if ( $show_ads || $show_post_ads) : ?>
                            <div class="prom-blocks">
                                <?php if ( $show_ads ) : ?>
                                    <div class="prom-block" data-nosnippet="true">
                                        <div class="prom_image-block"><img src="<?php echo esc_url( $ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                        <div class="prom_title"><?php echo esc_html( $ads_title ) ?></div>
                                        <div class="prom_content"><?php echo esc_html( $ads_content ) ?></div>
                                        <div class="abs_button"><?php echo esc_html( $ads_button_text ) ?></div>
                                        <?php if ( $ads_text_under_btn ) : ?>
                                            <span class="abs_btn-notice"><?php echo esc_html( $ads_text_under_btn ); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( $ads_link_url ) ?>" rel="nofollow"></a>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $show_post_ads ) : ?>
                                    <div class="prom-block" data-nosnippet="true">
                                        <div class="prom_image-block"><img src="<?php echo esc_url( $post_ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                        <div class="prom_title"><?php echo esc_html( $post_ads_title ) ?></div>
                                        <div class="prom_content"><?php echo esc_html( $post_ads_content ) ?></div>
                                        <div class="abs_button"><?php echo esc_html( $post_ads_link_url['title'] ); ?></div>
                                        <?php if ( $post_ads_text_under_btn ) : ?>
                                            <span class="abs_btn-notice"><?php echo esc_html( $post_ads_text_under_btn ); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( $post_ads_link_url['url'] ) ?>" target="<?php echo esc_attr( $post_ads_link_url['target'] ); ?>" rel="nofollow"></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php get_template_part('template-parts/featured-articles', 'featured-articles', []); ?>

        <?php
    break;
    case 'posts_no_featured_image_with_author_name_and_date':
        ?>
        <main>
        <section class="hero-post white">
            <div class="container noimage__noauthor_container">
                <div class="noimage__noauthor_container_text">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
					yoast_breadcrumb( '<p id="breadcrumbs-green" class="breadcrumbs-green">', '</p>' );
				}
				?>
                </p>
                <h1><?php the_title() ?></h1>
                <p class="hero-post_description">
                    <?php the_field( 'description' ); ?>
                </p>
                <div class="hero__slider-item-header post_no_image_with_author">
                    <div class="hero__authordate">
                    <div class="hero__slider-item-author">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
                        <span><?php echo get_the_author_meta( 'display_name' ) ?></span>
                    </div>
                    
                    <div class="hero__slider-item-date">
                        <span class="kgn-capitalize"><?php echo esc_html__('Oppdatert ', 'cigtextdomain'); ?></span>
                        <span><?php echo get_the_date( 'd,F Y' ) ?></span>
                    </div>
                    </div>
                    <div class="guider-blocks-widget guider-blocks-flex post_no_image_with_author_socialicon">
                        <ul class="shared-list">
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3333 3102"
                                         shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                         image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                                         width="20" height="20"
                                    >
                                        <path d="M1204 925h640c26 0 47 21 47 47v196c52-57 118-109 199-151 107-56 240-92 395-92 356 0 569 113 693 299 122 183 155 433 155 715v1114c0 26-21 47-47 47h-667c-26 0-47-21-47-47v-988c0-113-1-243-42-340-37-88-111-152-258-152-154 0-241 55-290 138-52 88-64 211-64 336v1005c0 26-21 47-47 47h-667c-26 0-47-21-47-47V970c0-26 21-47 47-47zm593 94h-546v1988h572v-958c0-140 15-278 77-384 65-111 178-185 371-185 195 0 294 88 345 210 48 114 49 254 49 376v941h573V1940c0-265-30-499-139-663-107-161-295-258-615-258-139 0-257 32-352 82-114 59-194 142-239 222-8 14-23 24-41 24h-9c-26 0-47-21-47-47v-281zM789 393c0 109-44 207-116 279-71 71-170 116-279 116s-207-44-279-116C44 601-1 502-1 393s44-207 116-279C186 43 285-2 394-2s207 44 279 116c71 71 116 170 116 279zM607 605c54-54 88-129 88-212s-34-158-88-212-129-88-212-88-158 34-212 88-88 129-88 212 34 158 88 212 129 88 212 88 158-34 212-88zM48 924h694c26 0 47 21 47 47v2082c0 26-21 47-47 47H48c-26 0-47-21-47-47V971c0-26 21-47 47-47zm647 94H95v1988h600V1018z"
                                              fill-rule="nonzero"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_63_16657)">
                                            <path d="M11.3281 19.9609H8.12531C7.59033 19.9609 7.15515 19.5258 7.15515 18.9908V11.7667H5.28656C4.75159 11.7667 4.31641 11.3313 4.31641 10.7965V7.70096C4.31641 7.16599 4.75159 6.7308 5.28656 6.7308H7.15515V5.18066C7.15515 3.64365 7.63779 2.33597 8.55072 1.39923C9.46777 0.458221 10.7494 -0.0390625 12.2569 -0.0390625L14.6996 -0.0350952C15.2336 -0.0341797 15.668 0.401001 15.668 0.935059V3.8092C15.668 4.34418 15.233 4.77936 14.6982 4.77936L13.0536 4.77997C12.552 4.77997 12.4243 4.88052 12.397 4.91135C12.352 4.96246 12.2984 5.10696 12.2984 5.50598V6.73065H14.5746C14.7459 6.73065 14.912 6.77292 15.0546 6.85257C15.3624 7.02454 15.5537 7.3497 15.5537 7.70111L15.5525 10.7967C15.5525 11.3313 15.1173 11.7665 14.5824 11.7665H12.2984V18.9908C12.2984 19.5258 11.8631 19.9609 11.3281 19.9609ZM8.32764 18.7885H11.1258V11.2418C11.1258 10.8846 11.4165 10.594 11.7735 10.594H14.38L14.3811 7.90329H11.7734C11.4163 7.90329 11.1258 7.61276 11.1258 7.25555V5.50598C11.1258 5.04791 11.1723 4.52698 11.5181 4.13544C11.9359 3.66211 12.5943 3.60748 13.0533 3.60748L14.4955 3.60687V1.13709L12.256 1.13342C9.83322 1.13342 8.32764 2.68433 8.32764 5.18066V7.25555C8.32764 7.61261 8.03711 7.90329 7.68005 7.90329H5.48889V10.594H7.68005C8.03711 10.594 8.32764 10.8846 8.32764 11.2418V18.7885ZM14.6973 1.13739H14.6974H14.6973Z"
                                                  fill="#181818" fill-opacity="0.6"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_63_16657">
                                                <rect width="19.9609" height="20" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/share/url?&text=<?php the_title() ?>&url=<?php the_permalink(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#181818" viewBox="0 0 50 50"
                                         width="20px" height="20px">
                                        <path d="M 44.376953 5.9863281 C 43.889905 6.0076957 43.415817 6.1432497 42.988281 6.3144531 C 42.565113 6.4845113 40.128883 7.5243408 36.53125 9.0625 C 32.933617 10.600659 28.256963 12.603668 23.621094 14.589844 C 14.349356 18.562196 5.2382813 22.470703 5.2382812 22.470703 L 5.3046875 22.445312 C 5.3046875 22.445312 4.7547875 22.629122 4.1972656 23.017578 C 3.9185047 23.211806 3.6186028 23.462555 3.3730469 23.828125 C 3.127491 24.193695 2.9479735 24.711788 3.015625 25.259766 C 3.2532479 27.184511 5.2480469 27.730469 5.2480469 27.730469 L 5.2558594 27.734375 L 14.158203 30.78125 C 14.385177 31.538434 16.858319 39.792923 17.402344 41.541016 C 17.702797 42.507484 17.984013 43.064995 18.277344 43.445312 C 18.424133 43.635633 18.577962 43.782915 18.748047 43.890625 C 18.815627 43.933415 18.8867 43.965525 18.957031 43.994141 C 18.958531 43.994806 18.959437 43.99348 18.960938 43.994141 C 18.969579 43.997952 18.977708 43.998295 18.986328 44.001953 L 18.962891 43.996094 C 18.979231 44.002694 18.995359 44.013801 19.011719 44.019531 C 19.043456 44.030655 19.062905 44.030268 19.103516 44.039062 C 20.123059 44.395042 20.966797 43.734375 20.966797 43.734375 L 21.001953 43.707031 L 26.470703 38.634766 L 35.345703 45.554688 L 35.457031 45.605469 C 37.010484 46.295216 38.415349 45.910403 39.193359 45.277344 C 39.97137 44.644284 40.277344 43.828125 40.277344 43.828125 L 40.310547 43.742188 L 46.832031 9.7519531 C 46.998903 8.9915162 47.022612 8.334202 46.865234 7.7402344 C 46.707857 7.1462668 46.325492 6.6299361 45.845703 6.34375 C 45.365914 6.0575639 44.864001 5.9649605 44.376953 5.9863281 z M 44.429688 8.0195312 C 44.627491 8.0103707 44.774102 8.032983 44.820312 8.0605469 C 44.866523 8.0881109 44.887272 8.0844829 44.931641 8.2519531 C 44.976011 8.419423 45.000036 8.7721605 44.878906 9.3242188 L 44.875 9.3359375 L 38.390625 43.128906 C 38.375275 43.162926 38.240151 43.475531 37.931641 43.726562 C 37.616914 43.982653 37.266874 44.182554 36.337891 43.792969 L 26.632812 36.224609 L 26.359375 36.009766 L 26.353516 36.015625 L 23.451172 33.837891 L 39.761719 14.648438 A 1.0001 1.0001 0 0 0 38.974609 13 A 1.0001 1.0001 0 0 0 38.445312 13.167969 L 14.84375 28.902344 L 5.9277344 25.849609 C 5.9277344 25.849609 5.0423771 25.356927 5 25.013672 C 4.99765 24.994652 4.9871961 25.011869 5.0332031 24.943359 C 5.0792101 24.874869 5.1948546 24.759225 5.3398438 24.658203 C 5.6298218 24.456159 5.9609375 24.333984 5.9609375 24.333984 L 5.9941406 24.322266 L 6.0273438 24.308594 C 6.0273438 24.308594 15.138894 20.399882 24.410156 16.427734 C 29.045787 14.44166 33.721617 12.440122 37.318359 10.902344 C 40.914175 9.3649615 43.512419 8.2583658 43.732422 8.1699219 C 43.982886 8.0696253 44.231884 8.0286918 44.429688 8.0195312 z M 33.613281 18.792969 L 21.244141 33.345703 L 21.238281 33.351562 A 1.0001 1.0001 0 0 0 21.183594 33.423828 A 1.0001 1.0001 0 0 0 21.128906 33.507812 A 1.0001 1.0001 0 0 0 20.998047 33.892578 A 1.0001 1.0001 0 0 0 20.998047 33.900391 L 19.386719 41.146484 C 19.35993 41.068197 19.341173 41.039555 19.3125 40.947266 L 19.3125 40.945312 C 18.800713 39.30085 16.467362 31.5161 16.144531 30.439453 L 33.613281 18.792969 z M 22.640625 35.730469 L 24.863281 37.398438 L 21.597656 40.425781 L 22.640625 35.730469 z"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?&text=<?php the_title() ?>&via=kryptografen&url=<?php the_permalink(); ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.394018 16.3291C2.24568 17.5041 4.40068 18.125 6.62569 18.125C9.88402 18.125 12.8699 16.8733 15.034 14.6008C17.1049 12.4258 18.244 9.5033 18.1874 6.53747C18.9724 5.8658 19.8957 4.5833 19.8957 3.3333C19.8957 2.85414 19.3757 2.54997 18.954 2.79414C18.2165 3.22747 17.544 3.3408 16.8524 3.14664C15.4399 1.76997 13.3374 1.47997 11.5657 2.43497C10.0174 3.2683 9.15652 4.7933 9.23402 6.45997C6.61819 6.1408 4.20152 4.82914 2.51652 2.7908C2.23985 2.4583 1.71485 2.49747 1.49485 2.87414C0.683185 4.26414 0.691518 5.87497 1.39735 7.1758C1.06152 7.23497 0.854018 7.51747 0.854018 7.8233C0.854018 9.1308 1.44235 10.3325 2.38985 11.1525C2.21318 11.3225 2.15485 11.575 2.22985 11.8C2.64652 13.0516 3.58985 14.03 4.76902 14.52C3.48652 15.1325 2.06818 15.3366 0.805685 15.1816C0.152351 15.0933 -0.170149 15.9716 0.394018 16.3291ZM6.79652 14.7341C7.26402 14.375 7.01569 13.6266 6.42902 13.6141C5.39568 13.5925 4.45485 13.0833 3.86902 12.2825C4.15152 12.2641 4.44402 12.2208 4.72235 12.1458C5.35652 11.9741 5.32652 11.0591 4.68235 10.93C3.51318 10.695 2.59568 9.8433 2.25152 8.74664C2.56568 8.82414 2.88568 8.86747 3.20485 8.8733C3.83735 8.87664 4.07652 8.0658 3.56068 7.72664C2.39818 6.9608 1.90235 5.6083 2.23068 4.33664C4.26068 6.3933 7.01485 7.63247 9.92818 7.77247C10.3457 7.7983 10.659 7.4058 10.5674 7.0083C10.1715 5.29247 11.1299 4.08997 12.159 3.5358C13.1774 2.9858 14.8124 2.81414 16.0657 4.12914C16.4382 4.52164 17.6949 4.53664 18.334 4.38747C18.0474 4.92747 17.6065 5.43997 17.194 5.7283C17.0182 5.85164 16.9174 6.05664 16.9282 6.2708C17.0624 9.0083 16.0424 11.73 14.1299 13.7375C12.2032 15.76 9.53902 16.8741 6.62652 16.8741C5.46818 16.8741 4.33235 16.6858 3.25902 16.3225C4.54235 16.0741 5.76152 15.5308 6.79652 14.7341Z"
                                              fill="#181818" fill-opacity="0.7"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
                </div>
            </div>
        </section>
        <section class="article-block noimage__noauthor_article">
            <div class="container">
                <div class="guider-blocks-wrapper">
                    <div class="guider-blocks-info post_no_image_with_author_info">
                        <!-- <div class="thumbnail-img">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                        </div> -->
<!--                        Mobile adv block-->
                        <?php if ( $show_ads ) :  ?>
                            <div class="mobile-prom-block" data-nosnippet="true" >
                                <div class="prom_image-block"><img src="<?php echo esc_url( $ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                <div class="mobile_prom_title"><?php echo esc_html( $ads_title ) ?></div>
                                <div class="mobile_prom_content"><?php echo esc_html( $ads_content ) ?></div>
                                <div class="abs_button"><?php echo esc_html( $ads_button_text ) ?></div>
                                <?php if ( $ads_text_under_btn ) : ?>
                                    <span class="abs_btn-notice"><?php echo esc_html( $ads_text_under_btn ); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $ads_link_url ) ?>" rel="nofollow"></a>
                            </div>
                        <?php endif; ?>
                        <?php if ( $show_post_ads ) : ?>
                            <div class="mobile-prom-block" data-nosnippet="true">
                                <div class="prom_image-block"><img src="<?php echo esc_url( $post_ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                <div class="mobile_prom_title"><?php echo esc_html( $post_ads_title ) ?></div>
                                <div class="mobile_prom_content"><?php echo esc_html( $post_ads_content ) ?></div>
                                <div class="abs_button"><?php echo esc_html( $post_ads_link_url['title'] ) ?></div>
                                <?php if ( $post_ads_text_under_btn ) : ?>
                                    <span class="abs_btn-notice"><?php echo esc_html( $post_ads_text_under_btn ); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $post_ads_link_url['url'] ) ?>" rel="nofollow"></a>
                            </div>
                        <?php endif; ?>
<!--                       End of Mobile adv block-->

                        <div class="guider-blocks-text">
							<?php the_content(); ?>
                        </div>
                        <a href="/" class="back-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12"
                                 fill="none">
                                <path d="M14.6665 6.22875C14.6665 6.54517 14.4314 6.80666 14.1263 6.84805L14.0415 6.85375L3.05484 6.85325L7.02399 10.8062C7.2686 11.0497 7.26945 11.4455 7.0259 11.6901C6.80449 11.9124 6.45731 11.9334 6.21225 11.7523L6.14202 11.692L1.10035 6.67198C1.06811 6.63987 1.0401 6.60513 1.01633 6.56844C1.00962 6.55739 1.00279 6.5461 0.996308 6.53457C0.990349 6.52469 0.984965 6.51443 0.979885 6.50406C0.972828 6.48897 0.965935 6.47338 0.959676 6.45747C0.95459 6.4452 0.950344 6.43327 0.946471 6.42125C0.941866 6.40633 0.937392 6.39044 0.933544 6.37431C0.930683 6.36305 0.928417 6.35221 0.926441 6.34132C0.923661 6.32513 0.921296 6.30838 0.919608 6.29142C0.918149 6.27849 0.917272 6.26567 0.916788 6.25285C0.916663 6.24507 0.916504 6.23693 0.916504 6.22875L0.916818 6.20454C0.917297 6.19228 0.918134 6.18002 0.919332 6.16779L0.916504 6.22875C0.916504 6.18931 0.920158 6.15073 0.927145 6.11331C0.928765 6.10438 0.930695 6.0952 0.932833 6.08607C0.937273 6.06725 0.942403 6.04913 0.948311 6.03137C0.951211 6.02255 0.954589 6.01312 0.958199 6.00376C0.965503 5.98495 0.973442 5.96703 0.982174 5.94956C0.986232 5.94135 0.990776 5.93276 0.995534 5.92425C1.00334 5.91036 1.01139 5.89717 1.0199 5.88431C1.0259 5.87521 1.03255 5.86574 1.03949 5.85642L1.0449 5.84921C1.06174 5.82722 1.08001 5.80637 1.09956 5.78681L1.10031 5.78623L6.14198 0.765397C6.38656 0.521825 6.78229 0.522644 7.02586 0.767227C7.24729 0.989575 7.26674 1.33684 7.08469 1.58114L7.02403 1.65111L3.0565 5.60325L14.0415 5.60375C14.3867 5.60375 14.6665 5.88357 14.6665 6.22875Z"
                                      fill="#00D084"/>
                            </svg>
                            <?php _e('Back', 'cigtextdomain')?>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <?php get_template_part('template-parts/featured-articles', 'featured-articles', []); ?>

        <?php
    break;
    default:
?>

<?php
while ( have_posts() ) : the_post();

//    Adv block variables
    $post_id               = get_the_ID();
    $show_ads              = false;
    $show_post_ads         = false;
    $post_categories       = get_the_category( $post_id );
    $cat_id                = isset( $post_categories[0] ) ? $post_categories[0]->cat_ID : '';
    $ads_default_image_url = 'https://kryptografen.no/wp-content/uploads/2023/11/gratis-bitcoin.webp';
    $ads_categories        = [];

    $ads_image_url = get_field('ngn_advertisement_image', 'options') ? get_field(
        'ngn_advertisement_image',
        'options'
    ) : $ads_default_image_url;
    $ads_title       = get_field('ngn_advertisement_title', 'options');
    $ads_content     = get_field('ngn_advertisement_content', 'options');
    $ads_button_text = get_field('ngn_advertisement_button_text', 'options');
    $ads_link_url    = get_field('ngn_advertisement__link', 'options') ? get_field(
        'ngn_advertisement__link',
        'options'
    ) : '/';
    $ads_categories  = get_field('ngn_krypto_categories', 'options');
    $ads_text_under_btn = get_field('ngn_category_ads_text_under_button', 'options');

    $post_ads_image_url = get_field('kgn_post_ads_image', 'options') ? get_field(
        'kgn_post_ads_image',
        'options'
    ) : $ads_default_image_url;
    $post_ads_title          = get_field('kgn_post_ads_title', 'options');
    $post_ads_content        = get_field('kgn_post_ads_content', 'options');
    $post_ads_link_url       = get_field('kgn_post_ads_link', 'options');
    $post_ads_posts          = get_field('kgn_post_ads_posts', 'options');
    $post_ads_text_under_btn = get_field('kgn_post_ads_text_under_button', 'options');

    if ( in_array( $cat_id, $ads_categories ) ) {
        $show_ads = true;
    }

    if ( in_array($post_id, $post_ads_posts) ) {
        $show_post_ads = true;
    }


//    End of Adv block variables

?>
    <main>
        <section class="hero-post white">
            <div class="container">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
					yoast_breadcrumb( '<p id="breadcrumbs-green" class="breadcrumbs-green">', '</p>' );
				}
				?>
                </p>
                <h1><?php the_title() ?></h1>
                <p class="hero-post_description">
                    <?php the_field( 'description' ); ?>
                </p>
                <div class="hero__slider-item-header">
                    <div class="hero__slider-item-author">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
                        <span><?php echo get_the_author_meta( 'display_name' ) ?></span>
                    </div>
                    <div class="hero__slider-item-date">
                        <span class="kgn-capitalize"><?php echo esc_html__('Oppdatert ', 'cigtextdomain'); ?></span>
<!--                        <img src="--><?php //echo THEME_ASSETS_URL ?><!--/img/calendar-black.svg" alt="calendar">-->
                        <span><?php echo get_the_date( 'd,F Y' ) ?></span>
                    </div>
                </div>
            </div>
        </section>
        <section class="article-block">
            <div class="container">
                <div class="guider-blocks-wrapper">
                    <div class="guider-blocks-info">
                        <div class="thumbnail-img">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                        </div>
<!--                        Mobile adv block-->
                        <?php if ( $show_ads ) :  ?>
                            <div class="mobile-prom-block" data-nosnippet="true" >
                                <div class="prom_image-block"><img src="<?php echo esc_url( $ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                <div class="mobile_prom_title"><?php echo esc_html( $ads_title ) ?></div>
                                <div class="mobile_prom_content"><?php echo esc_html( $ads_content ) ?></div>
                                <div class="abs_button"><?php echo esc_html( $ads_button_text ) ?></div>
                                <?php if ( $ads_text_under_btn ) : ?>
                                    <span class="abs_btn-notice"><?php echo esc_html( $ads_text_under_btn ); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $ads_link_url ) ?>" rel="nofollow"></a>
                            </div>
                        <?php endif; ?>
                        <?php if ( $show_post_ads ) : ?>
                            <div class="mobile-prom-block" data-nosnippet="true">
                                <div class="prom_image-block"><img src="<?php echo esc_url( $post_ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                <div class="mobile_prom_title"><?php echo esc_html( $post_ads_title ) ?></div>
                                <div class="mobile_prom_content"><?php echo esc_html( $post_ads_content ) ?></div>
                                <div class="abs_button"><?php echo esc_html( $post_ads_link_url['title'] ) ?></div>
                                <?php if ( $post_ads_text_under_btn ) : ?>
                                    <span class="abs_btn-notice"><?php echo esc_html( $post_ads_text_under_btn ); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $post_ads_link_url['url'] ) ?>" rel="nofollow"></a>
                            </div>
                        <?php endif; ?>
<!--                       End of Mobile adv block-->

                        <div class="guider-blocks-text">
							<?php the_content(); ?>
                        </div>
                        <a href="/" class="back-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12"
                                 fill="none">
                                <path d="M14.6665 6.22875C14.6665 6.54517 14.4314 6.80666 14.1263 6.84805L14.0415 6.85375L3.05484 6.85325L7.02399 10.8062C7.2686 11.0497 7.26945 11.4455 7.0259 11.6901C6.80449 11.9124 6.45731 11.9334 6.21225 11.7523L6.14202 11.692L1.10035 6.67198C1.06811 6.63987 1.0401 6.60513 1.01633 6.56844C1.00962 6.55739 1.00279 6.5461 0.996308 6.53457C0.990349 6.52469 0.984965 6.51443 0.979885 6.50406C0.972828 6.48897 0.965935 6.47338 0.959676 6.45747C0.95459 6.4452 0.950344 6.43327 0.946471 6.42125C0.941866 6.40633 0.937392 6.39044 0.933544 6.37431C0.930683 6.36305 0.928417 6.35221 0.926441 6.34132C0.923661 6.32513 0.921296 6.30838 0.919608 6.29142C0.918149 6.27849 0.917272 6.26567 0.916788 6.25285C0.916663 6.24507 0.916504 6.23693 0.916504 6.22875L0.916818 6.20454C0.917297 6.19228 0.918134 6.18002 0.919332 6.16779L0.916504 6.22875C0.916504 6.18931 0.920158 6.15073 0.927145 6.11331C0.928765 6.10438 0.930695 6.0952 0.932833 6.08607C0.937273 6.06725 0.942403 6.04913 0.948311 6.03137C0.951211 6.02255 0.954589 6.01312 0.958199 6.00376C0.965503 5.98495 0.973442 5.96703 0.982174 5.94956C0.986232 5.94135 0.990776 5.93276 0.995534 5.92425C1.00334 5.91036 1.01139 5.89717 1.0199 5.88431C1.0259 5.87521 1.03255 5.86574 1.03949 5.85642L1.0449 5.84921C1.06174 5.82722 1.08001 5.80637 1.09956 5.78681L1.10031 5.78623L6.14198 0.765397C6.38656 0.521825 6.78229 0.522644 7.02586 0.767227C7.24729 0.989575 7.26674 1.33684 7.08469 1.58114L7.02403 1.65111L3.0565 5.60325L14.0415 5.60375C14.3867 5.60375 14.6665 5.88357 14.6665 6.22875Z"
                                      fill="#00D084"/>
                            </svg>
                            <?php _e('Back', 'cigtextdomain')?>
                        </a>
                    </div>
                    <div class="guider-blocks-widget guider-blocks-flex">
                        <ul class="shared-list">
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3333 3102"
                                         shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                         image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                                         width="20" height="20"
                                    >
                                        <path d="M1204 925h640c26 0 47 21 47 47v196c52-57 118-109 199-151 107-56 240-92 395-92 356 0 569 113 693 299 122 183 155 433 155 715v1114c0 26-21 47-47 47h-667c-26 0-47-21-47-47v-988c0-113-1-243-42-340-37-88-111-152-258-152-154 0-241 55-290 138-52 88-64 211-64 336v1005c0 26-21 47-47 47h-667c-26 0-47-21-47-47V970c0-26 21-47 47-47zm593 94h-546v1988h572v-958c0-140 15-278 77-384 65-111 178-185 371-185 195 0 294 88 345 210 48 114 49 254 49 376v941h573V1940c0-265-30-499-139-663-107-161-295-258-615-258-139 0-257 32-352 82-114 59-194 142-239 222-8 14-23 24-41 24h-9c-26 0-47-21-47-47v-281zM789 393c0 109-44 207-116 279-71 71-170 116-279 116s-207-44-279-116C44 601-1 502-1 393s44-207 116-279C186 43 285-2 394-2s207 44 279 116c71 71 116 170 116 279zM607 605c54-54 88-129 88-212s-34-158-88-212-129-88-212-88-158 34-212 88-88 129-88 212 34 158 88 212 129 88 212 88 158-34 212-88zM48 924h694c26 0 47 21 47 47v2082c0 26-21 47-47 47H48c-26 0-47-21-47-47V971c0-26 21-47 47-47zm647 94H95v1988h600V1018z"
                                              fill-rule="nonzero"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_63_16657)">
                                            <path d="M11.3281 19.9609H8.12531C7.59033 19.9609 7.15515 19.5258 7.15515 18.9908V11.7667H5.28656C4.75159 11.7667 4.31641 11.3313 4.31641 10.7965V7.70096C4.31641 7.16599 4.75159 6.7308 5.28656 6.7308H7.15515V5.18066C7.15515 3.64365 7.63779 2.33597 8.55072 1.39923C9.46777 0.458221 10.7494 -0.0390625 12.2569 -0.0390625L14.6996 -0.0350952C15.2336 -0.0341797 15.668 0.401001 15.668 0.935059V3.8092C15.668 4.34418 15.233 4.77936 14.6982 4.77936L13.0536 4.77997C12.552 4.77997 12.4243 4.88052 12.397 4.91135C12.352 4.96246 12.2984 5.10696 12.2984 5.50598V6.73065H14.5746C14.7459 6.73065 14.912 6.77292 15.0546 6.85257C15.3624 7.02454 15.5537 7.3497 15.5537 7.70111L15.5525 10.7967C15.5525 11.3313 15.1173 11.7665 14.5824 11.7665H12.2984V18.9908C12.2984 19.5258 11.8631 19.9609 11.3281 19.9609ZM8.32764 18.7885H11.1258V11.2418C11.1258 10.8846 11.4165 10.594 11.7735 10.594H14.38L14.3811 7.90329H11.7734C11.4163 7.90329 11.1258 7.61276 11.1258 7.25555V5.50598C11.1258 5.04791 11.1723 4.52698 11.5181 4.13544C11.9359 3.66211 12.5943 3.60748 13.0533 3.60748L14.4955 3.60687V1.13709L12.256 1.13342C9.83322 1.13342 8.32764 2.68433 8.32764 5.18066V7.25555C8.32764 7.61261 8.03711 7.90329 7.68005 7.90329H5.48889V10.594H7.68005C8.03711 10.594 8.32764 10.8846 8.32764 11.2418V18.7885ZM14.6973 1.13739H14.6974H14.6973Z"
                                                  fill="#181818" fill-opacity="0.6"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_63_16657">
                                                <rect width="19.9609" height="20" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/share/url?&text=<?php the_title() ?>&url=<?php the_permalink(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#181818" viewBox="0 0 50 50"
                                         width="20px" height="20px">
                                        <path d="M 44.376953 5.9863281 C 43.889905 6.0076957 43.415817 6.1432497 42.988281 6.3144531 C 42.565113 6.4845113 40.128883 7.5243408 36.53125 9.0625 C 32.933617 10.600659 28.256963 12.603668 23.621094 14.589844 C 14.349356 18.562196 5.2382813 22.470703 5.2382812 22.470703 L 5.3046875 22.445312 C 5.3046875 22.445312 4.7547875 22.629122 4.1972656 23.017578 C 3.9185047 23.211806 3.6186028 23.462555 3.3730469 23.828125 C 3.127491 24.193695 2.9479735 24.711788 3.015625 25.259766 C 3.2532479 27.184511 5.2480469 27.730469 5.2480469 27.730469 L 5.2558594 27.734375 L 14.158203 30.78125 C 14.385177 31.538434 16.858319 39.792923 17.402344 41.541016 C 17.702797 42.507484 17.984013 43.064995 18.277344 43.445312 C 18.424133 43.635633 18.577962 43.782915 18.748047 43.890625 C 18.815627 43.933415 18.8867 43.965525 18.957031 43.994141 C 18.958531 43.994806 18.959437 43.99348 18.960938 43.994141 C 18.969579 43.997952 18.977708 43.998295 18.986328 44.001953 L 18.962891 43.996094 C 18.979231 44.002694 18.995359 44.013801 19.011719 44.019531 C 19.043456 44.030655 19.062905 44.030268 19.103516 44.039062 C 20.123059 44.395042 20.966797 43.734375 20.966797 43.734375 L 21.001953 43.707031 L 26.470703 38.634766 L 35.345703 45.554688 L 35.457031 45.605469 C 37.010484 46.295216 38.415349 45.910403 39.193359 45.277344 C 39.97137 44.644284 40.277344 43.828125 40.277344 43.828125 L 40.310547 43.742188 L 46.832031 9.7519531 C 46.998903 8.9915162 47.022612 8.334202 46.865234 7.7402344 C 46.707857 7.1462668 46.325492 6.6299361 45.845703 6.34375 C 45.365914 6.0575639 44.864001 5.9649605 44.376953 5.9863281 z M 44.429688 8.0195312 C 44.627491 8.0103707 44.774102 8.032983 44.820312 8.0605469 C 44.866523 8.0881109 44.887272 8.0844829 44.931641 8.2519531 C 44.976011 8.419423 45.000036 8.7721605 44.878906 9.3242188 L 44.875 9.3359375 L 38.390625 43.128906 C 38.375275 43.162926 38.240151 43.475531 37.931641 43.726562 C 37.616914 43.982653 37.266874 44.182554 36.337891 43.792969 L 26.632812 36.224609 L 26.359375 36.009766 L 26.353516 36.015625 L 23.451172 33.837891 L 39.761719 14.648438 A 1.0001 1.0001 0 0 0 38.974609 13 A 1.0001 1.0001 0 0 0 38.445312 13.167969 L 14.84375 28.902344 L 5.9277344 25.849609 C 5.9277344 25.849609 5.0423771 25.356927 5 25.013672 C 4.99765 24.994652 4.9871961 25.011869 5.0332031 24.943359 C 5.0792101 24.874869 5.1948546 24.759225 5.3398438 24.658203 C 5.6298218 24.456159 5.9609375 24.333984 5.9609375 24.333984 L 5.9941406 24.322266 L 6.0273438 24.308594 C 6.0273438 24.308594 15.138894 20.399882 24.410156 16.427734 C 29.045787 14.44166 33.721617 12.440122 37.318359 10.902344 C 40.914175 9.3649615 43.512419 8.2583658 43.732422 8.1699219 C 43.982886 8.0696253 44.231884 8.0286918 44.429688 8.0195312 z M 33.613281 18.792969 L 21.244141 33.345703 L 21.238281 33.351562 A 1.0001 1.0001 0 0 0 21.183594 33.423828 A 1.0001 1.0001 0 0 0 21.128906 33.507812 A 1.0001 1.0001 0 0 0 20.998047 33.892578 A 1.0001 1.0001 0 0 0 20.998047 33.900391 L 19.386719 41.146484 C 19.35993 41.068197 19.341173 41.039555 19.3125 40.947266 L 19.3125 40.945312 C 18.800713 39.30085 16.467362 31.5161 16.144531 30.439453 L 33.613281 18.792969 z M 22.640625 35.730469 L 24.863281 37.398438 L 21.597656 40.425781 L 22.640625 35.730469 z"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?&text=<?php the_title() ?>&via=kryptografen&url=<?php the_permalink(); ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.394018 16.3291C2.24568 17.5041 4.40068 18.125 6.62569 18.125C9.88402 18.125 12.8699 16.8733 15.034 14.6008C17.1049 12.4258 18.244 9.5033 18.1874 6.53747C18.9724 5.8658 19.8957 4.5833 19.8957 3.3333C19.8957 2.85414 19.3757 2.54997 18.954 2.79414C18.2165 3.22747 17.544 3.3408 16.8524 3.14664C15.4399 1.76997 13.3374 1.47997 11.5657 2.43497C10.0174 3.2683 9.15652 4.7933 9.23402 6.45997C6.61819 6.1408 4.20152 4.82914 2.51652 2.7908C2.23985 2.4583 1.71485 2.49747 1.49485 2.87414C0.683185 4.26414 0.691518 5.87497 1.39735 7.1758C1.06152 7.23497 0.854018 7.51747 0.854018 7.8233C0.854018 9.1308 1.44235 10.3325 2.38985 11.1525C2.21318 11.3225 2.15485 11.575 2.22985 11.8C2.64652 13.0516 3.58985 14.03 4.76902 14.52C3.48652 15.1325 2.06818 15.3366 0.805685 15.1816C0.152351 15.0933 -0.170149 15.9716 0.394018 16.3291ZM6.79652 14.7341C7.26402 14.375 7.01569 13.6266 6.42902 13.6141C5.39568 13.5925 4.45485 13.0833 3.86902 12.2825C4.15152 12.2641 4.44402 12.2208 4.72235 12.1458C5.35652 11.9741 5.32652 11.0591 4.68235 10.93C3.51318 10.695 2.59568 9.8433 2.25152 8.74664C2.56568 8.82414 2.88568 8.86747 3.20485 8.8733C3.83735 8.87664 4.07652 8.0658 3.56068 7.72664C2.39818 6.9608 1.90235 5.6083 2.23068 4.33664C4.26068 6.3933 7.01485 7.63247 9.92818 7.77247C10.3457 7.7983 10.659 7.4058 10.5674 7.0083C10.1715 5.29247 11.1299 4.08997 12.159 3.5358C13.1774 2.9858 14.8124 2.81414 16.0657 4.12914C16.4382 4.52164 17.6949 4.53664 18.334 4.38747C18.0474 4.92747 17.6065 5.43997 17.194 5.7283C17.0182 5.85164 16.9174 6.05664 16.9282 6.2708C17.0624 9.0083 16.0424 11.73 14.1299 13.7375C12.2032 15.76 9.53902 16.8741 6.62652 16.8741C5.46818 16.8741 4.33235 16.6858 3.25902 16.3225C4.54235 16.0741 5.76152 15.5308 6.79652 14.7341Z"
                                              fill="#181818" fill-opacity="0.7"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <?php if ( have_rows( 'widget_info' ) ) : ?>
                        <div class="visible-lg sticky-head token-info-block__wrapper" data-margin-top="75" data-nosnippet="true">
                            <div class="token-info-block ">
                                <div class="token-info-block__head">
                                    <div class="token-info-block__head-desc">
                                        <div class="token-info-block__title"><?php the_title() ?></div>
                                    </div>
                                    <div class="token-info-block__img shadow_img">
                                        <?php $logo = get_field( 'logo' ); ?>
                                        <?php $size = 'full'; ?>
                                        <?php if ( $logo ) : ?>
                                            <?php echo wp_get_attachment_image( $logo, $size, '',
                                                [ "class" => "attachment-post-thumbnail size-post-thumbnail wp-post-image" ] ); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="token-info-block__body">
                                    <?php while ( have_rows( 'widget_info' ) ) : the_row(); ?>
                                        <div class="token-info-block__body-inner">
                                            <div class="token-info-block__body-inner-left">
                                                <div class="token-info-block__body-title"><?php the_sub_field( 'text' ); ?>
                                                    <span class="tooltip">
                                                    <i class="icon-info"></i>
                                                    <span class="tooltip__inner"><?php the_sub_field( 'tooltip' ); ?></span>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="token-info-block__body-inner-right">
                                                <?php if ( ! get_sub_field( 'description' ) ) { ?>
                                                    <div class="token-info-block__payment-method">
                                                        <?php if ( have_rows( 'icons_card' ) ) : ?>
                                                            <?php while ( have_rows( 'icons_card' ) ) : the_row(); ?>
                                                                <?php $icon_card = get_sub_field( 'icon_card' ); ?>
                                                                <?php $size = 'full'; ?>
                                                                <?php if ( $icon_card ) : ?>
                                                                    <?php echo wp_get_attachment_image( $icon_card,
                                                                        $size ); ?>
                                                                <?php endif; ?>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="token-info-block__price"><?php the_sub_field( 'description' ); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    <?php endwhile; ?>

                                    <div class="token-info-block__footer">
                                        <?php $custom_link = get_field( 'custom_link' ); ?>
                                        <?php if ( $custom_link ) : ?>
                                            <a href="<?php echo esc_url( $custom_link['url'] ); ?>"
                                               class="btn btn-primary btn-block"
                                               target="<?php echo esc_attr( $custom_link['target'] ); ?>"
                                               rel="nofollow"><?php echo $custom_link['title']; ?></a>
                                        <?php endif; ?>
                                        <span class="btn-notice">Annonselenke</span>
                                    </div>

                                </div><!-- /.token-info-block -->
                            </div>
                            <?php endif; ?>

                            <?php if ( get_field( 'show_sidebar_promo' ) == 1 ) : ?>

                            <div class="sidebar-promo">
                                <?php $image = get_field( 'image' ); ?>
                                <?php $size = 'full'; ?>
                                <?php if ( $image ) : ?>
                                    <?php echo wp_get_attachment_image( $image, $size ); ?>
                                <?php endif; ?>
                                <div class="text">
                                    <?php the_field( 'text' ); ?>
                                </div>
                                <div class="button-wrapper">
                                    <?php $button = get_field( 'button' ); ?>
                                    <?php if ( $button ) : ?>
                                        <a href="<?php echo esc_url( $button['url'] ); ?>" rel="nofollow" class="button" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endif; ?>

                            <?php if ( $show_ads || $show_post_ads) : ?>
                                <div class="prom-blocks">
                                    <?php if ( $show_ads ) : ?>
                                        <div class="ads-block" data-nosnippet="true">
                                            <div class="prom_image-block"><img src="<?php echo esc_url( $ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                            <div class="prom_title"><?php echo esc_html( $ads_title ) ?></div>
                                            <div class="prom_content"><?php echo esc_html( $ads_content ) ?></div>
                                            <div class="abs_button"><?php echo esc_html( $ads_button_text ) ?></div>
                                            <?php if ( $ads_text_under_btn ) : ?>
                                                <span class="abs_btn-notice"><?php echo esc_html( $ads_text_under_btn ); ?></span>
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url( $ads_link_url ) ?>" rel="nofollow"></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( $show_post_ads ) : ?>
                                        <div class="prom-block" data-nosnippet="true">
                                            <div class="prom_image-block"><img src="<?php echo esc_url( $post_ads_image_url ) ?>" alt="ads-image" class="prom_image"></div>
                                            <div class="prom_title"><?php echo esc_html( $post_ads_title ) ?></div>
                                            <div class="prom_content"><?php echo esc_html( $post_ads_content ) ?></div>
                                            <div class="abs_button"><?php echo esc_html( $post_ads_link_url['title'] ); ?></div>
                                            <?php if ( $post_ads_text_under_btn ) : ?>
                                                <span class="abs_btn-notice"><?php echo esc_html( $post_ads_text_under_btn ); ?></span>
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url( $post_ads_link_url['url'] ) ?>" target="<?php echo esc_attr( $post_ads_link_url['target'] ); ?>" rel="nofollow"></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php get_template_part('template-parts/featured-articles', 'featured-articles', []); ?>
  <script>
        if (jQuery(window).width() < 960) {
            jQuery('.thumbnail-img').after(jQuery('.guider-blocks-widget'))
        }

        jQuery(window).on('resize', function(){
            var win = jQuery(this); //this = window
            if (win.width() < 960) {
                jQuery('.thumbnail-img').after(jQuery('.sidebar-promo'))
            }else{
                jQuery('.shared-list').before(jQuery('.sidebar-promo'));
            }
        });
    </script>
		<?php if ( get_field( 'title_faq' ) ) { ?>
				<?php echo get_template_part( '/template-parts/blocks/partials/faq' ) ?>
		<?php } ?>

<?php endwhile;
?>

<?php
}
get_footer();
