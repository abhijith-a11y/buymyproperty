/**
 * Why Choose Us - Card Stacking Animation
 * GSAP ScrollTrigger implementation for card stacking effect
 *
 * @package buy-my-property
 * @version 1.0
 */

console.log('🎯 Why Choose Us Animation - Card stacking functionality loaded');

// ========================================
// CARD STACKING ANIMATION CLASS
// ========================================

class WhyChooseUsAnimation {
    constructor() {
        this.section = document.querySelector('.why_choose_top_stack');
        this.header = document.querySelector('.why_choose_header');
        this.cards = document.querySelectorAll('.card_content');
        this.cardContainer = document.querySelector('.why_choose_card');
        
        this.init();
    }

    init() {
        // Check if we're on the why-choose-us page
        if (!this.section || !this.cards.length) {
            console.log('Why Choose Us section not found on this page');
            return;
        }

        // Check if GSAP and ScrollTrigger are available
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            console.log('❌ GSAP or ScrollTrigger not available for Why Choose Us animation');
            return;
        }

        console.log('✅ Initializing Why Choose Us card stacking animation...');
        console.log(`Found ${this.cards.length} cards to animate`);

        // Register ScrollTrigger plugin
        gsap.registerPlugin(ScrollTrigger);

        this.setupInitialState();
        this.createStackingAnimation();
    }

    setupInitialState() {
        // Set initial positions for cards
        this.cards.forEach((card, index) => {
            if (index === 0) {
                // First card is visible at the bottom of the stack
                gsap.set(card, {
                    y: 0,
                    zIndex: 1, // Bottom card has lowest z-index
                    opacity: 1
                });
            } else {
                // Subsequent cards start below the viewport
                gsap.set(card, {
                    y: window.innerHeight,
                    zIndex: index + 1, // Each subsequent card has higher z-index
                    opacity: 1
                });
            }
        });

        console.log('🔧 Initial card positions set with proper z-index stacking');
        console.log(`Card z-index values: ${Array.from(this.cards).map((_, i) => i + 1).join(', ')}`);
    }

    createStackingAnimation() {
        const cardHeight = this.cards[0].offsetHeight;
        const totalCards = this.cards.length;

        // Calculate scroll distance needed for the entire animation based on card height
        const stepDistance = Math.max(150, Math.round(cardHeight * 0.7));
        const scrollDistance = Math.max(stepDistance, (totalCards - 1) * stepDistance);


        // Create main timeline for the pinned section
        const mainTimeline = gsap.timeline({
            scrollTrigger: {
                trigger: this.section,
                start: "top top+=30",
                end: () => {
                    const h = (this.cards[0] && this.cards[0].offsetHeight) ? this.cards[0].offsetHeight : 0;
                    const step = Math.max(150, Math.round(h * 0.7));
                    return `+=${Math.max(step, (this.cards.length - 1) * step)}`;
                },
                pin: true,
                pinSpacing: true,
                scrub: true,
                anticipatePin: 1,
                refreshPriority: -1,
                onEnter: () => {
                    console.log('🎯 Why Choose Us section pinned');
                    this.section.classList.add('pinned');
                },
                onLeave: () => {
                    console.log('🎯 Why Choose Us section unpinned');
                    this.section.classList.remove('pinned');
                },
                onEnterBack: () => {
                    console.log('🎯 Why Choose Us section re-pinned (scrolling up)');
                    this.section.classList.add('pinned');
                },
                onLeaveBack: () => {
                    console.log('🎯 Why Choose Us section unpinned (scrolling up)');
                    this.section.classList.remove('pinned');
                },
                markers: false // Set to true for debugging
            }
        });

        // Animate each card (except the first one) to stack on top
        this.cards.forEach((card, index) => {
            if (index === 0) return; // Skip first card as it's already in position

            // Calculate the target position for stacking
            // Each card should stack on top of the first card (y: 0)
            // This creates a perfect stack where all cards align at the top
            const targetY = 0;

            // Add animation to timeline
            // Each card animation takes 1/totalCards of the total scroll
            const animationStart = (index - 1) / (totalCards - 1);
            const animationEnd = index / (totalCards - 1);

            mainTimeline.to(card, {
                y: targetY,
                duration: animationEnd - animationStart,
                ease: "power2.inOut"
            }, animationStart);

            console.log(`📋 Card ${index + 1} (z-index: ${index + 1}) will animate from y:${window.innerHeight} to y:${targetY}`);
        });

        // Handle responsive behavior
        const handleResize = () => {
            ScrollTrigger.refresh();
        };

        window.addEventListener('resize', handleResize);

        console.log('✅ Why Choose Us card stacking animation initialized');
    }

    // Method to refresh animation (useful for debugging)
    refresh() {
        ScrollTrigger.refresh();
    }

    // Method to kill animation (useful for cleanup)
    destroy() {
        ScrollTrigger.getAll().forEach(trigger => {
            if (trigger.trigger === this.section) {
                trigger.kill();
            }
        });
    }
}

// ========================================
// INITIALIZATION
// ========================================

function initializeWhyChooseUsAnimation() {
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            new WhyChooseUsAnimation();
        });
    } else {
        new WhyChooseUsAnimation();
    }
}

// Auto-initialize when script loads
initializeWhyChooseUsAnimation();

// Export for potential use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { WhyChooseUsAnimation, initializeWhyChooseUsAnimation };
}

// Make available globally for debugging
window.WhyChooseUsAnimation = WhyChooseUsAnimation;
