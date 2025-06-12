export function getProductFromForm(form) {
  const formData = new FormData(form);
  
  return {
    id: formData.get("productid") || 0,
    name: formData.get("name"),
    price: formData.get("price"),
    variations: formData.get("variations"),
    stock: formData.get("stock"),
  };
}

export function sendAjaxRequest(type, url, data, successFunction) {
  $.ajax({
    type: type,
    url: url,
    data: data,
    async: true,
    success: successFunction,
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus);
      alert("Error: " + errorThrown);
    },
  });
}
