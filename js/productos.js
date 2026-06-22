// ─── PRODUCT FILTER TABS ───
const tabs    = document.querySelectorAll('.filter-tab');
const cols    = document.querySelectorAll('.prod-col');
const counter = document.querySelector('.prod-count');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        // active state
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const cat = tab.dataset.cat;
        let visible = 0;

        cols.forEach(col => {
            const match = cat === 'todos' || col.dataset.cat === cat;
            col.classList.toggle('hidden', !match);
            if (match) visible++;
        });

        counter.textContent = `${visible} producto${visible !== 1 ? 's' : ''}`;
    });
});