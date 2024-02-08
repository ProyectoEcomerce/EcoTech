"use strict";

document.addEventListener("DOMContentLoaded", function () {
    console.log("dom cargado")
    let cartToggle = document.getElementById("cart-toggle");
    let cartSidebar = document.getElementById("cart-sidebar");

    cartToggle.addEventListener("click", function () {
        cartSidebar.classList.toggle("closed");
    });
});


console.log("Carrito cargado");

