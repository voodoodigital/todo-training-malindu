//  const API_URL = "http://localhost/to%20do%20list/todo-training-malindu/"; //malidu
const API_URL = "http://localhost/voodooDigital/study/todo-training-malindu/"; //janith

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
      <div class="card primary-box mx-auto mt-3 rounded-4 text-bg-warning" style="width: 600px; height: 7rem">
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

  request.open("GET", API_URL + "api/todoViewProcess.php", true);
  request.send();
}

document.addEventListener("DOMContentLoaded", todoListLoader);

function addTodo() {
  // catch the input from ui
  let todo = document.getElementById("todoTitle").value;
  let date = document.getElementById("datepicker").value;
  let time = document.getElementById("timepicker").value;

  const requestDataObject = {
    title: todo,
    date: date,
    time: formatTimeForMySQL(time),
  };

  function formatTimeForMySQL(time) {
    const [hours, minutes] = time.split(":");
    return `${hours}:${minutes}:00`;
  }

  // store data in a form
  let form = new FormData();
  form.append("todoAddData", JSON.stringify(requestDataObject));

  // send the data to server
  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      // preform an action on response
      let response = request.responseText;
      if (response == "success") {
        alert(response);
        todoListLoader();
      } else {
        console.log(response);
      }
    }
  };
  request.open("POST", API_URL + "api/todoAddProcess.php", true);
  request.send(form);
}

document.getElementById("todoAddBtn").addEventListener("click", addTodo);
