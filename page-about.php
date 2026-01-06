<?php
/**
 * 
 * 
 * Template Name: About Us Page
 *
 *    <?php yakult_inner_banner('About', 'us', ' '); ?>

*
*/


get_header(); ?>

<main id="primary" class="site-main mt_default">
    <!-- top section here -->
    <?php get_template_part('template-parts/banner'); ?>

    <?php if (get_field('ab_mi_title') || get_field('ab_mi_description') || get_field('top_image') || get_field('left_bottom_image') || get_field('right_bottom_image')): ?>
        <section class="mission_section pt_120 pb_120">
            <div class="wrap">
                <div class="mission_content">
                    <!-- Left Content Area (34.42% width) -->
                    <div class="mission_text">
                        <h2 class="mission_title"><?php echo get_field('ab_mi_title'); ?></h2>
                        <div class="mission_description ">
                            <?php echo get_field('ab_mi_description'); ?>
                        </div>
                    </div>

                    <!-- Right Image Area (61.4% width) -->
                    <div class="mission_images">
                        <!-- Top Image (100% width, 225px height) -->
                        <div class="mission_image_top">
                            <?php if (get_field('top_image')): ?>
                                <img src="<?php echo get_field('top_image')['url']; ?>" alt="Modern residential development">
                            <?php endif; ?>
                        </div>

                        <!-- Bottom Images Container -->
                        <div class="mission_images_bottom">
                            <!-- Left Bottom Image (50% width, 406px height) -->
                            <div class="mission_image_bottom_left">
                                <?php if (get_field('left_bottom_image')): ?>
                                    <img src="<?php echo get_field('left_bottom_image')['url']; ?>"
                                        alt="Luxury poolside property">
                                <?php endif; ?>
                            </div>

                            <!-- Right Bottom Image (50% width, 406px height) -->
                            <div class="mission_image_bottom_right">
                                <?php if (get_field('right_bottom_image')): ?>
                                    <img src="<?php echo get_field('right_bottom_image')['url']; ?>"
                                        alt="Modern high-rise building">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php if (get_field('ab_vi_title') || get_field('ab_vi_description') || get_field('ab_vi_image')): ?>
        <section class="behind_vision pb_45 pt_45 p_relative container">
            <div class="wrap">
                <div class="vision_content">
                    <!-- Left Image Area -->
                    <div class="vision_image">
                        <?php if (get_field('ab_vi_image')): ?>
                            <img src="<?php echo get_field('ab_vi_image')['url']; ?>" alt="Visionary Behind Buy My Property">
                        <?php endif; ?>
                    </div>

                    <!-- Right Content Area -->
                    <div class="vision_text">
                        <h3 class="vision_title text-primary"><?php echo get_field('ab_vi_title'); ?></h3>
                        <div class="vision_description">
                            <?php echo get_field('ab_vi_description'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="decor_container">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/decor.png" alt="">
            </div>
        </section>
    <?php endif; ?>
    <?php
    // Get dynamic slides from ACF repeater
    $slides = [];
    if (have_rows('ab_wmud_features')) {
        $index = 1;
        while (have_rows('ab_wmud_features')) {
            the_row();
            $slides[] = [
                'id' => $index,
                'title' => get_sub_field('ab_wmud__feature_title'),
                'description' => get_sub_field('ab_wmud__feature_description'),
                'image' => get_sub_field('ab_wmud__feature_image'),
                'alt' => get_sub_field('ab_wmud__feature_title')
            ];
            $index++;
        }
    }

    // Only display section if there are slides
    if (!empty($slides)):
        ?>

        <section class="interactive-slider-section pt_120 pb_120">
            <div class="wrap">
                <!-- Section Header -->
                <div class="section-header">
                    <h2><?php echo get_field('ab_wmud_title'); ?></h2>
                    <p class="section-subtitle">
                        <?php echo get_field('ab_wmwd_description'); ?>
                    </p>
                </div>

                <!-- Desktop Layout (above 1200px) -->
                <div class="interactive-slider-container interactive-slider-desktop">
                    <!-- Left Side: Active Slide Content -->
                    <div class="slider-content-left">
                        <div class="active-slide-content">
                            <h3 class="slide-title" id="active-slide-title">
                                <?php echo esc_html($slides[0]['title']); ?>
                            </h3>
                            <p class="slide-description" id="active-slide-description">
                                <?php echo esc_html($slides[0]['description']); ?>
                            </p>
                            <div class="slide-number-display" id="active-slide-number">01</div>
                        </div>
                    </div>

                    <!-- Right Side: Stacked Slides -->
                    <div class="slider-content-right">
                        <div class="slides-stack" data-active="1">
                            <?php foreach ($slides as $index => $slide): ?>
                                <div class="slide-item <?php echo $index === 0 ? 'active' : 'inactive'; ?> slide-<?php echo $slide['id']; ?>"
                                    data-slide="<?php echo $slide['id']; ?>"
                                    data-title="<?php echo esc_attr($slide['title']); ?>"
                                    data-description="<?php echo esc_attr($slide['description']); ?>">

                                    <div class="slide-left">
                                        <div class="slide-vertical-text">
                                            <div class="text_conatiner">
                                                <div class="vt-number"><?php echo sprintf('%02d', $slide['id']); ?></div>
                                                <div class="vt-label"><?php echo esc_html($slide['title']); ?></div>
                                            </div>

                                            <div class="arrow_container">
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M16 8.36401C16.5523 8.36401 17 7.9163 17 7.36401C17 6.81173 16.5523 6.36401 16 6.36401L16 7.36401L16 8.36401ZM0.292893 6.65691C-0.0976314 7.04743 -0.0976315 7.68059 0.292892 8.07112L6.65685 14.4351C7.04738 14.8256 7.68054 14.8256 8.07107 14.4351C8.46159 14.0446 8.46159 13.4114 8.07107 13.0209L2.41421 7.36401L8.07107 1.70716C8.46159 1.31663 8.46159 0.68347 8.07107 0.292945C7.68054 -0.0975793 7.04738 -0.0975793 6.65685 0.292945L0.292893 6.65691ZM16 7.36401L16 6.36401L0.999999 6.36401L0.999999 7.36401L0.999999 8.36401L16 8.36401L16 7.36401Z"
                                                        fill="black" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide-right">
                                        <?php if (!empty($slide['image'])): ?>
                                            <?php if (is_array($slide['image'])): ?>
                                                <!-- If image is returned as array -->
                                                <img src="<?php echo esc_url($slide['image']['url']); ?>"
                                                    alt="<?php echo esc_attr($slide['image']['alt'] ?: $slide['alt']); ?>"
                                                    loading="lazy">
                                            <?php else: ?>
                                                <!-- If image is returned as URL -->
                                                <img src="<?php echo esc_url($slide['image']); ?>"
                                                    alt="<?php echo esc_attr($slide['alt']); ?>" loading="lazy">
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <!-- Bottom-right number badge on image -->
                                        <div class="slide-number-badge">
                                            <?php echo sprintf('%02d', $slide['id']); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Mobile Swiper Layout (below 1200px) -->
                <div class="interactive-slider-swiper-container interactive-slider-mobile">
                    <div class="interactive-slider-swiper swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($slides as $index => $slide): ?>
                                <div class="swiper-slide">
                                    <div class="mobile-slide-card">
                                        <div class="mobile-slide-content">
                                            <h3 class="mobile-slide-title"><?php echo esc_html($slide['title']); ?></h3>
                                            <p class="mobile-slide-description"><?php echo esc_html($slide['description']); ?>
                                            </p>
                                        </div>
                                        <div class="mobile-slide-image">
                                            <?php if (!empty($slide['image'])): ?>
                                                <?php if (is_array($slide['image'])): ?>
                                                    <img src="<?php echo esc_url($slide['image']['url']); ?>"
                                                        alt="<?php echo esc_attr($slide['image']['alt'] ?: $slide['alt']); ?>"
                                                        loading="lazy">
                                                <?php else: ?>
                                                    <img src="<?php echo esc_url($slide['image']); ?>"
                                                        alt="<?php echo esc_attr($slide['alt']); ?>" loading="lazy">
                                                <?php endif; ?>

                                                <!-- Bottom-right number badge on image -->
                                                <div class="slide-number-badge">
                                                    <?php echo sprintf('%02d', $slide['id']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Navigation -->
                        <div class="swiper-button-prev interactive-slider-prev">
                            <svg width="15" height="15" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="currentColor"
                                    stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.2 4.99994L0.800049 4.99994" stroke="currentColor" stroke-width="1.28571"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="swiper-button-next interactive-slider-next">
                            <svg width="15" height="15" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="currentColor"
                                    stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.2 4.99994L0.800049 4.99994" stroke="currentColor" stroke-width="1.28571"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <!-- Pagination -->
                        <div class="swiper-pagination interactive-slider-pagination"></div>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>
    <?php if (get_field('ab_bt_title') || get_field('ab_bt_content') || get_field('ab_bt_image')): ?>
        <section class="trust_matter_section">
            <div class="wrap trust-content-container ">
                <!-- <div class="trust-content-container"> -->
                <!-- Left Side: Image -->
                <div class="trust-image-container">
                    <?php if (get_field('ab_bt_image')): ?>
                        <img src="<?php echo get_field('ab_bt_image')['url']; ?>"
                            alt="Professional handshake representing trust and compliance" loading="lazy">
                    <?php endif; ?>
                </div>

                <!-- Right Side: Content -->
                <div class="trust-content">
                    <div class="trust-header">
                        <h2 class="trust-title"><?php echo get_field('ab_bt_title'); ?>
                        </h2>
                    </div>

                    <div class="trust-description">
                        <?php echo get_field('ab_bt_content'); ?>


                    </div>
                    <!-- </div> -->
                </div>
        </section>
    <?php endif; ?>


    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/interactive-slider.js"></script>


</main>

<?php get_footer(); ?>