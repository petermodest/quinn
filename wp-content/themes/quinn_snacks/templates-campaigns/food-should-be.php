<?
/*
Template Name: Campaign - Food Should Be
*/
?>

<? get_header(); ?>

    <?
    if (!isset($_GET['term'])) {
      get_template_part( 'parts/frontpage', 'foodshouldbe' );
    }
    else { ?>

  <div id="fsb-wrapper">

    <div class="fsb-section fsb-bluesection fsb-firstsection">
      <div class="fsb-section-inner">

    <h2 id="fsb-title"><span>#FOODSHOULDBE</span><? echo $_GET['term']; ?></h2>

    <div id="fsb-congrat">
      <p>Awesome, that’s a great one. You know what, you should share it. Use the buttons below to challenge your friends to share what they think food should be. Feeling fresh, tag a big food brand so they know what you think.</p>
    </div>

    <div id="fsb-social-boxes">
      <ul>
        <li id="fsb-twitter">
          <div class="fsb-social-icon"></div>

          <div class="fsb-social-whitebox">
            <textarea placeholder="Anything else to say?"></textarea>

            <h3>#foodshouldbe #<? echo $_GET['term']; ?></h3>
          </div><button class="fsb-submit-twitter">TWEET!</button>
        </li>

        <li id="fsb-facebook">
          <div class="fsb-social-icon"></div>

          <div class="fsb-social-whitebox">
            <textarea placeholder="Anything else to say?"></textarea>

            <h3>#foodshouldbe #<? echo $_GET['term']; ?></h3>
          </div><button class="fsb-submit-facebook">SHARE!</button>
        </li>

        <li id="fsb-instagram">
          <div class="fsb-social-icon"></div>

          <div class="fsb-social-whitebox">
            <p>Copy &amp; Paste into your next gram!</p>
            <br />
            <h3>#foodshouldbe #<? echo $_GET['term']; ?></h3>

          </div>
        </li>
      </ul>

      <div class="clearboth"></div>

    </div> <!-- fsb-social-boxes -->

  </div></div> <!-- .fsb-section -->

  <div class="fsb-section fsb-bluesection">
    <div class="fsb-section-inner">

    <div id="fsb-tweets-wrapper">
      <h3>It's happening...</h3>
      <div id="fsb-tweets">
      </div><!-- #fsb-tweets -->
      <a class="viewmore" href="https://twitter.com/search?q=foodshouldbe">View More on Twitter &raquo; </a>
    </div><!-- #fsb-tweets -->

    <div id="fsb-instagram-wrapper">
      <div id="fsb-instagram-stream">
      </div>

      <a class="viewmore" href="https://instagram.com/explore/tags/foodshouldbe/">View More on Instagram &raquo; </a>

    </div>



    <div class="clearboth"></div>

  </div></div> <!-- .fsb-section .bluesection -->

  <div class="fsb-section fsb-whitesection">
    <div class="fsb-section-inner">

    <div id="fsb-video">

      <h2>Meet Kristy, see what we think!</h2>

      <iframe src="https://player.vimeo.com/video/97542812?color=ffffff&title=0&byline=0&portrait=0" width="960" height="540" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>


    </div>

  </div></div> <!-- .fsb-section .whitesection -->

    <div class="fsb-section fsb-bluesection">
      <div class="fsb-section-inner">

    <div id="fsb-jumble">
      <h2>Thank you for helping to start a movement. <br /> Here's what other food friends had to say : </h2>

      <div id="fsb-jumble-inner"></div>

    </div>

  </div></div> <!-- .fsb-section fsb-bluesection -->









  </div><!-- #fsb-wrapper -->


<? }  // closes else ifset; ?>

  <? get_footer(); ?>
