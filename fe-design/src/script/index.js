document.addEventListener("DOMContentLoaded", function () {
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarCollapse = document.querySelector(".navbar-collapse");

    navbarToggler.addEventListener("click", function () {
        if (navbarCollapse.classList.contains("show")) {
            navbarCollapse.classList.remove("show");
        } else {
            navbarCollapse.classList.add("show");
        }
    });
});

document.querySelectorAll(".dropdown-toggle").forEach((item) => {
    item.addEventListener("click", (event) => {
        if (event.target.classList.contains("dropdown-toggle")) {
            event.target.classList.toggle("toggle-change");
        } else if (
            event.target.parentElement.classList.contains("dropdown-toggle")
        ) {
            event.target.parentElement.classList.toggle("toggle-change");
        }
    });
});
