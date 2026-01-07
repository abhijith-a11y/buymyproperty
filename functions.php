<?php
/**
 * Yakult functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package yakult
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function yakult_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on yakult, use a find and replace
     * to change 'yakult' to the name of your theme in all the template files.
     */
    load_theme_textdomain('yakult', get_template_directory() . '/languages');

    // enqueue style

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'yakult'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'globalis_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'yakult_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yakult_content_width()
{
    $GLOBALS['content_width'] = apply_filters('yakult_content_width', 640);
}
add_action('after_setup_theme', 'yakult_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function yakult_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'yakult'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'yakult'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action('widgets_init', 'yakult_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function buy_my_property_scripts()
{
    wp_enqueue_style('globalis-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('globalis-style', 'rtl', 'replace');

    // Enqueue fonts
    wp_enqueue_style('fonts', get_stylesheet_directory_uri() . '/assets/fonts/fonts.css', array(), '1.0', 'all');

    // Enqueue all styles from styles folder (compiled CSS files)
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/styles/main.css', array(), '1.0', 'all');

    // Enqueue third-party CSS
    wp_enqueue_style('aos', get_stylesheet_directory_uri() . '/assets/css/aos.css', array(), '1.0', 'all');
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0', 'all');
    wp_enqueue_style('responsive', get_stylesheet_directory_uri() . '/assets/css/responsive.css', array(), '1.0', 'all');

    // Third-party libraries
    wp_enqueue_script('swiper', get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('aos', get_stylesheet_directory_uri() . '/assets/js/aos.js', array('jquery'), '1.0', true);

    // GSAP and ScrollTrigger for animations
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true);

    // Main JavaScript file that imports all other JS files
    wp_enqueue_script('buy-my-property-main', get_stylesheet_directory_uri() . '/assets/js/home.js', array('jquery', 'swiper', 'aos', 'gsap', 'gsap-scrolltrigger'), '1.0', true);

    // Pass theme URL to JavaScript for dynamic imports
    wp_add_inline_script('buy-my-property-main', 'window.yakultThemeUrl = "' . get_template_directory_uri() . '";', 'before');
    wp_enqueue_script(
        'bmp-navigation', 
        get_template_directory_uri() . '/assets/js/navigation.js', 
        array(), 
        '1.0', 
        true // This 'true' tells WordPress to load the script in the FOOTER
    );
}
add_action('wp_enqueue_scripts', 'buy_my_property_scripts');

/**
 * Enqueue Choices.js scripts and styles (replacement for SumoSelect)
 */
function enqueue_choices_js()
{
    if (is_page() || is_single()) {
        // Choices.js CSS
        wp_enqueue_style(
            'choices-css',
            'https://cdn.jsdelivr.net/npm/choices.js@10.2.0/public/assets/styles/choices.min.css',
            array(),
            '10.2.0'
        );

        // Choices.js JavaScript
        wp_enqueue_script(
            'choices-js',
            'https://cdn.jsdelivr.net/npm/choices.js@10.2.0/public/assets/scripts/choices.min.js',
            array(),
            '10.2.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_choices_js');

/**
 * Enqueue Flatpickr scripts and styles for datetime picker
 */
function enqueue_flatpickr()
{
    // Only load on pages that might have datetime pickers
    if (is_page() || is_single()) {
        // Flatpickr CSS
        wp_enqueue_style(
            'flatpickr-css',
            'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
            array(),
            '4.6.13'
        );

        // Flatpickr JavaScript
        wp_enqueue_script(
            'flatpickr-js',
            'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js',
            array(),
            '4.6.13',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_flatpickr');

/**
 * Display inner banner component
 *
 * @param string $title Banner title
 * @param string $subtitle Banner subtitle (optional)
 * @param string $class Additional CSS class (optional)
 */
function yakult_inner_banner($title = '', $subtitle = '', $class = '')
{
    get_template_part('template-parts/inner-banner', null, array(
        'title' => $title,
        'subtitle' => $subtitle,
        'class' => $class
    ));
}


/**
 * Display about tabs navigation component
 *
 * @param string $active_tab Active tab slug (optional)
 * @param string $class Additional CSS class (optional)
 */
function yakult_about_tabs($active_tab = '', $class = '')
{
    get_template_part('template-parts/about-tabs-navigation', null, array(
        'active_tab' => $active_tab,
        'class' => $class
    ));
}
function yakult_product_tabs($active_tab = '', $class = '')
{
    get_template_part('template-parts/product-tabs-navigation', null, array(
        'active_tab' => $active_tab,
        'class' => $class
    ));
}
function events_tabs($active_tab = '', $class = '')
{
    get_template_part('template-parts/events-tabs', null, array(
        'active_tab' => $active_tab,
        'class' => $class
    ));
}
function yakult_contact_tabs($active_tab = '', $class = '')
{
    get_template_part('template-parts/contact-us-tabs', null, array(
        'active_tab' => $active_tab,
        'class' => $class
    ));
}

register_nav_menus(
    array(
        'header1' => __('Header Menu', 'yakult'),
        'solution-menu' => __('Solution Menus', 'yakult'),
        'service-menu' => __('Service Menus', 'yakult'),
        'company-menu' => __('Company Menus', 'yakult'),
    )
);

/**
 * Fallback menu for header navigation
 */
function header_fallback_menu()
{
    echo '<ul class="header-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'yakult') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about/')) . '">' . __('About Us', 'yakult') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/services/')) . '">' . __('How It Works', 'yakult') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/why-choose-us/')) . '">' . __('Why Choose Us', 'yakult') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '">' . __('Contact Us', 'yakult') . '</a></li>';
    echo '</ul>';
}

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
// require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

function enqueue_swiper_assets()
{
    // Swiper CSS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true
    );

    // Your custom swiper init script (depends on swiper-js)
    wp_enqueue_script(
        'history-swiper-init',
        get_template_directory_uri() . '/assets/js/history-swiper.js',
        array('swiper-js'),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');


function mytheme_enqueue_aos()
{
    // Theme directory URL
    $theme_uri = get_template_directory_uri();

    // AOS CSS
    wp_enqueue_style(
        'aos-css',
        $theme_uri . '/assets/styles/aos.css',
        array(),
        '2.3.4'
    );

    // AOS JS
    wp_enqueue_script(
        'aos-js',
        $theme_uri . '/assets/js/aos.js',
        array('jquery'),
        '2.3.4',
        true
    );

    // Init script
    // wp_add_inline_script(
    // 	'aos-js',
    // 	'document.addEventListener("DOMContentLoaded", function() { AOS.init(); });'
    // );
    wp_add_inline_script(
        'aos-js',
        'document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            duration: 1000, 
            
            offset: 120,
        });
    });'
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_aos');

function mytheme_enqueue_masonry()
{
    // Use WP core scripts
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('masonry');

    // Your init file depends on both
    wp_enqueue_script(
        'my-masonry-init',
        get_template_directory_uri() . '/assets/js/masonry-init.js',
        array('masonry', 'imagesloaded'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_masonry');

add_filter('upload_mimes', fn($m)=>$m+['svg'=>'image/svg+xml','svgz'=>'image/svg+xml']);

//Function to reset after form submission





// Register the custom form tag for Contact Form 7
if (function_exists('wpcf7_add_form_tag')) {

    wpcf7_add_form_tag('cf7_extra_fields', 'cf7_extra_fields_func');

    function cf7_extra_fields_func($tag)
    {
        $html  = '<input type="hidden" name="page-title" value="' . esc_attr(get_the_title()) . '" />';
        // $html .= '<input type="hidden" name="page-url" value="' . esc_url(get_the_permalink()) . '"/>';

        // Uncomment if needed (make sure ACF is installed and fields exist)
        // $html .= '<input type="hidden" name="page-img" value="' . esc_url(get_field("banner_image")) . '"/>';
        // $html .= '<input type="hidden" name="page-email" value="' . esc_attr(get_field("contact_email_address")) . '"/>';

        return $html;
    }
}

// Disable Gutenberg on the back end.
add_filter('use_block_editor_for_post', '__return_false');

// Auto hide success message for Contact Form 7

function cf7_auto_hide_success_message() {
    ?>
    <script type="text/javascript">
    document.addEventListener('wpcf7mailsent', function(event) {
        var response = event.target.querySelector('.wpcf7-response-output');
        if(response) {
            setTimeout(function() {
                response.style.display = 'none';
            }, 5000); // 5000ms = 5 seconds
        }
    }, false);
    </script>
    <?php
}
add_action('wp_footer', 'cf7_auto_hide_success_message');
//Function to reset all form fields after successful form submission (but preserve success message)
function force_cf7_reset_script() {
    ?>
    <script>
    document.addEventListener('wpcf7mailsent', function(event) {
        // Get the form
        var form = event.target;
        
        // Delay reset to ensure success message is displayed first
        setTimeout(function() {
            // Reset all form inputs, textareas, and selects
            var inputs = form.querySelectorAll('input:not([type="submit"]):not([type="hidden"]), textarea, select');
            inputs.forEach(function(input) {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = false;
                } else if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                    input.value = '';
                } else {
                    input.value = '';
                }
            });
            
            // Reset file inputs
            var fileInputs = form.querySelectorAll('input[type="file"]');
            fileInputs.forEach(function(input) {
                input.value = '';
                // Reset file input display text if exists
                var uploadText = form.querySelector('.upload-text');
                if (uploadText) {
                    uploadText.textContent = 'Upload Images' || 'Select files';
                }
            });
            
            // Reset Choices.js select elements - must reset underlying select first
            if (typeof Choices !== 'undefined') {
                var selects = form.querySelectorAll('select');
                selects.forEach(function(select) {
                    // Check if Choices.js is already initialized
                    if (select.closest('.choices')) {
                        try {
                            // First, reset the underlying select element
                            var placeholderOption = select.querySelector('option[selected][disabled]') || 
                                                   select.querySelector('option[disabled]') ||
                                                   select.querySelector('option[value=""]');
                            
                            if (placeholderOption) {
                                select.selectedIndex = Array.from(select.options).indexOf(placeholderOption);
                                select.value = '';
                            } else {
                                select.selectedIndex = 0;
                                select.value = '';
                            }
                            
                            // Then update Choices.js instance
                            var choicesInstance = Choices.getInstance(select);
                            if (choicesInstance) {
                                // Remove all active items
                                choicesInstance.removeActiveItems();
                                
                                // Set to empty value to show placeholder
                                choicesInstance.setChoiceByValue('');
                                
                                // Force update the display
                                if (choicesInstance._render) {
                                    choicesInstance._render();
                                }
                            }
                        } catch (e) {
                            console.log('Error resetting Choices.js:', e);
                            // Fallback: just reset the select element
                            select.selectedIndex = 0;
                            select.value = '';
                        }
                    } else {
                        // For non-Choices selects, just reset normally
                        select.selectedIndex = 0;
                        select.value = '';
                    }
                });
            }
            
            // Reset any custom dropdowns
            var customDropdowns = form.querySelectorAll('.custom-dropdown');
            customDropdowns.forEach(function(dropdown) {
                var placeholder = dropdown.querySelector('.placeholder');
                if (placeholder) {
                    placeholder.textContent = placeholder.getAttribute('data-placeholder') || 'Select';
                    placeholder.classList.add('placeholder');
                    placeholder.classList.remove('selected');
                }
                dropdown.removeAttribute('data-selected');
            });
            
            // Remove any validation error messages
            var errorMessages = form.querySelectorAll('.validation-error, .wpcf7-not-valid-tip, .field-error');
            errorMessages.forEach(function(error) {
                error.remove();
            });
            
            // Remove error styling from fields
            var errorFields = form.querySelectorAll('.wpcf7-not-valid, .error-border');
            errorFields.forEach(function(field) {
                field.classList.remove('wpcf7-not-valid', 'error-border');
                field.style.borderColor = '';
            });
            
            // Reset submit button
            var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = false;
                if (submitBtn.hasAttribute('data-original-text')) {
                    submitBtn.textContent = submitBtn.getAttribute('data-original-text');
                }
            }
            
        }, 500); // Small delay to ensure success message is visible, then reset everything
    }, false);
    </script>
    <?php
}
add_action('wp_footer', 'force_cf7_reset_script');



// function for removing unwanted br and p tag
function remove_wpautop_shortcode($content)
{
    $content = do_shortcode($content);
    $content = preg_replace('#^<p>#', '', $content); // Remove leading <p>
    $content = preg_replace('#</p>$#', '', $content); // Remove trailing </p>
    $content = preg_replace('#<br\s*/>#', '', $content); // Remove any <br />
    return $content;
}
add_shortcode('noautop', 'remove_wpautop_shortcode');

// Disable automatic formatting (p and br tags) for all Contact Form 7 forms
add_filter('wpcf7_autop_or_not', '__return_false');


// Allow only digits and plus sign & add validation message
add_action('wp_footer', function () {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Select all phone fields
        const phoneFields = document.querySelectorAll('input[name^="phonetext"], input[name="phone"]');

        phoneFields.forEach(function(phoneField) {
            // Restrict input to digits and plus
            phoneField.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9+]/g, '');
            });

            // Add validation on form submit
            const form = phoneField.closest('form.wpcf7-form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    if (phoneField.value.trim() === '' || /[^0-9+]/.test(phoneField.value)) {
                        e.preventDefault(); // Stop form submission
                        alert('Please enter a valid phone number with digits only (and optional +).');
                        phoneField.focus();
                    }
                });
            }
        });
    });
    </script>
    <?php
});


    
//Multi Step Property Form Handler 
// AJAX handler for property form submission for authenticated and unauthenticated users
add_action('wp_ajax_handle_property_form_submission', 'handle_property_form_submission');
add_action('wp_ajax_nopriv_handle_property_form_submission', 'handle_property_form_submission');

/**
 * Handles submission from the custom multi-step property form.
 * Sanitizes input, handles file uploads, validates fields, and sends formatted HTML email with attachments.
 * Returns field errors per-field for front-end display (no popup/alert, only structured data).
 */
function handle_property_form_submission()
{
    // Sanitize and fetch all posted values
    $full_name        = isset($_POST['full_name'])        ? sanitize_text_field($_POST['full_name'])        : '';
    $phone            = isset($_POST['phone'])            ? sanitize_text_field($_POST['phone'])            : '';
    $email            = isset($_POST['email'])            ? sanitize_email($_POST['email'])                 : '';
    $emirate          = isset($_POST['emirate'])          ? sanitize_text_field($_POST['emirate'])          : '';
    $community_area   = isset($_POST['community_area'])   ? sanitize_text_field($_POST['community_area'])   : '';
    $property_type    = isset($_POST['property_type'])    ? sanitize_text_field($_POST['property_type'])    : '';
    $bedrooms         = isset($_POST['bedrooms'])         ? sanitize_text_field($_POST['bedrooms'])         : '';
    $bua              = isset($_POST['bua'])              ? sanitize_text_field($_POST['bua'])              : '';
    $occupancy_status = isset($_POST['occupancy_status']) ? sanitize_text_field($_POST['occupancy_status']) : '';
    $expected_price   = isset($_POST['expected_price'])   ? sanitize_text_field($_POST['expected_price'])   : 'Not provided';
    $property_ready   = isset($_POST['property_ready'])   ? sanitize_text_field($_POST['property_ready'])   : '';
    $reason_selling   = isset($_POST['reason_selling'])   ? sanitize_text_field($_POST['reason_selling'])   : '';
    $timeline         = isset($_POST['timeline'])         ? sanitize_text_field($_POST['timeline'])         : '';

    // Validation per field - collect errors by field name
    $errors = array();

    if (empty($full_name)) {
        $errors['full_name'] = "Full name is required.";
    }

    if (empty($email)) {
        $errors['email'] = "Email address is required.";
    } elseif (!is_email($email)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if (empty($phone)) {
        $errors['phone'] = "Phone number is required.";
    } elseif (!preg_match('/^\+?[0-9\s\-]{6,}$/', $phone)) {
        $errors['phone'] = "Please enter a valid phone number.";
    }

    if (empty($emirate)) {
        $errors['emirate'] = "Emirate is required.";
    }

    if (empty($community_area)) {
        $errors['community_area'] = "Community Area is required.";
    }

    if (empty($property_type)) {
        $errors['property_type'] = "Property type is required.";
    }

    if (empty($bedrooms)) {
        $errors['bedrooms'] = "Number of bedrooms is required.";
    }

    if (empty($bua)) {
        $errors['bua'] = "BUA (Built-Up Area) is required.";
    }

    if (empty($occupancy_status)) {
        $errors['occupancy_status'] = "Occupancy status is required.";
    }

    if (empty($property_ready)) {
        $errors['property_ready'] = "Property status is required.";
    }

    if (empty($reason_selling)) {
        $errors['reason_selling'] = "Reason for selling is required.";
    }

    if (empty($timeline)) {
        $errors['timeline'] = "Timeline is required.";
    }

    // If errors, return error JSON with errors per field (AJAX can show near each field, not as popup)
    if (!empty($errors)) {
        wp_send_json(
            array(
                'success' => false,
                'type' => 'validation',
                'errors' => $errors
            )
        );
        wp_die();
    }

    // Fetch the recipient email from the ACF field 'hm_multiform_mail'
    $to = get_field('hm_multiform_mail', 'option');
    $subject = 'New Property Form Submission';

    // Assemble the HTML email body (same as before)
    $body = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buy My Property</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;">
        <tr>
            <td align="center" style="padding:20px 0;">
                <table width="600" border="0" cellpadding="0" cellspacing="0" style="background-color:#fff;border:1px solid #e3e3e3;">
                    <tr>
                        <td align="center" style="padding:30px 40px 10px 40px;">
                            <img src="https://buymyproperty.e8demo.com/Dev/wp-content/uploads/2025/09/logo_footer.png" alt="Buy My Property" style="display:block;width:150px;height:auto;max-width:150px;">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:10px 40px 30px 40px;">
                            <h2 style="font-family: Arial, sans-serif; color: #333; font-size:18px; margin:0; text-transform:uppercase; font-weight:600;">
                                Property Submission Form
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top:2px solid #e3e3e3;"></td>
                    </tr>
                </table>
                <table width="600" border="0" cellpadding="0" cellspacing="0" style="background-color:#fff;border:1px solid #e3e3e3;border-top:none;">
                    <tr>
                        <td style="padding:30px 40px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!-- Personal & Location Details -->
                                <tr>
                                    <td colspan="2" style="padding-bottom:20px;">
                                        <h3 style="font-family: Arial, sans-serif; color:#333; font-size:16px; margin:0; font-weight:600; border-bottom:2px solid #e3e3e3; padding-bottom:10px;">Personal &amp; Location Details</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;width:35%;">Full Name:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html($full_name) .'</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">Email:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html($email) .'</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">Phone:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html($phone) .'</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">Emirate:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html(ucfirst($emirate)) .'</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0 20px 0;">Community Area:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0 20px 0;font-weight:500;">'. esc_html(ucfirst(str_replace('-', ' ', $community_area))) .'</td>
                                </tr>
                                <!-- Property Details -->
                                <tr>
                                    <td colspan="2" style="padding-bottom:20px;padding-top:20px;">
                                        <h3 style="font-family: Arial, sans-serif; color:#333; font-size:16px; margin:0; font-weight:600; border-bottom:2px solid #e3e3e3; padding-bottom:10px;">Property Details</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">Property Type:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html(ucfirst($property_type)) .'</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">Bedrooms:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html($bedrooms) .'</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">BUA (Built-Up Area):</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html($bua) .' sq.ft</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">Occupancy Status:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html(ucfirst(str_replace('-', ' ', $occupancy_status))) .'</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0 20px 0;">Expected Price:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0 20px 0;font-weight:500;">'. esc_html($expected_price) .'</td>
                                </tr>
                                <!-- Sale Details -->
                                <tr>
                                    <td colspan="2" style="padding-bottom:20px;padding-top:20px;">
                                        <h3 style="font-family: Arial, sans-serif; color:#333; font-size:16px; margin:0; font-weight:600; border-bottom:2px solid #e3e3e3; padding-bottom:10px;">Sale Details</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">Property Status:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html(ucfirst(str_replace('-', ' ', $property_ready))) .'</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">Reason For Selling:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html(ucfirst($reason_selling)) .'</td>
                                </tr>
                                <tr>
                                    <td style="color:#747474;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;">Timeline:</td>
                                    <td style="color:#000;font-size:14px;font-family:Arial,sans-serif;padding:10px 0;font-weight:500;">'. esc_html(ucfirst(str_replace('-', ' ', $timeline))) .'</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color:#f7f7f7;padding:20px 40px;text-align:center;border-top:2px solid #e3e3e3;">
                            <p style="font-family:Arial,sans-serif;color:#747474;font-size:12px;margin:0;">
                                This email was sent from your website contact form
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Buy My Property <noreply@e8demo.com>',
        'Reply-To: ' . $email
    ];

    // Handle file uploads (attachments)
    $attachments = array();
    if (!empty($_FILES['property_images']['name'][0])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        foreach ((array) $_FILES['property_images']['name'] as $key => $value) {
            if ($_FILES['property_images']['error'][$key] === 0) {
                $file = array(
                    'name'     => $_FILES['property_images']['name'][$key],
                    'type'     => $_FILES['property_images']['type'][$key],
                    'tmp_name' => $_FILES['property_images']['tmp_name'][$key],
                    'error'    => $_FILES['property_images']['error'][$key],
                    'size'     => $_FILES['property_images']['size'][$key]
                );
                $upload = wp_handle_upload($file, array('test_form' => false));
                if ($upload && empty($upload['error'])) {
                    $attachments[] = $upload['file'];
                }
            }
        }
    }

    // Send email with attachments and cleanup
    if (wp_mail($to, $subject, $body, $headers, $attachments)) {
        foreach ($attachments as $attachment) {
            @unlink($attachment);
        }
        wp_send_json(array(
            'success' => true,
            'type' => 'success',
            'message' => 'Form submitted successfully!'
        ));
    } else {
        wp_send_json(array(
            'success' => false,
            'type' => 'server',
            'message' => 'Failed to send email. Please try again.'
        ));
    }
    wp_die();
}



// Enqueue script with localized AJAX URL and custom styles
add_action('wp_enqueue_scripts', 'enqueue_property_form_scripts');
function enqueue_property_form_scripts()
{
    // Enqueue custom JavaScript for form handling
    wp_enqueue_script(
        'property-form-handler',
        get_template_directory_uri() . '/js/property-form-handler.js',
        array('jquery'),
        '1.0.1',
        true
    );
    
    // Localize script with AJAX URL
    wp_localize_script('property-form-handler', 'propertyFormAjax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
    
    // Enqueue custom CSS for form errors
    wp_enqueue_style(
        'property-form-errors',
        get_template_directory_uri() . '/css/property-form-errors.css',
        array(),
        '1.0.0'
    );
}

// Add inline script if you don't want to create a separate JS file
add_action('wp_footer', 'property_form_inline_script');
function property_form_inline_script()
{
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {

        // ============ MULTISTEP VALIDATION HANDLER ============= //

        // Add validation for multi-step form "next" buttons (only for property-form, homeoffer-form has its own validation)
        $('.property-multistep-next').on('click', function(e) {
            // Get this step's required fields
            var $step = $(this).closest('.form-step');
            var valid = true;

            // Remove old errors in this step
            $step.find('.field-error').remove();
            $step.find('.error-border').removeClass('error-border');

            $step.find('[data-required], .required, [required]').each(function() {
                var $input = $(this);
                var isValid = true;
                var value = $input.val();

                // For checkbox/radio, check :checked prop
                if ($input.is(':checkbox') || $input.is(':radio')) {
                    if (!$input.is(':checked')) {
                        isValid = false;
                    }
                } else if ($input.is('select')) {
                    // For select fields, check if disabled/placeholder option is selected
                    // Note: HTML select elements return empty string "", not null when empty
                    var selectedIndex = $input[0].selectedIndex;
                    var selectedOption = $input[0].options[selectedIndex];
                    // Invalid if: no option selected, empty string value, or selected option is disabled
                    if (!selectedOption || 
                        selectedOption.disabled || 
                        !value || 
                        value === '') {
                        isValid = false;
                    }
                } else {
                    // Check if value is null - show validation
                    if (value === null) {
                        isValid = false;
                    }
                    // Check if value is empty or undefined
                    else if (value === undefined || !value) {
                        isValid = false;
                    }
                }

                if (!isValid) {
                    valid = false;
                    $input.addClass('error-border');
                    if ($input.parent().hasClass('form-group') || $input.parent().hasClass('field-wrapper')) {
                        $input.parent().append('<span class="field-error">This field is required.</span>');
                    } else {
                        $input.after('<span class="field-error">This field is required.</span>');
                    }
                }
            });

            // You can extend here for custom validation if needed (like email/phone check)

            // If not valid, prevent next step and scroll to first error
            if (!valid) {
                e.preventDefault();
                var $firstError = $step.find('.error-border').first();
                if ($firstError.length) {
                    $('html, body').animate({
                        scrollTop: $firstError.offset().top - 100
                    }, 500);
                }
                return false;
            }
            // Else, allow step to proceed (no scrolling on successful next)
        });


        // Property form submission handler (final step) - only for property-form (homeoffer-form has its own handler)
        $('#property-form').on('submit', function(e) {
            e.preventDefault();
            
            // Clear all previous errors for this form
            var $form = $(this);
            $form.find('.field-error').remove();
            $form.find('.error-border').removeClass('error-border');
            // Debugging: Check if JS submit handler is being triggered
            // Uncomment the line below to ensure submit event is hooked
            // console.log('Property form submit handler triggered');
            
            // You can perform extra validation here if needed
            // If client-side valid, allow AJAX call to proceed
            // Otherwise, return false to prevent actual submission

            var formData = new FormData(this);
            formData.append('action', 'handle_property_form_submission');
            
            // Disable submit button to prevent double submission
            var $submitBtn = $(this).find('button[type="submit"]');
            var originalText = $submitBtn.text();
            $submitBtn.prop('disabled', true).text('Submitting...');
            
            $.ajax({
                url: propertyFormAjax.ajax_url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Success - show success message
                        var $successMsg = $('<div class="form-success-message" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">' + response.message + '</div>');
                        $('#property-form').prepend($successMsg);
                        $('#property-form')[0].reset();
                        
                        // Scroll to success message
                        $('html, body').animate({
                            scrollTop: $successMsg.offset().top - 100
                        }, 500);
                        
                        // Remove success message after 5 seconds
                        setTimeout(function() {
                            $successMsg.fadeOut(function() {
                                $(this).remove();
                            });
                        }, 5000);
                    } else {
                        if (response.type === 'validation') {
                            // Display field-specific errors
                            displayFieldErrors(response.errors);
                        } else {
                            // Server error
                            var $errorMsg = $('<div class="form-error-message" style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">' + response.message + '</div>');
                            $('#property-form').prepend($errorMsg);
                            
                            // Remove error message after 5 seconds
                            setTimeout(function() {
                                $errorMsg.fadeOut(function() {
                                    $(this).remove();
                                });
                            }, 5000);
                        }
                    }
                },
                error: function() {
                    var $errorMsg = $('<div class="form-error-message" style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">An error occurred. Please try again.</div>');
                    $('#property-form').prepend($errorMsg);
                    
                    setTimeout(function() {
                        $errorMsg.fadeOut(function() {
                            $(this).remove();
                        });
                    }, 5000);
                },
                complete: function() {
                    // Re-enable submit button
                    $submitBtn.prop('disabled', false).text(originalText);
                }
            });
        });
        
        // Function to display errors under each field
        function displayFieldErrors(errors) {
            var firstError = true;
            
            $.each(errors, function(fieldName, errorMessage) {
                // Find the input field
                var $field = $('[name="' + fieldName + '"]');
                
                if ($field.length) {
                    // Add error border to field
                    $field.addClass('error-border');
                    
                    // Create error message element
                    var $errorMsg = $('<span class="field-error">' + errorMessage + '</span>');
                    
                    // Insert error message after the field (or its parent container)
                    if ($field.parent().hasClass('form-group') || $field.parent().hasClass('field-wrapper')) {
                        $field.parent().append($errorMsg);
                    } else {
                        $field.after($errorMsg);
                    }
                    
                    // Scroll to first error
                    if (firstError) {
                        $('html, body').animate({
                            scrollTop: $field.offset().top - 100
                        }, 500);
                        firstError = false;
                    }
                }
            });
        }
        
        // Remove error styling when user starts typing/selecting
        $(document).on('input change', 'input, select, textarea', function() {
            $(this).removeClass('error-border');
            $(this).siblings('.field-error').remove();
            $(this).parent().find('.field-error').remove();
        });
    });
    </script>
    
    <style type="text/css">
    /* Error styling for form fields */
    .error-border {
        border-color: #d9534f !important;
        border-width: 2px !important;
    }

    .field-error {
        color: #d9534f;
        font-size: 13px;
        display: block;
        margin-top: 5px;
        font-weight: 500;
        animation: fadeInError 0.3s ease-in-out;
    }

    /* Optional: Add a subtle animation for error appearance */
    @keyframes fadeInError {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Focus state for error fields */
    .error-border:focus {
        border-color: #c9302c !important;
        box-shadow: 0 0 0 0.2rem rgba(217, 83, 79, 0.25);
        outline: none;
    }
    </style>
    <?php
}

