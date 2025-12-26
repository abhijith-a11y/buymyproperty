/**
 * Interactive Stacked Slider (About Page)
 * - Left content fades on change
 * - Right stack positions controlled by CSS via data-active on .slides-stack
 * - Prevents simultaneous transitions
 */

(function() {
  document.addEventListener('DOMContentLoaded', function() {
    const slidesStack = document.querySelector('.slides-stack');
    const slideItems = document.querySelectorAll('.slide-item');

    const activeTitle = document.getElementById('active-slide-title');
    const activeDescription = document.getElementById('active-slide-description');
    const activeNumber = document.getElementById('active-slide-number');

    if (!slidesStack || !slideItems.length || !activeTitle || !activeDescription || !activeNumber) {
      return;
    }

    const gs = window.gsap || null;
    let isTransitioning = false;
    let currentSlide = parseInt(slidesStack.getAttribute('data-active') || '1', 10);

    // Initialize classes to match data-active
    function syncClasses() {
      slideItems.forEach((el) => {
        const id = parseInt(el.dataset.slide, 10);
        if (id === currentSlide) {
          el.classList.add('active');
          el.classList.remove('inactive');
        } else {
          el.classList.add('inactive');
          el.classList.remove('active');
        }
      });
    }

    function updateLeftContent(id, title, desc) {
      if (gs) {
        gs.to([activeTitle, activeDescription, activeNumber], { opacity: 0, duration: 0.2, ease: 'power1.out', onComplete: () => {
          activeTitle.textContent = title;
          activeDescription.textContent = desc;
          activeNumber.textContent = String(id).padStart(2, '0');
          gs.to([activeTitle, activeDescription, activeNumber], { opacity: 1, duration: 0.4, ease: 'power1.inOut' });
        }});
      } else {
        activeTitle.style.opacity = '0.2';
        activeDescription.style.opacity = '0.2';
        activeNumber.style.opacity = '0.2';
        setTimeout(() => {
          activeTitle.textContent = title;
          activeDescription.textContent = desc;
          activeNumber.textContent = String(id).padStart(2, '0');
          activeTitle.style.opacity = '1';
          activeDescription.style.opacity = '1';
          activeNumber.style.opacity = '1';
        }, 200);
      }
    }

    function setActive(id) {
      if (isTransitioning || id === currentSlide) return;
      isTransitioning = true;

      const target = document.querySelector(`[data-slide="${id}"]`);
      if (!target) { isTransitioning = false; return; }

      slidesStack.setAttribute('data-active', String(id));
      updateLeftContent(id, target.dataset.title, target.dataset.description);

      // Toggle classes
      slideItems.forEach((el) => {
        el.classList.add('inactive');
        el.classList.remove('active');
      });
      target.classList.add('active');
      target.classList.remove('inactive');

      // Prevent rapid clicks during transition
      slidesStack.style.pointerEvents = 'none';
      setTimeout(() => {
        currentSlide = id;
        slidesStack.style.pointerEvents = '';
        isTransitioning = false;
      }, 600); // matches CSS transition timing feel
    }

    // Setup click handlers
    slideItems.forEach((el) => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        const id = parseInt(el.dataset.slide, 10);
        if (!Number.isNaN(id)) {
          setActive(id);
        }
      });
      el.style.cursor = 'pointer';
    });

    // Initial sync
    slidesStack.setAttribute('data-active', String(currentSlide || 1));
    syncClasses();
  });
})();
