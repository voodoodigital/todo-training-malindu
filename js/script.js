// const API_URL = "http://localhost/to%20do%20list/todo-training-malindu/"; //malidu
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
        let id = todoItemData.id;

        let todoItemUi = `
  <div class="card primary-box mx-auto mt-3 rounded-4 text-bg-warning" style="width: 600px; height: 7rem">
    <div class="card-body">
      <p class="card-text pt-3 pb-0" id="todo-text-${index}">${todo}</p>
      <p class="card-text pt-1 pb-0 text-danger">
        ${date}
        <span class="float-end">
          <i class="bi bi-trash text-danger me-2 fs-4" onclick="deleteTodoItem(${id})"></i>
          <i class="bi bi-check text-success me-2 fs-4" onclick="addLineThrough(${index}, ${id})"></i>

          <i class="bi bi-pencil-square edit-icon text-primary" onclick="editTodoItem(${id})"></i>

        </span>
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

<<<<<<< HEAD

/*function addLineThrough(index) {
=======
function addLineThrough(index) {
>>>>>>> e4673a00f5b48f2a6ba910c61805662058fc0e7e
  let todoText = document.getElementById(`todo-text-${index}`);
  let textDecoration = todoText.style.textDecoration;

  if (textDecoration === "line-through") {
    todoText.style.textDecoration = "";
  } else {
    todoText.style.textDecoration = "line-through";
  }
}*/




function addLineThrough(index, id) {
  let todoText = document.getElementById(`todo-text-${index}`);
  let textDecoration = todoText.style.textDecoration;

  if (textDecoration === 'line-through') {
    todoText.style.textDecoration = '';
  } else {
    // send the request
    let request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        let response = JSON.parse(request.responseText);
        console.log(response.status_id)
        if (response.status === "success" && response.status_id === '2') {
          todoText.style.textDecoration = 'line-through';
          alert(response.status)
        }
        else {
          console.log(response.error);
        }
      }
    };

    request.open("GET", API_URL + "api/todoStatus.php?id=" + id, true);
    request.send();
  }
}

<<<<<<< HEAD










=======
>>>>>>> e4673a00f5b48f2a6ba910c61805662058fc0e7e
function deleteTodoItem(id) {
  // send the request
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      let response = JSON.parse(request.responseText);
      if (response.status == "success") {
        alert(response.status);
        todoListLoader();
      } else {
        console.log(response.error);
      }
    }
  };

  request.open("GET", API_URL + "api/todoDelete.php?id=" + id, true);
  request.send();
}

<<<<<<< HEAD


function editTodoItem(id) {
  var newText = prompt("Enter the new text:");

  if (newText !== null) {
    // send the request
    let request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        let response = JSON.parse(request.responseText);
        if (response.status === "success") {
          alert("Todo item updated successfully");
          todoListLoader();
        } else {
          console.log(response.error);
        }
      }
    };

    request.open("POST", API_URL + "api/todoEdit.php", true);
    request.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded"
    );
    request.send(`id=${id}&text=${encodeURIComponent(newText)}`);
  }
}







=======
>>>>>>> e4673a00f5b48f2a6ba910c61805662058fc0e7e
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
      /* let response = JSON.parse(request.responseText);
      if (response.status == "success") {
        alert(response.status);
        todoListLoader();
      } else {
        console.log(response.error);
      }*/
      console.log(request.responseText);
    }
  };
  request.open("POST", API_URL + "api/todoAddProcess.php", true);
  request.send(form);
}

document.getElementById("todoAddBtn").addEventListener("click", addTodo);
