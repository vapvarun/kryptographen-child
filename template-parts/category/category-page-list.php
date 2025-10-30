<?php

?>
<section class="category-posts">
    <div class="container">
        <div class="category-posts__heading">
            <h1><?php echo single_cat_title(); ?></h1>
        </div>
        <div class="category-posts-filters">
            <div class="category-posts-filters_view">
                <div class="category-posts-filters_view_block active" data-view="block">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="#181818"
                         xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_83_106)">
                            <path d="M5.81278 0H1.21913C0.547399 0 0.000976562 0.546422 0.000976562 1.21815V5.81181C0.000976562 6.48353 0.547399 7.02996 1.21913 7.02996H5.81278C6.48451 7.02996 7.03093 6.48353 7.03093 5.81181V1.21815C7.03082 0.546422 6.48451 0 5.81278 0Z"/>
                            <path d="M14.7818 0H10.1881C9.51639 0 8.96997 0.546422 8.96997 1.21815V5.81181C8.96997 6.48353 9.51639 7.02996 10.1881 7.02996H14.7818C15.4535 7.02996 15.9999 6.48353 15.9999 5.81181V1.21815C15.9999 0.546422 15.4535 0 14.7818 0Z"/>
                            <path d="M5.8118 8.97003H1.21815C0.546422 8.97003 0 9.5164 0 10.1881V14.7818C0 15.4535 0.546422 15.9999 1.21815 15.9999H5.8118C6.48353 15.9999 7.02995 15.4535 7.02995 14.7818V10.1881C7.02985 9.5164 6.48353 8.97003 5.8118 8.97003Z"/>
                            <path d="M14.7818 8.97003H10.1881C9.51639 8.97003 8.96997 9.51646 8.96997 10.1882V14.7818C8.96997 15.4536 9.51639 16 10.1881 16H14.7818C15.4535 15.9999 15.9999 15.4535 15.9999 14.7818V10.1881C15.9999 9.5164 15.4535 8.97003 14.7818 8.97003Z"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_83_106">
                                <rect width="16" height="16"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="category-posts-filters_view_list" data-view="list">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="#181818"
                         xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_83_114)">
                            <path d="M15.1112 -0.0138855H0.888835C0.399089 -0.0138855 0 0.210605 0 0.486092V1.48614C0 1.76162 0.399089 1.98611 0.888835 1.98611H15.1112C15.6009 1.98611 16 1.76162 16 1.48614V0.486092C16 0.210605 15.6009 -0.0138855 15.1112 -0.0138855Z"/>
                            <path d="M15.1112 7H0.888835C0.399089 7 0 7.22449 0 7.49998V8.50002C0 8.77551 0.399089 9 0.888835 9H15.1112C15.6009 9 16 8.77551 16 8.50002V7.49998C16 7.22449 15.6009 7 15.1112 7Z"/>
                            <path d="M15.1112 14H0.888835C0.399089 14 0 14.2245 0 14.5V15.5C0 15.7755 0.399089 16 0.888835 16H15.1112C15.6009 16 16 15.7755 16 15.5V14.5C16 14.2245 15.6009 14 15.1112 14Z"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_83_114">
                                <rect width="16" height="16" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>

        <div class="category-post-wrapper" data-view="block">
            <?php if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>
                    <article class="latest-item">
                        <div class="latest-item-image">
                            <a href="<?php the_permalink() ?>">
                                <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                            </a>
                        </div>
                        <div class="latest-item-caption">
                            <h4 class="latest-item-title">
                                <a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a>
                            </h4>
                            <div class="latest-item-info">
                                <div class="latest-item-date">
                                    <span><?php the_date( 'd, M Y' ) ?></span>
                                </div>
                                <div class="latest-item-category"><?php echo single_cat_title(); ?></div>
                            </div>
                        </div>
                    </article>
                <?php endwhile;
            endif; ?>
        </div>
    </div>
</section>
