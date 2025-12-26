/**
 * Yakult Theme - Main JavaScript File
 * Imports all JavaScript modules by path
 *
 * @package yakult
 * @version 1.0
 */



// =============================================================================
// DYNAMIC SCRIPT LOADER
// =============================================================================

function loadScript(src, callback) {
    const script = document.createElement('script');
    script.src = src;
    script.async = true;

    script.onload = function () {
        if (callback) callback();
    };

    script.onerror = function () {
    };

    document.head.appendChild(script);
}

// =============================================================================
// IMPORT ALL JAVASCRIPT FILES
// =============================================================================

// Get the theme directory URL (WordPress way)
const themeUrl = window.yakultThemeUrl || '/wp-content/themes/yakult';

// List of JavaScript files to import
const jsFiles = [
    `${themeUrl}/assets/js/Header.js`,
    `${themeUrl}/assets/js/common.js`,
    `${themeUrl}/assets/js/history-swiper.js`,
    `${themeUrl}/assets/js/product-swiper.js`,
    `${themeUrl}/assets/js/news-marquee.js`,
    `${themeUrl}/assets/js/swiper-bundle.min.js`,
    `${themeUrl}/assets/js/interactive-slider.js`,
    `${themeUrl}/assets/js/home.js`,
    `${themeUrl}/assets/js/video.js`,
    `${themeUrl}/assets/js/why-choose-us-animation.js`,
    `${themeUrl}/assets/js/how-it-works-animation.js`
    // Note: snazzy-map.js is loaded separately on specific map pages to avoid conflicts
    // single-location-map.js is loaded on event detail pages
];

// Load all JavaScript files
console.log('📦 Loading JavaScript modules...');

let loadedCount = 0;
const totalFiles = jsFiles.length;

jsFiles.forEach((file) => {
    loadScript(file, function () {
        loadedCount++;
        console.log(`📊 Progress: ${loadedCount}/${totalFiles} files loaded`);

        if (loadedCount === totalFiles) {
            console.log('🎉 All JavaScript modules loaded successfully!');

            // Initialize any global functionality after all scripts are loaded
            if (typeof initializeAllModules === 'function') {
                initializeAllModules();
            }
        }
    });
});

// =============================================================================
// GLOBAL INITIALIZATION (runs after all modules are loaded)
// =============================================================================

window.initializeAllModules = function () {
    console.log('🔧 Initializing all loaded modules...');

    // Check if Swiper is available first
    if (typeof Swiper === 'undefined') {
        console.error('❌ Swiper library not available for module initialization');
        return;
    }

    // Wait a moment for all scripts to be fully parsed
    setTimeout(function () {
        let successCount = 0;
        let totalModules = 0;

        // Initialize History Swiper if function is available
        if (typeof window.initializeHistorySwiper === 'function') {
            console.log('🎠 Calling History Swiper initialization...');
            totalModules++;
            const historyResult = window.initializeHistorySwiper();
            if (historyResult) successCount++;
        } else {
            console.warn('⚠️ History Swiper initialization function not found');
        }

        // Initialize Product Swiper if function is available
        if (typeof window.initializeProductSwiper === 'function') {
            console.log('🛍️ Calling Product Swiper initialization...');
            totalModules++;
            const productResult = window.initializeProductSwiper();
            if (productResult) successCount++;
        } else {
            console.warn('⚠️ Product Swiper initialization function not found');
        }

        // Initialize Interactive Slider if function is available
        if (typeof window.initializeInteractiveSlider === 'function') {
            console.log('🎯 Calling Interactive Slider initialization...');
            totalModules++;
            const interactiveResult = window.initializeInteractiveSlider();
            if (interactiveResult) successCount++;
        } else {
            console.warn('⚠️ Interactive Slider initialization function not found');
        }

        // Initialize Property Types Slider if function is available
        if (typeof window.initializePropertyTypesSlider === 'function') {
            console.log('🏠 Calling Property Types Slider initialization...');
            totalModules++;
            const propertyTypesResult = window.initializePropertyTypesSlider();
            if (propertyTypesResult) successCount++;
        } else {
            console.warn('⚠️ Property Types Slider initialization function not found');
        }

        // Initialize How It Works Animation if function is available
        if (typeof window.initializeHowItWorksAnimation === 'function') {
            console.log('🎯 Calling How It Works Animation initialization...');
            totalModules++;
            const howItWorksResult = window.initializeHowItWorksAnimation();
            if (howItWorksResult) successCount++;
        } else {
            console.warn('⚠️ How It Works Animation initialization function not found');
        }

        // Initialize other modules as needed
        console.log(`✅ Module initialization complete: ${successCount}/${totalModules} successful`);
    }, 300);
};

// =============================================================================
// FALLBACK INITIALIZATION
// =============================================================================

// Fallback initialization in case dynamic loading fails
document.addEventListener('DOMContentLoaded', function () {
    console.log('📄 Main.js DOM ready - setting up fallback initialization...');

    // Initialize AOS (Animate On Scroll) first
    if (typeof AOS !== 'undefined') {
        console.log('🎨 Initializing AOS animations...');
        AOS.init({
            duration: 1000,        // Animation duration in milliseconds
            easing: 'ease-in-out', // Easing function
            once: true,            // Animation happens only once
            offset: 100,           // Trigger animations 100px before element comes into view
            delay: 0,              // Delay before animation starts
            disable: false,        // Disable AOS on mobile if needed
            startEvent: 'DOMContentLoaded',
            initClassName: 'aos-init',
            animatedClassName: 'aos-animate',
            useClassNames: false,
            disableMutationObserver: false,
            debounceDelay: 50,
            throttleDelay: 99,
        });
        console.log('✅ AOS initialized successfully!');
    } else {
        console.warn('⚠️ AOS library not found - animations will not work');
    }

    // Wait for potential dynamic loading to complete
    setTimeout(function () {
        // Check if modules were loaded dynamically
        if (loadedCount < totalFiles) {
            console.warn('⚠️ Not all modules loaded dynamically, trying fallback...');

            // Try to initialize swipers directly if Swiper is available
            if (typeof Swiper !== 'undefined') {
                console.log('🔄 Swiper available, attempting direct initialization...');

                // Try to initialize history swiper directly
                if (document.querySelector('.history-swiper')) {
                    console.log('🎠 Found history swiper, initializing directly...');
                    try {
                        const historySwiper = new Swiper(".history-swiper", {
                            slidesPerView: 1,
                            autoHeight: true,
                            centeredSlides: false,
                            spaceBetween: 20,
                            breakpoints: {
                                640: {
                                    slidesPerView: 2,
                                    autoHeight: true,
                                    spaceBetween: 30,
                                },
                                1200: {
                                    slidesPerView: 2,
                                    autoHeight: true,
                                    spaceBetween: 40,
                                },
                            },
                            navigation: {
                                prevEl: ".slider_btn.prev_btn",
                                nextEl: ".slider_btn.next_btn",
                            },
                            watchSlidesProgress: true,
                            watchSlidesVisibility: true,
                            on: {
                                init: function () {
                                    console.log('✅ History Swiper initialized via fallback');
                                },
                                slideChange: function () {
                                    this.updateAutoHeight(300);
                                },
                                resize: function () {
                                    this.updateAutoHeight(0);
                                }
                            }
                        });
                    } catch (error) {
                        console.error('❌ Fallback history swiper initialization failed:', error);
                    }
                }
            }
        }
    }, 2000); // Wait 2 seconds for dynamic loading
});

console.log('📋 Main.js setup complete - modules will load asynchronously with fallback');










// ------------newwww----------















// =============================================================================
// NEWS MARQUEE FUNCTIONALITY
// =============================================================================

function initializeNewsMarquee() {
    const newsMarqueeSwiper = document.querySelector('.news-marquee-swiper');

    if (!newsMarqueeSwiper) {
        console.log('News marquee not found on this page');
        return;
    }

    // Check if Swiper is available
    if (typeof Swiper !== 'undefined') {
        initSwiperMarquee();
    } else {
        // Load Swiper if not already loaded
        loadSwiperAndInitialize();
    }
}

function loadSwiperAndInitialize() {
    // Swiper CSS is already loaded via functions.php
    // Just check if Swiper JS is available
    if (typeof Swiper === 'undefined') {
        console.log('❌ Swiper JS not found - using fallback marquee');
        initFallbackMarquee();
    } else {
        console.log('✅ Swiper JS found - initializing marquee');
        initSwiperMarquee();
    }
}

function initSwiperMarquee() {
    const newsMarqueeSwiper = document.querySelector('.news-marquee-swiper');

    if (!newsMarqueeSwiper) {
        console.log('News marquee not found on this page');
        return;
    }

    // Initialize Swiper for news marquee
    const swiper = new Swiper(newsMarqueeSwiper, {
        slidesPerView: 'auto',
        spaceBetween: 0,
        loop: true,
        speed: 8000, // 8 seconds per loop
        autoplay: {
            delay: 0, // No delay between transitions
            disableOnInteraction: false,
            pauseOnMouseEnter: false
        },
        allowTouchMove: false, // Disable touch/swipe
        allowMouseDrag: false, // Disable mouse drag
        grabCursor: false,
        watchSlidesProgress: true,
        watchSlidesVisibility: true,
        freeMode: false,
        effect: 'slide',
        direction: 'horizontal',
        breakpoints: {
            320: {
                speed: 6000
            },
            768: {
                speed: 8000
            },
            1200: {
                speed: 10000
            }
        }
    });

    console.log('✅ News marquee initialized with Swiper');
}

function initFallbackMarquee() {
    console.log('🔄 Initializing fallback CSS marquee');

    const newsMarqueeSection = document.querySelector('.news-marquee-section');
    if (newsMarqueeSection) {
        // Add fallback CSS class for animation
        newsMarqueeSection.classList.add('fallback-marquee');

        // Create simple CSS animation as fallback
        const style = document.createElement('style');
        style.textContent = `
            .fallback-marquee .news-marquee-container {
                position: relative;
                overflow: hidden;
                white-space: nowrap;
            }
            
            .fallback-marquee .swiper-wrapper {
                display: inline-block;
                white-space: nowrap;
                animation: fallbackMarquee 20s linear infinite;
            }
            
            @keyframes fallbackMarquee {
                0% {
                    transform: translateX(100%);
                }
                100% {
                    transform: translateX(-100%);
                }
            }
        `;
        document.head.appendChild(style);
    }
}

 

// =============================================================================
// PROMOTIONAL BANNER SLIDER FUNCTIONALITY
// =============================================================================

function initializePromotionalBannerSlider() {
    const promotionalBannerSwiper = document.querySelector('.promotional-banner-swiper');

    if (!promotionalBannerSwiper) {
        console.log('Promotional banner slider not found on this page');
        return;
    }

    // Check if Swiper is available
    if (typeof Swiper !== 'undefined') {
        initPromotionalBannerSwiper();
    } else {
        // Load Swiper if not already loaded
        loadSwiperForPromotionalBanner();
    }
}

function loadSwiperForPromotionalBanner() {
    // Swiper CSS is already loaded via functions.php
    // Just check if Swiper JS is available
    if (typeof Swiper === 'undefined') {
        console.log('❌ Swiper JS not found for promotional banner slider');
        return;
    } else {
        console.log('✅ Swiper JS found - initializing promotional banner slider');
        initPromotionalBannerSwiper();
    }
}

function initPromotionalBannerSwiper() {
    const promotionalBannerSwiper = document.querySelector('.promotional-banner-swiper');

    if (!promotionalBannerSwiper) {
        return;
    }

    // Initialize Swiper for promotional banner
    const swiper = new Swiper(promotionalBannerSwiper, {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        speed: 1000,
        grabCursor: true,
        watchSlidesProgress: true,
        watchSlidesVisibility: true
    });

    console.log('✅ Promotional banner slider initialized with Swiper');
}

console.log('📋 Main.js setup complete - modules will load asynchronously');

// Check if DOM is already loaded and initialize marquee immediately
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            // Initialize AOS if not already initialized
            if (typeof AOS !== 'undefined' && !document.querySelector('.aos-init')) {
                console.log('🎨 Fallback AOS initialization...');
                AOS.init({
                    duration: 1000,
                    easing: 'ease-in-out',
                    once: true,
                    offset: 100,
                });
            }

            initializeNewsMarquee();
        }, 1000); // Small delay to ensure other scripts are loaded
    });
} else {
    // DOM is already loaded
    setTimeout(function () {
        initializeNewsMarquee();
    }, 1000);
}











const fileInput = document.getElementById("resume");
const fileNameLabel = document.getElementById("file-name");

fileInput.addEventListener("change", function () {
    if (this.files && this.files.length > 0) {
        fileNameLabel.textContent = this.files[0].name;
    } else {
        fileNameLabel.textContent = "Attach Resume";
    }
});












 
