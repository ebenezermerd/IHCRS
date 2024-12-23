document.addEventListener("DOMContentLoaded", function() {
    var sections = document.querySelectorAll(".grid-section");

    sections.forEach(function(section) {
        var slides = section.querySelectorAll(".secB-grid");
        var currentSlide = 0;

        function showSlide(slideIndex) {
            slides.forEach(function(slide) {
                slide.style.display = "none";
            });

            for (var i = slideIndex; i < slideIndex + 3; i++) {
                slides[i % slides.length].style.display = "block";
            }
        }

        function nextSlide() {
            currentSlide += 3;
            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }
            showSlide(currentSlide);
        }

        setInterval(nextSlide, 1000); // Change slide every 3 seconds

        showSlide(currentSlide);
    });
});