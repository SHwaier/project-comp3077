<?php
?><!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <?php include_once '../components/metas.php'; ?>
    <title>Cart | EStore</title>
    <meta name="description"
        content="View and manage items in your cart before checkout at EStore. Stylish jackets, hoodies, and more await.">
</head>

<body>
    <?php include_once '../components/header.php'; ?>

    <main class="container">
        <h1 style="margin-bottom: 2rem;">Your Cart</h1>

        <div id="cart-items"></div>

        <div id="cart-summary" style="margin-top: 2rem; text-align: right;"></div>
    </main>

    <?php include_once '../components/footer.php'; ?>
    <?php include_once '../components/scripts.php'; ?>

    <script>
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        const token = getCookie('token');

        async function fetchCart() {
            const cartContainer = document.getElementById('cart-items');
            const summaryContainer = document.getElementById('cart-summary');
            cartContainer.innerHTML = '<p>Loading cart...</p>';

            try {
                const res = await fetch('/api/cart.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                });

                const items = await res.json();
                if (!res.ok || !Array.isArray(items)) throw new Error();

                if (items.length === 0) {
                    cartContainer.innerHTML = '<p>Your cart is empty.</p>';
                    summaryContainer.innerHTML = '';
                    return;
                }

                let total = 0;
                cartContainer.innerHTML = '<div class="product-grid"></div>';
                const grid = cartContainer.querySelector('.product-grid');

                items.forEach(item => {
                    total += item.price * item.quantity;

                    const card = document.createElement('div');
                    card.className = 'product-card';
                    card.innerHTML = `
                    <img src="${"/product/" + item.image_url || '/assets/img/placeholder.png'}" alt="${item.product_name}" onerror="this.onerror=null;this.src='/assets/img/placeholder.png';">
                    <h2>${item.product_name}</h2>
                    <label for="qty-${item.product_id}">Quantity:</label>
                    <input type="number" id="qty-${item.product_id}" value="${item.quantity}" min="0" style="width: 60px;" />
                    <p class="price">$<span id="total-${item.product_id}">${(item.price * item.quantity).toFixed(2)}</span></p>
                    <div style="display:flex; gap: 0.5rem;">
                        <button onclick="removeItem(${item.product_id})" style="background: red;">Remove</button>
                    </div>
                `;

                    // Attach change handler
                    card.querySelector(`#qty-${item.product_id}`).addEventListener('change', e => {
                        const newQty = parseInt(e.target.value);
                        if (isNaN(newQty) || newQty < 0) return;
                        updateQuantity(item.product_id, newQty, item.price);
                    });

                    grid.appendChild(card);
                });

                summaryContainer.innerHTML = `<h3>Total: $${total.toFixed(2)}</h3>`;
            } catch (err) {
                cartContainer.innerHTML = '<p style="color: var(--error-color);">Error loading cart.</p>';
            }
        }

        async function updateQuantity(productId, quantity, unitPrice) {
            const input = document.getElementById(`qty-${productId}`);
            input.disabled = true;

            try {
                const res = await fetch('/api/cart.php', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Authorization': `Bearer ${token}`
                    },
                    body: `product_id=${productId}&quantity=${quantity}`
                });

                if (!res.ok) throw new Error();
                document.getElementById(`total-${productId}`).textContent = (unitPrice * quantity).toFixed(2);
                await fetchCart(); // reload cart totals only (not full page)
            } catch (err) {
                alert("Failed to update cart. Try again.");
            } finally {
                input.disabled = false;
            }
        }

        async function removeItem(productId) {
            const card = document.getElementById(`qty-${productId}`).closest('.product-card');
            card.style.opacity = '0.5';

            try {
                const res = await fetch('/api/cart.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Authorization': `Bearer ${token}`
                    },
                    body: `product_id=${productId}`
                });

                if (!res.ok) throw new Error();
                card.remove();
                await fetchCart(); // refresh totals
            } catch (err) {
                alert("Failed to remove item.");
            }
        }

        document.addEventListener('DOMContentLoaded', fetchCart);
    </script>

</body>

</html>