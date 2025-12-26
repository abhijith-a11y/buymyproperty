<?php
/**
 * Template part for displaying about tabs navigation
 *
 * @package yakult
 */

// Get the current page slug or passed active tab
$current_page = isset($args['active_tab']) ? $args['active_tab'] : '';

// If no active tab is passed, try to detect from current page
if (empty($current_page)) {
    if (is_page()) {
        $current_page = get_post_field('post_name', get_post());
    }
}

// Define the navigation items
$nav_items = array(

    'General Inquiries' => array(
        'url' => home_url('/contact-us/'),
        'title' => 'General Inquiries'
    ),
    'Feedback Form' => array(
        'url' => home_url('/Feedback Form/'),
        'title' => 'Feedback Form'
    ),
    'Office Locations' => array(
        'url' => home_url('/Office-Locations/'),
        'title' => "Office Locations"
    ),

);

// Additional CSS class
$nav_class = isset($args['class']) ? $args['class'] : '';
?>

<!-- About Tabs Navigation -->
<div class="about-tabs-section  product-tabs-section mt_50 mb_0 <?php echo esc_attr($nav_class); ?>">
    <ul>
        <?php foreach ($nav_items as $slug => $item): ?>
            <li>
                <a href="<?php echo esc_url($item['url']); ?>" <?php echo ($current_page === $slug) ? 'class="active"' : ''; ?>>
                    <?php echo esc_html($item['title']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>