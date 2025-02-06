    function toggleMenu() {
        document.querySelector('.header').classList.toggle('nav-open');
    }

    const faqItems = document.querySelectorAll('.faq-wrapper .faq-item');

    faqItems.forEach(item => {
        item.addEventListener('click', () => {
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            item.classList.toggle('active');
        });
    });

    const scrollUpButton = document.getElementById('scrollUp');

        window.onscroll = function() {
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                scrollUpButton.style.display = 'block';
            } else {
                scrollUpButton.style.display = 'none';
            }
        };

        scrollUpButton.onclick = function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };