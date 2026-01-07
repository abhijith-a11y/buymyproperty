<?php
/**
 * Template Name: Why Choose Us
 * 
 * The template for displaying the Why Choose Us page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buy-my-property
 */

get_header();
?>

<main id="primary" class="site-main mt_default">

   	<?php get_template_part('template-parts/banner'); ?>

<?php if( have_rows('guiding_principles') ): ?>
   <section class="why_choose_top_stack wrap pt_100">
    <!-- Header Section -->
    <div class="why_choose_header pb_100">
        <h2 class="why_choose_title"><?php echo esc_html(get_field('wcu_ov_title')); ?></h2>
        <div class="why_choose_description">
            <?php echo wp_kses_post(get_field('wcu_ov_description')); ?>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="why_choose_card">
        <?php if( have_rows('guiding_principles') ): ?>
            <?php while( have_rows('guiding_principles') ): the_row(); 
                $title = get_sub_field('gp_title');
                $image = get_sub_field('gp_image');
                $content = get_sub_field('gp_content');
            ?>
            
            <div class="card_content" data-aos="fade-up">
                <!-- Left Content -->
                <div class="card_text_section">
                    <?php if( $title ): ?>
                        <h3 class="card_title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>

                    <?php if( $content ): ?>
                        <div class="card_inner_text">
                            <?php echo wp_kses_post($content); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Image -->
                <?php if( $image ): ?>
                    <div class="card_image_section">
                        <img src="<?php echo esc_url($image['url']); ?>" 
                             alt="<?php echo esc_attr($image['alt']); ?>" 
                             class="card_image">
                    </div>
                <?php endif; ?>
            </div>

            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php if( have_rows('impact_stories') ): ?>
   <section class="made_difference wrap pt_100 pb_100">
    <!-- Header Section -->
    <div class="made_difference_header">
        <h2 class="made_difference_title">
            <?php echo esc_html(get_field('hwm_title')); ?>
        </h2>
        <p class="made_difference_description">
            <?php echo wp_kses_post(get_field('hwm_description')); ?>
        </p>
    </div>

    <!-- Swiper Container -->
    <div class="made_difference_swiper_wrapper">
        <div class="swiper made-difference-swiper">
            <div class="swiper-wrapper">
                <?php if ( have_rows('impact_stories') ): ?>
                    <?php while ( have_rows('impact_stories') ): the_row(); 
                        $ip_image   = get_sub_field('ip_image');
                        $ip_title   = get_sub_field('ip_title');
                        $ip_content = get_sub_field('ip_content');
                    ?>
                        <div class="swiper-slide">
                            <div class="difference_card">
                                
                                <?php if ( $ip_image ): ?>
                                <div class="card_image_container">
                                    <img src="<?php echo esc_url($ip_image['url']); ?>"
                                         alt="<?php echo esc_attr($ip_image['alt']); ?>"
                                         class="card_image">
                                </div>
                                <?php endif; ?>

                                <div class="card_content">
                                    <?php if ( $ip_title ): ?>
                                        <h3 class="card_title"><?php echo wp_kses_post($ip_title); ?></h3>
                                    <?php endif; ?>

                                    <?php if ( $ip_content ): ?>
                                        <p class="card_description"><?php echo wp_kses_post($ip_content); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if( get_field('st_title') || get_field('st_short_description') || have_rows('statistics') ): ?>
   <section class="built_on_trust" id="built-on-trust-section">
    <div class="built_on_trust_container">
        <!-- Background Image -->
        <div class="trust_background_image">
            <?php 
            $st_image = get_field('st_image');
            if( $st_image ): ?>
                <img src="<?php echo esc_url($st_image['url']); ?>" 
                     alt="<?php echo esc_attr($st_image['alt']); ?>" 
                     class="background_image">
            <?php endif; ?>
        </div>

        <!-- Content Overlay -->
        <div class="trust_content_overlay wrap">
            <!-- Left Side Content -->
            <div class="trust_left_content">
                <div class="trust_text_block" data-animate="trust-text">
                    <?php if( get_field('st_title') ): ?>
                        <h2 class="trust_main_title"><?php echo esc_html(get_field('st_title')); ?></h2>
                    <?php endif; ?>

                    <?php if( get_field('st_short_description') ): ?>
                        <p class="trust_description"><?php echo wp_kses_post(get_field('st_short_description')); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Side Statistics -->
            <div class="trust_content_overlay_container">
            <div class="trust_right_content">
                <?php if( have_rows('statistics') ): $i = 1; ?>
                    <?php while( have_rows('statistics') ): the_row(); 
                        $st_counter = get_sub_field('st_counter');
                        $st_content = get_sub_field('st_content');
                    ?>
                        <div class="trust_stat_item" data-animate="stat-<?php echo esc_attr($i); ?>">
                            <?php if( $st_counter ): ?>
                                <div class="stat_number_container">
                                    <span class="stat_number"><?php echo esc_html($st_counter); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if( $st_content ): ?>
                                <div class="stat_description">
                                    <p><?php echo wp_kses_post($st_content); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php $i++; endwhile; ?>
                <?php endif; ?>
            </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if( get_field('ta_title') || have_rows('comparison_table') ): ?>
   <section class="comparison_section wrap pt_120 pb_40">
    <!-- Section Header -->
    <div class="comparison_header">
        <?php if ( get_field('ta_title') ): ?>
            <h2 class="comparison_title"><?php echo esc_html(get_field('ta_title')); ?></h2>
        <?php endif; ?>
    </div>

    <!-- Comparison Table -->
    <div class="comparison_table">
        <!-- Features Column -->
        <div class="comparison_column features_column">
            <div class="table_head">
                <span class="service_label text-black">
                    <?php echo esc_html(get_field('col_features')); ?>
                </span>
            </div>

            <?php if ( have_rows('comparison_table') ): ?>
                <?php while ( have_rows('comparison_table') ): the_row(); 
                    $feature = get_sub_field('feature');
                ?>
                    <div class="table_data">
                        <span class="feature_text"><?php echo esc_html($feature); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <!-- Buy My Property Column -->
        <div class="comparison_column buy_my_property_column">
            <div class="table_head">
                <span class="service_label text-white">
                    <?php echo esc_html(get_field('col_buy_my_property')); ?>
                </span>
            </div>

            <?php if ( have_rows('comparison_table') ): ?>
                <?php while ( have_rows('comparison_table') ): the_row(); 
                    $bmp_text = get_sub_field('buy_my_property');
                ?>
                    <div class="table_data">
                        <span class="benefit_text"><?php echo esc_html($bmp_text); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <!-- Traditional Agent Column -->
        <div class="comparison_column traditional_agent_column">
            <div class="table_head">
                <span class="service_label text-black">
                    <?php echo esc_html(get_field('col_traditional_agent')); ?>
                </span>
            </div>

            <?php if ( have_rows('comparison_table') ): ?>
                <?php while ( have_rows('comparison_table') ): the_row(); 
                    $ta_text = get_sub_field('traditional_agent');
                ?>
                    <div class="table_data">
                        <span class="drawback_text"><?php echo esc_html($ta_text); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- Call to Action -->
    <?php 
    $cta = get_field('ta_button');
    if ( $cta ): ?>
        <div class="comparison_cta">
            <a href="<?php echo $cta['url']; ?>" 
               class="btn-primary" 
               target="<?php echo esc_attr($cta['target'] ?: '_self'); ?>">
                <?php echo $cta['title']; ?>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white"
                        stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    <?php endif; ?>
</section>
<?php endif; ?>


</main>

<?php get_footer(); ?>