document.addEventListener("DOMContentLoaded", function() {
    const carousel = document.getElementById('image-carousel');
    const dotsContainer = document.getElementById('dot-container');
    const images = document.querySelectorAll('.carousel-item');
    const totalImages = images.length;

    let currentIndex = 0;
    let autoSlideInterval;

    function showImage(index) {
        const translateValue = -index * 100 + '%';
        carousel.style.transform = 'translateX(' + translateValue + ')';
    }

    function updateDots(index) {
        const dots = Array.from(dotsContainer.children);
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    function showNextImage() {
        currentIndex = (currentIndex + 1) % totalImages;
        showImage(currentIndex);
        updateDots(currentIndex);
    }

    function createDots() {
        for (let i = 0; i < totalImages; i++) {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            dot.addEventListener('click', () => {
                currentIndex = i;
                showImage(currentIndex);
                updateDots(currentIndex);
            });
            dotsContainer.appendChild(dot);
        }
        updateDots(currentIndex);
    }

    function autoSlide() {
        autoSlideInterval = setInterval(showNextImage, 3000); // Adjust the interval as needed
    }

    createDots();
    autoSlide();
});
