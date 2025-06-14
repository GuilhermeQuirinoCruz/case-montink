import { sendAjaxRequest } from "./utils.js";
import { addUpdateListeners } from "./product-form.js";
import { updateCart } from "./product-cart.js";

$(document).ready(function () {
  document.querySelectorAll("[name='btnDeleteProduct']").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      sendAjaxRequest(
        "POST",
        "src/controller/product-list-controller.php",
        {
          action: "delete",
          productId: btn.getAttribute("productid"),
        },
        function (response) {
          location.reload();
        }
      );
    });
  });

  document.querySelectorAll("[name='btnUpdateProduct']").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      sendAjaxRequest(
        "POST",
        "src/view/product-form.php",
        {
          action: "fill",
          productId: btn.getAttribute("productid"),
        },
        function (response) {
          document.getElementById("product-form").innerHTML = response;
          addUpdateListeners();
        }
      );
    });
  });

  document.querySelectorAll("[name='btnAddToCart']").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      sendAjaxRequest(
        "POST",
        "src/view/product-cart.php",
        {
          action: "add",
          productId: btn.getAttribute("productid"),
        },
        function (response) {
          updateCart(response);
        }
      );
    });
  });
});
