<?php
/**
 * Template part for displaying inner page banner
 *
 * @package yakult
 */

// Get banner data from arguments or use defaults
$banner_title = isset($args['title']) ? $args['title'] : 'Page';
$banner_subtitle = isset($args['subtitle']) ? $args['subtitle'] : '';
$banner_class = isset($args['class']) ? $args['class'] : '';

// If no arguments passed, try to get from current page/post
if (!isset($args['title'])) {
    if (is_page()) {
        $banner_title = get_the_title();
    } elseif (is_single()) {
        $banner_title = get_the_title();
    } elseif (is_archive()) {
        $banner_title = get_the_archive_title();
    } elseif (is_search()) {
        $banner_title = 'Search Results';
    } else {
        $banner_title = 'Page';
    }
}
?>

<!-- Inner Banner Section -->
<section class="inner_banner_section">
    <div class="container-header">
        <div class="inner_banner_content">
            <h1 class="inner_banner_title font-100">
                <?php echo esc_html(strtolower($banner_title)); ?>
                <?php if ($banner_subtitle): ?>
                    <span><?php echo esc_html(strtolower($banner_subtitle)); ?></span>
                <?php endif; ?>
            </h1>
        </div>
    </div>
</section>