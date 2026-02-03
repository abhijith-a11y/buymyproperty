<?php
/**
 * Template Name: Book a Meeting
 * 
 * The template for displaying the Book a Meeting page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buy-my-property
 */

get_header();
?>

<main id="primary" class="site-main mt_default">

    <?php get_template_part('template-parts/banner'); ?>


    <!-- What Happens After You Submit Section -->
    <section class="after_submit pt_100 mb_120">
        <!-- Section Header -->
        <div class="section_header">
            <h2 class="section_title"><?php echo get_field('bm_title'); ?></h2>
            <p class="section_subtitle"><?php echo get_field('bm_short_description'); ?></p>
        </div>
        <div class="property-consultation-section pt_125 pb_125">
            <div class="wrap">
                <div class="left-content">
                    <h1 class="book_header"><?php echo get_field('bm_form_title'); ?></h1>
                    <p class="book_description"><?php echo get_field('bm_form_short_description'); ?></p>
                </div>

                <div class="form-container-book-meeting">
                    <div class="offer-form-container">
                        <div class="offer-form" id="propertyOfferForm">
                            <?php echo do_shortcode('[contact-form-7 id="fa35e3c" title="Book a Meeting"]'); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Steps Grid -->
    <?php if (have_rows('submission_process')): ?>
        <section class="process_steps_grid_section wrap">

            <!-- Section Header -->
            <div class="section_header">
                <?php if (get_field('whn_title')): ?>
                    <h2 class="section_title"><?php echo esc_html(get_field('whn_title')); ?></h2>
                <?php endif; ?>

                <?php if (get_field('whn_short_description')): ?>
                    <p class="section_subtitle"><?php echo esc_html(get_field('whn_short_description')); ?></p>
                <?php endif; ?>
            </div>

            <!-- Process Steps Grid -->
            <div class="process_steps_grid">
                <?php if (have_rows('submission_process')): ?>
                    <?php while (have_rows('submission_process')):
                        the_row();
                        $title = get_sub_field('su_title');
                        $icon = get_sub_field('su_icon'); // Image array
                        $desc = get_sub_field('su_short_description');
                        ?>
                        <div class="process_step_card">
                            <div class="step_icon">
                                <?php if ($icon): ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($title); ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="step_content">
                                <?php if ($title): ?>
                                    <h3 class="step_title"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>
                                <?php if ($desc): ?>
                                    <p class="step_description"><?php echo esc_html($desc); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>


</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to set minDate on datetime picker
    function restrictPreviousDates() {
        const datetimeInput = document.querySelector('.walcf7-datetimepicker');
        
        if (!datetimeInput) {
            return false;
        }
        
        // Check if Flatpickr is available and input is initialized
        if (typeof flatpickr !== 'undefined' && datetimeInput._flatpickr) {
            const today = new Date();
            // Set minDate to current date/time
            datetimeInput._flatpickr.set('minDate', today);
            
            // Also disable past dates in the calendar
            const calendar = datetimeInput._flatpickr.calendarContainer;
            if (calendar) {
                const pastDays = calendar.querySelectorAll('.flatpickr-day.flatpickr-disabled, .flatpickr-day.prev-month-day');
                pastDays.forEach(function(day) {
                    const dayDate = new Date(day.dateObj);
                    if (dayDate < today) {
                        day.classList.add('flatpickr-disabled');
                    }
                });
            }
            
            return true;
        }
        
        return false;
    }
    
    // Function to initialize or update date-time picker
    function initDateTimePicker() {
        const datetimeInput = document.querySelector('.walcf7-datetimepicker');
        
        if (!datetimeInput) {
            return;
        }
        
        // If already initialized, just update minDate
        if (datetimeInput._flatpickr) {
            restrictPreviousDates();
            return;
        }
        
        // Check if Flatpickr is available
        if (typeof flatpickr !== 'undefined') {
            // Get current config if any
            const currentConfig = datetimeInput._flatpickr ? datetimeInput._flatpickr.config : {};
            
            // Initialize or reinitialize with minDate
            const today = new Date();
            const config = {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: today, // Restrict previous dates
                time_24hr: true,
                minuteIncrement: 15,
                ...currentConfig // Preserve existing config
            };
            
            // If already initialized, update config
            if (datetimeInput._flatpickr) {
                datetimeInput._flatpickr.set('minDate', today);
            } else {
                // Initialize new instance
                flatpickr(datetimeInput, config);
            }
        } else {
            // If Flatpickr is not loaded yet, wait and try again
            setTimeout(initDateTimePicker, 100);
        }
    }
    
    // Initialize immediately
    initDateTimePicker();
    
    // Also try to restrict dates periodically in case picker is initialized later
    let initAttempts = 0;
    const maxAttempts = 50; // Try for 5 seconds (50 * 100ms)
    const initInterval = setInterval(function() {
        if (restrictPreviousDates() || initDateTimePicker()) {
            clearInterval(initInterval);
        } else {
            initAttempts++;
            if (initAttempts >= maxAttempts) {
                clearInterval(initInterval);
            }
        }
    }, 100);
    
    // Watch for form changes
    const formContainer = document.querySelector('#propertyOfferForm');
    if (formContainer) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length) {
                    setTimeout(function() {
                        initDateTimePicker();
                        restrictPreviousDates();
                    }, 100);
                }
            });
        });
        
        observer.observe(formContainer, {
            childList: true,
            subtree: true
        });
    }
    
    // Listen for CF7 form events
    document.addEventListener('wpcf7mailsent', function(event) {
        setTimeout(function() {
            initDateTimePicker();
            restrictPreviousDates();
        }, 100);
    });
    
    // Prevent manual entry of past dates
    const datetimeInput = document.querySelector('.walcf7-datetimepicker');
    if (datetimeInput) {
        datetimeInput.addEventListener('change', function() {
            if (this.value) {
                const selectedDate = new Date(this.value);
                const today = new Date();
                
                if (selectedDate < today) {
                    alert('Please select a future date and time.');
                    this.value = '';
                    
                    // If Flatpickr is initialized, clear it
                    if (this._flatpickr) {
                        this._flatpickr.clear();
                    }
                }
            }
        });
        
        // Also check on blur
        datetimeInput.addEventListener('blur', function() {
            if (this.value) {
                const selectedDate = new Date(this.value);
                const today = new Date();
                
                if (selectedDate < today) {
                    alert('Please select a future date and time.');
                    this.value = '';
                    
                    if (this._flatpickr) {
                        this._flatpickr.clear();
                    }
                }
            }
        });
    }
});
</script>

<?php
get_footer();
?>