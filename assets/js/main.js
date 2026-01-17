/**
 * WohneGrün Theme JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Hamburger Menu Toggle
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    const body = document.body;

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function() {
            const isActive = hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            body.classList.toggle('menu-open');

            // Update ARIA attributes for accessibility
            hamburger.setAttribute('aria-expanded', isActive ? 'true' : 'false');
            hamburger.setAttribute('aria-label', isActive ? 'Menü schließen' : 'Menü öffnen');
        });

        // Close menu when clicking on a link
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
                body.classList.remove('menu-open');
                hamburger.setAttribute('aria-expanded', 'false');
                hamburger.setAttribute('aria-label', 'Menü öffnen');
            });
        });
    }

    // Smooth scroll for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const navHeight = document.querySelector('.site-navigation').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Navigation background on scroll
    const navigation = document.querySelector('.site-navigation');
    if (navigation) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                navigation.classList.add('scrolled');
            } else {
                navigation.classList.remove('scrolled');
            }
        });
    }

    // Animate elements on scroll
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll('.feature-card, .model-card, .section-header');
    animateElements.forEach(function(el) {
        observer.observe(el);
    });

    // Gallery functionality
    initGallery();

    // Gallery Full Page (new template)
    initGalleryFull();

    // Floor Plans Lightbox
    initFloorPlanLightbox();

    // Archive filtering
    initArchiveFilters();

    // Model tabs and color sliders
    initModelTabs();
    initColorSliders();
});

/**
 * Gallery filtering and lightbox
 */
function initGallery() {
    const filterButtons = document.querySelectorAll('.gallery-filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxCounter = document.getElementById('lightbox-counter');
    const lightboxClose = document.querySelector('.lightbox-close');
    const lightboxPrev = document.querySelector('.lightbox-prev');
    const lightboxNext = document.querySelector('.lightbox-next');

    if (!filterButtons.length || !galleryItems.length) return;

    let currentFilter = 'all';
    let currentIndex = 0;
    let filteredItems = [];

    // Filter functionality
    filterButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            currentFilter = filter;

            // Update active button
            filterButtons.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');

            // Filter items
            galleryItems.forEach(function(item) {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });

            updateFilteredItems();
        });
    });

    function updateFilteredItems() {
        filteredItems = Array.from(galleryItems).filter(function(item) {
            return !item.classList.contains('hidden');
        });
    }

    updateFilteredItems();

    // Lightbox functionality
    if (!lightbox) return;

    galleryItems.forEach(function(item) {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            const title = this.querySelector('.gallery-item-title');

            currentIndex = filteredItems.indexOf(this);
            openLightbox(img.src, title ? title.textContent : '');
        });
    });

    function openLightbox(src, title) {
        lightboxImage.src = src;
        lightboxTitle.textContent = title;
        lightboxCounter.textContent = (currentIndex + 1) + ' / ' + filteredItems.length;
        lightbox.classList.add('active');
        document.body.classList.add('menu-open');
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.classList.remove('menu-open');
    }

    function showPrevious() {
        currentIndex = currentIndex === 0 ? filteredItems.length - 1 : currentIndex - 1;
        updateLightboxContent();
    }

    function showNext() {
        currentIndex = currentIndex === filteredItems.length - 1 ? 0 : currentIndex + 1;
        updateLightboxContent();
    }

    function updateLightboxContent() {
        const item = filteredItems[currentIndex];
        const img = item.querySelector('img');
        const title = item.querySelector('.gallery-item-title');

        lightboxImage.src = img.src;
        lightboxTitle.textContent = title ? title.textContent : '';
        lightboxCounter.textContent = (currentIndex + 1) + ' / ' + filteredItems.length;
    }

    if (lightboxClose) {
        lightboxClose.addEventListener('click', closeLightbox);
    }

    if (lightboxPrev) {
        lightboxPrev.addEventListener('click', function(e) {
            e.stopPropagation();
            showPrevious();
        });
    }

    if (lightboxNext) {
        lightboxNext.addEventListener('click', function(e) {
            e.stopPropagation();
            showNext();
        });
    }

    // Close on background click
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('active')) return;

        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            showPrevious();
        } else if (e.key === 'ArrowRight') {
            showNext();
        }
    });
}

/**
 * Archive Filtering for Mobilhaus Models
 */
function initArchiveFilters() {
    const sizeFilter = document.getElementById('filter-size');
    const priceFilter = document.getElementById('filter-price');
    const resetBtn = document.getElementById('filter-reset');
    const modelCards = document.querySelectorAll('.model-card');

    if (!sizeFilter || !priceFilter || !modelCards.length) return;

    function filterModels() {
        const sizeValue = sizeFilter.value;
        const priceValue = priceFilter.value;

        let visibleCount = 0;

        modelCards.forEach(function(card) {
            const cardSize = card.getAttribute('data-size');
            const cardPrice = card.getAttribute('data-price');

            const sizeMatch = sizeValue === 'alle' || cardSize === sizeValue;
            const priceMatch = priceValue === 'alle' || cardPrice === priceValue;

            if (sizeMatch && priceMatch) {
                card.style.display = 'block';
                // Add fade-in animation
                setTimeout(function() {
                    card.style.opacity = '1';
                }, 10);
                visibleCount++;
            } else {
                card.style.opacity = '0';
                setTimeout(function() {
                    card.style.display = 'none';
                }, 300);
            }
        });

        // Show "no results" message if needed
        showNoResultsMessage(visibleCount);
    }

    function showNoResultsMessage(visibleCount) {
        let noResultsMsg = document.querySelector('.no-results-message');

        if (visibleCount === 0) {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('div');
                noResultsMsg.className = 'no-results-message';
                noResultsMsg.innerHTML = '<p>Keine Modelle entsprechen Ihren Filterkriterien. Bitte versuchen Sie es mit anderen Filtern.</p>';

                const modelsGrid = document.querySelector('.models-grid');
                if (modelsGrid && modelsGrid.parentNode) {
                    modelsGrid.parentNode.insertBefore(noResultsMsg, modelsGrid.nextSibling);
                }
            }
            noResultsMsg.style.display = 'block';
        } else {
            if (noResultsMsg) {
                noResultsMsg.style.display = 'none';
            }
        }
    }

    function resetFilters() {
        sizeFilter.value = 'alle';
        priceFilter.value = 'alle';
        filterModels();
    }

    // Event listeners
    if (sizeFilter) {
        sizeFilter.addEventListener('change', filterModels);
    }

    if (priceFilter) {
        priceFilter.addEventListener('change', filterModels);
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            e.preventDefault();
            resetFilters();
        });
    }

    // Set initial card opacity for animations
    modelCards.forEach(function(card) {
        card.style.transition = 'opacity 0.3s ease';
        card.style.opacity = '1';
    });
}

/**
 * Gallery Full Page - Lightbox and Filtering
 */
function initGalleryFull() {
    const filterButtons = document.querySelectorAll('.gallery-filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item-full');
    const lightbox = document.getElementById('gallery-lightbox-full');
    const lightboxImage = document.getElementById('lightbox-image-full');
    const lightboxTitle = document.getElementById('lightbox-title-full');
    const lightboxCounter = document.getElementById('lightbox-counter-full');
    const lightboxClose = lightbox ? lightbox.querySelector('.lightbox-close') : null;
    const lightboxPrev = lightbox ? lightbox.querySelector('.lightbox-prev') : null;
    const lightboxNext = lightbox ? lightbox.querySelector('.lightbox-next') : null;

    if (!galleryItems.length) return;

    let currentFilter = 'all';
    let currentIndex = 0;
    let filteredItems = [];

    // Filter functionality
    filterButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            currentFilter = filter;

            // Update active button
            filterButtons.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');

            // Filter items
            galleryItems.forEach(function(item) {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    setTimeout(function() {
                        item.style.opacity = '1';
                    }, 10);
                } else {
                    item.style.opacity = '0';
                    setTimeout(function() {
                        item.style.display = 'none';
                    }, 300);
                }
            });

            updateFilteredItems();
        });
    });

    function updateFilteredItems() {
        filteredItems = Array.from(galleryItems).filter(function(item) {
            return item.style.display !== 'none';
        });
    }

    // Initialize filtered items
    galleryItems.forEach(function(item) {
        item.style.transition = 'opacity 0.3s ease';
        item.style.opacity = '1';
    });
    updateFilteredItems();

    // Lightbox functionality
    if (!lightbox) return;

    galleryItems.forEach(function(item, index) {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            const fullSrc = img.getAttribute('data-full') || img.src;
            const title = img.alt || '';

            // Find index in filtered items
            currentIndex = filteredItems.indexOf(this);
            openLightboxFull(fullSrc, title);
        });
    });

    function openLightboxFull(src, title) {
        lightboxImage.src = src;
        lightboxTitle.textContent = title;
        lightboxCounter.textContent = (currentIndex + 1) + ' / ' + filteredItems.length;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightboxFull() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function showPreviousFull() {
        currentIndex = currentIndex === 0 ? filteredItems.length - 1 : currentIndex - 1;
        updateLightboxContentFull();
    }

    function showNextFull() {
        currentIndex = currentIndex === filteredItems.length - 1 ? 0 : currentIndex + 1;
        updateLightboxContentFull();
    }

    function updateLightboxContentFull() {
        const item = filteredItems[currentIndex];
        const img = item.querySelector('img');
        const fullSrc = img.getAttribute('data-full') || img.src;
        const title = img.alt || '';

        lightboxImage.src = fullSrc;
        lightboxTitle.textContent = title;
        lightboxCounter.textContent = (currentIndex + 1) + ' / ' + filteredItems.length;
    }

    if (lightboxClose) {
        lightboxClose.addEventListener('click', closeLightboxFull);
    }

    if (lightboxPrev) {
        lightboxPrev.addEventListener('click', function(e) {
            e.stopPropagation();
            showPreviousFull();
        });
    }

    if (lightboxNext) {
        lightboxNext.addEventListener('click', function(e) {
            e.stopPropagation();
            showNextFull();
        });
    }

    // Close on background click
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            closeLightboxFull();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('active')) return;

        if (e.key === 'Escape') {
            closeLightboxFull();
        } else if (e.key === 'ArrowLeft') {
            showPreviousFull();
        } else if (e.key === 'ArrowRight') {
            showNextFull();
        }
    });

    // Load more button (if needed)
    const loadMoreBtn = document.querySelector('.gallery-load-more');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Placeholder for load more functionality
            // This would typically load more images via AJAX
        });
    }
}

/**
 * Floor Plans - Zoom Lightbox
 */
function initFloorPlanLightbox() {
    const zoomButtons = document.querySelectorAll('.floor-plan-zoom');
    const lightbox = document.getElementById('floor-plan-lightbox');
    const lightboxImage = document.getElementById('floor-plan-lightbox-image');
    const lightboxClose = lightbox ? lightbox.querySelector('.lightbox-close') : null;

    if (!lightbox || !zoomButtons.length) return;

    // Zoom button click
    zoomButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const imageUrl = this.getAttribute('data-image');
            if (imageUrl) {
                openFloorPlanLightbox(imageUrl);
            }
        });
    });

    function openFloorPlanLightbox(src) {
        lightboxImage.src = src;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeFloorPlanLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close button
    if (lightboxClose) {
        lightboxClose.addEventListener('click', closeFloorPlanLightbox);
    }

    // Close on background click
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox || e.target === lightbox.querySelector('.lightbox-content')) {
            closeFloorPlanLightbox();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('active')) return;

        if (e.key === 'Escape') {
            closeFloorPlanLightbox();
        }
    });
}

// Prevent body scroll when mobile menu is open
document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`);
window.addEventListener('resize', function() {
    document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`);
});

/**
 * Contact Form Handler
 */
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('.contact-form');
    
    if (contactForm && typeof wohnegruenContact !== 'undefined') {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Wird gesendet...';
            
            // Prepare form data
            const formData = new FormData(contactForm);
            formData.append('action', 'wohnegruen_contact_form');
            formData.append('nonce', wohnegruenContact.nonce);
            
            // Send AJAX request
            fetch(wohnegruenContact.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Show message
                showNotification(data.data.message, data.success ? 'success' : 'error');
                
                // Reset form if successful
                if (data.success) {
                    contactForm.reset();
                }
                
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            })
            .catch(error => {
                showNotification('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
    
    // Notification function
    function showNotification(message, type) {
        // Remove existing notification
        const existingNotification = document.querySelector('.form-notification');
        if (existingNotification) {
            existingNotification.remove();
        }
        
        // Create notification
        const notification = document.createElement('div');
        notification.className = 'form-notification form-notification-' + type;
        notification.textContent = message;
        
        // Insert after form
        contactForm.parentNode.insertBefore(notification, contactForm.nextSibling);
        
        // Auto remove after 10 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 10000);
    }
});

/**
 * Model Tabs - Switch between Nature and Pure
 */
function initModelTabs() {
    const tabButtons = document.querySelectorAll('.model-tab-btn');
    const modelContents = document.querySelectorAll('.model-content');

    if (!tabButtons.length || !modelContents.length) return;

    tabButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const targetModel = this.getAttribute('data-model');

            // Remove active class from all buttons and contents
            tabButtons.forEach(function(btn) {
                btn.classList.remove('active');
            });
            modelContents.forEach(function(content) {
                content.classList.remove('active');
            });

            // Add active class to clicked button
            this.classList.add('active');

            // Show corresponding model content
            const targetContent = document.getElementById(targetModel + '-content');
            if (targetContent) {
                targetContent.classList.add('active');

                // Scroll to top of content smoothly
                const navHeight = document.querySelector('.site-navigation') ?
                    document.querySelector('.site-navigation').offsetHeight : 0;
                const targetPosition = targetContent.getBoundingClientRect().top +
                    window.pageYOffset - navHeight - 20;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Color Sliders - Gallery carousel for color schemes
 */
function initColorSliders() {
    const sliders = document.querySelectorAll('.color-slider');

    if (!sliders.length) return;

    sliders.forEach(function(slider) {
        const sliderId = slider.id;
        const slides = slider.querySelectorAll('.color-slide');
        const prevBtn = document.querySelector('.slider-nav.prev[data-slider="' + sliderId.replace('-slider', '') + '"]');
        const nextBtn = document.querySelector('.slider-nav.next[data-slider="' + sliderId.replace('-slider', '') + '"]');
        const dotsContainer = document.getElementById(sliderId.replace('-slider', '-dots'));

        if (!slides.length) return;

        let currentSlide = 0;

        // Create dots
        if (dotsContainer) {
            slides.forEach(function(slide, index) {
                const dot = document.createElement('span');
                dot.classList.add('slider-dot');
                if (index === 0) {
                    dot.classList.add('active');
                }
                dot.addEventListener('click', function() {
                    goToSlide(index);
                });
                dotsContainer.appendChild(dot);
            });
        }

        const dots = dotsContainer ? dotsContainer.querySelectorAll('.slider-dot') : [];

        // Show initial slide
        showSlide(currentSlide);

        function showSlide(index) {
            // Hide all slides
            slides.forEach(function(slide) {
                slide.classList.remove('active');
            });

            // Remove active from all dots
            dots.forEach(function(dot) {
                dot.classList.remove('active');
            });

            // Show current slide
            if (slides[index]) {
                slides[index].classList.add('active');
            }

            // Activate current dot
            if (dots[index]) {
                dots[index].classList.add('active');
            }

            currentSlide = index;
        }

        function goToSlide(index) {
            showSlide(index);
        }

        function nextSlide() {
            const next = (currentSlide + 1) % slides.length;
            showSlide(next);
        }

        function prevSlide() {
            const prev = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(prev);
        }

        // Event listeners for navigation buttons
        if (prevBtn) {
            prevBtn.addEventListener('click', function(e) {
                e.preventDefault();
                prevSlide();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                nextSlide();
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            // Only respond if this slider's parent tab is active
            const parentContent = slider.closest('.model-content');
            if (!parentContent || !parentContent.classList.contains('active')) return;

            if (e.key === 'ArrowLeft') {
                prevSlide();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
            }
        });

        // Touch/swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        slider.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        slider.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - next slide
                    nextSlide();
                } else {
                    // Swipe right - previous slide
                    prevSlide();
                }
            }
        }

        // Optional: Auto-advance (commented out by default)
        /*
        let autoAdvance = setInterval(function() {
            nextSlide();
        }, 5000);

        // Pause auto-advance on hover
        slider.addEventListener('mouseenter', function() {
            clearInterval(autoAdvance);
        });

        slider.addEventListener('mouseleave', function() {
            autoAdvance = setInterval(function() {
                nextSlide();
            }, 5000);
        });
        */
    });
}
