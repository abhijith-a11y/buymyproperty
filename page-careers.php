<?php
/**
 * Template Name: Careers
 * Description: Careers listing page with sorting options.
 */

get_header();
?>

<main id="primary" class="site-main mt_default">

	<?php get_template_part('template-parts/banner'); ?>

	<section class="careers_content wrap pt_100 pb_100">
		<div class="careers_header">
			<h2 class="careers_title">
				<?php echo esc_html(get_field('career_title') ?: get_the_title()); ?>
			</h2>

			<div class="careers_filter">
				<?php
				// Sorting options
				$sort_options = [
					''       => 'Newest First',
					'oldest' => 'Oldest First',
					'title'  => 'By Title',
				];

				$selected_sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : '';

				// Build dropdown
				?>
				<div class="custom-dropdown" data-dropdown="careers-sort">
					<div class="dropdown-trigger" tabindex="0">
						<span class="placeholder">
							<?php echo esc_html($sort_options[$selected_sort] ?? $sort_options['']); ?>
						</span>
						<svg class="dropdown-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
							stroke="#6c757d" stroke-width="2">
							<path d="M6 9l6 6 6-6" />
						</svg>
					</div>
					<div class="dropdown-menu">
						<?php foreach ($sort_options as $value => $label) : ?>
							<div class="dropdown-option" data-value="<?php echo esc_attr($value); ?>">
								<?php echo esc_html($label); ?>
							</div>
						<?php endforeach; ?>
					</div>
					<input type="hidden" name="sort" value="<?php echo esc_attr($selected_sort); ?>">
				</div>
			</div>
		</div>

		<div class="careers_grid">
			<?php
			// Determine sort order
			$args = [
				'post_type'      => 'career', // use your CPT slug or ACF repeater
				'posts_per_page' => -1,
			];

			switch ($selected_sort) {
				case 'oldest':
					$args['order'] = 'ASC';
					break;
				case 'title':
					$args['orderby'] = 'title';
					$args['order']   = 'ASC';
					break;
				default:
					$args['orderby'] = 'date';
					$args['order']   = 'DESC';
			}

			$jobs = new WP_Query($args);

			if ($jobs->have_posts()) :
				while ($jobs->have_posts()) : $jobs->the_post();
					$location = get_field('ca_location');
					$time_ago = human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
			?>
					<div class="career_card">
						<div class="card_header">
							<p class="time_posted"><?php echo esc_html($time_ago); ?></p>
						</div>
						<div class="card_content">
							<h3 class="job_title"><?php the_title(); ?></h3>
							<?php if ($location) : ?>
								<div class="job_location">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.6 4 5 5.6 3.6C7.3 1.9 9.6 1 12 1C14.4 1 16.7 1.9 18.4 3.6C20 5.3 21 7.6 21 10Z"
											stroke="#3F6745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13Z"
											stroke="#3F6745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
									<span><?php echo esc_html($location); ?></span>
								</div>
							<?php endif; ?>
								 <a class="btn-primary apply_btn open-career-modal" data-job="<?php echo esc_attr(get_the_title()); ?>">
                                    Apply
                                    <svg width="9" height="9" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white"
                                            stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>

						</div>
					</div>
			<?php
				endwhile;
				wp_reset_postdata();
			else :
				echo '<p>No job openings available at the moment.</p>';
			endif;
			?>
		</div>
	</section>
    <!-- Career Apply Modal -->

     <div class="career-apply-modal" id="careerApplyModal" aria-hidden="true" >
            <div class="modal-backdrop"></div>
            <div class="modal-dialog pt_80 pb_80">
                <button type="button" class="modal-close" aria-label="Close">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#6E6E6E" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="#6E6E6E" stroke-width="2" stroke-linecap="round" />
                        <path d="M6 6L18 18" stroke="#6E6E6E" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>

                <div class="modal-left">
                    <h3 class="apply-heading"><?php  echo get_field('ca_popup_title'); ?></h3>
                    <p class="apply-description">
                    <?php  echo get_field('ca_popup_description'); ?>
                    </p>
                </div>

                <div class="modal-right">
                    <div class="offer-form-container">
                        <div class="offer-form career-apply-form" id="careerApplyForm">
                            <?php echo do_shortcode('[contact-form-7 id="13866ab" title="Career Form"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</main>

<?php get_footer(); ?>
<script>
    document.querySelectorAll('.dropdown-option').forEach(option => {
	option.addEventListener('click', e => {
		const value = e.target.dataset.value;
		const url = new URL(window.location.href);
		url.searchParams.set('sort', value);
		window.location.href = url.toString();
	});
});



document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('careerApplyModal');
    const openBtns = document.querySelectorAll('.open-career-modal');
    const closeBtn = modal.querySelector('.modal-close');
    const backdrop = modal.querySelector('.modal-backdrop');
    const hiddenInput = document.getElementById('job-title'); // CF7 hidden field

    openBtns.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            const jobTitle = btn.dataset.job;
            if (hiddenInput) hiddenInput.value = jobTitle; // set the hidden field
            modal.classList.add('active'); // open modal
        });
    });

    const closeModal = () => modal.classList.remove('active');

    closeBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);
});

//File upload
document.addEventListener('DOMContentLoaded', function() {
    // Select the CF7 resume file input and label
    const resumeInput = document.querySelector('#resume-file');
    const resumeLabel = document.querySelector('.default_upload_file .file-label');
    const browseBtn = document.querySelector('.default_upload_file .browse-btn');

    if (!resumeInput || !resumeLabel) return;

    // Update label on file selection
    resumeInput.addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            if (files.length === 1) {
                resumeLabel.textContent = files[0].name;
            } else {
                resumeLabel.textContent = `${files.length} files selected`;
            }
        } else {
            resumeLabel.textContent = 'Attach Resume';
        }
    });

    // Optional: click on "Browse" opens file dialog
    if (browseBtn) {
        browseBtn.addEventListener('click', function() {
            resumeInput.click();
        });
    }

    // Clear resume field after successful CF7 submission
    document.addEventListener('wpcf7mailsent', function(event) {
        if (resumeInput) {
            resumeInput.value = ''; // Clear the file input
        }
        if (resumeLabel) {
            resumeLabel.textContent = 'Attach Resume'; // Reset label text
        }
    }, false);
});


    </script>