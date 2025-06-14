import { enforceNumbersOnly, sendAjaxRequest } from "./utils.js";

export function updateCart(html) {
  document.getElementById("product-cart").innerHTML = html;
  addRemoveListeners();
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

$(document).ready(function () {
  document.querySelectorAll("[name='productCartAmount']").forEach((amount) => {
    enforceNumbersOnly(amount, false);
  });

  addRemoveListeners();
});
