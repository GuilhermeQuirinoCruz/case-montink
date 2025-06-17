import {
  enforceNumbersOnly,
  sendAjaxRequest,
  showMessageModal,
} from "./utils.js";

import { updateProductList } from "./product-list.js";

function setupCart() {
  addRemoveListeners();
  addEnforceNumbersListeners();
  addUpdateAmountListeners();
  addZipCodeListeners();
  addCheckoutListeners();
}

export function updateCart(html) {
  document.getElementById("productCart").innerHTML = html;

  setupCart();
}

export function updateCartProduct(action, id) {
  sendAjaxRequest(
    "POST",
    "src/view/product-cart.php",
    {
      action: action,
      productId: id,
    },
    function (response) {
      updateCart(response);
    }
  );
}

function addRemoveListeners() {
  document.querySelectorAll("[name='btnRemoveFromCart']").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      sendAjaxRequest(
        "POST",
        "src/view/product-cart.php",
        {
          action: "remove",
          productId: btn.getAttribute("productid"),
        },
        function (response) {
          updateCart(response);
        }
      );
    });
  });
}

function addEnforceNumbersListeners() {
  document.querySelectorAll("[name='productCartAmount']").forEach((input) => {
    enforceNumbersOnly(input, false);
  });
}

function addUpdateAmountListeners() {
  document.querySelectorAll("[name='productCartAmount']").forEach((input) => {
    input.addEventListener("change", (e) => {
      sendAjaxRequest(
        "POST",
        "src/view/product-cart.php",
        {
          action: "updateAmount",
          productId: input.getAttribute("productid"),
          amount: input.value,
        },
        function (response) {
          updateCart(response);
        }
      );
    });
  });
}

function addZipCodeListeners() {
  const zipCode = document.getElementById("zipCode");

  enforceNumbersOnly(zipCode, false);
}

function addCheckoutListeners() {
  const btnCheckout = document.getElementById("btnCheckout");
  if (btnCheckout) {
    btnCheckout.addEventListener("click", (e) => {
      sendAjaxRequest(
        "POST",
        "src/controller/product-cart-controller.php",
        {
          action: "checkout",
        },
        function (response) {
          response = JSON.parse(response);

          if (response["success"]) {
            showMessageModal(response["title"], response["message"]);
            refreshProductCart();
            updateProductList();
          }
        }
      );
    });
  }
}

function refreshProductCart() {
  sendAjaxRequest("GET", "src/view/product-cart.php", {}, function (response) {
    updateCart(response);
  });
}

$(document).ready(function () {
  setupCart();
});
