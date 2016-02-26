<style type="text/css">

  .fp-reimagine-header {
    background-image: url("<?php echo get_field('frontpage_image', 1487)['url']; ?>");
    height: 700px;
  }
  .section-inner-overlay {
    background-color: <?php the_field('frontpage_overlay_color', 1487); ?>
  }

</style>


<div class="fp-reimagine-header reimagine-section">

  <div class="reimagine-header-inner">

    <div class="section-inner-overlay"></div>
    <div class="fp-reimagine-inner">
        <div class="js-reimagine-title fp-reimagine-title">

          <?php the_field('frontpage_text', 1487); ?>

        </div>
    </div>

  </div>
</div>
