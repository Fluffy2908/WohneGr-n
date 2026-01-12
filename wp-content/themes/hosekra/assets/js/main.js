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
            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            body.classList.toggle('menu-open');
        });

        // Close menu when clicking on a link
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
                body.classList.remove('menu-open');
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

    // Form submission handler
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic form validation
            const nameField = contactForm.querySelector('input[name="name"]');
            const emailField = contactForm.querySelector('input[name="email"]');
            const messageField = contactForm.querySelector('textarea[name="message"]');

            const name = nameField ? nameField.value.trim() : '';
            const email = emailField ? emailField.value.trim() : '';
            const message = messageField ? messageField.value.trim() : '';

            if (!name || !email || !message) {
                alert('Bitte füllen Sie alle Pflichtfelder aus.');
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Bitte geben Sie eine gültige E-Mail-Adresse ein.');
                return;
            }

            // Here you would typically send the form data to a server
            // For now, we'll just show a success message
            alert('Vielen Dank für Ihre Nachricht! Wir werden uns so schnell wie möglich bei Ihnen melden.');
            contactForm.reset();
        });
    }

    // Gallery functionality
    initGallery();

    // Gallery Full Page (new template)
    initGalleryFull();

    // Floor Plans Lightbox
    initFloorPlanLightbox();

    // Archive filtering
    initArchiveFilters();
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

    let currentFilter = 'Alle';
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
                if (filter === 'Alle' || category === filter) {
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
            console.log('Load more images functionality would go here');
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
