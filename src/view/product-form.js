$(document).ready(function () {
  $("#btnSubmitFormProduct").click(function () {
    var data = FormData(document.getElementById("formProduct"));

    $product = new Product(
      0,
      data.get("name"),
      data.get("price"),
      data.get("variations"),
      data.get("stock")
    );

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "../controller/product-form-controller.php",
      async: true,
      data: $product,
      success: function (response) {
        location.reload();
      },
    });

    return false;
  });
});
