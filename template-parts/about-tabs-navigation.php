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
    'about-us' => array(
        'url' => home_url('/about-us/'),
        'title' => 'Overview'
    ),
    'history' => array(
        'url' => home_url('/history/'),
        'title' => 'History'
    ),
    'founders-vision' => array(
        'url' => home_url('/founders-vision/'),
        'title' => "Founder's Vision"
    ),
    'yakult-middle-east' => array(
        'url' => home_url('/yakult-middle-east/'),
        'title' => 'Yakult Middle East'
    ),
    'yakult-central-institute' => array(
        'url' => home_url('/yakult-central-institute/'),
        'title' => 'Yakult Central Institute'
    ),
    'yakult-honsha' => array(
        'url' => home_url('/yakult-honsha/'),
        'title' => 'Yakult Honsha'
    ),
    'yakult-worldwide' => array(
        'url' => home_url('/yakult-worldwide/'),
        'title' => 'Yakult Worldwide'
    ),
    'factory-tour' => array(
        'url' => home_url('/factory-tour/'),
        'title' => 'Factory Tour'
    ),
    'sustainability' => array(
        'url' => home_url('/sustainability/'),
        'title' => 'Sustainability'
    )
);

// Additional CSS class
$nav_class = isset($args['class']) ? $args['class'] : '';
?>

<!-- About Tabs Navigation -->
<div class="about-tabs-section mt_50 mb_0 <?php echo esc_attr($nav_class); ?>" data-aos="fade">
    <ul >
        <?php foreach ($nav_items as $slug => $item) : ?>
            <li>
                <a href="<?php echo esc_url($item['url']); ?>" 
                   <?php echo ($current_page === $slug) ? 'class="active"' : ''; ?>>
                    <?php echo esc_html($item['title']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
