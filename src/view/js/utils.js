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

  // input.addEventListener("paste", (e) => {
  //   const previousValue = input.value;
  //   let pastedValue = e.clipboardData.getData("text");

  //   pastedValue = pastedValue.replace(/\D/g, "");
  //   if (!isFloat) {
  //     pastedValue = pastedValue.replace(/\./, "");
  //   }

  //   input.value = previousValue + pastedValue;
  // });
}

function isDigit(value) {
  return value in [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
}
