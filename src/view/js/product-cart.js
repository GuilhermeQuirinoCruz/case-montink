import { enforceNumbersOnly, sendAjaxRequest } from "./utils.js";

function setupCart() {
  addRemoveListeners();
  addEnforceNumbersListeners();
  addUpdateAmountListeners();
  addCheckoutListeners();
}

export function updateCart(html) {
  document.getElementById("product-cart").innerHTML = html;

  setupCart();
}

export async function updateCartProduct(action, id) {
  await sendAjaxRequest(
    "POST",
    "src/controller/product-cart-controller.php",
    {
      action: action,
      productId: id,
    },
    function () {}
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
          location.reload();
        }
      );
    });
  }
}

$(document).ready(function () {
  setupCart();
});
