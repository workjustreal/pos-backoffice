$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#calendar").fullCalendar({
        editable: true,
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay,listMonth",
        },
        // nextDayThreshold: '00:00:00',
        displayEventTime: false,
        events: "/calendar/show",
        eventClick: function (info) {
            $("#calendarModal").modal("show");

            var updated_at = moment(info.updated_at)
                .locale("th")
                .format("dd, lll น.");
            $("#modal-author").text(info.name + " " + info.surname);
            $("#modal-dept").text("หน่วยงาน: " + info.dept_desc);
            $("#modal-update").html(
                '<small class="text-muted">อัปเดตล่าสุด </small>' + updated_at
            );
            $("#modal-title").text(info.title);
            $("#modal-description").html(info.description);
        },
        editable: true,
        droppable: true,
        selectable: true,
        editable: true,
        selectHrlper: true,
        select: function (start, end, allDay) {},
    });
});
