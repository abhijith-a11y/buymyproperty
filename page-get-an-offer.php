<?php
/**
 * Template Name: Get an Offer
 * 
 * The template for displaying the Get an Offer page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buy-my-property
 */

get_header();
?>

<main id="primary" class="site-main mt_default">

    <?php get_template_part('template-parts/banner', null, array('bg_position' => 'top')); ?>


    <section class="get-offer-section container mt_50 pb_100 pt_100">
        <div class="wrap">
            <div class="get-offer-content">
                <!-- Left Side: Heading and Description -->
                <div class="get-offer-left">
                    <h2 class="section-title"><?php echo get_field('go_title'); ?></h2>
                    <p class="section-description"><?php echo get_field('go_short_description'); ?></p>
                </div>

                <!-- Right Side: Form -->
                <div class="get-offer-right">
                    <div class="offer-form-container">
                        <div class="offer-form" id="propertyOfferForm">
                            <?php echo do_shortcode('[contact-form-7 id="5f631f8" title="Get an offer"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Upload area functionality
        const uploadArea = document.querySelector('.upload-area');
        const fileInput = document.getElementById('property-images');

        if (uploadArea && fileInput) {
            uploadArea.addEventListener('click', function () {
                fileInput.click();
            });

            uploadArea.addEventListener('dragover', function (e) {
                e.preventDefault();
                uploadArea.style.borderColor = 'var(--color-primary)';
                uploadArea.style.background = '#f8f9fa';
            });

            uploadArea.addEventListener('dragleave', function (e) {
                e.preventDefault();
                uploadArea.style.borderColor = '#ddd';
                uploadArea.style.background = 'white';
            });

            uploadArea.addEventListener('drop', function (e) {
                e.preventDefault();
                uploadArea.style.borderColor = '#ddd';
                uploadArea.style.background = 'white';

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    updateUploadText(files.length);
                }
            });

            fileInput.addEventListener('change', function () {
                if (this.files.length > 0) {
                    updateUploadText(this.files.length);
                }
            });

            function updateUploadText(fileCount) {
                const uploadText = uploadArea.querySelector('.upload-text');
                if (uploadText) {
                    uploadText.textContent = `${fileCount} file(s) selected`;
                }
            }
        }

        // Reset form completely after successful submission
        document.addEventListener('wpcf7mailsent', function (event) {
            const form = event.target;
            
            // Function to show success message - try multiple times
            function showSuccessMessage() {
                // Method 1: Look for success class
                let successMessage = form.querySelector('.wpcf7-response-output.wpcf7-mail-sent-ok');
                
                // Method 2: Look for any response output that's not an error
                if (!successMessage) {
                    const allResponses = form.querySelectorAll('.wpcf7-response-output');
                    allResponses.forEach(function(response) {
                        if (!response.classList.contains('wpcf7-not-valid') && 
                            response.textContent.trim().length > 0) {
                            successMessage = response;
                            successMessage.classList.add('wpcf7-mail-sent-ok');
                        }
                    });
                }
                
                if (successMessage) {
                    // Force visibility with !important inline styles
                    successMessage.style.cssText = 'display: block !important; visibility: visible !important; opacity: 1 !important; position: relative !important; z-index: 9999 !important;';
                    successMessage.classList.add('wpcf7-mail-sent-ok');
                    successMessage.classList.remove('wpcf7-not-valid');
                    
                    // Scroll to success message so user can see it
                    setTimeout(function() {
                        if (successMessage && successMessage.scrollIntoView) {
                            successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }, 50);
                    
                    return true;
                }
                return false;
            }
            
            // Try immediately
            showSuccessMessage();
            
            // Try again multiple times in case CF7 hasn't added it yet
            setTimeout(showSuccessMessage, 50);
            setTimeout(showSuccessMessage, 100);
            setTimeout(showSuccessMessage, 200);
            setTimeout(showSuccessMessage, 500);

            // Wait longer to show success message, then reset everything
            setTimeout(function () {
                // Reset file inputs first
                const fileInputs = form.querySelectorAll('input[type="file"]');
                fileInputs.forEach(function (input) {
                    input.value = '';
                    // Reset upload area text
                    if (uploadArea) {
                        const uploadText = uploadArea.querySelector('.upload-text');
                        if (uploadText) {
                            uploadText.textContent = uploadText.getAttribute('data-original-text') || 'Upload Images' || 'Select files';
                        }
                    }
                });

                // Reset all form inputs and textareas (but not selects yet)
                const allInputs = form.querySelectorAll('input:not([type="submit"]):not([type="hidden"]):not([type="file"]), textarea');
                allInputs.forEach(function (input) {
                    if (input.type === 'checkbox' || input.type === 'radio') {
                        input.checked = false;
                    } else if (input.type !== 'submit' && input.type !== 'hidden') {
                        input.value = '';
                    }
                });

                // Reset ALL select elements (both Choices.js and regular)
                const selects = form.querySelectorAll('select');
                selects.forEach(function (select) {
                    // Find placeholder option (first option with empty value, disabled, or selected)
                    const placeholderOption = select.querySelector('option[value=""][selected]') ||
                        select.querySelector('option[value=""]') ||
                        select.querySelector('option[selected][disabled]') ||
                        select.querySelector('option[disabled]');

                    // Check if Choices.js is initialized
                    const isChoices = select.closest('.choices') && typeof Choices !== 'undefined';

                    if (isChoices) {
                        try {
                            // Reset underlying select first
                            if (placeholderOption) {
                                select.selectedIndex = Array.from(select.options).indexOf(placeholderOption);
                                select.value = placeholderOption.value || '';
                            } else {
                                select.selectedIndex = 0;
                                select.value = select.options[0] ? select.options[0].value : '';
                            }

                            // Then update Choices.js instance
                            const choicesInstance = Choices.getInstance(select);
                            if (choicesInstance) {
                                // Remove all active items
                                choicesInstance.removeActiveItems();

                                // Set to placeholder value
                                if (placeholderOption && placeholderOption.value !== undefined) {
                                    choicesInstance.setChoiceByValue(placeholderOption.value);
                                } else {
                                    // Try to set to empty or first option
                                    try {
                                        choicesInstance.setChoiceByValue('');
                                    } catch (e) {
                                        // If empty doesn't work, select first option
                                        if (select.options.length > 0) {
                                            choicesInstance.setChoiceByValue(select.options[0].value);
                                        }
                                    }
                                }

                                // Force update the display
                                if (choicesInstance._render) {
                                    choicesInstance._render();
                                }
                            }
                        } catch (e) {
                            console.log('Error resetting Choices.js:', e);
                            // Fallback: reset the select element
                            if (placeholderOption) {
                                select.selectedIndex = Array.from(select.options).indexOf(placeholderOption);
                                select.value = placeholderOption.value || '';
                            } else {
                                select.selectedIndex = 0;
                                select.value = select.options[0] ? select.options[0].value : '';
                            }
                        }
                    } else {
                        // For regular selects (not Choices.js)
                        if (placeholderOption) {
                            select.selectedIndex = Array.from(select.options).indexOf(placeholderOption);
                            select.value = placeholderOption.value || '';
                        } else {
                            // If no placeholder, select first option
                            select.selectedIndex = 0;
                            select.value = select.options[0] ? select.options[0].value : '';
                        }

                        // Trigger change event to ensure any listeners are notified
                        const changeEvent = new Event('change', { bubbles: true });
                        select.dispatchEvent(changeEvent);
                    }
                });

                // Reset custom dropdowns
                const customDropdowns = form.querySelectorAll('.custom-dropdown');
                customDropdowns.forEach(function (dropdown) {
                    const placeholder = dropdown.querySelector('.placeholder, .selected');
                    if (placeholder) {
                        const originalText = placeholder.getAttribute('data-placeholder') || 'Select';
                        placeholder.textContent = originalText;
                        placeholder.classList.add('placeholder');
                        placeholder.classList.remove('selected');
                    }
                    dropdown.removeAttribute('data-selected');
                });

                // Clear all validation errors (but NOT success messages)
                const errorMessages = form.querySelectorAll('.validation-error, .wpcf7-not-valid-tip, .field-error');
                errorMessages.forEach(function (error) {
                    // Make sure we're not removing the success message
                    if (!error.classList.contains('wpcf7-mail-sent-ok') && 
                        !error.classList.contains('wpcf7-response-output')) {
                        error.remove();
                    }
                });
                
                // Also remove error response outputs, but keep success ones
                const errorResponses = form.querySelectorAll('.wpcf7-response-output.wpcf7-not-valid');
                errorResponses.forEach(function(error) {
                    if (!error.classList.contains('wpcf7-mail-sent-ok')) {
                        error.remove();
                    }
                });
                
                // Ensure success message is still visible after cleanup
                const successMsg = form.querySelector('.wpcf7-response-output.wpcf7-mail-sent-ok');
                if (successMsg) {
                    successMsg.style.cssText = 'display: block !important; visibility: visible !important; opacity: 1 !important; position: relative !important; z-index: 9999 !important;';
                }

                // Remove error styling
                const errorFields = form.querySelectorAll('.wpcf7-not-valid, .error-border');
                errorFields.forEach(function (field) {
                    field.classList.remove('wpcf7-not-valid', 'error-border');
                    field.style.borderColor = '';
                });

                // Reset submit button
                const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    if (submitBtn.hasAttribute('data-original-text')) {
                        submitBtn.textContent = submitBtn.getAttribute('data-original-text');
                    }
                }
                
                // DO NOT remove or hide the success message - let it stay visible
                // The auto-hide function in functions.php will handle hiding it after 5 seconds
            }, 3000); // Longer delay (3 seconds) to ensure success message is fully visible
        }, false);
    });
</script>

<?php get_footer(); ?>