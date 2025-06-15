import { sendAjaxRequest } from "./utils.js";
import { addUpdateListeners } from "./product-form.js";
import { updateCart, updateCartProduct } from "./product-cart.js";

$(document).ready(function () {
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

  document.querySelectorAll("[name='btnDeleteProduct']").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const productId = btn.getAttribute("productid");

      sendAjaxRequest(
        "POST",
        "src/controller/product-list-controller.php",
        {
          action: "delete",
          productId: productId,
        },
        async function (response) {
          await updateCartProduct("remove", productId);
          location.reload();
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
