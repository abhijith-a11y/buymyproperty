<?php
/**
 * Front Page Template
 *
 * This is the template that displays the front page of the site.
 * It includes various sections like hero slider, stats, business slider,
 * and other homepage components using Advanced Custom Fields.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buymyproperty
 */


get_header(); ?>

<!-- Hero Section -->
<section class="hero-section mt_default">
    <div class="container">
        <div class="hero-content">
            <div class="hero-left">
                <h1 class="hero-title heading-large-light">
                    <?php echo get_field('hm_bnr_title'); ?>
                    <span class="highlight"><?php echo get_field('hm_bnr_title_in_green'); ?></span>
                </h1>
                <p class="hero-description">
                    <?php echo get_field('hm_short_description'); ?>
                </p>
                <div class="form-video">
                    <?php if (get_field('horizontal_video')) { ?>
                        <video autoplay muted loop playsinline>
                            <source src="<?php echo get_field('horizontal_video')['url']; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php } ?>


                    <?php get_template_part('template-parts/homeoffer-form'); ?>


                </div>



            </div>

            <div class="hero-right overlay-1">
                <span class="overlay"></span>
                <div class="hero-background"
                    style="background-image:url(<?php if (get_field('hm_bnr_image')) {
                        echo get_field('hm_bnr_image')['url'];
                    } ?>);">
                    <?php if (get_field('vertical_video_')) { ?>
                        <video autoplay muted loop playsinline>
                            <source src="<?php echo get_field('vertical_video_')['url']; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Marquee Section -->
<?php if (have_rows('marquee_items')): ?>
    <section class="home_marquee_section container">
        <div class="marquee-container">
            <div class="swiper marquee-swiper">
                <div class="swiper-wrapper">

                    <?php if (have_rows('marquee_items')): ?>
                        <?php
                        // Repeat slides 3 times for seamless loop
                        for ($i = 0; $i < 3; $i++):
                            ?>
                            <div class="swiper-slide">
                                <div class="marquee-content">
                                    <?php while (have_rows('marquee_items')):
                                        the_row();
                                        $text = get_sub_field('marquee_text');
                                        ?>
                                        <span class="marquee-text"><?php echo esc_html($text); ?></span>
                                        <span class="marquee-separator">|</span>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- Three Step Process Section -->
<?php if (get_field('hm_p_title') || get_field('hm_p_short_description') || have_rows('process') || get_field('hm_p_button')): ?>
    <section class="three_step_process pb_100 pt_100">
        <div class="container">
            <div class="section-header">
                <h2 class="heading-medium-primary"><?php the_field('hm_p_title'); ?></h2>
                <p class="section-subtitle"><?php the_field('hm_p_short_description'); ?></p>
            </div>

            <?php if (have_rows('process')): ?>
                <div class="three-step-slider-container">
                    <div class="swiper three-step-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            $step_counter = 1;
                            while (have_rows('process')):
                                the_row();
                                $step = get_sub_field('hm_p_step');
                                $description = get_sub_field('hm_P_description');
                                $image = get_sub_field('hm_p_image');
                                ?>
                                <div class="swiper-slide">
                                    <div class="step-card-container">
                                        <!-- Text Card -->
                                        <div class="step-text-card">
                                            <div class="gradintent_overlay"></div>
                                            <div class="step-number"><?php echo str_pad($step_counter, 2, '0', STR_PAD_LEFT); ?>
                                            </div>
                                            <h3><?php echo esc_html($step); ?></h3>
                                            <p><?php echo esc_html($description); ?></p>
                                        </div>

                                        <!-- Image Card -->
                                        <div class="step-image-card">
                                            <?php if ($image): ?>
                                                <img src="<?php echo esc_url($image['url']); ?>"
                                                    alt="<?php echo esc_attr($image['alt']); ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $step_counter++; endwhile; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Call to Action Button -->
            <div class="three-step-cta">
                <?php if (get_field('hm_p_button')): ?>
                    <a href="<?php echo get_field('hm_p_button')['url']; ?>" class="btn-primary">
                        <?php echo get_field('hm_p_button')['title']; ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="margin-left: 8px;">
                            <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Why Sell to Us Section -->
<?php if (get_field('hm_ws_title') || have_rows('hm_ws_why_sell_to_us')): ?>
    <section class="why_sell_to_us pb_105 pt_105 p_relative">
        <div class="container">
            <div class="section-header">
                <h2 class="heading-medium-primary"><?php the_field('hm_ws_title'); ?></h2>
            </div>

            <?php if (have_rows('hm_ws_why_sell_to_us')):
                $total_slides = count(get_field('hm_ws_why_sell_to_us')); // total slides for pagination
                ?>
                <div class="why-sell-content">
                    <!-- Left Border Indicator -->
                    <div class="slide-indicator">
                        <div class="indicator-line"></div>
                    </div>

                    <!-- Main Slider Container -->
                    <div class="why-sell-slider-container">
                        <div class="swiper why-sell-swiper">
                            <div class="swiper-wrapper">
                                <?php
                                $slide_index = 0;
                                while (have_rows('hm_ws_why_sell_to_us')):
                                    the_row();
                                    $title = get_sub_field('hm_wsu_title');
                                    $description = get_sub_field('hm_wsu_description');
                                    $image = get_sub_field('hm_wsu_image');
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="slide-content">
                                            <div class="slide-image">
                                                <?php if ($image): ?>
                                                    <img src="<?php echo esc_url($image['url']); ?>"
                                                        alt="<?php echo esc_attr($image['alt']); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="slide-text">
                                                <h3><?php echo esc_html($title); ?></h3>
                                                <p><?php echo esc_html($description); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $slide_index++;
                                endwhile;
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Custom Numbered Pagination -->
                    <div class="why-sell-pagination">
                        <div class="pagination-numbers">
                            <?php for ($i = 0; $i < $total_slides; $i++): ?>
                                <span class="pagination-number <?php echo $i === 0 ? 'active' : ''; ?>"
                                    data-slide="<?php echo $i; ?>">
                                    <?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?>
                                    <sub>/<?php echo str_pad($total_slides, 2, '0', STR_PAD_LEFT); ?></sub>
                                </span>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="decor_container">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/decor.png" alt="">
        </div>
    </section>
<?php endif; ?>


<!-- What Our Sellers Say Section -->
<?php if (get_field('hm_te_title') || get_field('hm_te_short_description') || get_field('hm_testimonials')): ?>
    <section class="testimonials_section pb_100 pt_100">
        <div class="testimonials_container">
            <div class="section-header">
                <h2 class="heading-medium-primary">
                    <?php the_field('hm_te_title'); ?>
                </h2>
            </div>

            <div class="testimonials-slider-container">
                <div class="swiper testimonials-swiper">
                    <div class="swiper-wrapper">
                        <?php
                        $testimonials = get_field('hm_testimonials'); // Relationship field
                        if ($testimonials):
                            foreach ($testimonials as $post):
                                setup_postdata($post);
                                $designation = get_field('designation'); // ACF field in testimonial post
                                $image = get_the_post_thumbnail_url($post->ID, 'full'); // Featured image
                                ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-card">
                                        <div class="quote-icon">
                                            <svg width="51" height="47" viewBox="0 0 51 47" fill="#3F6745"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M49.4281 1.60715C50.3071 2.4787 50.3404 3.88576 49.5312 4.82246C46.7332 8.06163 44.4941 11.1623 42.8138 14.1244C40.9037 17.5337 39.9486 20.3477 39.9486 22.5665C39.9486 25.1641 41.122 27.2746 43.4687 28.8981C43.6324 29.0063 43.7961 29.1146 43.9599 29.2228C45.87 30.5757 47.2343 31.9286 48.053 33.2815C48.8716 34.6344 49.2809 36.1767 49.2809 37.9085C49.2809 40.5602 48.3804 42.7519 46.5795 44.4836C44.7785 46.1612 42.5136 47 39.7849 47C36.565 47 33.8363 45.7553 31.5987 43.266C29.4157 40.7225 28.3242 37.5296 28.3242 33.6874C28.3242 29.0334 29.9888 23.8112 33.3178 18.0207C36.358 12.7327 40.6499 7.26406 46.1935 1.61493C47.0797 0.711845 48.5297 0.716248 49.4281 1.60715ZM21.1039 1.60715C21.9828 2.4787 22.0161 3.88576 21.207 4.82246C18.409 8.06163 16.1699 11.1623 14.4896 14.1244C12.5795 17.5337 11.6244 20.3477 11.6244 22.5665C11.6244 25.1641 12.7978 27.2746 15.1445 28.8981C15.4593 29.1322 15.7981 29.3349 16.1128 29.5692C17.7747 30.8067 18.98 32.0441 19.7287 33.2815C20.5473 34.6344 20.9567 36.1767 20.9567 37.9085C20.9567 40.5602 20.0562 42.7519 18.2552 44.4836C16.4543 46.1612 14.1621 47 11.3788 47C8.21348 47 5.51204 45.7553 3.27448 43.266C1.09149 40.7225 0 37.5296 0 33.6874C0 29.0334 1.66453 23.8112 4.99358 18.0207C8.0338 12.7327 12.3257 7.26406 17.8693 1.61493C18.7555 0.711845 20.2055 0.716248 21.1039 1.60715Z"
                                                    fill="#3F6745" />
                                            </svg>
                                        </div>
                                        <div class="testimonial-content">
                                            <p><?php the_content(); ?></p>
                                        </div>
                                        <div class="testimonial-author">
                                            <div class="author-image">
                                                <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>">
                                            </div>
                                            <div class="author-info">
                                                <h4 class="author-name"><?php the_title(); ?></h4>
                                                <p class="author-title"><?php echo esc_html($designation); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- Recently Closed Deals Section -->
<?php if (get_field('hm_deal__title') || get_field('hm_deal_properties')): ?>
    <section class="recently-closed-deals-section pb_100 pt_100 container">
        <div class="container">
            <div class="section-header">
                <h2 class="heading-medium-primary"><?php the_field('hm_deal__title'); ?></h2>
            </div>

            <?php
            $properties = get_field('hm_deal_properties'); // relationship field
            if ($properties): ?>
                <div class="deals-slider-container">
                    <div class="swiper recently-closed-deals-swiper">
                        <div class="swiper-wrapper">

                            <?php foreach ($properties as $property):
                                $status = get_field('status', $property->ID);
                                $offer = get_field('offer_:_', $property->ID);
                                $location = get_field('loaction_:_', $property->ID);
                                $closed = get_field('closed_', $property->ID);
                                $image = get_the_post_thumbnail_url($property->ID, 'full');
                                ?>
                                <div class="swiper-slide">
                                    <div class="deal-card" style="background-image: url('<?php echo esc_url($image); ?>');">
                                        <div class="deal-image">
                                            <?php if ($status): ?>
                                                <div class="sold-badge"><?php echo esc_html($status); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="deal-content">
                                            <h3 class="deal-title"><?php echo get_the_title($property->ID); ?></h3>
                                            <?php if ($offer): ?>
                                                <div class="deal-price">Offer: <?php echo esc_html($offer); ?></div>
                                            <?php endif; ?>
                                            <?php if ($location): ?>
                                                <div class="deal-location">Location: <?php echo esc_html($location); ?></div>
                                            <?php endif; ?>
                                            <?php if ($closed): ?>
                                                <div class="deal-status">Closed in: <?php echo esc_html($closed); ?> Days</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div> <!-- end swiper-wrapper -->
                    </div> <!-- end swiper -->

                    <!-- Navigation Buttons -->
                    <div class="deals-navigation">
                        <div class="swiper-button-prev deals-prev">
                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 8.36401C16.5523 8.36401 17 7.9163 17 7.36401C17 6.81173 16.5523 6.36401 16 6.36401L16 7.36401L16 8.36401ZM0.292893 6.65691C-0.0976314 7.04743 -0.0976315 7.68059 0.292892 8.07112L6.65685 14.4351C7.04738 14.8256 7.68054 14.8256 8.07107 14.4351C8.46159 14.0446 8.46159 13.4114 8.07107 13.0209L2.41421 7.36401L8.07107 1.70716C8.46159 1.31663 8.46159 0.68347 8.07107 0.292945C7.68054 -0.0975793 7.04738 -0.0975793 6.65685 0.292945L0.292893 6.65691ZM16 7.36401L16 6.36401L0.999999 6.36401L0.999999 7.36401L0.999999 8.36401L16 8.36401L16 7.36401Z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <div class="swiper-button-next deals-next">
                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path 
                                    d="M16 8.36401C16.5523 8.36401 17 7.9163 17 7.36401C17 6.81173 16.5523 6.36401 16 6.36401L16 7.36401L16 8.36401ZM0.292893 6.65691C-0.0976314 7.04743 -0.0976315 7.68059 0.292892 8.07112L6.65685 14.4351C7.04738 14.8256 7.68054 14.8256 8.07107 14.4351C8.46159 14.0446 8.46159 13.4114 8.07107 13.0209L2.41421 7.36401L8.07107 1.70716C8.46159 1.31663 8.46159 0.68347 8.07107 0.292945C7.68054 -0.0975793 7.04738 -0.0975793 6.65685 0.292945L0.292893 6.65691ZM16 7.36401L16 6.36401L0.999999 6.36401L0.999999 7.36401L0.999999 8.36401L16 8.36401L16 7.36401Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                    </div>

                </div> <!-- end deals-slider-container -->
            <?php endif; ?>
        </div> <!-- end container -->
    </section>
<?php endif; ?>

<?php if (get_field('hm_bg_referal_image') || get_field('hm_re_title') || get_field('hm_re_title__in_bold') || get_field('hm_re_tag_line') || get_field('hm_re_button')): ?>
    <section class="referral-banner container"
        style="background: url('<?php echo get_field('hm_bg_referal_image')['url']; ?>') right center / cover no-repeat;">
        <div class="text-content">
            <div class="heading-medium-primary thin text-white"><?php echo get_field('hm_re_title'); ?></div>
            <h2 class="heading-medium-primary bold text-white"><?php echo get_field('hm_re_title__in_bold'); ?></h2>
            <div class="description">
                <div class="tagline"><?php echo get_field('hm_re_tag_line'); ?></div>
            </div>
            <?php if (get_field('hm_re_button')): ?>
                <a href="<?php echo get_field('hm_re_button')['url']; ?>" class="btn-primary">
                    <?php echo get_field('hm_re_button')['title']; ?>
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white" stroke-width="1.28571"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>

        <div class="gradient-overlay"></div>
    </section>
<?php endif; ?>


<?php get_footer(); ?>