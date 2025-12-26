<?php
//Multi Step Form // Handle Property Form Submission // Property Form Handler 
//Multi Step Property Form Handler 
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

        // Add validation for multi-step form "next" buttons
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
                } else if (!value || ($input.is('select') && value === '')) {
                    isValid = false;
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
            // Else, allow step to proceed
        });


        // Property form submission handler (final step)
        $('#property-form').on('submit', function(e) {
            e.preventDefault();
            
            // Clear all previous errors for this form
            var $form = $(this);
            $form.find('.field-error').remove();
            $form.find('.error-border').removeClass('error-border');
            
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