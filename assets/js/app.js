const api = "http://localhost/uas/";
let task = null;
const trash = document.getElementById("trash");
const modal = document.getElementById("modal");
function loadingStart() {
  document.getElementById("updating").classList.remove("hidden");
}

function setTask(_task) {
  task = _task;
  trash.classList.toggle("hidden");
}

function modalTrigger(e) {
  e.preventDefault();
  modal.classList.toggle("hidden");
}

function taskMove(e) {
  const element = e.currentTarget;
  element.classList.add("opacity-50");
  setTask(element);
}
function taskMoveEnd(e) {
  setTask(null);
  e.currentTarget.classList.remove("opacity-50");
}

function updateTaskStatus(e) {
  e.preventDefault();
  e.stopPropagation();
  if (e.target.closest(".card")) return;

  const status = e.currentTarget.id;
  if (task.closest("#" + status)) return;

  // buat form secara dinamis
  const form = document.createElement("form");
  form.method = "POST";
  form.action = api + "services/updateTask.php";

  // input id
  const inputId = document.createElement("input");
  inputId.type = "hidden";
  inputId.name = "id";
  inputId.value = task.id;
  form.appendChild(inputId);

  // input status
  const inputStatus = document.createElement("input");
  inputStatus.type = "hidden";
  inputStatus.name = "status";
  inputStatus.value = status;
  form.appendChild(inputStatus);

  // tambahkan form ke body dan submit
  document.body.appendChild(form);
  form.submit();
}

function onTaskDrop(e) {
  e.preventDefault();
  e.stopPropagation();

  const trash = e.target.closest("#trash");
  if (trash) {
    deleteTask(task.id);
    return;
  }

  const element = e.target.closest(".card");
  if (!element || element.id === task.id) return;

  const status = element.parentElement.parentElement.id;

  loadingStart();

  // buat form
  const form = document.createElement("form");
  form.method = "POST";
  form.action = api + "services/updateTask.php";

  // input id
  const inputId = document.createElement("input");
  inputId.type = "hidden";
  inputId.name = "id";
  inputId.value = task.id;

  // input status
  const inputStatus = document.createElement("input");
  inputStatus.type = "hidden";
  inputStatus.name = "status";
  inputStatus.value = status;

  // input otherTaskId
  const inputOther = document.createElement("input");
  inputOther.type = "hidden";
  inputOther.name = "otherTaskId";
  inputOther.value = element.id;

  form.appendChild(inputId);
  form.appendChild(inputStatus);
  form.appendChild(inputOther);

  document.body.appendChild(form);
  form.submit();
}

async function deleteTask(id) {
  const form = new FormData();
  form.append("id", id);
  loadingStart();

  try {
    const res = await fetch(api + "services/deleteTask.php", {
      method: "POST",
      body: form,
    });

    if (!res.ok) throw new Error("Delete gagal");

    location.reload();
  } catch (err) {
    console.error(err.message);
  }
}
