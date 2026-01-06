document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Only trigger click logic if screen is below 1200px
            if (window.innerWidth <= 1200) {
                const hasSubmenu = this.nextElementSibling && 
                                   this.nextElementSibling.classList.contains('submenu');

                if (hasSubmenu) {
                    // Prevent the link from navigating so the menu can open
                    e.preventDefault(); 
                    
                    const isActive = this.classList.contains('is-active');

                    // Close other open submenus (Accordion style)
                    navLinks.forEach(other => {
                        other.classList.remove('is-active');
                    });

                    // Toggle current submenu
                    if (!isActive) {
                        this.classList.add('is-active');
                    }
                }
            }
        });
    });
});