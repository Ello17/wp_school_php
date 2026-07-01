function showSidebar() {
    const sidebar = document.querySelector(".sidebar");
    sidebar.classList.add("active");
}

function hideSidebar() {
    const sidebar = document.querySelector(".sidebar");
    sidebar.classList.remove("active");
}

// ===== ANIMASI COUNTER STATISTIK =====
function animateCounter(element, target, duration) {
    let start = 0;
    const increment = target / 60;
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            start = target;
            clearInterval(timer);
        }
        // Jika target lebih dari 100, tampilkan tanpa koma
        if (target > 100) {
            element.textContent = Math.floor(start).toLocaleString();
        } else {
            element.textContent = Math.floor(start) + '%';
        }
    }, duration / 60);
}

// Observer untuk memulai animasi counter saat elemen terlihat
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const numberElement = entry.target;
            const target = parseInt(numberElement.getAttribute('data-target'));
            if (target > 0) {
                animateCounter(numberElement, target, 2000);
            }
            statsObserver.unobserve(numberElement);
        }
    });
}, { threshold: 0.3 });

// Daftarkan semua elemen statistik untuk diobservasi
document.addEventListener('DOMContentLoaded', () => {
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(el => statsObserver.observe(el));
});

// ===== TESTIMONIAL SLIDER =====
let currentSlide = 0;
let totalSlides = 0;
let slideInterval;
let isTransitioning = false;
let cardsPerView = 3;

function getCardsPerView() {
    if (window.innerWidth <= 768) {
        return 1;
    } else if (window.innerWidth <= 1024) {
        return 2;
    }
    return 3;
}

function updateTestimonials(animate = true) {
    const slider = document.getElementById('testimonialSlider');
    if (!slider) return;
    
    const cards = slider.querySelectorAll('.testimonial-card');
    const dots = document.querySelectorAll('.testimonial-dots span');
    totalSlides = cards.length;
    cardsPerView = getCardsPerView();
    
    // Hitung max slide
    const maxSlide = Math.max(0, totalSlides - cardsPerView);
    
    // Pastikan currentSlide valid
    if (currentSlide > maxSlide) currentSlide = maxSlide;
    if (currentSlide < 0) currentSlide = 0;
    
    // Hitung lebar slide
    const cardWidth = cards[0]?.offsetWidth || 0;
    const gap = 30;
    const slideWidth = (cardWidth + gap);
    
    // Terapkan transform
    if (!animate) {
        slider.style.transition = 'none';
    } else {
        slider.style.transition = 'transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    }
    
    slider.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
    
    // Update dots
    const dotCount = Math.max(1, totalSlides - cardsPerView + 1);
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === currentSlide);
    });
}

function slideTestimonial(direction) {
    if (isTransitioning) return;
    isTransitioning = true;
    
    const slider = document.getElementById('testimonialSlider');
    if (!slider) return;
    
    const cards = slider.querySelectorAll('.testimonial-card');
    cardsPerView = getCardsPerView();
    const maxSlide = Math.max(0, cards.length - cardsPerView);
    
    // Hitung slide berikutnya
    let nextSlide = currentSlide + direction;
    
    // Jika mencapai akhir, kembali ke awal (loop)
    if (nextSlide > maxSlide) {
        nextSlide = 0;
    } else if (nextSlide < 0) {
        nextSlide = maxSlide;
    }
    
    currentSlide = nextSlide;
    updateTestimonials(true);
    
    // Reset auto slide
    resetAutoSlide();
    
    setTimeout(() => {
        isTransitioning = false;
    }, 600);
}

function goToSlide(index) {
    if (isTransitioning || index === currentSlide) return;
    
    const slider = document.getElementById('testimonialSlider');
    if (!slider) return;
    
    const cards = slider.querySelectorAll('.testimonial-card');
    cardsPerView = getCardsPerView();
    const maxSlide = Math.max(0, cards.length - cardsPerView);
    
    if (index > maxSlide) index = 0;
    if (index < 0) index = maxSlide;
    
    currentSlide = index;
    updateTestimonials(true);
    resetAutoSlide();
}

// Auto slide dengan loop
function autoSlide() {
    if (isTransitioning) return;
    
    const slider = document.getElementById('testimonialSlider');
    if (!slider) return;
    
    const cards = slider.querySelectorAll('.testimonial-card');
    cardsPerView = getCardsPerView();
    const maxSlide = Math.max(0, cards.length - cardsPerView);
    
    // Jika sudah di slide terakhir, kembali ke awal
    if (currentSlide >= maxSlide) {
        currentSlide = 0;
    } else {
        currentSlide++;
    }
    
    updateTestimonials(true);
}

function startAutoSlide() {
    if (slideInterval) clearInterval(slideInterval);
    slideInterval = setInterval(autoSlide, 4000);
}

function resetAutoSlide() {
    if (slideInterval) {
        clearInterval(slideInterval);
        slideInterval = setInterval(autoSlide, 4000);
    }
}

// Inisialisasi testimonial
document.addEventListener('DOMContentLoaded', () => {
    const slider = document.getElementById('testimonialSlider');
    if (!slider) return;
    
    const cards = slider.querySelectorAll('.testimonial-card');
    totalSlides = cards.length;
    cardsPerView = getCardsPerView();
    
    // Buat dots
    const dotsContainer = document.getElementById('testimonialDots');
    if (!dotsContainer) return;
    
    const dotCount = Math.max(1, totalSlides - cardsPerView + 1);
    dotsContainer.innerHTML = '';
    for (let i = 0; i < dotCount; i++) {
        const dot = document.createElement('span');
        dot.addEventListener('click', () => goToSlide(i));
        dot.setAttribute('data-index', i);
        dotsContainer.appendChild(dot);
    }
    
    // Set initial position tanpa animasi
    updateTestimonials(false);
    
    // Tunggu sebentar lalu mulai auto slide
    setTimeout(() => {
        startAutoSlide();
    }, 1000);
    
    // Hentikan auto slide saat hover
    const wrapper = document.querySelector('.testimonials-wrapper');
    if (wrapper) {
        wrapper.addEventListener('mouseenter', () => {
            if (slideInterval) {
                clearInterval(slideInterval);
                slideInterval = null;
            }
        });
        wrapper.addEventListener('mouseleave', () => {
            if (!slideInterval) {
                startAutoSlide();
            }
        });
    }
    
    // Update saat resize dengan debounce
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            const newCardsPerView = getCardsPerView();
            if (newCardsPerView !== cardsPerView) {
                cardsPerView = newCardsPerView;
                const newDotCount = Math.max(1, totalSlides - cardsPerView + 1);
                const dotsContainer = document.getElementById('testimonialDots');
                if (dotsContainer) {
                    dotsContainer.innerHTML = '';
                    for (let i = 0; i < newDotCount; i++) {
                        const dot = document.createElement('span');
                        dot.addEventListener('click', () => goToSlide(i));
                        dot.setAttribute('data-index', i);
                        dotsContainer.appendChild(dot);
                    }
                }
                if (currentSlide >= newDotCount) currentSlide = newDotCount - 1;
                updateTestimonials(false);
            }
        }, 300);
    });
    
    // Tambahkan event listener untuk touch swipe
    let touchStartX = 0;
    let touchEndX = 0;
    let isSwiping = false;
    
    wrapper.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        isSwiping = true;
        // Hentikan auto slide saat touch
        if (slideInterval) {
            clearInterval(slideInterval);
            slideInterval = null;
        }
    }, { passive: true });
    
    wrapper.addEventListener('touchmove', (e) => {
        if (!isSwiping) return;
        touchEndX = e.changedTouches[0].screenX;
    }, { passive: true });
    
    wrapper.addEventListener('touchend', (e) => {
        if (!isSwiping) return;
        isSwiping = false;
        touchEndX = e.changedTouches[0].screenX;
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                slideTestimonial(1);
            } else {
                slideTestimonial(-1);
            }
        }
        // Mulai auto slide lagi
        if (!slideInterval) {
            startAutoSlide();
        }
    }, { passive: true });
});

// ===== SMOOTH SCROLL UNTUK NAV LINK =====
document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('nav a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                // Tutup sidebar jika aktif
                const sidebar = document.querySelector('.sidebar');
                if (sidebar && sidebar.classList.contains('active')) {
                    hideSidebar();
                }
                
                const navHeight = document.querySelector('nav')?.offsetHeight || 0;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navHeight - 10;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// ===== INTERSECTION OBSERVER UNTUK ANIMASI SECTION =====
document.addEventListener('DOMContentLoaded', () => {
    // Animasi fade-in untuk faculty cards
    const facultyCards = document.querySelectorAll('.faculty-card');
    const facultyObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                facultyObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    facultyCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        facultyObserver.observe(card);
    });
    
    // Animasi fade-in untuk stat cards
    const statCards = document.querySelectorAll('.stat-card');
    const statCardObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'scale(1)';
                }, index * 150);
                statCardObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'scale(0.8)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        statCardObserver.observe(card);
    });
    
    // Animasi fade-in untuk testimonial cards
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    const testimonialObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                testimonialObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    testimonialCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        testimonialObserver.observe(card);
    });
});

// ===== PARALLAX EFFECT UNTUK HERO SECTION =====
document.addEventListener('scroll', () => {
    const heroSection = document.querySelector('.hero-section');
    if (!heroSection) return;
    
    const scrolled = window.pageYOffset;
    const rate = scrolled * 0.5;
    
    // Efek parallax pada background
    heroSection.style.backgroundPositionY = `${rate}px`;
    
    // Efek parallax pada hero image
    const heroImage = heroSection.querySelector('.hero-image img');
    if (heroImage) {
        heroImage.style.transform = `translateY(${scrolled * 0.1}px)`;
    }
});

// ===== ACTIVE NAV LINK HIGHLIGHT =====
document.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav .nav-link');
    
    let currentSection = '';
    const scrollPosition = window.pageYOffset + 150;
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        
        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            currentSection = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${currentSection}`) {
            link.classList.add('active');
        }
    });
});

// ===== SIDEBAR CLOSE ON ESC =====
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const sidebar = document.querySelector('.sidebar');
        if (sidebar && sidebar.classList.contains('active')) {
            hideSidebar();
        }
    }
});

// ===== SIDEBAR CLOSE ON CLICK OUTSIDE =====
document.addEventListener('click', (e) => {
    const sidebar = document.querySelector('.sidebar');
    const menuButton = document.querySelector('.menu-button');
    
    if (!sidebar || !menuButton) return;
    
    if (sidebar.classList.contains('active')) {
        const isClickInsideSidebar = sidebar.contains(e.target);
        const isClickOnMenuButton = menuButton.contains(e.target);
        
        if (!isClickInsideSidebar && !isClickOnMenuButton) {
            hideSidebar();
        }
    }
});

// ===== PREVENT BODY SCROLL WHEN SIDEBAR OPEN =====
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('.sidebar');
    if (!sidebar) return;
    
    const observer = new MutationObserver(() => {
        if (sidebar.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });
    
    observer.observe(sidebar, { attributes: true, attributeFilter: ['class'] });
});

// ===== SMOOTH REVEAL FOR HEADER =====
document.addEventListener('DOMContentLoaded', () => {
    const sectionHeaders = document.querySelectorAll('.section-header');
    const headerObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                headerObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    sectionHeaders.forEach(header => {
        header.style.opacity = '0';
        header.style.transform = 'translateY(20px)';
        header.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        headerObserver.observe(header);
    });
});

// ===== LAZY LOAD IMAGES =====
document.addEventListener('DOMContentLoaded', () => {
    if ('IntersectionObserver' in window) {
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.getAttribute('data-src');
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }
});

// ===== BACK TO TOP BUTTON =====
document.addEventListener('DOMContentLoaded', () => {
    // Create back to top button
    const backToTopBtn = document.createElement('button');
    backToTopBtn.innerHTML = '<img src="./assets/arrow_shape_up_stack_2_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Back to Top">';
    backToTopBtn.className = 'back-to-top';
    backToTopBtn.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4a7fa5, #6f9bd1);
        color: white;
        border: none;
        font-size: 24px;
        cursor: pointer;
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(74, 127, 165, 0.4);
        padding-top: 5px;
    `;
    document.body.appendChild(backToTopBtn);
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopBtn.style.opacity = '1';
            backToTopBtn.style.visibility = 'visible';
        } else {
            backToTopBtn.style.opacity = '0';
            backToTopBtn.style.visibility = 'hidden';
        }
    });
    
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    backToTopBtn.addEventListener('mouseenter', () => {
        backToTopBtn.style.transform = 'scale(1.1)';
    });
    
    backToTopBtn.addEventListener('mouseleave', () => {
        backToTopBtn.style.transform = 'scale(1)';
    });
});

// ===== HAMBURGER MENU ANIMATION =====
document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('.menu-button a');
    if (menuButton) {
        menuButton.addEventListener('click', (e) => {
            e.preventDefault();
            const sidebar = document.querySelector('.sidebar');
            if (sidebar.classList.contains('active')) {
                hideSidebar();
            } else {
                showSidebar();
            }
        });
    }
});

// ===== PREVENT DEFAULT BEHAVIOR FOR SIDEBAR LINKS =====
document.addEventListener('DOMContentLoaded', () => {
    const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && href !== '#') {
                // Biarkan smooth scroll menangani
                return;
            }
            e.preventDefault();
        });
    });
});

console.log('Nusa Bina Informatika - Website Company Profile loaded successfully!');