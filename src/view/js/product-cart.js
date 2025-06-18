import {
  enforceNumbersOnly,
  sendAjaxRequest,
  showMessageModal,
  enforceLength
} from "./utils.js";

import { updateProductList } from "./product-list.js";

function setupCart() {
  addRemoveListeners();
  addCartAmountListeners();
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
    function (response) {
      updateCart(response);
    },
    {
      action: action,
      productId: id,
    }
  );
}

function addRemoveListeners() {
  document.querySelectorAll("[name='btnRemoveFromCart']").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      sendAjaxRequest(
        "POST",
        "src/view/product-cart.php",
        function (response) {
          updateCart(response);
        },
        {
          action: "remove",
          productId: btn.getAttribute("productid"),
        }
      );
    });
  });
}

function addCartAmountListeners() {
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
        function (response) {
          updateCart(response);
        },
        {
          action: "updateAmount",
          productId: input.getAttribute("productid"),
          amount: input.value,
        }
      );
    });
  });
}

function addZipCodeListeners() {
  const zipCode = document.getElementById("zipCode");
  if (!zipCode) {
    return;
  }

  enforceNumbersOnly(zipCode, false);
  enforceLength(zipCode, 8);
}

function validateZipCode(zipCode) {
  return zipCode.length == 8;
}

async function getAddressByZipCode(zipCode) {
  return $.getJSON(
    "https://viacep.com.br/ws/" + zipCode + "/json/?callback=?",
    (response) => {
      console.log(response);
      return response;
    }
  ).fail(() => {
    return { erro: true };
  });
}

function addCheckoutListeners() {
  const btnCheckout = document.getElementById("btnCheckout");
  if (btnCheckout) {
    btnCheckout.addEventListener("click", async function (e) {
      const zipCode = document.getElementById("zipCode").value;
      if (!validateZipCode(zipCode)) {
        showMessageModal("CEP inválido", "Confira o CEP e tente novamente");
        return;
      }

      btnCheckout.disabled = true;
      const address = await getAddressByZipCode(zipCode);
      btnCheckout.disabled = false;
      if (address["erro"]) {
        showMessageModal("CEP incorreto", "Endereço não encontrado");
        return;
      }

      const fullAddress =
        address["logradouro"] +
        ", " +
        address["bairro"] +
        ", " +
        address["localidade"] +
        " - " +
        address["estado"];

      sendAjaxRequest(
        "POST",
        "src/controller/product-cart-controller.php",
        function (response) {
          response = JSON.parse(response);

          let message = response["message"];

          if (response["success"]) {
            message += "<br />Enviado para: " + fullAddress;

            refreshProductCart();
            updateProductList();
          }
          
          showMessageModal(response["title"], message);
        },
        {
          action: "checkout",
          address: fullAddress
        }
      );
    });
  }
}

function refreshProductCart() {
  sendAjaxRequest("GET", "src/view/product-cart.php", function (response) {
    updateCart(response);
  });
}

$(document).ready(function () {
  setupCart();
});
