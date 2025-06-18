import { sendAjaxRequest, showMessageModal } from "./utils.js";
import { addUpdateListeners } from "./product-form.js";
import { updateCart, updateCartProduct } from "./product-cart.js";

export function updateProductList() {
  sendAjaxRequest("GET", "src/view/product-list.php", function (response) {
    document.getElementById("productList").innerHTML = response;
    addListListeners();
  });
}

function addListListeners() {
  document.querySelectorAll("[name='btnUpdateProduct']").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      sendAjaxRequest(
        "POST",
        "src/view/product-form.php",
        function (response) {
          const productForm = document.getElementById("productForm");
          productForm.innerHTML = response;
          addUpdateListeners();
          productForm.scrollIntoView();
        },
        {
          action: "fill",
          productId: btn.getAttribute("productid"),
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
        function (response) {
          response = JSON.parse(response);

          showMessageModal(response["title"], response["message"]);

          if (!response["success"]) {
            return;
          }

          updateCartProduct("remove", productId);
          updateProductList();
        },
        {
          action: "delete",
          productId: productId,
        }
      );
    });
  });

  document.querySelectorAll("[name='btnAddToCart']").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      sendAjaxRequest(
        "POST",
        "src/view/product-cart.php",
        function (response) {
          updateCart(response);
        },
        {
          action: "add",
          productId: btn.getAttribute("productid"),
        }
      );
    });
  });
}

$(document).ready(function () {
  addListListeners();
});
