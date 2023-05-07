function todoListLoader() {
  let container = document.getElementById("todoContainer");

  // send the request
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      let response = request.responseText; //Json
      let responseArray = JSON.parse(response);

      let todoList = "";
      for (let index = 0; index < responseArray.length; index++) {
        let todoItemData = responseArray[index];

        let todo = todoItemData.title;
        let date = todoItemData.dueDate;
        let time = todoItemData.dueDate;

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
  };

  request.open(
    "GET",
    "http://localhost/voodooDigital/study/todo-training-malindu/api/todoViewProcess.php",
    true
  );
  request.send();
}

todoListLoader();
