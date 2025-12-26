/**
 * How It Works - Card Stacking ScrollTrigger Animation
 * Implements pinned section with stepped stacking (100px gaps) for cards
 *
 * - Pins the entire section when the cards container hits the viewport
 * - First card stays at top; subsequent cards slide up and stack with 100px offsets
 * - Later cards have higher z-index so they appear on top
 * - Unpins after all cards complete stacking and normal scroll resumes
 *
 * @package buy-my-property
 * @version 1.0
 */

(function () {
  const GAP_PX = 100; // Vertical gap between stacked cards
  const SCROLL_PER_CARD = 600; // Scroll distance allocated per card animation
  const EXTRA_SLACK = 400; // Extra scroll so last card fully settles when scrolling fast

  function log(...args) {
    if (window && window.console) console.log.apply(console, args);
  }

  class HowItWorksAnimation {
    constructor() {
      this.section = document.querySelector('.three_step_process_for_sellers');
      this.container = this.section ? this.section.querySelector('.how-it-works-cards-container') : null;
      this.cards = this.container ? this.container.querySelectorAll('.how-it-works-card') : [];

      this.init();
    }

    init() {
      if (!this.section || !this.container || !this.cards.length) {
        log('How It Works section or cards not found on this page');
        return false;
      }

      if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        log('❌ GSAP or ScrollTrigger not available for How It Works animation');
        return false;
      }

      log('✅ Initializing How It Works card stacking animation...');
      log(`Found ${this.cards.length} cards to animate`);

      gsap.registerPlugin(ScrollTrigger);

      this.setupInitialState();
      this.createStackingAnimation();
      return true;
    }

    setupInitialState() {
      // Ensure container creates a proper stacking context while pinned
      gsap.set(this.container, { position: 'relative', force3D: true, transformStyle: 'preserve-3d' });

      const totalCards = this.cards.length;
      const cardHeight = this.cards[0].getBoundingClientRect().height || this.cards[0].offsetHeight;
      this.cardHeight = cardHeight;
      // Container height equals 1 full card + 100px per additional card visible
      const containerHeight = cardHeight + (totalCards - 1) * GAP_PX;
      gsap.set(this.container, { height: containerHeight });

      // Set initial card transforms and z-indices, stack absolutely at top-left
      this.cards.forEach((card, index) => {
        const isFirst = index === 0;
        gsap.set(card, {
          position: 'absolute', top: 0, left: 0, width: '100%',
          y: isFirst ? 0 : containerHeight + 50, // start below the stacked area
          zIndex: index + 1, // later cards on top
          willChange: 'transform',
        });
      });

      log('🔧 Initial absolute stacking prepared with container height set');
    }

    createStackingAnimation() {
      const totalCards = this.cards.length;
      if (totalCards <= 1) return;

      // Total scroll distance: allocate per card and add slack so last card fully settles
      const scrollDistance = (totalCards) * SCROLL_PER_CARD + EXTRA_SLACK;

      const tl = gsap.timeline({
        defaults: { ease: 'none' }, // smooth, no bounce during scrub
        scrollTrigger: {
          trigger: this.section,
          start: 'top top+=50',
                    // start: 'top top',

          end: `+=${scrollDistance}`,
          pin: true, // pin the whole section
          pinSpacing: true,
          scrub: true,
          anticipatePin: 1,
          refreshPriority: -1,
          onEnter: () => {
            log('🎯 How It Works section pinned');
            this.section.classList.add('pinned');
          },
          onLeave: () => {
            log('🎯 How It Works section unpinned');
            this.section.classList.remove('pinned');
          },
          onEnterBack: () => {
            log('🎯 How It Works section re-pinned (scrolling up)');
            this.section.classList.add('pinned');
          },
          onLeaveBack: () => {
            log('🎯 How It Works section unpinned (scrolling up)');
            this.section.classList.remove('pinned');
          },
          markers: false,
        },
      });

      // Step-by-step stacking (latest card sits 100px BELOW previous):
      // Final positions: card0 y=0, card1 y=100, card2 y=200, ... with later cards on higher z-index
      for (let s = 1; s < totalCards; s++) {
        const newCard = this.cards[s];
        tl.to(newCard, { y: s * GAP_PX }, '>');
        log(`📋 Step ${s}: move card ${s + 1} to y=${s * GAP_PX} (below previous by ${GAP_PX}px)`);
      }

      // Refresh on resize so viewport-dependent values update
      const handleResize = () => {
        ScrollTrigger.refresh();
      };
      window.addEventListener('resize', handleResize);

      log('✅ How It Works card stacking animation initialized');
    }
  }

  function initializeHowItWorksAnimation() {
    // Safeguard DOM readiness
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => new HowItWorksAnimation());
    } else {
      new HowItWorksAnimation();
    }
    return true;
  }

  // Auto-initialize
  initializeHowItWorksAnimation();

  // Export / expose for debugging
  if (typeof module !== 'undefined' && module.exports) {
    module.exports = { HowItWorksAnimation, initializeHowItWorksAnimation };
  }
  window.initializeHowItWorksAnimation = initializeHowItWorksAnimation;
})();

