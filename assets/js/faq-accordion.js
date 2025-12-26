/**
 * FAQ Accordion Functionality
 * Handles the expand/collapse behavior for FAQ items
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get all FAQ question elements
    const faqQuestions = document.querySelectorAll('.faq_question');
    
    // Add click event listener to each question
    faqQuestions.forEach(function(question) {
        question.addEventListener('click', function() {
            const faqItem = this.closest('.faq_item');
            const isActive = faqItem.classList.contains('active');
            
            // Close all other FAQ items
            document.querySelectorAll('.faq_item').forEach(function(item) {
                if (item !== faqItem) {
                    item.classList.remove('active');
                }
            });
            
            // Toggle current FAQ item
            if (isActive) {
                faqItem.classList.remove('active');
            } else {
                faqItem.classList.add('active');
            }
        });
    });
    
    // Add keyboard accessibility
    faqQuestions.forEach(function(question) {
        // Make questions focusable
        question.setAttribute('tabindex', '0');
        question.setAttribute('role', 'button');
        question.setAttribute('aria-expanded', 'false');
        
        // Add keyboard event listener
        question.addEventListener('keydown', function(e) {
            // Trigger on Enter or Space key
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
    
    // Update aria-expanded attributes when items are toggled
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                const faqItem = mutation.target;
                const question = faqItem.querySelector('.faq_question');
                const isActive = faqItem.classList.contains('active');
                
                if (question) {
                    question.setAttribute('aria-expanded', isActive ? 'true' : 'false');
                }
            }
        });
    });
    
    // Observe all FAQ items for class changes
    document.querySelectorAll('.faq_item').forEach(function(item) {
        observer.observe(item, { attributes: true, attributeFilter: ['class'] });
    });
});
