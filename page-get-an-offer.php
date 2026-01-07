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

            // Wait a moment to show success message, then reset everything
            setTimeout(function () {
                // Reset all form fields
                const allInputs = form.querySelectorAll('input, textarea, select');
                allInputs.forEach(function (input) {
                    if (input.type === 'checkbox' || input.type === 'radio') {
                        input.checked = false;
                    } else if (input.type === 'file') {
                        input.value = '';
                        // Reset upload area text
                        if (uploadArea) {
                            const uploadText = uploadArea.querySelector('.upload-text');
                            if (uploadText) {
                                uploadText.textContent = uploadText.getAttribute('data-original-text') || 'Upload Images' || 'Select files';
                            }
                        }
                    } else if (input.tagName === 'SELECT') {
                        input.selectedIndex = 0;
                        input.value = '';
                    } else if (input.type !== 'submit' && input.type !== 'hidden') {
                        input.value = '';
                    }
                });

                // Reset Choices.js selects - must reset underlying select first, then update Choices
                if (typeof Choices !== 'undefined') {
                    const selects = form.querySelectorAll('select');
                    selects.forEach(function (select) {
                        if (select.closest('.choices')) {
                            try {
                                // First, reset the underlying select element
                                const placeholderOption = select.querySelector('option[selected][disabled]') ||
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
                                const choicesInstance = Choices.getInstance(select);
                                if (choicesInstance) {
                                    // Remove all active items
                                    choicesInstance.removeActiveItems();

                                    // Set to empty value to show placeholder
                                    choicesInstance.setChoiceByValue('');

                                    // Force update the display
                                    choicesInstance._render();
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

                // Clear all validation errors
                const errorMessages = form.querySelectorAll('.validation-error, .wpcf7-not-valid-tip, .field-error');
                errorMessages.forEach(function (error) {
                    error.remove();
                });

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
            }, 500); // Small delay to show success message first
        }, false);
    });
</script>

<?php get_footer(); ?>