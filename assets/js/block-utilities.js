/**
 * WohneGrün Block Utilities
 * Reusable JavaScript utilities for ACF block templates
 *
 * @package WohneGruen
 * @version 1.0.0
 */

(function(window) {
    'use strict';

    // Create global namespace
    window.WGBlockUtils = window.WGBlockUtils || {};

    /**
     * 1. TAB SWITCHING UTILITY
     * Handles tab navigation with active state management and ARIA support
     *
     * @param {Object} options Configuration options
     * @param {string} options.container - Selector for the container element
     * @param {string} options.tabSelector - Selector for tab buttons (default: '[data-tab]')
     * @param {string} options.contentSelector - Selector for content panels (default: '[data-tab-content]')
     * @param {string} options.activeClass - Active state class (default: 'active')
     * @param {Function} options.onSwitch - Callback fired after tab switch
     * @param {boolean} options.scrollToContent - Scroll to content after switch (default: false)
     *
     * @example
     * WGBlockUtils.initTabSwitching({
     *   container: '#my-block',
     *   onSwitch: function(tabId, tabElement) {
     *     console.log('Switched to tab:', tabId);
     *   }
     * });
     */
    WGBlockUtils.initTabSwitching = function(options) {
        const config = {
            container: null,
            tabSelector: '[data-tab]',
            contentSelector: '[data-tab-content]',
            activeClass: 'active',
            onSwitch: null,
            scrollToContent: false,
            ...options
        };

        if (!config.container) {
            console.error('WGBlockUtils.initTabSwitching: container is required');
            return;
        }

        const container = typeof config.container === 'string'
            ? document.querySelector(config.container)
            : config.container;

        if (!container) return;

        const tabs = container.querySelectorAll(config.tabSelector);
        const contents = container.querySelectorAll(config.contentSelector);

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const tabId = this.dataset.tab;

                // Update active tabs
                tabs.forEach(t => {
                    t.classList.remove(config.activeClass);
                    if (t.hasAttribute('aria-selected')) {
                        t.setAttribute('aria-selected', 'false');
                    }
                });
                this.classList.add(config.activeClass);
                if (this.hasAttribute('aria-selected')) {
                    this.setAttribute('aria-selected', 'true');
                }

                // Show corresponding content
                contents.forEach(content => {
                    const contentId = content.dataset.tabContent;
                    if (contentId === tabId) {
                        content.classList.add(config.activeClass);
                        content.style.display = '';
                        if (content.hasAttribute('aria-hidden')) {
                            content.setAttribute('aria-hidden', 'false');
                        }
                    } else {
                        content.classList.remove(config.activeClass);
                        content.style.display = 'none';
                        if (content.hasAttribute('aria-hidden')) {
                            content.setAttribute('aria-hidden', 'true');
                        }
                    }
                });

                // Scroll to content if enabled
                if (config.scrollToContent) {
                    const activeContent = container.querySelector(`${config.contentSelector}[data-tab-content="${tabId}"]`);
                    if (activeContent) {
                        activeContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }

                // Fire callback
                if (typeof config.onSwitch === 'function') {
                    config.onSwitch(tabId, this);
                }
            });
        });
    };

    /**
     * 2. THUMBNAIL NAVIGATION UTILITY
     * Handles thumbnail click events for image switching with fade effect
     *
     * @param {Object} options Configuration options
     * @param {string} options.container - Selector for the container element
     * @param {string} options.thumbnailSelector - Selector for thumbnails (default: '[data-image]')
     * @param {string} options.mainImageSelector - Selector for main image (default: '.main-image img')
     * @param {string} options.activeClass - Active thumbnail class (default: 'active')
     * @param {number} options.fadeDuration - Fade duration in ms (default: 200)
     * @param {Function} options.onSwitch - Callback fired after image switch
     *
     * @example
     * WGBlockUtils.initThumbnailNavigation({
     *   container: '.gallery',
     *   mainImageSelector: '.main-image img'
     * });
     */
    WGBlockUtils.initThumbnailNavigation = function(options) {
        const config = {
            container: null,
            thumbnailSelector: '[data-image]',
            mainImageSelector: '.main-image img',
            activeClass: 'active',
            fadeDuration: 200,
            onSwitch: null,
            ...options
        };

        if (!config.container) {
            console.error('WGBlockUtils.initThumbnailNavigation: container is required');
            return;
        }

        const container = typeof config.container === 'string'
            ? document.querySelector(config.container)
            : config.container;

        if (!container) return;

        const thumbnails = container.querySelectorAll(config.thumbnailSelector);

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newSrc = this.dataset.image;
                const gallery = this.closest(config.container);
                const mainImage = gallery ? gallery.querySelector(config.mainImageSelector) : null;

                if (!mainImage || !newSrc) return;

                // Update active thumbnail
                const siblings = this.parentElement.querySelectorAll(config.thumbnailSelector);
                siblings.forEach(t => t.classList.remove(config.activeClass));
                this.classList.add(config.activeClass);

                // Update main image with fade effect
                mainImage.style.opacity = '0';
                mainImage.style.transition = `opacity ${config.fadeDuration}ms ease`;

                setTimeout(() => {
                    mainImage.src = newSrc;
                    mainImage.style.opacity = '1';

                    // Fire callback
                    if (typeof config.onSwitch === 'function') {
                        config.onSwitch(newSrc, this);
                    }
                }, config.fadeDuration);
            });
        });
    };

    /**
     * 3. LIGHTBOX UTILITY
     * Image lightbox with navigation, keyboard support, and accessibility
     *
     * @param {Object} options Configuration options
     * @param {string} options.lightboxId - ID of the lightbox element (required)
     * @param {Array} options.images - Array of image URLs
     * @param {number} options.startIndex - Starting image index (default: 0)
     * @param {Function} options.onOpen - Callback fired when lightbox opens
     * @param {Function} options.onClose - Callback fired when lightbox closes
     * @param {Function} options.onNavigate - Callback fired on navigation
     *
     * @returns {Object} Lightbox controller with methods: open, close, navigate, destroy
     *
     * @example
     * const lightbox = WGBlockUtils.createLightbox({
     *   lightboxId: 'my-lightbox',
     *   images: ['img1.jpg', 'img2.jpg', 'img3.jpg']
     * });
     * lightbox.open(0); // Open at first image
     */
    WGBlockUtils.createLightbox = function(options) {
        const config = {
            lightboxId: null,
            images: [],
            startIndex: 0,
            onOpen: null,
            onClose: null,
            onNavigate: null,
            ...options
        };

        if (!config.lightboxId) {
            console.error('WGBlockUtils.createLightbox: lightboxId is required');
            return null;
        }

        const lightbox = document.getElementById(config.lightboxId);
        if (!lightbox) {
            console.error(`WGBlockUtils.createLightbox: lightbox element #${config.lightboxId} not found`);
            return null;
        }

        const img = lightbox.querySelector('.lightbox-content, .lightbox-image, img');
        const counter = lightbox.querySelector('.lightbox-counter');
        const closeBtn = lightbox.querySelector('.lightbox-close');
        const prevBtn = lightbox.querySelector('.lightbox-prev, .lightbox-nav-prev');
        const nextBtn = lightbox.querySelector('.lightbox-next, .lightbox-nav-next');

        let currentIndex = config.startIndex;
        let images = config.images;
        let keyboardHandler = null;

        // Controller object
        const controller = {
            open: function(index) {
                if (index !== undefined) {
                    currentIndex = index;
                }

                if (!images[currentIndex]) return;

                // Update image and counter
                if (img) {
                    img.src = images[currentIndex];
                    img.alt = `Image ${currentIndex + 1} of ${images.length}`;
                }
                if (counter) {
                    counter.textContent = `${currentIndex + 1} / ${images.length}`;
                }

                // Show lightbox
                lightbox.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                lightbox.setAttribute('aria-hidden', 'false');

                // Setup keyboard handler
                controller.enableKeyboard();

                // Fire callback
                if (typeof config.onOpen === 'function') {
                    config.onOpen(currentIndex, images[currentIndex]);
                }
            },

            close: function() {
                lightbox.style.display = 'none';
                document.body.style.overflow = '';
                lightbox.setAttribute('aria-hidden', 'true');

                // Remove keyboard handler
                controller.disableKeyboard();

                // Fire callback
                if (typeof config.onClose === 'function') {
                    config.onClose();
                }
            },

            navigate: function(direction) {
                currentIndex += direction;

                // Wrap around
                if (currentIndex < 0) {
                    currentIndex = images.length - 1;
                } else if (currentIndex >= images.length) {
                    currentIndex = 0;
                }

                // Update display
                if (img) {
                    img.src = images[currentIndex];
                    img.alt = `Image ${currentIndex + 1} of ${images.length}`;
                }
                if (counter) {
                    counter.textContent = `${currentIndex + 1} / ${images.length}`;
                }

                // Fire callback
                if (typeof config.onNavigate === 'function') {
                    config.onNavigate(currentIndex, images[currentIndex]);
                }
            },

            setImages: function(newImages, startIndex = 0) {
                images = newImages;
                currentIndex = startIndex;
            },

            getCurrentIndex: function() {
                return currentIndex;
            },

            getImages: function() {
                return images;
            },

            enableKeyboard: function() {
                if (keyboardHandler) return; // Already enabled

                keyboardHandler = function(e) {
                    if (lightbox.style.display !== 'flex') return;

                    switch(e.key) {
                        case 'Escape':
                            controller.close();
                            break;
                        case 'ArrowLeft':
                            controller.navigate(-1);
                            break;
                        case 'ArrowRight':
                            controller.navigate(1);
                            break;
                    }
                };

                document.addEventListener('keydown', keyboardHandler);
            },

            disableKeyboard: function() {
                if (keyboardHandler) {
                    document.removeEventListener('keydown', keyboardHandler);
                    keyboardHandler = null;
                }
            },

            destroy: function() {
                controller.disableKeyboard();
                if (closeBtn) closeBtn.removeEventListener('click', controller.close);
                if (prevBtn) prevBtn.removeEventListener('click', () => controller.navigate(-1));
                if (nextBtn) nextBtn.removeEventListener('click', () => controller.navigate(1));
                lightbox.removeEventListener('click', handleBackdropClick);
            }
        };

        // Setup event listeners
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                controller.close();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                controller.navigate(-1);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                controller.navigate(1);
            });
        }

        // Close on backdrop click
        function handleBackdropClick(e) {
            if (e.target === lightbox) {
                controller.close();
            }
        }
        lightbox.addEventListener('click', handleBackdropClick);

        return controller;
    };

    /**
     * 4. SIMPLE LIGHTBOX OPENER
     * Opens a lightbox with a single image or caption
     *
     * @param {string} lightboxId - ID of the lightbox element
     * @param {string} imageUrl - URL of the image to display
     * @param {string} caption - Optional caption text
     *
     * @example
     * WGBlockUtils.openSimpleLightbox('floorplan-lightbox-123', 'image.jpg', '2D Floor Plan');
     */
    WGBlockUtils.openSimpleLightbox = function(lightboxId, imageUrl, caption) {
        const lightbox = document.getElementById(lightboxId);
        if (!lightbox) return;

        const img = lightbox.querySelector('.lightbox-content, .lightbox-image, img');
        const captionEl = lightbox.querySelector('.lightbox-caption');

        if (img) {
            img.src = imageUrl;
        }

        if (captionEl && caption) {
            captionEl.textContent = caption;
        }

        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    };

    /**
     * 5. SIMPLE LIGHTBOX CLOSER
     * Closes a lightbox by ID
     *
     * @param {string} lightboxId - ID of the lightbox element
     *
     * @example
     * WGBlockUtils.closeSimpleLightbox('floorplan-lightbox-123');
     */
    WGBlockUtils.closeSimpleLightbox = function(lightboxId) {
        const lightbox = document.getElementById(lightboxId);
        if (!lightbox) return;

        lightbox.style.display = 'none';
        document.body.style.overflow = '';
    };

    /**
     * 6. COLOR/IMAGE TOGGLE UTILITY
     * Switches between color variants with active state and ARIA support
     *
     * @param {Object} options Configuration options
     * @param {string} options.container - Selector for the container element
     * @param {string} options.toggleSelector - Selector for toggle buttons (default: '[data-color], [data-variant]')
     * @param {string} options.contentSelector - Selector for content panels (default: '[data-color-gallery], [data-variant-content]')
     * @param {string} options.activeClass - Active state class (default: 'active')
     * @param {Function} options.onToggle - Callback fired after toggle
     *
     * @example
     * WGBlockUtils.initColorToggle({
     *   container: '.exterior-colors-section',
     *   toggleSelector: '.color-toggle-btn',
     *   contentSelector: '.exterior-gallery'
     * });
     */
    WGBlockUtils.initColorToggle = function(options) {
        const config = {
            container: null,
            toggleSelector: '[data-color], [data-variant]',
            contentSelector: '[data-color-gallery], [data-variant-content]',
            activeClass: 'active',
            onToggle: null,
            ...options
        };

        if (!config.container) {
            console.error('WGBlockUtils.initColorToggle: container is required');
            return;
        }

        const container = typeof config.container === 'string'
            ? document.querySelector(config.container)
            : config.container;

        if (!container) return;

        const toggles = container.querySelectorAll(config.toggleSelector);
        const contents = container.querySelectorAll(config.contentSelector);

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const colorId = this.dataset.color || this.dataset.variant;

                // Update active toggle and ARIA attributes
                toggles.forEach(t => {
                    t.classList.remove(config.activeClass);
                    if (t.hasAttribute('aria-selected')) {
                        t.setAttribute('aria-selected', 'false');
                    }
                });
                this.classList.add(config.activeClass);
                if (this.hasAttribute('aria-selected')) {
                    this.setAttribute('aria-selected', 'true');
                }

                // Show corresponding content with ARIA
                contents.forEach(content => {
                    const contentId = content.dataset.colorGallery || content.dataset.variantContent;
                    if (contentId === colorId) {
                        content.classList.add(config.activeClass);
                        if (content.hasAttribute('aria-hidden')) {
                            content.setAttribute('aria-hidden', 'false');
                        }
                    } else {
                        content.classList.remove(config.activeClass);
                        if (content.hasAttribute('aria-hidden')) {
                            content.setAttribute('aria-hidden', 'true');
                        }
                    }
                });

                // Fire callback
                if (typeof config.onToggle === 'function') {
                    config.onToggle(colorId, this);
                }
            });
        });
    };

    /**
     * 7. GALLERY GRID LIGHTBOX HELPER
     * Setup click handlers for gallery grid items to open lightbox
     *
     * @param {Object} options Configuration options
     * @param {string} options.container - Selector for the container element
     * @param {string} options.itemSelector - Selector for gallery items (default: '.gallery-item')
     * @param {Object} options.lightbox - Lightbox controller object (from createLightbox)
     * @param {Function} options.getImageUrl - Function to extract image URL from item element
     *
     * @example
     * const lightbox = WGBlockUtils.createLightbox({...});
     * WGBlockUtils.setupGalleryGrid({
     *   container: '.variant-gallery-grid',
     *   lightbox: lightbox,
     *   getImageUrl: function(item, index) {
     *     return item.querySelector('img').dataset.fullsize;
     *   }
     * });
     */
    WGBlockUtils.setupGalleryGrid = function(options) {
        const config = {
            container: null,
            itemSelector: '.gallery-item',
            lightbox: null,
            getImageUrl: null,
            ...options
        };

        if (!config.container || !config.lightbox) {
            console.error('WGBlockUtils.setupGalleryGrid: container and lightbox are required');
            return;
        }

        const container = typeof config.container === 'string'
            ? document.querySelector(config.container)
            : config.container;

        if (!container) return;

        const items = container.querySelectorAll(config.itemSelector);

        // Collect images
        const images = [];
        items.forEach((item, index) => {
            let imageUrl;
            if (typeof config.getImageUrl === 'function') {
                imageUrl = config.getImageUrl(item, index);
            } else {
                const img = item.querySelector('img');
                imageUrl = img ? (img.dataset.fullsize || img.src) : null;
            }
            if (imageUrl) {
                images.push(imageUrl);
            }
        });

        // Update lightbox images
        config.lightbox.setImages(images);

        // Setup click handlers
        items.forEach((item, index) => {
            item.addEventListener('click', function() {
                config.lightbox.open(index);
            });
        });
    };

    /**
     * 8. AUTO-INIT HELPER
     * Automatically initializes block utilities based on data attributes
     *
     * Usage: Add data-wg-block-init attribute to containers
     *
     * Examples:
     * <div data-wg-block-init="tab-switching" data-wg-tab-selector=".tab">
     * <div data-wg-block-init="thumbnail-nav" data-wg-main-image=".main img">
     * <div data-wg-block-init="color-toggle">
     *
     * @example
     * // In your block template or main.js:
     * document.addEventListener('DOMContentLoaded', function() {
     *   WGBlockUtils.autoInit();
     * });
     */
    WGBlockUtils.autoInit = function() {
        // Tab Switching
        document.querySelectorAll('[data-wg-block-init="tab-switching"]').forEach(container => {
            WGBlockUtils.initTabSwitching({
                container: container,
                tabSelector: container.dataset.wgTabSelector || '[data-tab]',
                contentSelector: container.dataset.wgContentSelector || '[data-tab-content]',
                scrollToContent: container.dataset.wgScrollToContent === 'true'
            });
        });

        // Thumbnail Navigation
        document.querySelectorAll('[data-wg-block-init="thumbnail-nav"]').forEach(container => {
            WGBlockUtils.initThumbnailNavigation({
                container: container,
                thumbnailSelector: container.dataset.wgThumbnailSelector || '[data-image]',
                mainImageSelector: container.dataset.wgMainImage || '.main-image img'
            });
        });

        // Color Toggle
        document.querySelectorAll('[data-wg-block-init="color-toggle"]').forEach(container => {
            WGBlockUtils.initColorToggle({
                container: container,
                toggleSelector: container.dataset.wgToggleSelector || '[data-color]',
                contentSelector: container.dataset.wgContentSelector || '[data-color-gallery]'
            });
        });
    };

    // Auto-initialize on DOM ready (if enabled via global flag)
    if (window.WG_AUTO_INIT_BLOCKS !== false) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', WGBlockUtils.autoInit);
        } else {
            WGBlockUtils.autoInit();
        }
    }

})(window);
