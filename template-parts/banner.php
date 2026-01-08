<?php
// Accept arguments passed from get_template_part (like React props)
$args = isset($args) ? $args : array();
$bg_position = isset($args['bg_position']) ? $args['bg_position'] : 'center';

$banner_image_field = get_field('cm_banner_image');
$banner_image = $banner_image_field ? $banner_image_field['url'] : '';
$banner_title = get_field('cm_banner_title');

// Function to convert string to Title Case (capitalize first letter of every word)
function to_title_case($string)
{
    // Use ucwords to capitalize first letter of each word
    // Handle spaces, hyphens, and underscores
    $string = trim($string);
    if (empty($string)) {
        return '';
    }
    // Convert to title case, handling spaces, hyphens, and underscores
    return ucwords(strtolower($string), " \t\r\n\f\v-_");
}

// Get the title and convert to Title Case
$title_text = $banner_title ? $banner_title : get_the_title();
$title_case_title = to_title_case($title_text);
?>

<section class="banner container"
    style="background-image: url('<?php echo $banner_image ? esc_url($banner_image) : get_template_directory_uri() . '/assets/images/banner/faq_banner.png'; ?>'); background-position: <?php echo esc_attr($bg_position); ?>;">

    <?php if (!is_single()):  // Only show title on non-single pages ?>
        <div class="page_top_content wrap">
            <h1 class="page_top_title">
                <?php
                // Always display title in Title Case (first letter of every word capitalized)
                echo esc_html($title_case_title);
                ?>
                    </h1>
                </div>
    <?php endif; ?>
</section>