<?php
/**
 * Template Name: How it Works
 * 
 * The template for displaying the How it Works page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buy-my-property
 */

get_header();
?>

<main id="primary" class="site-main mt_default">

  	<?php get_template_part('template-parts/banner'); ?>

<?php if(get_field('pr_title') || have_rows('procedures')): ?>
<section class="three_step_process_for_sellers wrap pt_100">
    <div class="section-header">
        <h2 class="three_step_heading"><?php echo get_field('pr_title'); ?></h2>
    </div>

    <!-- Desktop Layout (above 768px) -->
    <div class="how-it-works-cards-container how-it-works-desktop">
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

    <!-- Mobile Swiper Layout (below 768px) -->
    <div class="how-it-works-swiper-container how-it-works-mobile">
        <div class="how-it-works-swiper swiper">
            <div class="swiper-wrapper">
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
                
                <!-- Step <?php echo $step_count; ?> Slide -->
                <div class="swiper-slide">
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
                </div>

                <?php 
                    $step_count++;
                    endwhile; 
                endif; 
                ?>
            </div>
            
            <!-- Navigation -->
            <div class="swiper-button-prev how-it-works-prev">
                <svg width="15" height="15" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="currentColor"
                        stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.2 4.99994L0.800049 4.99994" stroke="currentColor" stroke-width="1.28571"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="swiper-button-next how-it-works-next">
                <svg width="15" height="15" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="currentColor"
                        stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.2 4.99994L0.800049 4.99994" stroke="currentColor" stroke-width="1.28571"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            
            <!-- Pagination -->
            <div class="swiper-pagination how-it-works-pagination"></div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php if(get_field('pl_title') || have_rows('properties')): ?>
    <section class="pt_100">
   <div class="property_types_section pt_50 pb_50">
    <div class="wrap">
        <div class="section-header">
            <h2><?php echo esc_html(get_field('pl_title')); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(get_field('pl_short_description')); ?></p>
        </div>

        <div class="property-types-slider-container">
            <div class="property-types-swiper">
                <div class="swiper-wrapper">
                    <?php if (have_rows('properties')) : ?>
                        <?php while (have_rows('properties')) : the_row(); 
                            $title = get_sub_field('pp_title');
                            $image = get_sub_field('pp_image');
                            $description = get_sub_field('pp_description');
                        ?>
                            <div class="swiper-slide">
                                <div class="property-type-card">
                                    <div class="property-image">
                                        <?php if ($image) : ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="property-content">
                                        <?php if ($title) : ?>
                                            <h3 class="property-title"><?php echo esc_html($title); ?></h3>
                                        <?php endif; ?>
                                        <?php if ($description) : ?>
                                            <p class="property-description"><?php echo esc_html($description); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Navigation -->
            <div class="swiper-button-prev property-types-prev">
                <svg width="15" height="15" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="currentColor"
                        stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.2 4.99994L0.800049 4.99994" stroke="currentColor" stroke-width="1.28571"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="swiper-button-next property-types-next">
                <svg width="15" height="15" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="currentColor"
                        stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.2 4.99994L0.800049 4.99994" stroke="currentColor" stroke-width="1.28571"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
    </div>
                                        </div>
</section>
<?php endif; ?>

</main>

<?php 
?>
<!-- <script type="text/javascript">
    jQuery(document).ready(function($) {

        var $window = $(window);
        var $siteHeader = $('.site-header'); 

        function toggleHowItWorksHeader() {
            if ($window.scrollTop() === 0) {
                $siteHeader.removeClass('scrolldown');
            } else {
                $siteHeader.addClass('scrolldown');
            }
        }

        // 3. Initial check on page load
        toggleHowItWorksHeader();

        // 4. Attach to the window's scroll event
        $window.on('scroll', toggleHowItWorksHeader);

    });
</script> -->

<?php get_footer(); ?>