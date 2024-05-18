// dot-slider.js
const dots = document.querySelectorAll('.dot');
const slides = document.querySelector('.slider');
let currentIndex = 0;
let timer;

dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        clearInterval(timer);
        setActiveDot(index);
        showSlide(index);
    });
});

function setActiveDot(index) {
    dots.forEach(dot => dot.classList.remove('active'));
    dots[index].classList.add('active');
}

function showSlide(index) {
    slides.style.transform = `translateX(${-index * 100}%)`;
    currentIndex = index;
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % dots.length;
    setActiveDot(currentIndex);
    showSlide(currentIndex);
}

// Initial start of the timer
startTimer();

function startTimer() {
    timer = setInterval(nextSlide, 5000);
}

// Initialize the first dot as active
setActiveDot(0);
