/**
 * Lightbox Keyboard Accessibility Fix
 * Adds proper keyboard navigation to all lightboxes
 * January 24, 2026
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLightboxKeyboard);
    } else {
        initLightboxKeyboard();
    }

    function initLightboxKeyboard() {
        // Find all lightbox elements
        const lightboxes = document.querySelectorAll('.gallery-lightbox, .interior-lightbox, .mobilhaus-lightbox');

        lightboxes.forEach(lightbox => {
            const closeBtn = lightbox.querySelector('.lightbox-close');
            const prevBtn = lightbox.querySelector('.lightbox-prev');
            const nextBtn = lightbox.querySelector('.lightbox-next');

            // Ensure buttons are keyboard accessible
            if (closeBtn) {
                makeButtonAccessible(closeBtn);
                closeBtn.setAttribute('aria-label', 'Close lightbox');
            }

            if (prevBtn) {
                makeButtonAccessible(prevBtn);
                prevBtn.setAttribute('aria-label', 'Previous image');
            }

            if (nextBtn) {
                makeButtonAccessible(nextBtn);
                nextBtn.setAttribute('aria-label', 'Next image');
            }

            // Global keyboard navigation when lightbox is open
            lightbox.addEventListener('keydown', function(e) {
                if (!lightbox.classList.contains('active')) return;

                switch(e.key) {
                    case 'Escape':
                        if (closeBtn) closeBtn.click();
                        break;
                    case 'ArrowLeft':
                        if (prevBtn) prevBtn.click();
                        e.preventDefault();
                        break;
                    case 'ArrowRight':
                        if (nextBtn) nextBtn.click();
                        e.preventDefault();
                        break;
                    case 'Home':
                        // Go to first image
                        if (prevBtn) {
                            // Click prev until we can't anymore
                            let count = 0;
                            while (count < 100) { // Safety limit
                                prevBtn.click();
                                count++;
                            }
                        }
                        e.preventDefault();
                        break;
                    case 'End':
                        // Go to last image
                        if (nextBtn) {
                            // Click next until we can't anymore
                            let count = 0;
                            while (count < 100) { // Safety limit
                                nextBtn.click();
                                count++;
                            }
                        }
                        e.preventDefault();
                        break;
                }
            });

            // Focus management - trap focus inside lightbox
            lightbox.addEventListener('keydown', function(e) {
                if (!lightbox.classList.contains('active')) return;

                if (e.key === 'Tab') {
                    const focusableElements = lightbox.querySelectorAll(
                        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
                    );

                    if (focusableElements.length === 0) return;

                    const firstElement = focusableElements[0];
                    const lastElement = focusableElements[focusableElements.length - 1];

                    if (e.shiftKey) {
                        // Shift + Tab
                        if (document.activeElement === firstElement) {
                            lastElement.focus();
                            e.preventDefault();
                        }
                    } else {
                        // Tab
                        if (document.activeElement === lastElement) {
                            firstElement.focus();
                            e.preventDefault();
                        }
                    }
                }
            });

            // When lightbox opens, focus the close button
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        if (lightbox.classList.contains('active')) {
                            // Lightbox opened
                            if (closeBtn) {
                                closeBtn.focus();
                            }
                            // Set aria-hidden on body content
                            document.body.setAttribute('aria-hidden', 'true');
                            lightbox.setAttribute('aria-hidden', 'false');
                        } else {
                            // Lightbox closed
                            document.body.removeAttribute('aria-hidden');
                            lightbox.setAttribute('aria-hidden', 'true');
                        }
                    }
                });
            });

            observer.observe(lightbox, { attributes: true });

            // Set initial aria-hidden
            lightbox.setAttribute('aria-hidden', 'true');
            lightbox.setAttribute('role', 'dialog');
            lightbox.setAttribute('aria-modal', 'true');
        });
    }

    /**
     * Make a button keyboard accessible
     */
    function makeButtonAccessible(button) {
        // Ensure it's focusable
        if (!button.hasAttribute('tabindex')) {
            button.setAttribute('tabindex', '0');
        }

        // Add keyboard event listener if it has onclick
        if (button.hasAttribute('onclick')) {
            const onclickCode = button.getAttribute('onclick');

            button.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    // Execute the onclick
                    button.click();
                }
            });
        }

        // Ensure it has role=button if it's not a real button
        if (button.tagName.toLowerCase() !== 'button' && !button.hasAttribute('role')) {
            button.setAttribute('role', 'button');
        }
    }

    /**
     * Add keyboard support to filter buttons
     */
    const filterButtons = document.querySelectorAll('.filter-btn, .plan-btn, .color-btn');
    filterButtons.forEach(btn => {
        makeButtonAccessible(btn);

        // Add arrow key navigation for filter groups
        btn.addEventListener('keydown', function(e) {
            const container = btn.closest('.gallery-filters, .models-filters, .color-buttons, .plan-controls');
            if (!container) return;

            const buttons = Array.from(container.querySelectorAll('.filter-btn, .plan-btn, .color-btn'));
            const currentIndex = buttons.indexOf(btn);

            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                e.preventDefault();
                const nextIndex = (currentIndex + 1) % buttons.length;
                buttons[nextIndex].focus();
            } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                e.preventDefault();
                const prevIndex = (currentIndex - 1 + buttons.length) % buttons.length;
                buttons[prevIndex].focus();
            }
        });
    });

    /**
     * Gallery expand buttons
     */
    const expandButtons = document.querySelectorAll('.gallery-expand');
    expandButtons.forEach(btn => {
        makeButtonAccessible(btn);
    });

    /**
     * Screen reader announcements
     */
    function announce(message) {
        const announcer = document.getElementById('sr-announcer') || createAnnouncer();
        announcer.textContent = message;
    }

    function createAnnouncer() {
        const announcer = document.createElement('div');
        announcer.id = 'sr-announcer';
        announcer.setAttribute('aria-live', 'polite');
        announcer.setAttribute('aria-atomic', 'true');
        announcer.style.position = 'absolute';
        announcer.style.left = '-10000px';
        announcer.style.width = '1px';
        announcer.style.height = '1px';
        announcer.style.overflow = 'hidden';
        document.body.appendChild(announcer);
        return announcer;
    }

    // Export announce function globally
    window.wohnegruenAnnounce = announce;

})();
