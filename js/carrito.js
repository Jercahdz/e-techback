// ─── QUANTITY CONTROLS ───
const items = document.querySelectorAll('.cart-item');

const BASE_PRICES = [899.99, 1299.99, 79.99]; // unit prices per item

function getUnitPrice(item) {
    const index = [...items].indexOf(item);
    return BASE_PRICES[index] ?? 0;
}

function formatPrice(value) {
    return '$' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function recalcTotals() {
    let subtotal = 0;

    items.forEach((item, i) => {
        const qty   = parseInt(item.querySelector('.qty-value').textContent);
        const unit  = BASE_PRICES[i] ?? 0;
        const line  = unit * qty;
        subtotal   += line;
        item.querySelector('.cart-item-price').textContent = formatPrice(line);
    });

    const tax   = subtotal * 0.13;
    const total = subtotal + tax;

    document.getElementById('subtotal').textContent  = formatPrice(subtotal);
    document.getElementById('impuestos').textContent = formatPrice(tax);
    document.getElementById('total').textContent     = formatPrice(total);
}

items.forEach(item => {
    const minus = item.querySelector('.qty-minus');
    const plus  = item.querySelector('.qty-plus');
    const label = item.querySelector('.qty-value');
    const removeBtn = item.querySelector('.cart-item-remove');

    plus.addEventListener('click', () => {
        label.textContent = parseInt(label.textContent) + 1;
        recalcTotals();
        updateCount();
    });

    minus.addEventListener('click', () => {
        const current = parseInt(label.textContent);
        if (current > 1) {
            label.textContent = current - 1;
            recalcTotals();
            updateCount();
        }
    });

    removeBtn.addEventListener('click', () => {
        item.closest('.cart-item')?.remove();
        // also remove the divider below if present
        const next = document.querySelector('.cart-divider');
        if (next) next.remove();
        recalcTotals();
        updateCount();
    });
});

function updateCount() {
    const remaining = document.querySelectorAll('.cart-item').length;
    const countEl   = document.querySelector('.cart-item-count');
    if (countEl) countEl.textContent = `${remaining} artículo${remaining !== 1 ? 's' : ''}`;
}

// ─── CHECKOUT ───
const btnCompra       = document.getElementById('btnCompra');
const mensajeCompra   = document.getElementById('mensajeCompra');
const contenidoCarrito = document.getElementById('contenidoCarrito');

btnCompra.addEventListener('click', () => {
    contenidoCarrito.style.display = 'none';
    mensajeCompra.classList.remove('d-none');
    window.scrollTo({ top: 0, behavior: 'smooth' });
});