<?php
/**
 * Template Name: How it Works - Investor
 *
 * The template for displaying the How it Works page for Investors.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buy-my-property
 */

get_header();
?>

<main id="primary" class="site-main mt_default">

    	<?php get_template_part('template-parts/banner'); ?>


    <!-- Content will be added here -->

<?php if(get_field('pr_title') || have_rows('procedures')): ?>
<section class="three_step_process_for_sellers wrap pb_100 pt_100">
    <div class="section-header">
        <h2 class="three_step_heading"><?php echo get_field('pr_title'); ?></h2>
                    <P class="section-subtitle"><?php echo get_field('pr_description'); ?></P>

    </div>

    <div class="how-it-works-cards-container">
        <?php 
        if( have_rows('procedures') ): 
            $step_count = 1;
            while( have_rows('procedures') ): the_row(); 
                $p_step = get_sub_field('p_step');
                $p_title = get_sub_field('p_title');
                $p_image = get_sub_field('p_image');
                $p_content = get_sub_field('p_content');
                $p_button = get_sub_field('p_button');
                
                // Format step number with leading zero
                $step_number = str_pad($step_count, 2, '0', STR_PAD_LEFT);
        ?>
        
        <!-- Step <?php echo $step_count; ?> Card -->
        <div class="how-it-works-card step<?php echo $step_count; ?>">
            <!-- Top Section: Step Number + Heading -->
            <div class="card-top-section">
                <div class="step-number"><?php echo $step_number; ?></div>
                <h3 class="card-main-title"><?php echo esc_html($p_step); ?></h3>
            </div>

            <!-- Bottom Section: Content + Image -->
            <div class="card-bottom-section">
                <div class="card-content">
                    <h4 class="card-title"><?php echo esc_html($p_title); ?></h4>
                    <div class="card-description">
                        <?php echo $p_content; ?>
                    </div>
                    <?php if( $p_button ): ?>
                        <a href="<?php echo esc_url($p_button['url']); ?>" 
                           class="card-cta-btn default_btn"
                           <?php if($p_button['target']): ?>target="<?php echo esc_attr($p_button['target']); ?>"<?php endif; ?>>
                            <?php echo esc_html($p_button['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="card-image">
                    <?php if( $p_image ): ?>
                        <img src="<?php echo esc_url($p_image['url']); ?>" 
                             alt="<?php echo esc_attr($p_image['alt'] ? $p_image['alt'] : $p_step); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php 
            $step_count++;
            endwhile; 
        endif; 
        ?>
    </div>
</section>

<?php endif; ?>

</main>

<?php get_footer(); ?>