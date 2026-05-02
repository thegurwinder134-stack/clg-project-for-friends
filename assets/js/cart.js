// Cart JavaScript
function addToCart(productId) {
    const quantityInput = document.getElementById('quantity');
    const quantity = quantityInput ? quantityInput.value : 1;

    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `product_id=${productId}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Product added to cart!');
            updateCartCount();
        } else {
            alert('Error adding to cart');
        }
    });
}

function updateCartCount() {
    fetch('get_cart_count.php')
    .then(response => response.json())
    .then(data => {
        const cartCount = document.querySelector('.cart-count');
        if (cartCount) {
            cartCount.textContent = data.count;
        }
    });
}

function updateQuantity(cartId, quantity) {
    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `cart_id=${cartId}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

function removeFromCart(cartId) {
    if (confirm('Remove this item from cart?')) {
        fetch('remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `cart_id=${cartId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});
