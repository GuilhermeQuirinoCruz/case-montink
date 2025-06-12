import { getProductFromForm, sendAjaxRequest } from "./utils.js";

function sendFormRequest(form, action) {
  const product = getProductFromForm(form);
  product["id"] = document.getElementById("productid").value;

  sendAjaxRequest(
    "POST",
    "src/controller/product-form-controller.php",
    {
      action: action,
      product: product,
    },
    function (response) {
      form.reset();
      location.reload();
    }
  );
}

function addFormListeners() {
  document.getElementById("formProduct").addEventListener("submit", (e) => {
    e.preventDefault();
  });
}

function addInsertListeners() {
  const btnInsert = document.getElementById("btnInsert");
  if (btnInsert) {
    btnInsert.addEventListener("click", (e) => {
      sendFormRequest(document.getElementById("formProduct"), "insert");
    });
  }
}

export function addUpdateListeners() {
  addFormListeners();

  const btnUpdate = document.getElementById("btnUpdate");
  if (btnUpdate) {
    btnUpdate.addEventListener("click", (e) => {
      sendFormRequest(document.getElementById("formProduct"), "update");
    });
  }

  const btnCancel = document.getElementById("btnCancel");
  if (btnCancel) {
    btnCancel.addEventListener("click", (e) => {
      location.reload();
    });
  }
}

$(document).ready(function () {
  addFormListeners();
  addInsertListeners();
});
