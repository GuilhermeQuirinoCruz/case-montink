export function getProductFromForm(form) {
  const formData = new FormData(form);

  return {
    id: formData.get("productId") || 0,
    name: formData.get("productName"),
    price: formData.get("productPrice"),
    variations: formData.get("productVariations"),
    stock: formData.get("productStock"),
  };
}

export async function sendAjaxRequest(
  type,
  url,
  successFunction = function () {},
  data = {},
  headers = {}
) {
  return $.ajax({
    type: type,
    url: url,
    data: data,
    headers: headers,
    success: successFunction,
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus);
      alert("Error: " + errorThrown);
    },
  });
}

export function showMessageModal(title, message) {
  sendAjaxRequest(
    "POST",
    "src/view/message-modal.php",
    function (response) {
      document.getElementById("modalContainer").innerHTML = response;
      $("#messageModal").modal("toggle");
    },
    {
      modalTitle: title,
      modalMessage: message,
    }
  );
}

function replaceInteger(input) {
  input.value = input.value.replace(/\D/g, "");
}

function replaceFloat(input) {
  input.value = input.value
    .replace(/[^\d.]/g, "")
    .replace(/\.([.\d]+)$/, function (m, m1) {
      return "." + m1.replace(/\./g, "");
    });
}

export function formatToCurrencyOnChange(input) {
  input.addEventListener("change", (e) => {
    input.value = parseFloat(input.value).toLocaleString("en-US", {
      style: "decimal",
      maximumFractionDigits: 2,
      minimumFractionDigits: 2,
    });
  });
}

export function enforceNumbersOnly(input, isFloat) {
  input.addEventListener("input", (e) => {
    if (isFloat) {
      replaceFloat(input);
      return;
    }

    replaceInteger(input);
  });
}

export function enforceLength(input, maxLength) {
  input.addEventListener("input", (e) => {
    input.value = input.value.substring(0, maxLength);
  });
}
