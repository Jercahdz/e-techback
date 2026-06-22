// ─── SHARED HELPERS ───
const tbody    = document.getElementById('tbodyCategorias');
const countEl  = document.getElementById('catCount');
const toast    = document.getElementById('toastNotif');
const toastMsg = document.getElementById('toastMsg');
let nextId = 4;

function showToast(msg) {
    toastMsg.textContent = msg;
    toast.classList.remove('d-none');
    setTimeout(() => toast.classList.add('d-none'), 3000);
}

function updateCount() {
    const n = tbody.querySelectorAll('tr').length;
    countEl.textContent = `${n} categoría${n !== 1 ? 's' : ''} registrada${n !== 1 ? 's' : ''}`;
}

function attachRowEvents(row) {
    row.querySelector('.admin-btn-delete').addEventListener('click', () => {
        row.classList.add('removing');
        setTimeout(() => { row.remove(); updateCount(); showToast('Categoría eliminada.'); }, 280);
    });

    row.querySelector('.admin-btn-edit').addEventListener('click', () => {
        showToast('Función de edición próximamente.');
    });
}

// attach to existing rows
document.querySelectorAll('#tbodyCategorias tr').forEach(attachRowEvents);

// ─── FORM SUBMIT ───
document.getElementById('formCategoria').addEventListener('submit', function (e) {
    e.preventDefault();

    const inputs = this.querySelectorAll('input, textarea');
    const nombre = inputs[0].value.trim();
    const desc   = inputs[1].value.trim();

    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td><span class="admin-id">#${nextId++}</span></td>
        <td><span class="admin-prod-name">${nombre}</span></td>
        <td class="admin-desc">${desc}</td>
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
    this.reset();
    showToast(`"${nombre}" agregada correctamente.`);
});

// ─── SEARCH ───
document.querySelector('.admin-search').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    tbody.querySelectorAll('tr').forEach(row => {
        const name = row.querySelector('.admin-prod-name')?.textContent.toLowerCase() ?? '';
        row.style.display = name.includes(q) ? '' : 'none';
    });
});