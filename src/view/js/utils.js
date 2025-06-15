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

export async function sendAjaxRequest(type, url, data, successFunction) {
  return $.ajax({
    type: type,
    url: url,
    data: data,
    success: successFunction,
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus);
      alert("Error: " + errorThrown);
    },
  });
}

export function enforceNumbersOnly(input, isFloat) {
  input.addEventListener("keypress", (e) => {
    if (isDigit(e.key)) {
      return;
    }

    if (isFloat && e.key == ".") {
      return;
    }

    e.preventDefault();

    // if (e.key != "." || !isFloat) {
    //   e.preventDefault();
    //   return;
    // }

    // if (input.value.includes(".")) {
    //   e.preventDefault();
    // }
  });

  input.addEventListener("paste", (e) => {
    e.preventDefault();

    let pastedValue = e.clipboardData.getData("text");

    pastedValue = pastedValue.replace(/\D^\./g, "");
    if (!isFloat) {
      pastedValue = pastedValue.replace(/\./, "");
    }

    input.value += pastedValue;
  });
}

function isDigit(value) {
  return value in [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
}
