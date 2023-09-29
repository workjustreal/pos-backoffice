var base_url = window.location.protocol + "//" + window.location.host;
function getEmp(el, auth) {
    var $myTypeahead = el;
    $myTypeahead.typeahead({
        minLength: 1,
        items: 10,
        showHintOnFocus: "all",
        selectOnBlur: false,
        autoSelect: true,
        displayText: function (item) {
            var userimg = base_url + "/assets/images/users/user-1.jpg";
            var errimg = base_url + "/assets/images/users/user-1.jpg";
            html = '<div class="row">';
            html += '<div class="col-md-2">';
            html +=
                '<img class="me-2 rounded-circle" src="' +
                userimg +
                '" onerror="this.onerror=null;this.src=\'' +
                errimg +
                '\';" width="35" height="35" />';
            html += "</div>";
            html += '<div class="col-md-10">';
            html +=
                '<span class="m-0">' +
                item.name +
                " " +
                item.surname +
                " <span>(" +
                item.emp_id +
                ")</span></span>";
            html +=
                '<p class="m-0"><small>(' + item.dept_name + ")</small></p>";
            html += "</div>";
            html += "</div>";
            return html;
        },
        afterSelect: function (item) {
            this.$element[0].value = item.emp_id;
            el.val(item.emp_id);
            auth.val(item.name + " " + item.surname);
        },
        source: function (search, process) {
            if (search == "") {
                auth.val("");
            }
            return $.get(
                base_url + "/employee/search-emp",
                { search: search },
                function (data) {
                    return process(data);
                }
            );
        },
    });
}
function getCheckEmp(el, name) {
    setTimeout(() => {
        var base_url = window.location.protocol + "//" + window.location.host;
        var a = $.get(
            base_url + "/employee/get-emp",
            { search: el.val() },
            function (data) {
                if (Object.keys(data).length === 0) {
                    name.val("ไม่พบข้อมูล!");
                    name.addClass("bg-soft-danger text-danger");
                } else {
                    if (data.emp_id.toString().length == 6) {
                        name.val(data.name + " " + data.surname);
                        name.removeClass("bg-soft-danger text-danger");
                    } else {
                        name.val("ไม่พบข้อมูล!");
                        name.addClass("bg-soft-danger text-danger");
                    }
                }
            }
        );
    }, 500);
}
