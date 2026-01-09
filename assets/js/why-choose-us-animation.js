/**
 * Why Choose Us - Card Stacking Animation
 * GSAP ScrollTrigger implementation for card stacking effect
 *
 * @package buy-my-property
 * @version 1.0
 */

console.log("🎯 Why Choose Us Animation - Card stacking functionality loaded");

// ========================================
// CARD STACKING ANIMATION CLASS
// ========================================

class WhyChooseUsAnimation {
	constructor() {
		this.section = document.querySelector(".why_choose_top_stack");
		this.header = document.querySelector(".why_choose_header");
		this.cards = document.querySelectorAll(".card_content");
		this.cardContainer = document.querySelector(".why_choose_card");

		this.init();
	}

	init() {
		// Check if we're on the why-choose-us page
		if (!this.section || !this.cards.length) {
			console.log("Why Choose Us section not found on this page");
			return;
		}

		// Check window width - disable GSAP below 969px
		const breakpoint = 969;
		if (window.innerWidth < breakpoint) {
			console.log(
				"📱 Why Choose Us: Below breakpoint, disabling GSAP stacking animation"
			);
			this.setupNormalCards();
			return;
		}

		// Check if GSAP and ScrollTrigger are available
		if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
			console.log(
				"❌ GSAP or ScrollTrigger not available for Why Choose Us animation"
			);
			return;
		}

		console.log("✅ Initializing Why Choose Us card stacking animation...");
		console.log(`Found ${this.cards.length} cards to animate`);

		// Register ScrollTrigger plugin
		gsap.registerPlugin(ScrollTrigger);

		this.setupInitialState();
		this.createStackingAnimation();

		// Handle resize - disable/enable GSAP based on breakpoint
		let resizeTimer;
		window.addEventListener("resize", () => {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(() => {
				if (window.innerWidth < breakpoint) {
					// Destroy GSAP animations if they exist
					if (this.scrollTrigger) {
						this.scrollTrigger.kill();
						this.scrollTrigger = null;
					}
					// Reset cards to normal state
					this.setupNormalCards();
				} else {
					// Reinitialize GSAP if window is large enough
					if (!this.scrollTrigger) {
						this.setupInitialState();
						this.createStackingAnimation();
					}
				}
			}, 250);
		});
	}

	setupNormalCards() {
		// Kill ScrollTrigger first to prevent memory leaks or ghost pins
		if (typeof ScrollTrigger !== "undefined") {
			ScrollTrigger.getAll().forEach((trigger) => {
				if (trigger.trigger === this.section) {
					trigger.kill();
				}
			});
		}

		// Reset all GSAP transforms and set cards to normal flow
		this.cards.forEach((card, index) => {
			// Kill any existing GSAP animations
			if (typeof gsap !== "undefined") {
				gsap.killTweensOf(card);
				gsap.set(card, { clearProps: "all" });
			}
			// Remove any inline styles that GSAP might have added
			card.style.transform = "";
			card.style.position = "";
			card.style.top = "";
			card.style.left = "";
			card.style.zIndex = "";
			card.style.opacity = "";
			card.style.willChange = "";
			card.style.backfaceVisibility = "";
		});
		console.log("📱 Cards set to normal flow (no GSAP stacking)");
	}

	setupInitialState() {
		// Set initial positions for cards
		this.cards.forEach((card, index) => {
			if (index === 0) {
				// First card is visible at the bottom of the stack
				gsap.set(card, {
					y: 0,
					zIndex: 1, // Bottom card has lowest z-index
					opacity: 1,
				});
			} else {
				// Subsequent cards start below the viewport
				gsap.set(card, {
					y: window.innerHeight,
					zIndex: index + 1, // Each subsequent card has higher z-index
					opacity: 1,
				});
			}
		});

		console.log("🔧 Initial card positions set with proper z-index stacking");
		console.log(
			`Card z-index values: ${Array.from(this.cards)
				.map((_, i) => i + 1)
				.join(", ")}`
		);
	}

	createStackingAnimation() {
		const totalCards = this.cards.length;
		const cardsToAnimate = totalCards - 1;
		const cardHeight = this.cards[0]?.offsetHeight || 460; // Get actual card height or fallback to 460px
		const viewportHeight = window.innerHeight; // 100vh

		// Calculate exact scroll distance: card height per card minus viewport height
		// Subtracting 100vh removes unnecessary scroll at start (scrolling up) and end (scrolling down)
		const scrollDistance = cardHeight * cardsToAnimate - viewportHeight;

		// Build timeline first without ScrollTrigger to ensure exact duration
		const mainTimeline = gsap.timeline({
			defaults: { ease: "none" }, // Linear easing for 1:1 scroll relationship
		});

		// Animate each card (except the first one) to stack on top
		// Each card takes exactly 1/cardsToAnimate of the timeline duration
		this.cards.forEach((card, index) => {
			if (index === 0) return; // Skip first card as it's already in position

			// Calculate timeline position: each card animates during its portion of scroll
			const animationStart = (index - 1) / cardsToAnimate;
			const duration = 1 / cardsToAnimate; // Each card gets equal scroll distance

			// Use .to() for cleaner transitions - card already positioned at window.innerHeight
			mainTimeline.to(
				card,
				{
					y: 0, // Stack on top of first card
					duration: duration,
					ease: "none", // Linear - ensures cards are "locked" to scrollbar
				},
				animationStart
			);
		});

		// Normalize timeline to exactly 1.0 duration for perfect scroll mapping
		const actualDuration = mainTimeline.duration();
		if (Math.abs(actualDuration - 1.0) > 0.0001) {
			mainTimeline.timeScale(1.0 / actualDuration);
		}

		// Create ScrollTrigger separately and link to the normalized timeline
		this.scrollTrigger = ScrollTrigger.create({
			trigger: this.section,
			start: "top top", // Pin immediately when section hits viewport top
			end: `+=${scrollDistance}`, // Exact scroll distance: (cardHeight * cardsToAnimate) - viewportHeight
			pin: true,
			pinSpacing: true,
			scrub: 1, // Smooth scrub to absorb mouse wheel jitter while staying responsive
			animation: mainTimeline, // Link to the normalized timeline
			anticipatePin: 1,
			refreshPriority: -1,
			invalidateOnRefresh: true, // Handle window resizing properly
			onEnter: () => {
				console.log("🎯 Why Choose Us section pinned");
				this.section.classList.add("pinned");
			},
			onLeave: () => {
				console.log(
					"🎯 Why Choose Us section unpinned - all cards stacked, scroll ended exactly"
				);
				this.section.classList.remove("pinned");
			},
			onEnterBack: () => {
				console.log("🎯 Why Choose Us section re-pinned (scrolling up)");
				this.section.classList.add("pinned");
			},
			onLeaveBack: () => {
				console.log("🎯 Why Choose Us section unpinned (scrolling up)");
				this.section.classList.remove("pinned");
			},
			markers: false,
		});

		// Verify alignment
		const finalDuration = mainTimeline.duration();
		const actualScrollDistance =
			this.scrollTrigger.end - this.scrollTrigger.start;
		console.log(
			`✅ Why Choose Us animation initialized: ${cardsToAnimate} cards, ${scrollDistance}px scroll distance (${cardHeight}px per card, -${viewportHeight}px viewport height)`
		);
		console.log(
			`📊 Timeline duration: ${finalDuration.toFixed(
				6
			)}, Scroll distance: ${actualScrollDistance.toFixed(
				2
			)}px, Perfect alignment: ${
				Math.abs(finalDuration - 1.0) < 0.0001 ? "✅" : "⚠️"
			}`
		);

		// Handle responsive behavior
		const handleResize = () => {
			ScrollTrigger.refresh();
		};

		window.addEventListener("resize", handleResize);
	}

	// Method to refresh animation (useful for debugging)
	refresh() {
		ScrollTrigger.refresh();
	}

	// Method to kill animation (useful for cleanup)
	destroy() {
		if (typeof ScrollTrigger !== "undefined") {
			ScrollTrigger.getAll().forEach((trigger) => {
				if (trigger.trigger === this.section) {
					trigger.kill();
				}
			});
		}
		// Reset cards to normal state
		this.setupNormalCards();
		this.scrollTrigger = null;
	}
}

// ========================================
// INITIALIZATION
// ========================================

function initializeWhyChooseUsAnimation() {
	// Wait for DOM to be ready
	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", () => {
			new WhyChooseUsAnimation();
		});
	} else {
		new WhyChooseUsAnimation();
	}
}

// Auto-initialize when script loads
initializeWhyChooseUsAnimation();

// Export for potential use in other modules
if (typeof module !== "undefined" && module.exports) {
	module.exports = { WhyChooseUsAnimation, initializeWhyChooseUsAnimation };
}

// Make available globally for debugging
window.WhyChooseUsAnimation = WhyChooseUsAnimation;
