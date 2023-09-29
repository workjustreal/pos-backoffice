$("#order_number").keyup(function () {
    if ($("#order_number") !== "") {
        $("#order_search").prop("disabled", false);
    } else {
        $("#order_search").prop("disabled", true);
    }
});
