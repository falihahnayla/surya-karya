document.addEventListener("DOMContentLoaded", function () {
    const animatedElements = document.querySelectorAll(
        ".animate-up, .animate-left, .animate-right, .animate-float-3d"
    );

    if (!animatedElements.length) {
        return;
    }

    // Function to check if element is already in viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) + 80 &&
            rect.bottom >= 0
        );
    }

    // Immediately trigger elements currently visible on screen
    animatedElements.forEach(function (element) {
        if (isElementInViewport(element)) {
            element.classList.add("is-visible");
        }
    });

    // Create Intersection Observer for remaining/scrolled elements
    const observer = new IntersectionObserver(
        function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    // Small RAF delay for liquid smooth animation frame synchronization
                    requestAnimationFrame(function () {
                        entry.target.classList.add("is-visible");
                    });
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.02,
            rootMargin: "0px 0px 40px 0px",
        }
    );

    animatedElements.forEach(function (element) {
        if (!element.classList.contains("is-visible")) {
            observer.observe(element);
        }
    });
});

