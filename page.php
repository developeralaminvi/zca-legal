<?php
/**
 * Default Single Page Template
 *
 * @package ZCA_Legal
 */

get_header();

while (have_posts()) : the_post();
?>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 4rem 0 3.5rem; text-align: center; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <h1 style="color: #fff; margin-bottom: 0.5rem;"><?php the_title(); ?></h1>
    </div>
  </section>

  <section class="section">
    <div class="container container-narrow">
      <div class="single-content-box">
        <div style="line-height: 1.8; color: #334155;">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </section>

<?php
endwhile;

get_footer();
