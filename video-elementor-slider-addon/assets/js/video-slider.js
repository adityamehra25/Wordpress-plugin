document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.multi-video-slider', {
        loop: true,
        autoplay: {
            delay: 5000, // Time in milliseconds between slides
            disableOnInteraction: false, // Continue autoplay after user interactions
        },
        slidesPerView: 3, // Show 3 slides per view
        spaceBetween: 30, // Space between slides (adjust as needed)
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            type: 'fraction', // Display slide numbers
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});
