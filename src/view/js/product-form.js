import {
  enforceNumbersOnly,
  getProductFromForm,
  sendAjaxRequest,
  showMessageModal,
} from "./utils.js";

import { updateCartProduct } from "./product-cart.js";
import { updateProductList } from "./product-list.js";

function sendFormRequest(form, action) {
  const product = getProductFromForm(form);
  const productIdInput = document.getElementById("productId");
  if (productIdInput) {
    product["id"] = productIdInput.value;
  }

  sendAjaxRequest(
    "POST",
    "src/controller/product-form-controller.php",
    function (response) {
      response = JSON.parse(response);

      showMessageModal(response["title"], response["message"]);

      if (!response["success"]) {
        return;
      }

      switch (action) {
        case "insert":
          updateProductList();
          break;
        case "update":
          updateCartProduct("updateData", product["id"]);
          updateProductList();
          break;
      }

      resetForm(form);
    },
    {
      action: action,
      product: product,
    },
  );
}

function resetForm() {
  sendAjaxRequest("GET", "src/view/product-form.php", function (response) {
    document.getElementById("productForm").innerHTML = response;

    addUpdateListeners();
    addInsertListeners();
  });
}

function addFormListeners() {
  document.getElementById("formProduct").addEventListener("submit", (e) => {
    e.preventDefault();
  });

  enforceNumbersOnly(document.getElementById("productPrice"), true);
  enforceNumbersOnly(document.getElementById("productStock"), false);
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
