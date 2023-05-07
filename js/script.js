function todoListLoader() {
  let container = document.getElementById("todoContainer");
  let todoList = "";

  for (let index = 0; index < 3; index++) {
    let todo = "eat food" + index;
    let date = "2023.05.07";
    let time = "09:46 PM";

    let todoItemUi = `
  <div class="card primary-box mx-auto mt-5 rounded-4 text-bg-warning" style="width: 600px; height: 7rem">
    <div class="card-body">
      <p class="card-text pt-3 pb-0">${todo}</p>
      <p class="card-text pt-1 pb-0 text-danger">
        ${date} &nbsp; &nbsp; ${time}
      </p>
    </div>
  </div>
  `;

    todoList += todoItemUi;
  }

  container.innerHTML = todoList;
}
