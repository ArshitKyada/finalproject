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

    