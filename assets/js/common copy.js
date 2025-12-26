// =============================================================================
// HEADER FUNCTIONALITY NOTICE
// =============================================================================
// ALL header-related functionality (sticky header, navigation, mobile menu,
// search, language toggle) is handled in Header.js to avoid conflicts.
// This file contains only non-header utilities (sliders, animations, etc.)
// =============================================================================

// nice select
jQuery(document).ready(function () {
  jQuery("select").niceSelect();
});

// classic plugin
// add_filter("use_block_editor_for_post", "__return_false");

// container width
var x = jQuery(".container").offset();
jQuery(".margin-left").css("margin-left", x.left);

// remove roll attribute
jQuery(document).ready(function () {
  jQuery(".resp-accordion").removeAttr("roll");
});

var swiper = new Swiper(".hero-slider", {
  spaceBetween: 20,
  loop: true,
  // autoplay: {
  //   delay: 5500,
  //   disableOnInteraction: false,
  //   pauseOnMouseEnter: true,
  // },
  pagination: {
    el: ".swiper-pagination", // CSS selector for the pagination element
    clickable: true,          // Allows clicking on pagination bullets
  },
  centeredSlides: false,
  allowTouchMove: true,
  breakpoints: {
    0: {
      slidesPerView: 0,
    },
    568: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 1,
    },
    1020: {
      slidesPerView: 1,
    },
  },
});

// Video play button functionality
jQuery(document).ready(function () {
  var currentVideoSlide = null;
  var videoEnded = false;
  var videoPlaying = false;
  var autoplayTimeout = null;

  // Function to reset video state
  function resetVideoState() {
    // Pause all videos and reset to beginning
    jQuery('.hero-slider video').each(function () {
      this.pause();
      this.currentTime = 0;
    });

    // Reset all iframes to remove autoplay
    jQuery('.hero-slider iframe').each(function () {
      var iframe = jQuery(this);
      var src = iframe.attr('src');
      if (src && src.indexOf('autoplay=1') !== -1) {
        // Remove autoplay parameter
        src = src.replace(/[?&]autoplay=1/, '').replace(/[?&]mute=1/, '');
        iframe.attr('src', src);
      }
    });

    // Show all play buttons
    jQuery('.video-play-button').fadeIn();

    // Remove resume indicators
    jQuery('.resume-autoplay-indicator').remove();

    // Clear any existing timeout
    if (autoplayTimeout) {
      clearTimeout(autoplayTimeout);
      autoplayTimeout = null;
    }

    // Reset state variables
    videoPlaying = false;
    videoEnded = false;
  }

  // Function to resume autoplay
  function resumeAutoplay() {
    if (!videoPlaying && !swiper.autoplay.running) {
      swiper.autoplay.start();
    }
  }

  jQuery('.video-play-button').on('click', function () {
    var videoContainer = jQuery(this).closest('.video-container');
    var iframe = videoContainer.find('iframe');
    var video = videoContainer.find('video');
    var slideIndex = jQuery(this).closest('.swiper-slide').index();

    // Store current video slide
    currentVideoSlide = slideIndex;
    videoEnded = false;
    videoPlaying = true;

    // Stop slider autoplay when video starts
    swiper.autoplay.stop();

    if (iframe.length > 0) {
      // Handle iframe videos (YouTube, etc.)
      var videoUrl = iframe.attr('src');

      // Add autoplay parameter to YouTube URL
      if (videoUrl.indexOf('youtube.com/embed/') !== -1) {
        var separator = videoUrl.indexOf('?') !== -1 ? '&' : '?';
        videoUrl += separator + 'autoplay=1&mute=1';
        iframe.attr('src', videoUrl);

        // Set timeout for YouTube videos
        autoplayTimeout = setTimeout(function () {
          if (currentVideoSlide === slideIndex && !videoEnded && videoPlaying) {
            swiper.autoplay.start();
            videoEnded = true;
            videoPlaying = false;
          }
        }, 30000); // Resume after 30 seconds
      }
    } else if (video.length > 0) {
      // Handle video file uploads
      video[0].play();

      // Listen for video end event
      video[0].addEventListener('ended', function () {
        if (currentVideoSlide === slideIndex && !videoEnded && videoPlaying) {
          swiper.autoplay.start();
          videoEnded = true;
          videoPlaying = false;
        }
      });

      // Listen for pause event
      video[0].addEventListener('pause', function () {
        if (currentVideoSlide === slideIndex && !videoEnded && videoPlaying) {
          swiper.autoplay.start();
          videoEnded = true;
          videoPlaying = false;
        }
      });
    }

    // Hide the play button
    jQuery(this).fadeOut();

    // Add resume autoplay indicator
    var resumeIndicator = jQuery('<div class="resume-autoplay-indicator">Click to resume slideshow</div>');
    videoContainer.append(resumeIndicator);

    // Show indicator after a short delay
    setTimeout(function () {
      resumeIndicator.fadeIn();
    }, 2000);

    // Handle resume indicator click
    resumeIndicator.on('click', function () {
      swiper.autoplay.start();
      resumeIndicator.fadeOut();
      videoEnded = true;
      videoPlaying = false;
    });
  });

  // Handle slide change
  swiper.on('slideChange', function () {
    var currentSlide = swiper.activeIndex;

    // Reset video state for all slides
    resetVideoState();

    // If we're not on the video slide that was playing, reset tracking
    if (currentVideoSlide !== null && currentSlide !== currentVideoSlide) {
      currentVideoSlide = null;
      resumeAutoplay();
    }
  });

  // Handle slide change transition end to ensure proper state
  swiper.on('slideChangeTransitionEnd', function () {
    // Double-check that videos are properly reset
    resetVideoState();
  });
});

var swiper = new Swiper(".business-swiper", {
  spaceBetween: 35,
  loop: true,
  autoplay: {
    delay: 5500,
    disableOnInteraction: false,
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  centeredSlides: false,
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    568: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1020: {
      slidesPerView: 3,
    },
  },
});

var partnersSolutionsSwiper = new Swiper(".partners-solutions-swiper", {
  spaceBetween: 35,
  loop: true,
  autoplay: {
    delay: 5500,
    disableOnInteraction: false,
  },

  navigation: {
    nextEl: ".partners_solution_sec .swiper-button-next",
    prevEl: ".partners_solution_sec .swiper-button-prev",
  },
  centeredSlides: false,
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    568: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1020: {
      slidesPerView: 3,
    },
  },
});



var swiper = new Swiper(".why-choosen-swiper", {
  spaceBetween: 34,
  loop: true,
  autoplay: {
    delay: 5500,
    disableOnInteraction: false,
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  centeredSlides: false,
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    568: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1020: {
      slidesPerView: 4,
    },
  },
});


// aos animation
AOS.init({
  easing: "ease",
  duration: 800,
  // once: true,
});


let scrollRef = 0;
jQuery(window).on("resize scroll", function () {
  // increase value up to 10, then refresh AOS
  scrollRef <= 10 ? scrollRef++ : AOS.refresh();
});


jQuery('.counter').counterUp({
  delay: 10,
  time: 1000
});


 


