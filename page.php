<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package globalis
 */

get_header();
?>

	<main id="primary" class="site-main">
    <?php get_template_part('template-parts/banner'); ?>

<section class="sub-banner">
    	<div class="container">
      		<h1><?php the_title(); ?></h1>
           			<?php the_content(); ?>

    	</div>
  	</section>

	</main><!-- #main -->

<?php

get_footer();