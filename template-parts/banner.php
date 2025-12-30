<?php
// Accept arguments passed from get_template_part (like React props)
$args = isset($args) ? $args : array();
$bg_position = isset($args['bg_position']) ? $args['bg_position'] : 'center';

$banner_image_field = get_field('cm_banner_image');
$banner_image = $banner_image_field ? $banner_image_field['url'] : '';
$banner_title = get_field('cm_banner_title');
?>

<section class="banner container"
    style="background-image: url('<?php echo $banner_image ? esc_url($banner_image) : get_template_directory_uri() . '/assets/images/banner/faq_banner.png'; ?>'); background-position: <?php echo esc_attr($bg_position); ?>;">

    <?php if (!is_single()):  // Only show title on non-single pages ?>
        <div class="page_top_content wrap">
            <h1 class="page_top_title">
                <?php
                // Use ACF title if available, otherwise default to page title
                echo $banner_title ? esc_html($banner_title) : get_the_title();
                ?>
            </h1>
        </div>
    <?php endif; ?>
</section>