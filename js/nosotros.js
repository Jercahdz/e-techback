// ─── HELPERS ───
const timeSince = (date) => {
    const seconds = Math.floor((new Date() - date) / 1000);
    const intervals = [
        [31536000, 'año',     'años'],
        [2592000,  'mes',     'meses'],
        [86400,    'día',     'días'],
        [3600,     'hora',    'horas'],
        [60,       'minuto',  'minutos'],
    ];
    for (const [secs, singular, plural] of intervals) {
        const n = Math.floor(seconds / secs);
        if (n >= 1) return `hace ${n} ${n === 1 ? singular : plural}`;
    }
    return seconds < 10 ? 'ahora mismo' : `hace ${Math.floor(seconds)} segundos`;
};

// ─── DATA ───
const users = {
    jose:  { name: 'Jose Varela',     src: 'https://cdn-icons-png.flaticon.com/512/3135/3135768.png' },
    anna:  { name: 'Anna Luiza',      src: 'https://cdn-icons-png.flaticon.com/512/3135/3135768.png' },
    marco: { name: 'Marcos Silva',    src: 'https://cdn-icons-png.flaticon.com/512/3135/3135768.png' },
    lili:  { name: 'Lili Fernandes',  src: 'https://cdn-icons-png.flaticon.com/512/3135/3135768.png' },
};

const loggedUser = users.jose;

const comments = [
    { id: 1, text: 'Me gustó mucho la tienda.',          author: users.lili,  createdAt: '2023-09-03 12:00:00' },
    { id: 2, text: 'Muy buena distribución de todo.',    author: users.anna,  createdAt: '2023-09-03 11:00:00' },
    { id: 3, text: 'Muy recomendable esta tienda.',      author: users.marco, createdAt: '2023-09-02 10:00:00' },
];

// ─── RENDER HELPERS ───
const createCommentHTML = (comment) => {
    const date = new Date(comment.createdAt);
    return DOMPurify.sanitize(`
        <div class="comment">
            <div class="avatar">
                <img src="${comment.author.src}" alt="${comment.author.name}">
            </div>
            <div class="comment__body">
                <div class="comment__author">
                    ${comment.author.name}
                    <time datetime="${comment.createdAt}" class="comment__date">${timeSince(date)}</time>
                </div>
                <div class="comment__text"><p>${comment.text}</p></div>
            </div>
        </div>
    `);
};

// ─── INIT ───
const authedUserEl    = document.querySelector('.authed-user');
const commentsWrapper = document.getElementById('commentsList');
const form            = document.getElementById('newcomment__form');
const textarea        = form.querySelector('textarea');

// render logged-in user avatar
authedUserEl.innerHTML = DOMPurify.sanitize(
    `<img class="avatar" src="${loggedUser.src}" alt="${loggedUser.name}">`
);

// render existing comments
commentsWrapper.innerHTML = comments.map(createCommentHTML).join('');

// ─── SUBMIT NEW COMMENT ───
form.addEventListener('submit', (e) => {
    e.preventDefault();
    const text = textarea.value.trim();
    if (!text) return;

    const newComment = {
        id: comments.length + 1,
        text,
        author: loggedUser,
        createdAt: new Date().toISOString(),
    };

    const el = document.createElement('div');
    el.innerHTML = createCommentHTML(newComment);

    commentsWrapper.insertBefore(el.firstElementChild, commentsWrapper.firstChild);
    form.reset();
});

// ─── RESET ───
document.getElementById('reset-button').addEventListener('click', () => form.reset());