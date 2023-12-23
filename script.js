let lastScrollTop = 0;

window.addEventListener("scroll", function () {
    let st = window.pageYOffset || document.documentElement.scrollTop;

    if (st > lastScrollTop) {
        // Scrolling down
        document.getElementById("main-header").classList.remove("transparent");
    } else {
        // Scrolling up
        document.getElementById("main-header").classList.add("transparent");
    }

    lastScrollTop = st <= 0 ? 0 : st;
});

document.addEventListener("scroll", function () {
    let scrollPosition = window.scrollY;

    // Adjust the speed of the parallax effect by changing the divisor
    document.querySelector(".parallax").style.transform = `translate(0, ${scrollPosition * 0.5}px)`;
});

