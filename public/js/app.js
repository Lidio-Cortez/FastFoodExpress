const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

function showToast(msg) {
    const toast = document.getElementById('toast');
    if (!toast) return;
    toast.textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2800);
}

function updateCartCount(count) {
    const el = document.getElementById('cart-count');
    if (el) el.textContent = count;
}

async function addToCart(productId, productName) {
    try {
        const res = await fetch(`/carrinho/adicionar/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
        });
        const data = await res.json();
        if (data.success) {
            updateCartCount(data.cartCount);
            showToast('✓ ' + (productName || 'Produto') + ' adicionado!');

            // Atualiza quantidade na página do carrinho se estiver aberta
            const qtyEl = document.getElementById('qty-' + productId);
            if (qtyEl) {
                qtyEl.textContent = parseInt(qtyEl.textContent) + 1;
            }
        }
    } catch (e) {
        showToast('Erro ao adicionar produto.');
    }
}

async function removeFromCart(productId) {
    try {
        const res = await fetch(`/carrinho/remover/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
        });
        const data = await res.json();
        if (data.success) {
            updateCartCount(data.cartCount);
            const qtyEl = document.getElementById('qty-' + productId);
            if (qtyEl) {
                const newQty = parseInt(qtyEl.textContent) - 1;
                if (newQty <= 0) {
                    const row = document.getElementById('cart-item-' + productId);
                    if (row) row.remove();
                    if (data.cartCount === 0) location.reload();
                } else {
                    qtyEl.textContent = newQty;
                }
            }
        }
    } catch (e) {
        showToast('Erro ao remover produto.');
    }
}
