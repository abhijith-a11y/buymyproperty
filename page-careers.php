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
					'' => 'Newest First',
					'oldest' => 'Oldest First',
					'title' => 'By Title',
				];

				$selected_sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : '';

				// Build SumoSelect dropdown
				?>
				<select name="sort" id="careers-sort" class="careers-sort-select">
					<?php foreach ($sort_options as $value => $label): ?>
						<option value="<?php echo esc_attr($value); ?>" <?php selected($selected_sort, $value); ?>>
							<?php echo esc_html($label); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="careers_grid">
			<?php
			// Determine sort order
			$args = [
				'post_type' => 'career', // use your CPT slug or ACF repeater
				'posts_per_page' => -1,
			];

			switch ($selected_sort) {
				case 'oldest':
					$args['order'] = 'ASC';
					break;
				case 'title':
					$args['orderby'] = 'title';
					$args['order'] = 'ASC';
					break;
				default:
					$args['orderby'] = 'date';
					$args['order'] = 'DESC';
			}

			$jobs = new WP_Query($args);

			if ($jobs->have_posts()):
				while ($jobs->have_posts()):
					$jobs->the_post();
					$location = get_field('ca_location');
					$time_ago_raw = human_time_diff(get_the_time('U'), current_time('timestamp'));
					// Capitalize first letter of time unit (e.g., "8 months" -> "8 Months")
					$time_ago = preg_replace_callback(
						'/(\d+\s+)([a-z]+)/',
						function ($matches) {
							return $matches[1] . ucfirst($matches[2]);
						},
						$time_ago_raw
					) . ' ago';
					?>
					<div class="career_card">
						<div class="card_header">
							<p class="time_posted"><?php echo esc_html($time_ago); ?></p>
						</div>
						<div class="card_content">
							<h3 class="job_title"><?php the_title(); ?></h3>
							<?php if ($location): ?>
								<div class="job_location">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.6 4 5 5.6 3.6C7.3 1.9 9.6 1 12 1C14.4 1 16.7 1.9 18.4 3.6C20 5.3 21 7.6 21 10Z"
											stroke="#3F6745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<path
											d="M12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13Z"
											stroke="#3F6745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
									<span><?php echo esc_html($location); ?></span>
								</div>
							<?php endif; ?>
							<a class="btn-primary apply_btn open-career-modal"
								data-job="<?php echo esc_attr(get_the_title()); ?>">
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
			else:
				echo '<p>No job openings available at the moment.</p>';
			endif;
			?>
		</div>
	</section>
	<!-- Career Apply Modal -->

	<div class="career-apply-modal" id="careerApplyModal" aria-hidden="true">
		<div class="modal-backdrop"></div>
		<div class="modal-dialog pt_80">
			<button type="button" class="modal-close" aria-label="Close">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="#6E6E6E" xmlns="http://www.w3.org/2000/svg">
					<path d="M18 6L6 18" stroke="#6E6E6E" stroke-width="2" stroke-linecap="round" />
					<path d="M6 6L18 18" stroke="#6E6E6E" stroke-width="2" stroke-linecap="round" />
				</svg>
			</button>

			<div class="modal-left">
				<h3 class="apply-heading"><?php echo get_field('ca_popup_title'); ?></h3>
				<p class="apply-description">
					<?php echo get_field('ca_popup_description'); ?>
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



	document.addEventListener('DOMContentLoaded', function () {
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
				document.body.classList.add('career-modal-open'); // Add class to body
			});
		});

		const closeModal = () => {
			modal.classList.remove('active');
			document.body.classList.remove('career-modal-open'); // Remove class from body
		};

		closeBtn.addEventListener('click', closeModal);
		backdrop.addEventListener('click', closeModal);

		// Fix intl-tel-input dropdown z-index when modal is open
		// The intl-tel-input library appends its dropdown to body
		function fixIntlTelDropdown() {
			if (!modal.classList.contains('active')) return;

			// Try multiple possible class names for the dropdown
			const selectors = [
				'.iti-flag-dropdown',
				'.iti-country-list',
				'ul.iti__country-list',
				'div.iti__flag-dropdown',
				'[id*="iti"][id*="dropdown"]',
				'[id*="iti"][id*="country"]'
			];

			selectors.forEach(selector => {
				try {
					const elements = document.querySelectorAll(selector);
					elements.forEach(el => {
						// Force z-index with inline style (highest priority)
						el.style.setProperty('z-index', '100000', 'important');
						// Ensure it's positioned
						const computedStyle = window.getComputedStyle(el);
						if (computedStyle.position === 'static' || !computedStyle.position) {
							el.style.setProperty('position', 'absolute', 'important');
						}
					});
				} catch (e) {
					// Silently fail for invalid selectors
				}
			});

			// Also check all direct children of body that might be the dropdown
			try {
				Array.from(document.body.children).forEach(child => {
					if (child.classList && (
						child.classList.contains('iti-flag-dropdown') ||
						child.classList.contains('iti-country-list') ||
						(child.id && child.id.includes('iti'))
					)) {
						child.style.setProperty('z-index', '100000', 'important');
						const computedStyle = window.getComputedStyle(child);
						if (computedStyle.position === 'static' || !computedStyle.position) {
							child.style.setProperty('position', 'absolute', 'important');
						}
					}
				});
			} catch (e) {
				// Silently fail
			}
		}

		// Continuous check when modal is open
		let checkInterval = null;
		const startChecking = () => {
			if (checkInterval) clearInterval(checkInterval);
			checkInterval = setInterval(fixIntlTelDropdown, 50); // Check every 50ms
		};
		const stopChecking = () => {
			if (checkInterval) {
				clearInterval(checkInterval);
				checkInterval = null;
			}
		};

		// Watch for modal open/close
		const modalObserver = new MutationObserver(function (mutations) {
			mutations.forEach(function (mutation) {
				if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
					if (modal.classList.contains('active')) {
						startChecking();
					} else {
						stopChecking();
					}
				}
			});
		});
		modalObserver.observe(modal, { attributes: true, attributeFilter: ['class'] });

		// Watch for intl-tel-input dropdown being added to DOM
		const bodyObserver = new MutationObserver(function (mutations) {
			if (modal.classList.contains('active')) {
				fixIntlTelDropdown();
			}
		});
		bodyObserver.observe(document.body, {
			childList: true,
			subtree: true
		});

		// Watch for clicks on intl-tel-input flag
		document.addEventListener('click', function (e) {
			if (e.target.closest('.intl-tel-input .selected-flag') && modal.classList.contains('active')) {
				// Use multiple timeouts to catch the dropdown
				setTimeout(fixIntlTelDropdown, 10);
				setTimeout(fixIntlTelDropdown, 50);
				setTimeout(fixIntlTelDropdown, 100);
				setTimeout(fixIntlTelDropdown, 200);
			}
		}, true);

		// Also listen for focus events
		document.addEventListener('focusin', function (e) {
			if (e.target.closest('.intl-tel-input') && modal.classList.contains('active')) {
				setTimeout(fixIntlTelDropdown, 10);
				setTimeout(fixIntlTelDropdown, 50);
			}
		}, true);
	});

	//File upload
	function setupFileUpload() {
		// Select the CF7 resume file input - try multiple selectors
		let resumeInput = document.querySelector('#resume-file');
		if (!resumeInput) {
			// Try finding file input within the career form
			const careerForm = document.querySelector('#careerApplyForm');
			if (careerForm) {
				resumeInput = careerForm.querySelector('input[type="file"]');
			}
		}
		if (!resumeInput) {
			// Try finding any file input in default_upload_file
			resumeInput = document.querySelector('.default_upload_file input[type="file"]');
		}

		const resumeLabel = document.querySelector('.default_upload_file .file-label');
		const browseBtn = document.querySelector('.default_upload_file .browse-btn');
		const uploadArea = document.querySelector('.default_upload_file');

		if (!resumeInput) {
			console.log('Resume file input not found');
			return;
		}

		// Store a flag to prevent double-triggering
		let isOpeningFileDialog = false;

		// Update label on file selection
		resumeInput.addEventListener('change', function (e) {
			const files = e.target.files;
			isOpeningFileDialog = false;
			if (resumeLabel) {
				if (files.length > 0) {
					if (files.length === 1) {
						resumeLabel.textContent = files[0].name;
					} else {
						resumeLabel.textContent = `${files.length} files selected`;
					}
				} else {
					resumeLabel.textContent = 'Attach Resume';
				}
			}
		});

		// Prevent any default click behavior on the file input that might open files
		resumeInput.addEventListener('click', function(e) {
			// If this is triggered by our browse button, allow it
			if (!isOpeningFileDialog) {
				// This is a direct click on the input, prevent any default file opening
				e.stopPropagation();
			}
		}, true);

		// Click on "Browse" opens file dialog
		if (browseBtn) {
			browseBtn.addEventListener('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
				e.stopImmediatePropagation();
				
				// Set flag to indicate we're opening the dialog
				isOpeningFileDialog = true;
				
				// Use requestAnimationFrame to ensure it happens after all event handlers
				requestAnimationFrame(function() {
					setTimeout(function() {
						if (resumeInput && isOpeningFileDialog) {
							// Directly trigger the file input click
							resumeInput.focus();
							resumeInput.click();
						}
					}, 0);
				});
			});
		}

		// Also handle clicks on the upload area/label if it exists
		if (uploadArea && resumeLabel) {
			resumeLabel.addEventListener('click', function(e) {
				// If clicking on browse button, let it handle it
				if (e.target.closest('.browse-btn')) {
					return;
				}
				e.preventDefault();
				e.stopPropagation();
				
				isOpeningFileDialog = true;
				requestAnimationFrame(function() {
					setTimeout(function() {
						if (resumeInput && isOpeningFileDialog) {
							resumeInput.focus();
							resumeInput.click();
						}
					}, 0);
				});
			});
		}

		// Clear resume field after successful CF7 submission
		document.addEventListener('wpcf7mailsent', function (event) {
			isOpeningFileDialog = false;
			if (resumeInput) {
				resumeInput.value = ''; // Clear the file input
			}
			if (resumeLabel) {
				resumeLabel.textContent = 'Attach Resume'; // Reset label text
			}
		}, false);
	}

	// Run on DOMContentLoaded
	document.addEventListener('DOMContentLoaded', setupFileUpload);

	// Also run when modal opens (in case form is loaded dynamically)
	const modal = document.getElementById('careerApplyModal');
	if (modal) {
		const modalObserver = new MutationObserver(function (mutations) {
			if (modal.classList.contains('active')) {
				// Wait a bit for CF7 form to render
				setTimeout(setupFileUpload, 100);
			}
		});
		modalObserver.observe(modal, { attributes: true, attributeFilter: ['class'] });
	}

	// Initialize Choices.js for careers sort dropdown
	document.addEventListener('DOMContentLoaded', function () {
		var careersSort = document.getElementById('careers-sort');
		if (careersSort && typeof Choices !== 'undefined') {
			var choices = new Choices(careersSort, {
				placeholder: true,
				placeholderValue: 'Newest First',
				searchEnabled: false,
				itemSelectText: '',
				shouldSort: false
			});

			// Handle change event to redirect with sort parameter
			careersSort.addEventListener('change', function () {
				var sortValue = this.value;
				var url = new URL(window.location.href);

				if (sortValue) {
					url.searchParams.set('sort', sortValue);
				} else {
					url.searchParams.delete('sort');
				}

				window.location.href = url.toString();
			});
		}
	});

</script>