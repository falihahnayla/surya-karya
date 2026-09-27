document.addEventListener("DOMContentLoaded", function () {
    const animatedElements = document.querySelectorAll(
        ".animate-up, .animate-left, .animate-right",
    );

    if (!animatedElements.length) {
        return;
    }

    const observer = new IntersectionObserver(
        function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.15,
            rootMargin: "0px 0px -50px 0px",
        },
    );

    animatedElements.forEach(function (element) {
        observer.observe(element);
    });
});
