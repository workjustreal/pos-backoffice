var all = document.getElementById("allchecked");
function selectall() {
    $('input[name="val_checked[]"]').prop("checked", all.checked);
    $("#submit_qr").prop(
        "disabled",
        !$('input[name="val_checked[]"]:checked').length
    );
}
function copy(text, target) {
    // if (!navigator.clipboard) return;
    setTimeout(function () {
        $("#copied_tip").remove();
    }, 800);
    $(target).append("<div class='tip' id='copied_tip'>Copied!</div>");
    var input = document.createElement("input");
    input.setAttribute("value", text);
    document.body.appendChild(input);
    input.select();
    document.execCommand("copy");
    document.body.removeChild(input);
    // navigator.clipboard.writeText(input.value).then(
    //     (success) => console.log("text copied"),
    //     (err) => console.log("error copying text")
    // );
}
function pasteit(target) {
    if (!navigator.clipboard) return;
    navigator.clipboard.readText().then(
        (cliptext) => $(target).val(cliptext),
        (err) => console.log(err)
    );
}

$(function () {
    $('input[name="val_checked[]"]').click(function () {
        $("#submit_qr").prop(
            "disabled",
            !$('input[name="val_checked[]"]:checked').length
        );
        if (
            $('input[name="val_checked[]"]:checked').length ==
            $('input[name="val_checked[]"]').length
        ) {
            $("#allchecked").prop("checked", true);
        } else {
            $("#allchecked").prop("checked", false);
        }
    });
});
