<?php
/*
Template Name: Campaign - Reimagine Snacks
*/
?>

<?php get_header(); ?>



<style type="text/css">

<?php
// Begin ACF repeater
  $count=1;
  if( have_rows('section') ):
    while ( have_rows('section') ) : the_row();
?>

  .reimagine-<?php echo $count; ?> {
    background-image: url("<?php echo get_sub_field('background_image')['url']; ?>");
  }
  .reimagine-<?php echo $count; ?> .section-inner-overlay {
    background-color: <?php the_sub_field('photo_overlay_color'); ?>
  }
  .reimagine-<?php echo $count; ?> h1,
  .reimagine-<?php echo $count; ?> a
   {
    color: <?php the_sub_field('title_link_color'); ?>
  }
  .reimagine-<?php echo $count; ?> .box-prefix  {
    background: <?php the_sub_field('title_link_color'); ?>
  }

<?php

  // end ACF repeater
    $count++;
    endwhile;

else :
endif;

?>
</style>


<div class="SectionScroll-wrap reimagine-wrap">

  <?php
  // Begin ACF repeater
    $count=1;
    if( have_rows('section') ):
      while ( have_rows('section') ) : the_row();
  ?>

          <?php
          // The Up/Down Arrows
          // if bottom, show up arrow.
          // if odd section, show black downarrow

          $arrowType = null;
          $arrowColor = null;
          if ($count == 5) { $arrowType = 'up';  $arrowColor = 'white';
          } else {
            if ($count % 2 == 0)  { $arrowType = 'down';  $arrowColor = 'black';}
            else  { $arrowType = 'down';  $arrowColor = 'white';}
          }
          ?>

          <div class="SectionScroll reimagine-section reimagine-<?php echo $count; ?>" data-arrow-color="<?php echo $arrowColor ?>">


            <!-- Section Content  -->

            <div class="SectionScroll-matchHeight section-inner-overlay"></div>
            <div class="SectionScroll-inner section-inner">

              <?php /* video head  */ if ($count == 5) { echo '<div class="video-intro">'; } ?>

              <h1><?php the_sub_field('title_line_1'); ?></h1>
              <?php if ( get_sub_field('title_line_2') ) { ?>

                <h1 class="subtitle">
                  <span class="box-prefix"></span><?php the_sub_field('title_line_2'); ?>
                </h1>

              <?php } ?>

              <?php the_sub_field('content'); ?>

              <?php /* video head  */ if ($count == 5) { ?>
                  <div class="js-playvideo play-button"></div>
                 </div> <!-- video-intro -->

                 <div class="video-container">
                   <video poster="<?php bloginfo('stylesheet_directory'); ?>/assets/videos/QuinnPopcorn.jpg" controls preload="none" width="100%" height="auto">
                   <source src="<?php bloginfo('stylesheet_directory'); ?>/assets/videos/QuinnPopcorn.mp4" type="video/mp4">
                   <source src="<?php bloginfo('stylesheet_directory'); ?>/assets/videos/QuinnPopcorn.webm" type="video/webm">
                   </video>
                 </div>

                 <?php }  // close video section ?>

            </div> <!-- .section-inner -->
          </div> <!-- .section -->

          <?php if ($count == 1){ ?>
            <div class="SectionScroll-matchHeight reimagine-shim"></div>
          <?php } ?>

  <?php

    // end ACF repeater
      $count++;
      endwhile;

  else :
  endif;

  ?>

</div>



<?php get_footer(); ?>
