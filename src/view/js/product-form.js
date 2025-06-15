import {
  enforceNumbersOnly,
  getProductFromForm,
  sendAjaxRequest,
} from "./utils.js";

import { updateCartProduct } from "./product-cart.js";

function sendFormRequest(form, action, updateCart) {
  const product = getProductFromForm(form);
  const productIdInput = document.getElementById("productId");
  if (productIdInput) {
    product["id"] = productIdInput.value;
  }

  sendAjaxRequest(
    "POST",
    "src/controller/product-form-controller.php",
    {
      action: action,
      product: product,
    },
    async function (response) {
      form.reset();

      if (updateCart) {
        await updateCartProduct("updateData", product["id"]);
      }

      location.reload();
    }
  );
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
      sendFormRequest(document.getElementById("formProduct"), "insert", false);
    });
  }
}

export function addUpdateListeners() {
  addFormListeners();

  const btnUpdate = document.getElementById("btnUpdate");
  if (btnUpdate) {
    btnUpdate.addEventListener("click", (e) => {
      sendFormRequest(document.getElementById("formProduct"), "update", true);
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
