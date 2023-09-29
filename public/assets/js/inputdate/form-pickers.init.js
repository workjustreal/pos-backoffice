/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Form pickers init js
*/

!(function ($) {
    "use strict";

    var FormPickers = function () {};

    (FormPickers.prototype.init = function () {
        //Flat picker
        $(".datepicker").flatpickr({
            minDate: Date.now(),
        });
        $(".holiday-datepicker").flatpickr({});
        $(".emp-datepicker").flatpickr({
            // minDate: Date.now(),
            dateFormat: "d/m/Y",
        });
        $(".custom-datepicker").flatpickr({
            // minDate: Date.now(),
            dateFormat: "d/m/Y",
        });
    }),
        ($.FormPickers = new FormPickers()),
        ($.FormPickers.Constructor = FormPickers);
})(window.jQuery),
    //initializing
    (function ($) {
        "use strict";
        $.FormPickers.init();
    })(window.jQuery);
