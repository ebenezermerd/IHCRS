const slider = document.querySelector('.slider');
const images = slider.querySelectorAll('img');
let currentIndex = 0;

function showSlide(index) {
  images.forEach((image, i) => {
    if (i === index) {
      image.style.display = 'block';
    } else {
      image.style.display = 'none';
    }
  });
}

function slideNext() {
  currentIndex++;
  if (currentIndex >= images.length) {
    currentIndex = 0;
  }
  showSlide(currentIndex);
}

function slidePrevious() {
  currentIndex--;
  if (currentIndex < 0) {
    currentIndex = images.length - 1;
  }
  showSlide(currentIndex);
}

// Call the initial slide
showSlide(currentIndex);

// Set interval for automatic sliding every 3 seconds
setInterval(slideNext, 3000);
