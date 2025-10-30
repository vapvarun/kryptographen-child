<?php ?>

<section class="table-of-contents">
    <div class="table-of-content__heading">
        <div class="table-of-contents__title"><?php echo esc_html( get_field( 'table-of-contents_title' ) ); ?></div>
        <button type="button" id="toggleButton" data-close="<?php echo esc_attr__('Close Snippet', 'cv'); ?>" data-open="<?php echo esc_attr__('Open Snippet', 'cv'); ?>" class="toggleButton table-of-contents__button"><?php echo esc_html__('Åpne Snarveier', 'cv'); ?>
        </button>
    </div>
    <ul class="table-of-contents__list"></ul>
</section>
