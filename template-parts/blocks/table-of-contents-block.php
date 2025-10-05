<?php ?>

<section class="table-of-contents">
    <div class="table-of-content__heading">
        <div class="table-of-contents__title"><?php echo get_field( 'table-of-contents_title' ); ?></div>
        <button type="button" id="toggleButton" data-close="<?php echo __('Close Snippet', 'cv'); ?>" data-open="<?php echo __('Open Snippet', 'cv'); ?>" class="toggleButton table-of-contents__button"><?php echo __('Åpne Snarveier', 'cv'); ?>
        </button>
    </div>
    <ul class="table-of-contents__list"></ul>
</section>
