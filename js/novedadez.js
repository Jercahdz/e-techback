const timeSince = (date) => {
    const seconds = Math.floor((new Date() - date) / 1000);
  
    let interval = seconds / 31536000;
  
    if (interval > 1) {
      return Math.floor(interval) + " ano atras";
    }
    interval = seconds / 2592000;
    if (interval > 1) {
      return Math.floor(interval) + " mes atrás";
    }
    interval = seconds / 86400;
    if (interval > 1) {
      return Math.floor(interval) + " dia atras";
    }
    interval = seconds / 3600;
    if (interval > 1) {
      return Math.floor(interval) + " horas atras";
    }
    interval = seconds / 60;
    if (interval > 1) {
      return Math.floor(interval) + " minutos atras";
    }
  
    if (seconds < 10) {
      return "ahora";
    }
  
    return Math.floor(seconds) + " segundos ago";
  };
  
  
  const users = {
    jose: {
      name: "Jose Varela",
      src: "https://cdn-icons-png.flaticon.com/512/3135/3135768.png",
    },
    anna: {
      name: "Anna Luiza",
      src: "https://cdn-icons-png.flaticon.com/512/3135/3135768.png",
    },
    marco: {
      name: "Marcos Silva",
      src: "https://cdn-icons-png.flaticon.com/512/3135/3135768.png",
    },
    lili: {
      name: "Lili Fernandes",
      src: "https://cdn-icons-png.flaticon.com/512/3135/3135768.png",
    },
  };
  
  const loggedUser = users["jose"];
  
  let comments = [
    {
      id: 1,
      text: "Me gusto mucho la tienda.",
      author: users["lili"],
      createdAt: "2023-09-03 12:00:00",
    },
    {
      id: 2,
      text: "Muy buena distibucion de todo.",
      author: users["anna"],
      createdAt: "2023-09-03 11:00:00",
    },
    {
      id: 3,
      text: "Muy recomendable esta tienda.",
      author: users["marco"],
      createdAt: "2023-09-02 10:00:00",
    },
  ];
  
  const authedUser = document.querySelector(".authed-user");
  
  const authorHTML = DOMPurify.sanitize(
    `<img class="avatar" src="${loggedUser.src}" alt="${loggedUser.name}">`
  );
  
  authedUser.innerHTML = authorHTML;
  
  const commentsWrapper = document.querySelector(".discussion__comments");
  
  const createComment = (comment) => {
    const newDate = new Date(comment.createdAt);
    return DOMPurify.sanitize(`<div class="comment">
          <div class="avatar">
              <img
                  class="avatar"
                  src="${comment.author.src}"
                  alt="${comment.author.name}"
              >
          </div>
          <div class="comment__body">
              <div class="comment__author">
                  ${comment.author.name}
                  <time
                      datetime="${comment.createdAt}"
                      class="comment__date"
                  >
                      ${timeSince(newDate)}
                  </time>
              </div>
              <div class="comment__text">
                  <p>${comment.text}</p>
              </div>
          </div>
      </div>`);
  };
  
  const commentsMapped = comments.map((comment) => createComment(comment));
  
  const innerComments = commentsMapped.join("");
  commentsWrapper.innerHTML = innerComments;
  
  const newCommentForm = document.getElementById("newcomment__form");
  const newCommentTextarea = document.querySelector("#newcomment__form textarea");
  
  document.getElementById("reset-button").addEventListener("click", () => {
    newCommentForm.reset();
    document.location.reload();
  });
  
  newCommentForm.addEventListener("submit", (e) => {
    e.stopPropagation();
    e.preventDefault();
    const newCommentTextareaValue = newCommentTextarea.value;
  
    const newComment = {
      id: comments.length + 1,
      text: newCommentTextareaValue,
      author: loggedUser,
      createdAt: new Date().toISOString(),
    };
  
    const comment = document.createElement("div");
    comment.innerHTML = createComment(newComment);
  
    if (commentsWrapper.hasChildNodes()) {
      commentsWrapper.insertBefore(comment, commentsWrapper.childNodes[0]);
    } else {
      commentsWrapper.appendChild(comment);
    }
  
    newCommentForm.reset();
  });
  