const settings = document.querySelector(".settings");
const menu = document.querySelector(".menu")

function show() {
    if (menu.classList.contains("active")) {
        menu.classList.remove("active");
        menu.style.opacity = 0;
        menu.style.display = "none";
    } else {
        menu.classList.toggle("active");
        menu.style.display = "block";
        menu.style.opacity = 1;
    }
}

settings.addEventListener("click", show);