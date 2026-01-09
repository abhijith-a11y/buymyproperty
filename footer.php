<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yakult
 */
?>

<footer class="footer-section test_class">

    <div class="wrap">
        <!-- Main Footer Content - Single Parent Container -->
        <div class="footer-main">
            <!-- Left Section: Logo, Navigation, and Legal -->
            <div class="footer-left">
                <!-- Top Section: Brand and Navigation -->
                <div class="footer-top">
                    <!-- Logo and Social Links -->
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <?php if (get_field('footer_logo', 'option')): ?>
                                <a href="<?php echo home_url('/'); ?>"><img
                                        src="<?php echo get_field('footer_logo', 'option')['url']; ?>"
                                        alt="<?php bloginfo('name'); ?>" class="footer-brand-logo"></a>
                            <?php endif; ?>
                        </div>

                        <!-- Social Media Links -->
                        <?php if (have_rows('social_links', 'option')): ?>
                            <div class="footer-social">
                                <?php while (have_rows('social_links', 'option')):
                                    the_row();
                                    $url = get_sub_field('social_url');
                                    $icon_url = get_sub_field('icon'); // directly gets image URL
                                    ?>
                                    <a href="<?php echo esc_url($url); ?>" class="social-link " target="_blank" rel="noopener"
                                        aria-label="<?php echo esc_attr($url); ?>">
                                        <img src="<?php echo $icon_url['url']; ?>" alt="Social Icon" />
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Navigation Links -->
                    <div class="footer-nav">
                        <!-- Column 1 -->
                        <div class="footer-nav-column">
                            <nav>
                                <?php
                                wp_nav_menu(array(
                                    'menu' => 'Footer Menu one',
                                    'container' => 'ul',
                                    'menu_class' => 'footer-nav-list'
                                ));
                                ?>

                            </nav>
                        </div>

                        <!-- Column 2 -->
                        <div class="footer-nav-column">
                            <nav>
                                <?php
                                wp_nav_menu(array(
                                    'menu' => 'Footer Menu Two',
                                    'container' => 'ul',
                                    'menu_class' => 'footer-nav-list'
                                ));
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section: Copyright and Legal Links -->
                <div class="footer-bottom">
                    <div class="footer-copyright">
                        <p class="text-body-regular text-muted">
                            <?php echo str_replace('{year}', date('Y'), get_field('copyright_text', 'option')); ?>
                        </p>

                    </div>

                    <div class="footer-legal">
                        <nav>

                            <?php
                            wp_nav_menu(array(
                                'menu' => 'Privacy Menu',
                                'container' => 'ul',
                                'menu_class' => 'footer-legal-list'
                            ));
                            ?>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Right Section: CTA -->
            <div class="footer-right">
                <div class="footer-cta-content">
                    <h3 class="heading-medium-accent text-accent font-medium">
                        <?php echo get_field('sell_title', 'option'); ?>
                    </h3>
                    <?php if (get_field('sell_link', 'option')): ?>
                        <a href="<?php echo get_field('sell_link', 'option')['url']; ?>"
                            class="btn-primary footer-cta-btn"><?php echo get_field('sell_link', 'option')['title']; ?>
                            <svg width="9" height="9" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white"
                                    stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>

                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/footer_decor.png"
                    alt="<?php bloginfo('name'); ?>" class="footer-decor">
            </div>
        </div>
    </div>
</footer>

<script>
    //     class BuymyNavToggle {
    // 	constructor() {
    // 		this.buymyNav = document.querySelector(".buymy-nav");
    // 		this.showToggle = document.querySelector(".site-header .menu-toggle");
    // 		this.hideToggle = document.querySelector(".buymy-nav .menu-toggle");
    // 		this.body = document.body;
    // 		this.isOpen = false;

    // 		this.init();
    // 	}

    // 	init() {
    // 		if (!this.buymyNav || !this.showToggle || !this.hideToggle) {
    // 			console.warn("BuyMy navigation elements not found");
    // 			return;
    // 		}

    // 		this.bindEvents();
    // 		console.log("✅ BuyMy navigation toggle initialized");
    // 	}

    // 	bindEvents() {
    // 		// Show navigation when clicking the main header toggle
    // 		this.showToggle.addEventListener("click", (e) => {
    // 			e.preventDefault();
    // 			this.showNavigation();
    // 		});

    // 		// Hide navigation when clicking the toggle inside buymy-nav
    // 		this.hideToggle.addEventListener("click", (e) => {
    // 			e.preventDefault();
    // 			this.hideNavigation();
    // 		});

    // 		// Close navigation on escape key
    // 		document.addEventListener("keydown", (e) => {
    // 			if (e.key === "Escape" && this.isOpen) {
    // 				this.hideNavigation();
    // 			}
    // 		});

    // 		// Close navigation when clicking on main nav links
    // 		const navLinks = this.buymyNav.querySelectorAll(".main-nav a");
    // 		navLinks.forEach((link) => {
    // 			link.addEventListener("click", () => {
    // 				this.hideNavigation();
    // 			});
    // 		});
    // 	}

    // 	showNavigation() {
    // 		if (this.isOpen) return;

    // 		this.isOpen = true;
    // 		this.buymyNav.classList.add("active");
    // 		this.showToggle.setAttribute("aria-expanded", "true");
    // 		this.buymyNav.setAttribute("aria-hidden", "false");
    // 		this.body.style.overflow = "hidden"; // Prevent background scrolling

    // 		console.log("📱 BuyMy navigation opened");
    // 	}

    // 	hideNavigation() {
    // 		if (!this.isOpen) return;

    // 		this.isOpen = false;
    // 		this.buymyNav.classList.remove("active");
    // 		this.showToggle.setAttribute("aria-expanded", "false");
    // 		this.buymyNav.setAttribute("aria-hidden", "true");
    // 		this.body.style.overflow = ""; // Restore background scrolling

    // 		console.log("📱 BuyMy navigation closed");
    // 	}

    // 	toggleNavigation() {
    // 		if (this.isOpen) {
    // 			this.hideNavigation();
    // 		} else {
    // 			this.showNavigation();
    // 		}
    // 	}
    // }

    class BuymyNavToggle {
        constructor() {
            this.buymyNav = document.querySelector(".buymy-nav");
            // *** MODIFIED LINE: Select ALL menu-toggle elements that should OPEN the menu ***
            this.showToggles = document.querySelectorAll(".mobile-header .menu-toggle, .site-header .menu-toggle");
            // ****************************************************************************

            // This is still needed for the close button inside the nav itself
            this.hideToggle = document.querySelector(".buymy-nav .menu-toggle");

            this.body = document.body;
            this.isOpen = false;

            this.init();
        }

        init() {
            if (!this.buymyNav || this.showToggles.length === 0 || !this.hideToggle) {
                // Updated console warning check
                console.warn("BuyMy navigation elements not found or show toggles missing.");
                return;
            }

            this.bindEvents();
            console.log("✅ BuyMy navigation toggle initialized");
        }

        bindEvents() {
            // --- MODIFIED BINDING LOGIC ---
            // Loop through all elements that should SHOW the navigation
            this.showToggles.forEach(toggle => {
                toggle.addEventListener("click", (e) => {
                    e.preventDefault();
                    this.showNavigation();
                });
            });
            // ------------------------------

            // Hide navigation when clicking the toggle inside buymy-nav
            this.hideToggle.addEventListener("click", (e) => {
                e.preventDefault();
                this.hideNavigation();
            });

            // ... rest of bindEvents (Escape key, nav links, etc.) ...

            // Close navigation on escape key
            document.addEventListener("keydown", (e) => {
                if (e.key === "Escape" && this.isOpen) {
                    this.hideNavigation();
                }
            });

            // Close navigation when clicking on main nav links
            const navLinks = this.buymyNav.querySelectorAll(".main-nav a");
            navLinks.forEach((link) => {
                link.addEventListener("click", () => {
                    this.hideNavigation();
                });
            });
        }

        showNavigation() {
            if (this.isOpen) return;

            this.isOpen = true;
            this.buymyNav.classList.add("active");

            // Since we have multiple show toggles, we need to update all of them
            this.showToggles.forEach(toggle => {
                toggle.setAttribute("aria-expanded", "true");
                toggle.classList.add("toggled"); // Add class for visual change (e.g., hamburger to X)
            });

            this.buymyNav.setAttribute("aria-hidden", "false");
            this.body.style.overflow = "hidden"; // Prevent background scrolling

            console.log("📱 BuyMy navigation opened");
        }

        hideNavigation() {
            if (!this.isOpen) return;

            this.isOpen = false;
            this.buymyNav.classList.remove("active");

            // Since we have multiple show toggles, we need to update all of them
            this.showToggles.forEach(toggle => {
                toggle.setAttribute("aria-expanded", "false");
                toggle.classList.remove("toggled"); // Remove class to restore icon
            });

            this.buymyNav.setAttribute("aria-hidden", "true");
            this.body.style.overflow = ""; // Restore background scrolling

            console.log("📱 BuyMy navigation closed");
        }

        // toggleNavigation is no longer strictly needed but can remain
        toggleNavigation() {
            if (this.isOpen) {
                this.hideNavigation();
            } else {
                this.showNavigation();
            }
        }
    }

    class HeaderNavigation {
        constructor() {
            this.navToggle = document.querySelector(".nav-toggle");
            this.mobileNavOverlay = document.querySelector(".mobile-nav-overlay");
            this.body = document.body;
            this.isOpen = false;

            this.init();
        }

        init() {
            if (!this.navToggle || !this.mobileNavOverlay) {
                console.warn("Header navigation elements not found");
                return;
            }

            this.bindEvents();
            this.handleResize();
        }

        bindEvents() {
            // Navigation toggle click
            this.navToggle.addEventListener("click", (e) => {
                e.preventDefault();
                this.toggleMobileNav();
            });

            // Close navigation when clicking outside
            this.mobileNavOverlay.addEventListener("click", (e) => {
                if (e.target === this.mobileNavOverlay) {
                    this.closeMobileNav();
                }
            });

            // Close navigation on escape key
            document.addEventListener("keydown", (e) => {
                if (e.key === "Escape" && this.isOpen) {
                    this.closeMobileNav();
                }
            });

            // Handle window resize
            window.addEventListener("resize", () => {
                this.handleResize();
            });

            // Close mobile nav when clicking on menu links
            const mobileMenuLinks = this.mobileNavOverlay.querySelectorAll("a");
            mobileMenuLinks.forEach((link) => {
                link.addEventListener("click", () => {
                    this.closeMobileNav();
                });
            });
        }

        toggleMobileNav() {
            if (this.isOpen) {
                this.closeMobileNav();
            } else {
                this.openMobileNav();
            }
        }

        openMobileNav() {
            this.isOpen = true;
            this.mobileNavOverlay.classList.add("active");
            this.navToggle.setAttribute("aria-expanded", "true");
            this.mobileNavOverlay.setAttribute("aria-hidden", "false");
            this.body.style.overflow = "hidden"; // Prevent background scrolling

            console.log("📱 Mobile navigation opened");
        }

        closeMobileNav() {
            this.isOpen = false;
            this.mobileNavOverlay.classList.remove("active");
            this.navToggle.setAttribute("aria-expanded", "false");
            this.mobileNavOverlay.setAttribute("aria-hidden", "true");
            this.body.style.overflow = ""; // Restore scrolling

            console.log("📱 Mobile navigation closed");
        }

        handleResize() {
            // Close mobile nav if window is resized to desktop size
            if (window.innerWidth > 768 && this.isOpen) {
                this.closeMobileNav();
            }
        }
    }


    class HeaderScrollEffects {
        constructor() {
            this.header = document.querySelector('.site-header');
            this.lastScrollTop = 0;
            this.scrollThreshold = 10; // Use a small threshold to immediately apply 'scrolled' class

            // Add an initial check in the constructor to handle page loads that are not at the top
            this.toggleScrolldownClass(window.pageYOffset || document.documentElement.scrollTop);

            this.init();
        }

        init() {
            if (!this.header) {
                console.warn('Header element not found');
                return;
            }

            this.bindEvents();
        }

        bindEvents() {
            let ticking = false;

            window.addEventListener('scroll', () => {
                if (!ticking) {
                    requestAnimationFrame(() => {
                        this.handleScroll();
                        ticking = false;
                    });
                    ticking = true;
                }
            });
        }

        handleScroll() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // --- OLD LOGIC: Add/remove 'scrolled' class for styling (e.g., shrinking) ---
            if (scrollTop > this.scrollThreshold) {
                this.header.classList.add('scrolled');
            } else {
                this.header.classList.remove('scrolled');
            }

            // --- NEW LOGIC: Add/remove 'scrolldown' class based on TOP-OF-PAGE position ---
            this.toggleScrolldownClass(scrollTop);
            // ----------------------------------------------------------------------------

            this.lastScrollTop = scrollTop;
        }

        // NEW HELPER METHOD to implement the logic you wanted
        toggleScrolldownClass(scrollTop) {
            if (scrollTop === 0) {
                this.header.classList.remove('scrolldown');
                // Add 'at-top' class for non-home pages when at top
                if (this.header.classList.contains('not-home-page')) {
                    this.header.classList.add('at-top');
                }
            } else {
                this.header.classList.add('scrolldown');
                // Remove 'at-top' class when scrolled
                this.header.classList.remove('at-top');
            }
        }
    }
    document.addEventListener("DOMContentLoaded", () => {
        new BuymyNavToggle();
        new HeaderNavigation();
        new HeaderScrollEffects();
    });
</script>

<script>
    // Dynamic Community/Area Filter based on Emirate Selection
    document.addEventListener('DOMContentLoaded', function () {

        // Community data for each Emirate
        const communities = {
            'Dubai': [
                'Downtown Dubai',
                'Dubai Marina',
                'JBR (Jumeirah Beach Residence)',
                'Business Bay',
                'Palm Jumeirah',
                'Arabian Ranches',
                'Arabian Ranches 2',
                'Dubai Hills Estate',
                'Jumeirah Village Circle (JVC)',
                'Jumeirah Village Triangle (JVT)',
                'Dubai Sports City',
                'Motor City',
                'Discovery Gardens',
                'International City',
                'Deira',
                'Bur Dubai',
                'Al Barsha',
                'Jumeirah Lakes Towers (JLT)',
                'Dubai Silicon Oasis',
                'Mirdif',
                'Al Furjan',
                'Damac Hills',
                'Dubai Land',
                'Nad Al Sheba',
                'Al Quoz',
                'Jumeirah',
                'Umm Suqeim',
                'The Greens',
                'The Views',
                'Emirates Hills',
                'Meadows',
                'Springs',
                'Lakes',
                'Dubai Production City (IMPZ)',
                'Studio City',
                'Sports City',
                'Al Barari',
                'City Walk',
                'DIFC',
                'Bluewaters Island',
                'Dubai Creek Harbour',
                'Al Satwa'
            ],
            'Abu Dhabi': [
                'Al Reem Island',
                'Yas Island',
                'Saadiyat Island',
                'Al Reef',
                'Al Raha Beach',
                'Khalifa City',
                'Masdar City',
                'Al Ghadeer',
                'Al Shamkha',
                'Mohammed Bin Zayed City',
                'Mussafah',
                'Tourist Club Area',
                'Corniche Area',
                'Al Bateen',
                'Al Khalidiyah',
                'Al Wahda',
                'Al Markaziyah',
                'Al Nahyan',
                'Al Mushrif',
                'Hydra Village',
                'Marina Village',
                'Golf Gardens',
                'Al Bandar',
                'Water\'s Edge',
                'Mangrove Place'
            ],
            'Sharjah': [
                'Al Majaz',
                'Al Nahda',
                'Muwailih',
                'Al Khan',
                'Al Qasimia',
                'University City',
                'Al Taawun',
                'Abu Shagara',
                'Al Mamzar',
                'Rolla',
                'King Faisal Street',
                'Al Qulayaa',
                'Al Dhaid',
                'Al Ghubaiba',
                'Industrial Area',
                'Maysaloon',
                'Halwan Suburb',
                'Al Sharq',
                'Al Mujarrah',
                'Al Jazzat',
                'Samnan',
                'Tilal City',
                'Aljada'
            ],
            'Ajman': [
                'Al Nuaimiya',
                'Al Rashidiya',
                'Al Jurf',
                'Al Rawda',
                'Al Zahra',
                'Al Bustan',
                'Al Mowaihat',
                'Emirates City',
                'Ajman Corniche',
                'Ajman Downtown',
                'Al Yasmeen',
                'Ajman Uptown',
                'Garden City',
                'Al Helio',
                'Al Hamidiya',
                'Al Sawan',
                'Ajman Industrial Area'
            ]
        };

        // Get the form elements
        const emirateSelect = document.getElementById('emirate-select');
        const communityInput = document.getElementById('community-area');
        const communityList = document.getElementById('community-list');

        if (emirateSelect && communityInput && communityList) {

            // Function to update community options
            function updateCommunities(emirate) {
                // Clear existing options
                communityList.innerHTML = '';

                // Clear the input field
                communityInput.value = '';

                // Get communities for selected emirate
                const selectedCommunities = communities[emirate] || [];

                // Add new options
                selectedCommunities.forEach(function (community) {
                    const option = document.createElement('option');
                    option.value = community;
                    communityList.appendChild(option);
                });

                // Update placeholder
                if (emirate && emirate !== 'Select') {
                    communityInput.placeholder = 'Type or select community in ' + emirate;
                } else {
                    communityInput.placeholder = 'Select an Emirate first';
                    communityInput.disabled = true;
                }
            }

            // Disable community input initially if no emirate selected
            if (!emirateSelect.value || emirateSelect.value === 'Select') {
                communityInput.disabled = true;
                communityInput.placeholder = 'Select an Emirate first';
            }

            // Listen for emirate changes
            emirateSelect.addEventListener('change', function () {
                const selectedEmirate = this.value;

                if (selectedEmirate && selectedEmirate !== 'Select') {
                    communityInput.disabled = false;
                    updateCommunities(selectedEmirate);
                } else {
                    communityInput.disabled = true;
                    communityInput.value = '';
                    communityInput.placeholder = 'Select an Emirate first';
                    communityList.innerHTML = '';
                }
            });

            // Initialize on page load if emirate is already selected
            if (emirateSelect.value && emirateSelect.value !== 'Select') {
                updateCommunities(emirateSelect.value);
            }
        }
    });
</script>

<!-- Choices.js Initialization for ALL select elements -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Choices === 'undefined') {
            console.warn('Choices.js not loaded');
            return;
        }

        var choicesInstances = {};

        function initAllSelects() {
            // Get ALL select elements, excluding those that should not be initialized
            var selectElements = document.querySelectorAll('select:not([data-no-choices])');

            selectElements.forEach(function (select) {
                // Skip if already initialized
                if (select.closest('.choices')) {
                    return;
                }

                // Skip if disabled (Choices.js can handle disabled, but skip for now)
                if (select.hasAttribute('disabled') && select.getAttribute('disabled') !== 'false') {
                    return;
                }

                // Destroy existing instance if any
                var key = select.id || select.name || 'select_' + Array.from(selectElements).indexOf(select);
                if (choicesInstances[key]) {
                    try {
                        choicesInstances[key].destroy();
                        delete choicesInstances[key];
                    } catch (e) {
                        // Ignore errors
                    }
                }

                try {
                    // Get placeholder from disabled selected option, or use default
                    var placeholderOption = select.querySelector('option[selected][disabled]') || 
                                           select.querySelector('option[disabled]') ||
                                           select.querySelector('option[value=""]');
                    var placeholder = placeholderOption 
                        ? placeholderOption.text 
                        : 'Select an option';

                    var choices = new Choices(select, {
                        placeholder: true,
                        placeholderValue: placeholder,
                        searchEnabled: false,
                        itemSelectText: '',
                        shouldSort: false,
                        removeItemButton: false
                    });

                    // Store instance
                    choicesInstances[key] = choices;
                } catch (e) {
                    console.error('Choices.js init error:', e);
                }
            });
        }

        // Initialize immediately on DOM ready (no delay to prevent FOUC)
        // Native selects are already styled to match Choices.js appearance
        if (typeof Choices !== 'undefined') {
            initAllSelects();
        } else {
            // If Choices.js isn't loaded yet, retry after a short delay
            setTimeout(function () {
                if (typeof Choices !== 'undefined') {
                    initAllSelects();
                }
            }, 50);
        }

        // Also initialize on window load as fallback
        window.addEventListener('load', function () {
            initAllSelects();
        });

        // Handle resize - Choices.js handles this well
        var resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                // Check if any selects are broken
                var broken = false;
                document.querySelectorAll('select:not([data-no-choices])').forEach(function (select) {
                    if (!select.closest('.choices')) {
                        broken = true;
                    }
                });
                if (broken) {
                    initAllSelects();
                }
            }, 300);
        });

        // Watch for dynamically added selects
        if (typeof MutationObserver !== 'undefined') {
            var observer = new MutationObserver(function (mutations) {
                var needsInit = false;
                mutations.forEach(function (mutation) {
                    if (mutation.addedNodes.length) {
                        for (var i = 0; i < mutation.addedNodes.length; i++) {
                            var node = mutation.addedNodes[i];
                            if (node.nodeType === 1) {
                                // Check if node is a select or contains selects
                                if (node.tagName === 'SELECT' && !node.hasAttribute('data-no-choices')) {
                                    needsInit = true;
                                } else if (node.querySelectorAll && node.querySelectorAll('select:not([data-no-choices])').length > 0) {
                                    needsInit = true;
                                }
                            }
                        }
                    }
                });
                if (needsInit) {
                    setTimeout(function () {
                        initAllSelects();
                    }, 200);
                }
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }
    });
</script>

<?php wp_footer(); ?>
</body>

</html>