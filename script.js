        //JavaScript to fungsionalitas interaktif
        document.addEventListener('scroll', function() {
            const heroSection = document.querySelector('.hero');
            const scrollPosition = window.scrollY;
            
            // Adjust background position for parralax effect
            heroSection.style.backgroundPosition = 'center ' + (scrollPosition * 0.5) + 'px';
        });
        
        document.addEventListener("DOMContentLoaded", function () {
            const mobileMenuBtn = document.querySelector(".mobile-menu-btn");
            const mobileMenu = document.querySelector(".mobile-menu");
            const closeMenuBtn = document.querySelector(".close-menu");
        
            if (mobileMenuBtn && mobileMenu && closeMenuBtn) {
                mobileMenuBtn.addEventListener("click", function () {
                    mobileMenu.classList.add("active");
                });
        
                closeMenuBtn.addEventListener("click", function () {
                    mobileMenu.classList.remove("active");
                });
        
                // Click Outside to close menu
                document.addEventListener("click", function (event) {
                    if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                        mobileMenu.classList.remove("active");
                    }
                });
            }
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                    }

                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Scroll to top button
            const scrollTopBtn = document.getElementById('scroll-top');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollTopBtn.style.opacity = '1';
                } else {
                    scrollTopBtn.style.opacity = '0';
                }
            });

            scrollTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });