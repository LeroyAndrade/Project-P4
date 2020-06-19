const buttonMenuClosed1 = document.querySelector("#menuClosed1");
let menuOpen = document.getElementById("menuOpen").style;

buttonMenuClosed1.addEventListener("click", function(){

menuOpen.display === "" || menuOpen.display === null || menuOpen.display === "none" ? menuOpen.display = "inline": menuOpen.display = "none";
});