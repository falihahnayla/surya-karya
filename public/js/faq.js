document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll('aside a[href^="#kategori-"]');

    function setActive(link) {
        navLinks.forEach((item) => {
            const indicator = item.querySelector(".category-indicator");

            item.classList.remove(
                "bg-slate-50",
                "text-brand-navy",
                "font-semibold",
            );

            item.classList.add("text-slate-600");

            if (indicator) {
                indicator.classList.remove("bg-brand-navy");
                indicator.classList.add("bg-slate-300");
            }
        });

        link.classList.add("bg-slate-50", "text-brand-navy", "font-semibold");

        link.classList.remove("text-slate-600");

        const indicator = link.querySelector(".category-indicator");

        if (indicator) {
            indicator.classList.remove("bg-slate-300");
            indicator.classList.add("bg-brand-navy");
        }
    }

    navLinks.forEach((link) => {
        link.addEventListener("click", () => {
            setActive(link);
        });
    });

    const sections = document.querySelectorAll('[id^="kategori-"]');

    function updateOnScroll() {
        let currentSection = "";

        sections.forEach((section) => {
            const sectionTop = section.getBoundingClientRect().top;

            if (sectionTop <= 160) {
                currentSection = section.id;
            }
        });

        if (currentSection) {
            const activeLink = document.querySelector(
                `aside a[href="#${currentSection}"]`,
            );

            if (activeLink) {
                setActive(activeLink);
            }
        }
    }

    window.addEventListener("scroll", updateOnScroll);
    updateOnScroll();
});
