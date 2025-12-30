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


    <section class="get-offer-section container">
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
    });
</script>

<?php get_footer(); ?>