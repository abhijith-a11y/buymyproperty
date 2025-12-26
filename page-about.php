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

<?php if(get_field('ab_mi_title') || get_field('ab_mi_description') || get_field('top_image') || get_field('left_bottom_image') || get_field('right_bottom_image')) : ?>    <section class="mission_section pt_120 pb_120">
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
                        <?php if(get_field('top_image')): ?>
                        <img src="<?php echo get_field('top_image')['url']; ?>"
                            alt="Modern residential development">
                            <?php endif; ?>
                    </div>

                    <!-- Bottom Images Container -->
                    <div class="mission_images_bottom">
                        <!-- Left Bottom Image (50% width, 406px height) -->
                        <div class="mission_image_bottom_left">
                            <?php if(get_field('left_bottom_image')): ?>
                            <img src="<?php echo get_field('left_bottom_image')['url']; ?>"
                                alt="Luxury poolside property">
                                <?php endif; ?>
                        </div>

                        <!-- Right Bottom Image (50% width, 406px height) -->
                        <div class="mission_image_bottom_right">
                            <?php if(get_field('right_bottom_image')): ?>
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
<?php if(get_field('ab_vi_title') || get_field('ab_vi_description') || get_field('ab_vi_image')) : ?>
    <section class="behind_vision pb_45 pt_45 p_relative container">
        <div class="wrap">
            <div class="vision_content">
                <!-- Left Image Area -->
                <div class="vision_image">
                    <?php if(get_field('ab_vi_image')): ?>
                    <img src="<?php echo get_field('ab_vi_image')['url']; ?>"
                        alt="Visionary Behind Buy My Property">
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

        <!-- Interactive Slider Container -->
        <div class="interactive-slider-container">
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
                                <div class="vt-number"><?php echo sprintf('%02d', $slide['id']); ?></div>
                                <div class="vt-label"><?php echo esc_html($slide['title']); ?></div>
                            </div>
                        </div>
                        <div class="slide-right">
                            <?php if (!empty($slide['image'])): ?>
                                <?php if (is_array($slide['image'])): ?>
                                    <!-- If image is returned as array -->
                                    <img src="<?php echo esc_url($slide['image']['url']); ?>"
                                        alt="<?php echo esc_attr($slide['image']['alt'] ?: $slide['alt']); ?>" loading="lazy">
                                <?php else: ?>
                                    <!-- If image is returned as URL -->
                                    <img src="<?php echo esc_url($slide['image']); ?>"
                                        alt="<?php echo esc_attr($slide['alt']); ?>" loading="lazy">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>
<?php if(get_field('ab_bt_title') || get_field('ab_bt_content') || get_field('ab_bt_image')) : ?>
    <section class="trust_matter_section">
        <div class="wrap trust-content-container ">
            <!-- <div class="trust-content-container"> -->
            <!-- Left Side: Image -->
            <div class="trust-image-container">
                <?php if(get_field('ab_bt_image')): ?>
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