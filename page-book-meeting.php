<?php
/**
 * Template Name: Book a Meeting
 * 
 * The template for displaying the Book a Meeting page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buy-my-property
 */

get_header();
?>

<main id="primary" class="site-main mt_default">

      	<?php get_template_part('template-parts/banner'); ?>


    <!-- What Happens After You Submit Section -->
    <section class="after_submit pt_100 mb_120">
        <!-- Section Header -->
        <div class="section_header">
            <h2 class="section_title"><?php echo get_field('bm_title'); ?></h2>
            <p class="section_subtitle"><?php echo get_field('bm_short_description'); ?></p>
        </div>
        <div class="property-consultation-section pt_125 pb_125">
            <div class="wrap">
                <div class="left-content">
                    <h1 class="book_header"><?php echo get_field('bm_form_title'); ?></h1>
                    <p class="book_description"><?php echo get_field('bm_form_short_description'); ?></p>
                </div>

                <div class="form-container-book-meeting">
                    <div class="offer-form-container">
                        <div class="offer-form" id="propertyOfferForm">
                            <?php echo do_shortcode('[contact-form-7 id="fa35e3c" title="Book a Meeting"]'); ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Steps Grid -->
<?php if( have_rows('submission_process') ): ?>
 <section class="process_steps_grid_section wrap">

    <!-- Section Header -->
    <div class="section_header">
        <?php if( get_field('whn_title') ): ?>
            <h2 class="section_title"><?php echo esc_html(get_field('whn_title')); ?></h2>
        <?php endif; ?>

        <?php if( get_field('whn_short_description') ): ?>
            <p class="section_subtitle"><?php echo esc_html(get_field('whn_short_description')); ?></p>
        <?php endif; ?>
    </div>

    <!-- Process Steps Grid -->
    <div class="process_steps_grid">
        <?php if( have_rows('submission_process') ): ?>
            <?php while( have_rows('submission_process') ): the_row(); 
                $title = get_sub_field('su_title');
                $icon  = get_sub_field('su_icon'); // Image array
                $desc  = get_sub_field('su_short_description');
            ?>
                <div class="process_step_card">
                    <div class="step_icon">
                        <?php if( $icon ): ?>
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($title); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="step_content">
                        <?php if( $title ): ?>
                            <h3 class="step_title"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>
                        <?php if( $desc ): ?>
                            <p class="step_description"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>


</main>

<?php
get_footer();
?>