const mainmenu_toggler = document.querySelectorAll(".mainmenu-toggler");
const topmenu = document.querySelector("[class^='menu-primaer-menu-container']");

for (i = 0; i < mainmenu_toggler.length; i++) {
    mainmenu_toggler[i].addEventListener("click", () => {
        topmenu.classList.toggle("open");
    });
}