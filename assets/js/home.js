/**
 * Yakult Theme - Main JavaScript File
 * Imports all JavaScript modules by path
 *
 * @package yakult
 * @version 1.0
 */

console.log("🚀 Yakult Main.js - Loading all modules by path...");

// =============================================================================
// DYNAMIC SCRIPT LOADER
// =============================================================================

function loadScript(src, callback) {
	const script = document.createElement("script");
	script.src = src;
	script.async = true;

	script.onload = function () {
		console.log("✅ Loaded:", src);
		if (callback) callback();
	};

	script.onerror = function () {
		console.error("❌ Failed to load:", src);
	};

	document.head.appendChild(script);
}

// =============================================================================
// IMPORT ALL JAVASCRIPT FILES
// =============================================================================

// Get the theme directory URL (WordPress way)
const themeUrl = window.yakultThemeUrl || "/wp-content/themes/yakult";

// List of JavaScript files to import
const jsFiles = [
	`${themeUrl}/assets/js/Header.js`,
	`${themeUrl}/assets/js/common.js`,
	// `${themeUrl}/assets/js/history-swiper.js`,
	// `${themeUrl}/assets/js/product-swiper.js`,
	`${themeUrl}/assets/js/video.js`,
	`${themeUrl}/assets/js/why-choose-us-animation.js`,
	`${themeUrl}/assets/js/how-it-works-animation.js`,
	// `${themeUrl}/assets/js/snazzy-map.js`,
	// `${themeUrl}/assets/js/news-marquee.js`
];

// Load all JavaScript files
console.log("📦 Loading JavaScript modules...");

let loadedCount = 0;
const totalFiles = jsFiles.length;

jsFiles.forEach((file) => {
	loadScript(file, function () {
		loadedCount++;
		console.log(`📊 Progress: ${loadedCount}/${totalFiles} files loaded`);

		if (loadedCount === totalFiles) {
			console.log("🎉 All JavaScript modules loaded successfully!");

			// Initialize any global functionality after all scripts are loaded
			if (typeof initializeAllModules === "function") {
				initializeAllModules();
			}
		}
	});
});

// =============================================================================
// GLOBAL INITIALIZATION (runs after all modules are loaded)
// =============================================================================

window.initializeAllModules = function () {
	console.log("🔧 Initializing all loaded modules...");

	console.log("✅ All modules initialized successfully!");
};

// Start marquee after bottle animation ends (5 seconds)
function startMarqueeAfterBottles() {
	setTimeout(function () {
		initializeMainMarquee();
	}, 5000); // 5 seconds delay to wait for bottle animation
}

console.log("📋 Main.js setup complete - modules will load asynchronously");

// Check if DOM is already loaded and initialize
if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", function () {
		setTimeout(function () {
			initializeNewsMarquee();
			initializeScrollAnimations(); // Initialize scroll-triggered animations
			initializeDynamicBackgrounds(); // Initialize dynamic background switching
		}, 1000); // Small delay to ensure other scripts are loaded
	});
} else {
	// DOM is already loaded
	setTimeout(function () {
		initializeNewsMarquee();
		initializeScrollAnimations(); // Initialize scroll-triggered animations
		initializeDynamicBackgrounds(); // Initialize dynamic background switching
	}, 1000);
}

document.addEventListener("DOMContentLoaded", function () {
	const accordions = document.querySelectorAll(".accordion_header");

	// Initialize all accordion content to be closed
	document.querySelectorAll(".accordion_content").forEach((content) => {
		content.style.maxHeight = "0px";
		content.style.overflow = "hidden";
	});

	accordions.forEach((header, index) => {
		header.addEventListener("click", function (e) {
			e.preventDefault();

			const content = this.nextElementSibling;
			const parentItem = this.closest(".accordion_item");
			const isActive = this.classList.contains("active");

			// Close all accordions
			document.querySelectorAll(".accordion_header").forEach((h) => {
				h.classList.remove("active");
				const item = h.closest(".accordion_item");
				if (item) item.classList.remove("active");

				const hContent = h.nextElementSibling;
				if (hContent && hContent.classList.contains("accordion_content")) {
					hContent.style.maxHeight = "0px";
					hContent.style.overflow = "hidden";
				}
			});

			// Toggle current accordion
			if (
				!isActive &&
				content &&
				content.classList.contains("accordion_content")
			) {
				this.classList.add("active");
				if (parentItem) parentItem.classList.add("active");

				const fullHeight = content.scrollHeight;
				content.style.maxHeight = fullHeight + "px";
			}
		});
	});
});

document.addEventListener("DOMContentLoaded", function () {
	const isRTL =
		document.documentElement.dir === "rtl" ||
		document.body.classList.contains("rtl");

	const swiper = new Swiper(".recipeSwiper", {
		slidesPerView: 1.5,
		spaceBetween: 20,
		// loop: true,
		navigation: {
			nextEl: ".recipe_btn.next_btn",
			prevEl: ".recipe_btn.prev_btn",
		},
		// Swiper detects RTL if dir="rtl" on <html>,
		// but this ensures it’s always correct:
		rtl: isRTL,

		breakpoints: {
			768: {
				slidesPerView: 2.2,
				spaceBetween: 30,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 50,
			},
		},
	});
});

// Product Swiper Initialization
console.log("🛍️ Product Swiper module loaded");

function initializeProductSwiper() {
	console.log("🔄 Attempting to initialize Product Swiper...");

	// Check if Swiper is available
	if (typeof Swiper === "undefined") {
		console.error(
			"❌ Swiper library not found. Product Swiper cannot initialize."
		);
		return false;
	}

	// Check if product swiper container exists
	const productContainer = document.querySelector(".product-swiper");
	if (!productContainer) {
		console.log("ℹ️ Product swiper container not found on this page");
		return false;
	}

	console.log("✅ Initializing Product Swiper...");

	try {
		// Check if RTL is active
		const isRTL = document.body.classList.contains("rtl");

		// Initialize Product Swiper with RTL support
		const productSwiper = new Swiper(".product-swiper", {
			slidesPerView: 1.3,
			rtl: isRTL, // Set RTL based on body class

			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
				reverseDirection: isRTL, // Reverse autoplay direction for RTL
			},

			breakpoints: {
				640: {
					slidesPerView: 2.2,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 3,
				},
			},

			// Add smooth transitions
			speed: 600,
			effect: "slide",

			// Accessibility with RTL support
			a11y: {
				prevSlideMessage: isRTL ? "الشريحة التالية" : "Previous slide",
				nextSlideMessage: isRTL ? "الشريحة السابقة" : "Next slide",
			},

			// Callbacks
			on: {
				init: function () {
					console.log("🛍️ Product Swiper initialized with RTL:", isRTL);
				},
				slideChange: function () {
					console.log("🔄 Product slide changed");
				},
			},
		});

		// Listen for language changes and reinitialize if needed
		const observer = new MutationObserver(function (mutations) {
			mutations.forEach(function (mutation) {
				if (
					mutation.type === "attributes" &&
					mutation.attributeName === "class"
				) {
					const newIsRTL = document.body.classList.contains("rtl");
					if (newIsRTL !== isRTL) {
						// Destroy and reinitialize swiper with new direction
						productSwiper.destroy(true, true);
						setTimeout(() => {
							location.reload(); // Simple reload to reinitialize with new direction
						}, 100);
					}
				}
			});
		});

		// Observe body class changes
		observer.observe(document.body, {
			attributes: true,
			attributeFilter: ["class"],
		});

		console.log(
			"✅ Product Swiper initialized successfully with RTL support:",
			isRTL
		);
		return productSwiper;
	} catch (error) {
		console.error("❌ Failed to initialize Product Swiper:", error);
		return false;
	}
}

// Try to initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
	console.log("📄 DOM loaded - checking for Product Swiper...");

	// Wait a bit for other scripts to load
	setTimeout(function () {
		if (typeof Swiper !== "undefined") {
			initializeProductSwiper();
		} else {
			console.warn(
				"⚠️ Swiper not ready yet for Product Swiper, will try again..."
			);
			// Try again after more time
			setTimeout(initializeProductSwiper, 1000);
		}
	}, 500);
});

// Make function available globally for main.js
window.initializeProductSwiper = initializeProductSwiper;

document.addEventListener("DOMContentLoaded", function () {
	const tabBtns = document.querySelectorAll(".tab_btn");
	const tabContents = document.querySelectorAll(".tab_content");

	tabBtns.forEach((btn) => {
		btn.addEventListener("click", function () {
			// Remove active classes
			tabBtns.forEach((b) => b.classList.remove("active"));
			tabContents.forEach((c) => c.classList.remove("active"));

			// Activate clicked tab + related content
			this.classList.add("active");
			const target = document.getElementById(this.dataset.tab);
			if (target) target.classList.add("active");
		});
	});
});

// =============================================================================
// PRODUCTS SLIDER FUNCTIONALITY
// =============================================================================

var swiper = new Swiper(".our-products-swiper", {
	slidesPerView: 1,
	spaceBetween: 3,
	pagination: {
		el: ".swiper-pagination",
		clickable: true,
	},
	breakpoints: {
		640: {
			slidesPerView: 2,
			spaceBetween: 20,
		},
		768: {
			slidesPerView: 2,
			spaceBetween: 40,
		},
		1024: {
			slidesPerView: 3,
			spaceBetween: 50,
		},
	},
});

// function initializeProductsSlider() {
//     const productsSwiper = document.querySelector('.our-products-swiper');

//     if (!productsSwiper) {
//         console.log('Products slider not found on this page');
//         return;
//     }

//     // Check if Swiper is available
//     if (typeof Swiper !== 'undefined') {
//         initProductsSwiper();
//     } else {
//         // Load Swiper if not already loaded
//         loadSwiperForProducts();
//     }
// }

function loadSwiperForProducts() {
	// Swiper CSS is already loaded via functions.php
	// Just check if Swiper JS is available
	if (typeof Swiper === "undefined") {
		console.log("❌ Swiper JS not found for products slider");
		return;
	} else {
		console.log("✅ Swiper JS found - initializing products slider");
		initProductsSwiper();
	}
}

function initProductsSwiper() {
	const productsSwiper = document.querySelector(".our-products-swiper");

	if (!productsSwiper) {
		return;
	}

	// Initialize Swiper for products
	const swiper = new Swiper(productsSwiper, {
		slidesPerView: 1,
		spaceBetween: 30,
		loop: true,
		centeredSlides: true,
		autoplay: {
			delay: 4000,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		breakpoints: {
			0: {
				slidesPerView: 1.3,
				spaceBetween: 30,
				centeredSlides: false,
			},
			600: {
				slidesPerView: 2,
				spaceBetween: 40,
				centeredSlides: false,
			},

			1200: {
				slidesPerView: 3,
				spaceBetween: 30,
				centeredSlides: false,
			},
		},
		effect: "slide",
		speed: 800,
		grabCursor: true,
		watchSlidesProgress: true,
		watchSlidesVisibility: true,
	});

	console.log("✅ Products slider initialized with Swiper");
}

var swiper = new Swiper(".experts-swiper", {
	effect: "cards",
	grabCursor: true,
	spaceBetween: 30,
	direction: "vertical", // or "horizontal"
	autoplay: {
		delay: 5000,
		disableOnInteraction: false,
		pauseOnMouseEnter: true,
	},
	//   pagination: {
	//     el: '.experts-swiper .swiper-pagination',
	//     clickable: true,
	//     dynamicBullets: true,
	// },

	pagination: {
		el: ".swiper-pagination",
		clickable: true,
	},
});

// =============================================================================
// RECENTLY CLOSED DEALS SLIDER FUNCTIONALITY
// =============================================================================

function initializeRecentlyClosedDealsSlider() {
	const dealsSwiper = document.querySelector(".recently-closed-deals-swiper");

	if (!dealsSwiper) {
		console.log("Recently closed deals slider not found on this page");
		return;
	}

	// Check if Swiper is available
	if (typeof Swiper !== "undefined") {
		initRecentlyClosedDealsSwiper();
	} else {
		console.log("❌ Swiper not available for recently closed deals slider");
	}
}

function initRecentlyClosedDealsSwiper() {
	const dealsSwiper = document.querySelector(".recently-closed-deals-swiper");

	if (!dealsSwiper) {
		return;
	}

	// Get the swiper wrapper and slides
	const swiperWrapper = dealsSwiper.querySelector(".swiper-wrapper");
	const slides = swiperWrapper.querySelectorAll(".swiper-slide");
	const slideCount = slides.length;

	// Duplicate slides if there are less than 4 slides
	if (slideCount > 0 && slideCount <= 4) {
		// Convert NodeList to Array for easier manipulation
		const slidesArray = Array.from(slides);

		// Calculate how many more slides we need to reach at least 4
		const slidesNeeded = 5 - slideCount;

		// Clone and append slides until we have at least 4
		for (let i = 0; i < slidesNeeded; i++) {
			// Clone the slide at index (i % slideCount) to cycle through original slides
			const slideToClone = slidesArray[i % slideCount];
			const clonedSlide = slideToClone.cloneNode(true);
			swiperWrapper.appendChild(clonedSlide);
		}
	}

	// Initialize Swiper for recently closed deals
	const swiper = new Swiper(dealsSwiper, {
		slidesPerView: 3.9,
		spaceBetween: 10,
		loop: true,
		centeredSlides: false,
		observer: true,
		observeParents: true,
		autoplay: {
			delay: 1500,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
		},
		navigation: {
			nextEl: ".deals-next",
			prevEl: ".deals-prev",
		},
		breakpoints: {
			0: {
				slidesPerView: 1.3,
			},
			768: {
				slidesPerView: 2,
			},
			992: {
				slidesPerView: 3,
			},
			1200: {
				slidesPerView: 3.9,
				spaceBetween: 10,
			},
		},
		effect: "slide",
		speed: 1000,
		grabCursor: true,
		watchSlidesProgress: true,
		watchSlidesVisibility: true,
		allowSlidePrev: true,
		allowSlideNext: true,
		on: {
			init: function () {
				this.update();
			},
			loopFix: function () {
				this.update();
			},
		},
	});

	// Force update after a short delay to ensure proper sizing
	setTimeout(() => {
		if (swiper) {
			swiper.update();
		}
	}, 100);
}

// =============================================================================
// TESTIMONIALS SLIDER FUNCTIONALITY
// =============================================================================

function initializeTestimonialsSlider() {
	const testimonialsSwiper = document.querySelector(".testimonials-swiper");

	if (!testimonialsSwiper) {
		console.log("Testimonials slider not found on this page");
		return;
	}

	// Check if Swiper is available
	if (typeof Swiper !== "undefined") {
		initTestimonialsSwiper();
	} else {
		console.log("❌ Swiper not available for testimonials slider");
	}
}

function initTestimonialsSwiper() {
	const testimonialsSwiper = document.querySelector(".testimonials-swiper");

	if (!testimonialsSwiper) {
		return;
	}

	// Initialize Swiper for testimonials
	const swiper = new Swiper(testimonialsSwiper, {
		slidesPerView: 3.5,
		centeredSlides: false,
		spaceBetween: 16,
		loop: false, // Disable Swiper's loop, we'll handle duplication manually
		navigation: {
			nextEl: ".testimonials-next",
			prevEl: ".testimonials-prev",
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 10,
			},
			768: {
				slidesPerView: 2.5,
				spaceBetween: 10,
			},
			992: {
				slidesPerView: 3,
				spaceBetween: 10,
			},
			1200: {
				slidesPerView: 3.5,
				spaceBetween: 16,
			},
		},
		effect: "slide",
		grabCursor: true,
		watchSlidesProgress: true,
		watchSlidesVisibility: true,
		allowTouchMove: false,
		on: {
			init: function () {
				// Override Swiper's setTranslate to allow CSS animation
				const wrapper = this.wrapperEl;
				const swiper = this;

				// Get all original slides
				const originalSlides = Array.from(this.slides);

				// Wait for layout to calculate proper widths
				setTimeout(() => {
					// Calculate the width of one complete set of original slides
					let originalSetWidth = 0;
					originalSlides.forEach((slide) => {
						const slideWidth = slide.offsetWidth;
						const spaceBetween = swiper.params.spaceBetween || 0;
						originalSetWidth += slideWidth + spaceBetween;
					});

					// Duplicate slides multiple times for seamless infinite loop
					// Create 3-4 complete sets total for smooth continuous scrolling
					const totalSets = 4; // original + 3 duplicates = 4 sets

					// Clone and append original slides multiple times
					for (let i = 0; i < totalSets - 1; i++) {
						originalSlides.forEach((slide) => {
							const clone = slide.cloneNode(true);
							clone.classList.add("swiper-slide-duplicate-custom");
							wrapper.appendChild(clone);
						});
					}

					// Override setTranslate to prevent Swiper from managing transforms
					swiper.setTranslate = function (translate) {
						// Don't apply Swiper's transform, let CSS animation handle it
						return;
					};

					// Set CSS custom property with exact width of one set
					// This ensures seamless loop - animation now starts at negative position
					// and moves to 0, creating reverse direction
					wrapper.style.setProperty(
						"--slide-set-width",
						`-${originalSetWidth}px`
					);

					// Mark wrapper as initialized and enable CSS animation
					wrapper.classList.add("swiper-wrapper-initialized");

					// Set initial position to match reversed animation start (negative position)
					wrapper.style.transform = `translateX(${-originalSetWidth}px)`;
				}, 100);
			},
		},
	});

	console.log("✅ Testimonials slider initialized with Swiper");
}

// =============================================================================
// WHY SELL TO US SLIDER FUNCTIONALITY
// =============================================================================

function initializeWhySellSlider() {
	const whySellSwiper = document.querySelector(".why-sell-swiper");

	if (!whySellSwiper) {
		console.log("Why Sell to Us slider not found on this page");
		return;
	}

	// Check if Swiper is available
	if (typeof Swiper !== "undefined") {
		initWhySellSwiper();
	} else {
		console.log("❌ Swiper not available for Why Sell to Us slider");
	}
}

function initWhySellSwiper() {
	const whySellSwiper = document.querySelector(".why-sell-swiper");
	const indicatorLine = document.querySelector(".indicator-line");
	const paginationNumbers = document.querySelectorAll(".pagination-number");

	if (!whySellSwiper) {
		return;
	}

	// Initialize Swiper for Why Sell to Us with vertical direction
	const swiper = new Swiper(whySellSwiper, {
		direction: "vertical",
		slidesPerView: 1,
		spaceBetween: 0,
		loop: true,
		speed: 1000,
		// autoplay: {
		//     delay: 6000,
		//     disableOnInteraction: false,
		//     pauseOnMouseEnter: true
		// },
		effect: "slide",
		grabCursor: true,
		watchSlidesProgress: true,
		watchSlidesVisibility: true,

		// Custom slide transition
		on: {
			slideChange: function () {
				const activeIndex = this.realIndex;
				updateIndicatorPosition(activeIndex);
				updatePaginationNumbers(activeIndex);
			},

			slideChangeTransitionStart: function () {
				// Add custom transition effects
				const slides = this.slides;
				slides.forEach((slide, index) => {
					if (index === this.activeIndex) {
						slide.style.opacity = "1";
						slide.style.transform = "translateY(0)";
					} else {
						slide.style.opacity = "0";
						slide.style.transform = "translateY(50px)";
					}
				});
			},
		},
	});

	// Function to update indicator line position
	function updateIndicatorPosition(activeIndex) {
		if (indicatorLine) {
			const screenWidth = window.innerWidth;
			const totalSlides = 4; // We have 4 slides

			// Calculate transform based on screen size and slide position
			if (screenWidth <= 768) {
				// Mobile: height 500px, each slide = 125px
				// For 4 slides: positions are 0%, 25%, 50%, 75%
				const translateY = activeIndex * 100; // 25% per slide
				indicatorLine.style.transform = `translateY(${translateY}%)`;
			} else if (screenWidth <= 992) {
				// Tablet: height 300px, each slide = 75px
				// For 4 slides: positions are 0%, 25%, 50%, 75%
				const translateY = activeIndex * 100; // 25% per slide
				indicatorLine.style.transform = `translateY(${translateY}%)`;
			} else {
				// Desktop: height 348px, each slide = 87px (25% of 348px)
				// For 4 slides: positions are 0%, 25%, 50%, 75%
				const translateY = activeIndex * 100; // 25% per slide
				indicatorLine.style.transform = `translateY(${translateY}%)`;
			}

			console.log(
				`🎯 Indicator updated: slide ${activeIndex + 1}/4, translateY: ${
					activeIndex * 25
				}%`
			);
		}
	}

	// Function to update pagination numbers - show only active page
	function updatePaginationNumbers(activeIndex) {
		paginationNumbers.forEach((number, index) => {
			if (index === activeIndex) {
				number.classList.add("active");
				number.style.display = "block";
			} else {
				number.classList.remove("active");
				number.style.display = "none";
			}
		});
	}

	const whySellContent = document.querySelector(".why-sell-content");
	if (whySellContent) {
		whySellContent.addEventListener("click", () => {
			swiper.slideNext(); // automatically handles looping
		});
	}

	// Handle window resize for indicator position
	window.addEventListener("resize", () => {
		updateIndicatorPosition(swiper.realIndex);
	});

	// Initialize first slide
	updateIndicatorPosition(0);
	updatePaginationNumbers(0);

	console.log("✅ Why Sell to Us slider initialized with vertical transitions");
}

// =============================================================================
// THREE STEP PROCESS SLIDER FUNCTIONALITY
// =============================================================================

function initializeThreeStepSlider() {
	const threeStepSwiper = document.querySelector(".three-step-swiper");

	if (!threeStepSwiper) {
		console.log("Three Step Process slider not found on this page");
		return;
	}

	// Check if Swiper is available
	if (typeof Swiper !== "undefined") {
		initThreeStepSwiper();
	} else {
		console.log("❌ Swiper not available for Three Step Process slider");
	}
}

function initThreeStepSwiper() {
	const threeStepSwiper = document.querySelector(".three-step-swiper");

	if (!threeStepSwiper) {
		return;
	}

	// Initialize Swiper for Three Step Process
	const swiper = new Swiper(threeStepSwiper, {
		slidesPerView: 3,
		spaceBetween: 30,
		loop: true,
		speed: 800,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
		},
		navigation: {
			nextEl: ".three-step-navigation .swiper-button-next",
			prevEl: ".three-step-navigation .swiper-button-prev",
		},
		grabCursor: true,
		watchSlidesProgress: true,
		watchSlidesVisibility: true,

		// Responsive breakpoints
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 100,
				centeredSlides: true,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 50,
				centeredSlides: false,
			},
			1200: {
				slidesPerView: 3,
				spaceBetween: 30,
				centeredSlides: false,
			},
		},

		// Custom slide transition effects
		on: {
			slideChange: function () {
				// Reset any hover states when slide changes
				resetCardHoverStates();
			},

			init: function () {
				// Trigger entrance animations after Swiper initialization
				triggerCardEntranceAnimations();
			},
		},
	});

	// Function to reset card hover states
	function resetCardHoverStates() {
		const cardContainers = document.querySelectorAll(".step-card-container");
		cardContainers.forEach((container) => {
			container.classList.remove("hover-active");
		});
	}

	// Function to trigger entrance animations
	function triggerCardEntranceAnimations() {
		const cardContainers = document.querySelectorAll(".step-card-container");
		cardContainers.forEach((container, index) => {
			setTimeout(() => {
				container.style.animationDelay = `${index * 0.1}s`;
				container.style.animationPlayState = "running";
			}, 100);
		});
	}

	// Enhanced hover effects for better interaction
	const cardContainers = document.querySelectorAll(".step-card-container");
	cardContainers.forEach((container) => {
		// Mouse events for desktop
		container.addEventListener("mouseenter", function () {
			this.classList.add("hover-active");
		});

		container.addEventListener("mouseleave", function () {
			this.classList.remove("hover-active");
		});

		// Touch events for mobile devices
		container.addEventListener("touchstart", function (e) {
			// Remove hover state from all other cards
			cardContainers.forEach((otherContainer) => {
				if (otherContainer !== this) {
					otherContainer.classList.remove("hover-active");
				}
			});

			// Toggle hover state on current card
			this.classList.toggle("hover-active");
		});

		// Prevent default touch behavior to avoid conflicts
		container.addEventListener("touchend", function (e) {
			e.preventDefault();
		});
	});

	// Close hover states when touching outside
	document.addEventListener("touchstart", function (e) {
		if (!e.target.closest(".step-card-container")) {
			cardContainers.forEach((container) => {
				container.classList.remove("hover-active");
			});
		}
	});

	console.log(
		"✅ Three Step Process slider initialized with responsive breakpoints"
	);
}

// =============================================================================
// HOW IT WORKS (MOBILE) SLIDER
// =============================================================================
let howItWorksMobileSwiper = null;

function initializeHowItWorksMobileSwiper() {
	const swiperContainer = document.querySelector(".how-it-works-swiper");

	if (!swiperContainer) {
		return;
	}

	const shouldEnable = window.matchMedia("(max-width: 767px)").matches;

	if (shouldEnable) {
		if (howItWorksMobileSwiper) {
			return;
		}

		if (typeof Swiper === "undefined") {
			console.log("❌ Swiper not available for How It Works mobile slider");
			return;
		}

		howItWorksMobileSwiper = new Swiper(swiperContainer, {
			slidesPerView: 1,
			spaceBetween: 18,
			autoHeight: true,
			// No navigation or pagination on mobile - swipe only
			navigation: false,
			pagination: false,
		});

		return;
	}

	if (howItWorksMobileSwiper) {
		howItWorksMobileSwiper.destroy(true, true);
		howItWorksMobileSwiper = null;
		resetHowItWorksMobileStyles(swiperContainer);
	}
}

function resetHowItWorksMobileStyles(container) {
	const wrapper = container.querySelector(".swiper-wrapper");

	if (wrapper) {
		wrapper.removeAttribute("style");
	}

	container.querySelectorAll(".swiper-slide").forEach((slide) => {
		slide.removeAttribute("style");
	});
}

// =============================================================================
// MARQUEE SLIDER FUNCTIONALITY
// =============================================================================

function initializeMarqueeSlider() {
	const marqueeSwiper = document.querySelector(".marquee-swiper");

	if (!marqueeSwiper) {
		console.log("Marquee slider not found on this page");
		return;
	}

	// Check if Swiper is available
	if (typeof Swiper !== "undefined") {
		initMarqueeSwiper();
	} else {
		console.log("❌ Swiper not available for Marquee slider");
	}
}

function initMarqueeSwiper() {
	const marqueeSwiper = document.querySelector(".marquee-swiper");

	if (!marqueeSwiper) {
		return;
	}

	// Initialize Swiper for Marquee with continuous scrolling
	const swiper = new Swiper(marqueeSwiper, {
		slidesPerView: "auto",
		spaceBetween: 0,
		loop: true,
		speed: 1000,
		autoplay: {
			delay: 0,
			disableOnInteraction: false,
			pauseOnMouseEnter: false,
			reverseDirection: false,
		},
		freeMode: {
			enabled: true,
			momentum: false,
		},
		grabCursor: false,
		allowTouchMove: false,
		simulateTouch: false,
		resistance: false,
		watchSlidesProgress: false,
		watchSlidesVisibility: false,

		// Responsive speed adjustments
		breakpoints: {
			0: {
				speed: 9000,
			},
			768: {
				speed: 10000,
			},
			1200: {
				speed: 20000,
			},
		},

		// Ensure smooth continuous movement
		on: {
			init: function () {
				// Set initial state for smooth marquee
				this.setTranslate(0);
				// Add CSS class for additional styling
				marqueeSwiper.classList.add("marquee-initialized");
				// Ensure autoplay starts
				if (this.autoplay && this.autoplay.running === false) {
					this.autoplay.start();
				}
			},

			slideChange: function () {
				// Maintain continuous movement
				if (this.realIndex === 0) {
					this.setTranslate(0);
				}
			},

			transitionStart: function () {
				// Ensure smooth transitions
				this.wrapperEl.style.transitionTimingFunction = "linear";
			},
		},
	});

	// Ensure autoplay is running
	if (swiper.autoplay) {
		swiper.autoplay.start();
	}

	// Pause marquee on hover (optional)
	marqueeSwiper.addEventListener("mouseenter", function () {
		if (swiper.autoplay) {
			swiper.autoplay.stop();
		}
	});

	marqueeSwiper.addEventListener("mouseleave", function () {
		if (swiper.autoplay) {
			swiper.autoplay.start();
		}
	});

	// Handle visibility change to pause/resume when tab is not active
	document.addEventListener("visibilitychange", function () {
		if (document.hidden) {
			if (swiper.autoplay) {
				swiper.autoplay.stop();
			}
		} else {
			if (swiper.autoplay) {
				swiper.autoplay.start();
			}
		}
	});

	console.log("✅ Marquee slider initialized with continuous scrolling");
}

// =============================================================================
// HERO SECTION FUNCTIONALITY
// =============================================================================

function initializeHeroSection() {
	const heroForm = document.getElementById("heroContactForm");
	const fileInput = document.getElementById("property_images");
	const fileLabel = document.querySelector(".file-upload-label span");

	if (!heroForm) {
		console.log("Hero form not found on this page");
		return;
	}

	// Handle file upload display
	if (fileInput && fileLabel) {
		fileInput.addEventListener("change", function (e) {
			const files = e.target.files;
			if (files.length > 0) {
				if (files.length === 1) {
					fileLabel.textContent = `${files[0].name}`;
				} else {
					fileLabel.textContent = `${files.length} files selected`;
				}
			} else {
				fileLabel.textContent = "Upload Images";
			}
		});
	}

	// Handle form submission
	heroForm.addEventListener("submit", function (e) {
		e.preventDefault();

		// Get form data
		const formData = new FormData(heroForm);
		const location = formData.get("location");
		const area = formData.get("area");
		const priceRange = formData.get("price_range");
		const propertyType = formData.get("property_type");
		const images = formData.getAll("property_images");

		// Basic validation
		if (!location || !area || !priceRange || !propertyType) {
			alert("Please fill in all required fields.");
			return;
		}

		// Show loading state
		const submitBtn = heroForm.querySelector(".hero-submit-btn");
		const originalText = submitBtn.innerHTML;
		submitBtn.innerHTML = "Processing...";
		submitBtn.disabled = true;

		// Simulate form submission (replace with actual API call)
		setTimeout(() => {
			alert("Thank you! We will contact you shortly with your cash offer.");

			// Reset form
			heroForm.reset();
			if (fileLabel) {
				fileLabel.textContent = "Upload Images";
			}

			// Reset button
			submitBtn.innerHTML = originalText;
			submitBtn.disabled = false;
		}, 2000);

		console.log("Hero form submitted:", {
			location,
			area,
			priceRange,
			propertyType,
			imageCount: images.length,
		});
	});

	// Handle video loading and fallback
	const heroVideo = document.querySelector(".hero-video");
	if (heroVideo) {
		heroVideo.addEventListener("loadeddata", function () {
			console.log("✅ Hero video loaded successfully");
		});

		heroVideo.addEventListener("error", function () {
			console.log("❌ Hero video failed to load, showing fallback image");
			// The fallback image will be shown automatically
		});
	}

	console.log("✅ Hero section initialized");
}

// =============================================================================
// PROPERTY TYPES SLIDER FUNCTIONALITY
// =============================================================================

function initializePropertyTypesSlider() {
	const propertyTypesSwiper = document.querySelector(".property-types-swiper");

	if (!propertyTypesSwiper) {
		console.log("Property types slider not found on this page");
		return;
	}

	// Check if Swiper is available
	if (typeof Swiper !== "undefined") {
		initPropertyTypesSwiper();
	} else {
		console.log("❌ Swiper not available for property types slider");
	}
}

function initPropertyTypesSwiper() {
	const propertyTypesSwiper = document.querySelector(".property-types-swiper");

	if (!propertyTypesSwiper) {
		return;
	}

	// Function to duplicate slides when data is loaded
	function duplicateSlidesWhenReady() {
		const wrapper = propertyTypesSwiper.querySelector(".swiper-wrapper");
		if (!wrapper) {
			return;
		}

		// Get original slides (only once, when data is loaded)
		const originalSlides = Array.from(
			wrapper.querySelectorAll(".swiper-slide")
		);
		const originalCount = originalSlides.length;

		// Duplicate slides if there are less than 4 slides (only do this once on load)
		if (originalCount < 4 && originalCount > 0) {
			const needed = 6 - originalCount;

			// Duplicate slides to reach at least 4
			for (let i = 0; i < needed; i++) {
				const slideToClone = originalSlides[i % originalCount];
				const clone = slideToClone.cloneNode(true);
				// Remove any AOS attributes from cloned slides
				clone.removeAttribute("data-aos");
				const clonedElements = clone.querySelectorAll("[data-aos]");
				clonedElements.forEach((el) => {
					el.removeAttribute("data-aos");
					el.style.opacity = "1";
					el.style.visibility = "visible";
					el.style.transform = "none";
				});
				wrapper.appendChild(clone);
			}
		}

		return wrapper.querySelectorAll(".swiper-slide").length;
	}

	// Disable AOS on slider elements to prevent interference
	const sliderElements = propertyTypesSwiper.querySelectorAll("[data-aos]");
	sliderElements.forEach((el) => {
		el.removeAttribute("data-aos");
		el.style.opacity = "1";
		el.style.visibility = "visible";
		el.style.transform = "none";
	});

	// Wait for images to load, then duplicate slides and initialize Swiper
	const images = propertyTypesSwiper.querySelectorAll("img");
	let imagesLoaded = 0;
	const totalImages = images.length;

	if (totalImages === 0) {
		// No images, duplicate immediately
		const finalSlideCount = duplicateSlidesWhenReady();
		initializeSwiper(finalSlideCount);
	} else {
		// Wait for all images to load before duplicating
		images.forEach((img) => {
			if (img.complete) {
				imagesLoaded++;
				checkAndInit();
			} else {
				img.addEventListener("load", () => {
					imagesLoaded++;
					checkAndInit();
				});
				img.addEventListener("error", () => {
					imagesLoaded++;
					checkAndInit();
				});
			}
		});
	}

	function checkAndInit() {
		if (imagesLoaded === totalImages) {
			// All images loaded, now duplicate slides and initialize
			const finalSlideCount = duplicateSlidesWhenReady();
			initializeSwiper(finalSlideCount);
		}
	}

	function initializeSwiper(finalSlideCount) {
		// Swiper loop mode needs more slides than slidesPerView to work properly
		// Enable loop only if we have more than 3 slides (since slidesPerView is 3)
		const shouldUseLoop = finalSlideCount > 3;

		// Initialize Swiper for property types
		const swiper = new Swiper(propertyTypesSwiper, {
			slidesPerView: 3,
			spaceBetween: 20,
			loop: shouldUseLoop,
			centeredSlides: true,
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
				pauseOnMouseEnter: true,
			},
			navigation: {
				nextEl: ".property-types-next",
				prevEl: ".property-types-prev",
			},
			speed: 800,
			grabCursor: true,
			watchSlidesProgress: true,
			watchSlidesVisibility: true,
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 20,
					centeredSlides: true,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 25,
					centeredSlides: true,
				},
				1024: {
					slidesPerView: 3,
					spaceBetween: 30,
					centeredSlides: true,
				},
			},
			on: {
				init: function () {
					// Ensure all slides are visible after initialization
					this.slides.forEach((slide) => {
						slide.style.opacity = "1";
						slide.style.visibility = "visible";
					});
					// Force update to ensure proper rendering
					this.update();
					// Refresh AOS to prevent interference
					if (typeof AOS !== "undefined") {
						AOS.refresh();
					}
				},
			},
		});

		console.log("✅ Property types slider initialized with Swiper");
	}
}

// =============================================================================
// BUILT ON TRUST SCROLL ANIMATION FUNCTIONALITY
// =============================================================================

function initializeBuiltOnTrustAnimation() {
	const trustSection = document.querySelector("#built-on-trust-section");

	if (!trustSection) {
		console.log("Built on Trust section not found on this page");
		return;
	}

	// Check if GSAP and ScrollTrigger are available
	if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
		console.log(
			"❌ GSAP or ScrollTrigger not available for Built on Trust animation"
		);
		return;
	}

	console.log("✅ Initializing Built on Trust ScrollTrigger animation...");

	// Register ScrollTrigger plugin
	gsap.registerPlugin(ScrollTrigger);

	// Get animation elements
	const rightContent = trustSection.querySelector(".trust_right_content");

	if (!rightContent) {
		console.log("❌ Required animation elements not found");
		return;
	}

	// Set initial state for right content (always visible but positioned below)
	gsap.set(rightContent, {
		opacity: 1, // Always visible
		y: "120%", // Start positioned below viewport
	});

	// Create main timeline for the pinned section
	const mainTimeline = gsap.timeline({
		scrollTrigger: {
			trigger: trustSection,
			start: "top top",
			end: "+=200%", // Extended scroll distance for animation
			pin: true,
			pinSpacing: true,
			scrub: 1,
			anticipatePin: 1,
			refreshPriority: -1,
			onEnter: () => {
				console.log("🎯 Built on Trust section pinned");
				trustSection.classList.add("pinned");
			},
			onLeave: () => {
				console.log("🎯 Built on Trust section unpinned");
				trustSection.classList.remove("pinned");
			},
			onEnterBack: () => {
				console.log("🎯 Built on Trust section re-pinned (scrolling up)");
				trustSection.classList.add("pinned");
			},
			onLeaveBack: () => {
				console.log("🎯 Built on Trust section unpinned (scrolling up)");
				trustSection.classList.remove("pinned");
			},
			markers: false, // Set to true for debugging
		},
	});

	// Animate right content from 120% to -50% translateY during scroll
	mainTimeline.to(rightContent, {
		y: "-50%", // End position
		duration: 1,
		ease: "none", // Linear animation for smooth scroll-linked movement
	});

	// Handle responsive behavior
	const handleResize = () => {
		ScrollTrigger.refresh();
	};

	window.addEventListener("resize", handleResize);

	console.log(
		"✅ Built on Trust ScrollTrigger animation initialized with translateY animation"
	);
}

// =============================================================================
// HOW IT WORKS SWIPER FUNCTIONALITY (Mobile only - below 768px)
// =============================================================================

function initializeHowItWorksSwiper() {
	const howItWorksSwiper = document.querySelector(".how-it-works-swiper");

	if (!howItWorksSwiper) {
		console.log("How It Works swiper not found on this page");
		return;
	}

	// Check if Swiper is available
	if (typeof Swiper !== "undefined") {
		initHowItWorksSwiper();
	} else {
		console.log("❌ Swiper not available for How It Works swiper");
	}
}

function initHowItWorksSwiper() {
	const howItWorksSwiper = document.querySelector(".how-it-works-swiper");

	if (!howItWorksSwiper) {
		return;
	}

	// Handle responsive show/hide function
	function handleHowItWorksResponsive() {
		const desktopLayout = document.querySelector(".how-it-works-desktop");
		const mobileLayout = document.querySelector(".how-it-works-mobile");
		const isMobile = window.innerWidth < 768;

		if (desktopLayout && mobileLayout) {
			if (isMobile) {
				desktopLayout.style.display = "none";
				mobileLayout.style.display = "block";
			} else {
				desktopLayout.style.display = "flex";
				mobileLayout.style.display = "none";
			}
		}
	}

	// Initial responsive check
	handleHowItWorksResponsive();

	// Initialize Swiper (will only be visible on mobile via CSS)
	let swiper = null;

	if (window.innerWidth < 768) {
		swiper = new Swiper(howItWorksSwiper, {
			slidesPerView: 1,
			spaceBetween: 60,
			loop: true,
			speed: 600,
			grabCursor: true,
			centeredSlides: true,
			// No navigation or pagination on mobile - swipe only
			navigation: false,
			pagination: false,
		});
		console.log("✅ How It Works swiper initialized for mobile (swipe only)");
	}

	// Handle window resize to show/hide desktop vs mobile layout
	let resizeTimer;
	window.addEventListener("resize", function () {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function () {
			handleHowItWorksResponsive();
			if (window.innerWidth < 768 && swiper) {
				swiper.update();
			}
		}, 250);
	});
}

// =============================================================================
// MADE DIFFERENCE SLIDER FUNCTIONALITY
// =============================================================================

function initializeMadeDifferenceSlider() {
	const madeDifferenceSwiper = document.querySelector(
		".made-difference-swiper"
	);

	if (!madeDifferenceSwiper) {
		console.log("Made Difference slider not found on this page");
		return;
	}

	// Check if Swiper is available
	if (typeof Swiper !== "undefined") {
		initMadeDifferenceSwiper();
	} else {
		console.log("❌ Swiper not available for Made Difference slider");
	}
}

function initMadeDifferenceSwiper() {
	const madeDifferenceSwiper = document.querySelector(
		".made-difference-swiper"
	);

	if (!madeDifferenceSwiper) {
		return;
	}

	// Initialize Swiper for Made Difference section
	const swiper = new Swiper(madeDifferenceSwiper, {
		slidesPerView: 1,
		spaceBetween: 18,
		loop: true,
		centeredSlides: false,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
		},
		navigation: {
			nextEl: ".made-difference-next",
			prevEl: ".made-difference-prev",
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
			},
			480: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 3,
			},
			1200: {
				slidesPerView: 4,
				spaceBetween: 18,
			},
		},
		effect: "slide",
		speed: 800,
		grabCursor: true,
		watchSlidesProgress: true,
		watchSlidesVisibility: true,
	});

	console.log("✅ Made Difference slider initialized with Swiper");
}

function customeDropdown() {
	const dropdowns = document.querySelectorAll(".custom-dropdown");

	dropdowns.forEach((dropdown) => {
		const trigger = dropdown.querySelector(".dropdown-trigger");
		const menu = dropdown.querySelector(".dropdown-menu");
		const options = dropdown.querySelectorAll(".dropdown-option");
		const placeholder = trigger.querySelector(".placeholder");

		// Toggle dropdown
		trigger.addEventListener("click", function (e) {
			e.preventDefault();
			closeAllDropdowns();

			trigger.classList.toggle("open");
			menu.classList.toggle("show");
		});

		// Handle keyboard navigation
		trigger.addEventListener("keydown", function (e) {
			if (e.key === "Enter" || e.key === " ") {
				e.preventDefault();
				trigger.click();
			}
		});

		// Select option
		options.forEach((option) => {
			option.addEventListener("click", function () {
				const value = option.getAttribute("data-value");
				const text = option.textContent;

				placeholder.textContent = text;
				placeholder.classList.remove("placeholder");
				placeholder.classList.add("selected");

				// Store selected value
				dropdown.setAttribute("data-selected", value);

				trigger.classList.remove("open");
				menu.classList.remove("show");
			});
		});
	});

	// Close dropdowns when clicking outside
	document.addEventListener("click", function (e) {
		if (!e.target.closest(".custom-dropdown")) {
			closeAllDropdowns();
		}
	});

	function closeAllDropdowns() {
		document.querySelectorAll(".dropdown-trigger").forEach((trigger) => {
			trigger.classList.remove("open");
		});
		document.querySelectorAll(".dropdown-menu").forEach((menu) => {
			menu.classList.remove("show");
		});
	}

	// Form submission
	document.querySelector("form").addEventListener("submit", function (e) {
		e.preventDefault();

		// Collect form data including custom dropdowns
		const formData = {
			fullName: document.getElementById("fullName").value,
			phone: document.getElementById("phone").value,
			email: document.getElementById("email").value,
			location: document
				.querySelector('[data-dropdown="location"]')
				.getAttribute("data-selected"),
			discuss: document
				.querySelector('[data-dropdown="discuss"]')
				.getAttribute("data-selected"),
			propertyType: document
				.querySelector('[data-dropdown="propertyType"]')
				.getAttribute("data-selected"),
			meetingFormat: document
				.querySelector('[data-dropdown="meetingFormat"]')
				.getAttribute("data-selected"),
			dateTime: document
				.querySelector('[data-dropdown="dateTime"]')
				.getAttribute("data-selected"),
			notes: document.getElementById("notes").value,
		};

		console.log("Form Data:", formData);
		alert("Form submitted successfully! Check console for data.");
	});
}

// Initialize the sliders and hero section when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
	initializeRecentlyClosedDealsSlider();
	initializeTestimonialsSlider();
	initializeWhySellSlider();
	initializeThreeStepSlider();
	initializeMarqueeSlider();
	initializePropertyTypesSlider();
	initializeHowItWorksSwiper();
	initializeMadeDifferenceSlider();
	initializeBuiltOnTrustAnimation();
	initializeHeroSection();
	initializeCareerApplyModal();
	customeDropdown();
});

function initializeCareerApplyModal() {
	const modal =
		document.getElementById("careerApplyModal") ||
		document.querySelector(".career-apply-modal");
	if (!modal) {
		console.log("Career Apply modal not found on this page");
		return;
	}

	const backdrop = modal.querySelector(".modal-backdrop");

	const openModal = (e) => {
		if (e) e.preventDefault();
		modal.classList.add("open");
		document.body.classList.add("modal-open"); // ⬅️ ADD HERE
		if (backdrop) backdrop.classList.add("open");
	};

	const closeModal = (e) => {
		if (e) e.preventDefault();
		modal.classList.remove("open");
		document.body.classList.remove("modal-open"); // ⬅️ ADD HERE
		if (backdrop) backdrop.classList.remove("open");
	};

	// Delegate clicks for dynamic buttons
	document.addEventListener("click", function (e) {
		// Open on any .apply_btn click
		const applyBtn = e.target.closest(".apply_btn");
		if (applyBtn) {
			openModal(e);
			return;
		}

		// Close on close button
		if (e.target.closest(".modal-close")) {
			closeModal(e);
			return;
		}

		// Close when clicking on the backdrop itself
		if (backdrop && e.target === backdrop) {
			closeModal(e);
			return;
		}
	});

	// Close on ESC key
	document.addEventListener("keydown", function (e) {
		if (e.key === "Escape" && modal.classList.contains("open")) {
			closeModal(e);
		}
	});

	console.log("✅ Career Apply modal initialized");
}
