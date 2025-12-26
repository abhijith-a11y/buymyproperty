<?php
/**
 * Template Name: FAQ
 * 
 * The template for displaying the FAQ page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buy-my-property
 */

get_header();
?>

<main id="primary" class="site-main mt_default">
<?php get_template_part( 'template-parts/banner' ); ?>

    <section class="faq_content wrap pt_100 pb_100">
        <div class="faq_container">
            <div class="faq_header">
                <?php
                $faq_title = get_field('faq_title');
                $faq_description = get_field('faq_description');
                ?>
                <?php if ($faq_title) : ?>
                <h2 class="faq_title">
                    <?php echo esc_html($faq_title); ?>
                </h2>
                <?php endif; ?>
                <?php if ($faq_description) : ?>
                <p class="faq_subtitle">
                    <?php echo wp_kses_post($faq_description); ?>
                </p>
                <?php endif; ?>
            </div>

            <div class="faq_accordion">
                <?php
                $faqs = get_field('faqs');
                if ($faqs) :
                    foreach ($faqs as $index => $faq) :
                        $faq_number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                        $faq_question = $faq['faq_question'];
                        $faq_answer = $faq['faq_answer'];
                        $faq_id = 'faq-' . ($index + 1);
                ?>
                <!-- FAQ Item <?php echo $index + 1; ?> -->
                <div class="faq_item">
                    <div class="faq_question" data-faq="<?php echo $index + 1; ?>">
                        <span class="faq_number"><?php echo $faq_number; ?></span>
                        <h3 class="faq_question_text"><?php echo esc_html($faq_question); ?></h3>
                        <span class="faq_arrow">
                            <svg width="26" height="25" viewBox="0 0 26 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.69238 12.5962H24.3077M24.3077 12.5962L13.4524 1.74084M24.3077 12.5962L13.4524 23.4516"
                                    stroke="#222222" stroke-width="2.42308" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <div class="faq_answer" id="<?php echo $faq_id; ?>">
                        <p><?php echo wp_kses_post($faq_answer); ?></p>
                    </div>
                </div>
                <?php
                    endforeach;
                endif; ?>
            </div>
        </div>
    </section>

</main>

<!-- FAQ Accordion JavaScript -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/faq-accordion.js"></script>

<?php get_footer(); ?>