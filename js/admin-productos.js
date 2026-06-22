// ─── FORM SUBMIT ───
const form  = document.getElementById('formProducto');
const tbody = document.getElementById('tbodyProductos');
const tableSubtitle = document.querySelector('.admin-table-sub');
const toast = document.getElementById('toastNotif');
const toastMsg = document.getElementById('toastMsg');

let nextId = 5;

function showToast(msg) {
    toastMsg.textContent = msg;
    toast.classList.remove('d-none');
    setTimeout(() => toast.classList.add('d-none'), 3000);
}

function updateCount() {
    const count = tbody.querySelectorAll('tr').length;
    tableSubtitle.textContent = `${count} producto${count !== 1 ? 's' : ''} registrado${count !== 1 ? 's' : ''}`;
}

function attachRowEvents(row) {
    row.querySelector('.admin-btn-delete').addEventListener('click', () => {
        row.classList.add('removing');
        setTimeout(() => {
            row.remove();
            updateCount();
            showToast('Producto eliminado.');
        }, 280);
    });

    row.querySelector('.admin-btn-edit').addEventListener('click', () => {
        showToast('Función de edición próximamente.');
    });
}

// attach events to existing rows
document.querySelectorAll('#tbodyProductos tr').forEach(attachRowEvents);

form.addEventListener('submit', function (e) {
    e.preventDefault();

    const inputs  = form.querySelectorAll('input, textarea, select');
    const nombre  = inputs[0].value.trim();
    const desc    = inputs[1].value.trim();
    const precio  = parseFloat(inputs[2].value).toFixed(2);
    const catVal  = inputs[5].value;

    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td><span class="admin-id">#${nextId++}</span></td>
        <td><span class="admin-prod-name">${nombre}</span></td>
        <td class="admin-desc">${desc}</td>
        <td><span class="admin-price">$${parseFloat(precio).toLocaleString('en-US', {minimumFractionDigits:2})}</span></td>
        <td><span class="admin-cat-badge">${catVal}</span></td>
        <td>
            <div class="admin-actions">
                <button class="admin-btn-edit">Editar</button>
                <button class="admin-btn-delete">Eliminar</button>
            </div>
        </td>
    `;

    tbody.appendChild(tr);
    attachRowEvents(tr);
    updateCount();
    form.reset();
    showToast(`"${nombre}" agregado correctamente.`);
});

// ─── SEARCH FILTER ───
document.querySelector('.admin-search').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    tbody.querySelectorAll('tr').forEach(row => {
        const name = row.querySelector('.admin-prod-name')?.textContent.toLowerCase() ?? '';
        row.style.display = name.includes(q) ? '' : 'none';
    });
});