// var script = document.createElement("script");
// script.src = "../../assets/js/jquery.min.js";
// script.type = "text/javascript";
// document.getElementsByTagName("head")[0].appendChild(script);

$(function () {
    notification();
});

function notification() {
    $.ajax({
        url:
            window.location.protocol +
            "//" +
            window.location.host +
            "/notification",
        method: "GET",
        data: {},
        dataType: "json",
        success: function (res) {
            var noti = res.notification;
            var notiHTML = "";
            for (var i = 0; i < noti.length; i++) {
                var href = "javascript:void(0);";
                if (noti[i].link != null) {
                    href = noti[i].link;
                }
                notiHTML +=
                    `<a href="` +
                    href +
                    `" class="dropdown-item notify-item">
                        <div class="notify-icon ` +
                    noti[i].color +
                    `">
                            <i class="mdi ` +
                    noti[i].icon +
                    `"></i>
                        </div>
                        <p class="notify-details">` +
                    noti[i].title +
                    `<small class="text-muted">` +
                    noti[i].body +
                    `</small></p>
                    </a>`;
            }
            $(".noti-topbar").html(
                `<div class="noti-scroll" data-simplebar>` + notiHTML + `</div>`
            );
            if (noti.length > 0) {
                $(".noti-icon-badge").show();
                $(".noti-icon-badge").html(noti.length);
            } else {
                $(".noti-icon-badge").hide();
            }
            setTimeout(notification, 5000);
        },
    });
}
