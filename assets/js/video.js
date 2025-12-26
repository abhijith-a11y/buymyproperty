// function playVideo(playButton) {
//     const videoContainer = playButton.parentElement;
//     const video = videoContainer.querySelector('video');

//     if (!video) return;

//     if (video.paused) {
//         video.play();
//         videoContainer.classList.add('video_playing');
//     } else {
//         video.pause();
//         videoContainer.classList.remove('video_playing');
//     }
// }

// // Attach one-time listeners to each video
// document.addEventListener('DOMContentLoaded', function () {
//     const videos = document.querySelectorAll('.video_round_sec video');

//     videos.forEach(video => {
//         const videoContainer = video.parentElement;

//         // ✅ Ensure correct class on page load
//         if (!video.paused && !video.ended) {
//             videoContainer.classList.add('video_playing');
//         } else {
//             videoContainer.classList.remove('video_playing');
//         }

//         // ✅ Single listeners for each event
//         video.addEventListener('ended', function () {
//             videoContainer.classList.remove('video_playing');
//         });

//         video.addEventListener('pause', function () {
//             videoContainer.classList.remove('video_playing');
//         });

//         video.addEventListener('play', function () {
//             videoContainer.classList.add('video_playing');
//         });

//         // ✅ Click video to toggle play/pause
//         video.addEventListener('click', function () {
//             const playButton = videoContainer.querySelector('.play_btn');
//             playVideo(playButton);
//         });
//     });
// });

// // ✅ Re-sync video states on window resize/refresh
// window.addEventListener('resize', function () {
//     const videos = document.querySelectorAll('.video_round_sec video');
//     videos.forEach(video => {
//         const videoContainer = video.parentElement;
//         if (!video.paused && !video.ended) {
//             videoContainer.classList.add('video_playing');
//         } else {
//             videoContainer.classList.remove('video_playing');
//         }
//     });
// });
















// ========================
// Video Play + Scroll (Only if page has .scroll_video)
// ========================

function playVideo(playButton) {
    const videoContainer = playButton.parentElement;
    const video = videoContainer.querySelector('video');

    if (!video) return;

    if (video.paused) {
        video.play();
        videoContainer.classList.add('video_playing');

        // ✅ Scroll only if page has "scroll_video" class
        if (document.querySelector(".scroll_video")) {
            smoothScrollTo(videoContainer, 1200, 70); // duration + offset
        }
    } else {
        video.pause();
        videoContainer.classList.remove('video_playing');
    }
}

// ✅ Smooth scroll helper
function smoothScrollTo(element, duration = 800, offset = 0) {
    const start = window.pageYOffset;
    const target = element.getBoundingClientRect().top + start - offset; // ✅ offset applied
    const distance = target - start;
    let startTime = null;

    function animation(currentTime) {
        if (!startTime) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const progress = Math.min(timeElapsed / duration, 1);

        // easeInOutCubic easing
        const ease = progress < 0.5
            ? 4 * progress * progress * progress
            : 1 - Math.pow(-2 * progress + 2, 3) / 2;

        window.scrollTo(0, start + distance * ease);

        if (timeElapsed < duration) {
            requestAnimationFrame(animation);
        }
    }

    requestAnimationFrame(animation);
}

// Attach listeners
document.addEventListener('DOMContentLoaded', function () {
    const videos = document.querySelectorAll('.video_round_sec video');

    videos.forEach(video => {
        const videoContainer = video.parentElement;

        // Ensure correct class on page load
        if (!video.paused && !video.ended) {
            videoContainer.classList.add('video_playing');
        } else {
            videoContainer.classList.remove('video_playing');
        }

        // Listeners
        video.addEventListener('ended', () => videoContainer.classList.remove('video_playing'));
        video.addEventListener('pause', () => videoContainer.classList.remove('video_playing'));
        video.addEventListener('play', () => videoContainer.classList.add('video_playing'));

        // Click video toggles play/pause
        video.addEventListener('click', function () {
            const playButton = videoContainer.querySelector('.play_btn');
            playVideo(playButton);
        });
    });
});

// Re-sync on resize
window.addEventListener('resize', function () {
    const videos = document.querySelectorAll('.video_round_sec video');
    videos.forEach(video => {
        const videoContainer = video.parentElement;
        if (!video.paused && !video.ended) {
            videoContainer.classList.add('video_playing');
        } else {
            videoContainer.classList.remove('video_playing');
        }
    });
});
