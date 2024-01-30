"use strict";

document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('cart-icon').addEventListener('click', function(event) {
        event.preventDefault();
        let cartSidebar = document.getElementById('cart-sidebar');
        if (cartSidebar.style.display === 'none') {
            cartSidebar.style.display = 'block';
        } else {
            cartSidebar.style.display = 'none';
        }
    });
});

console.log('carrito.js loaded');