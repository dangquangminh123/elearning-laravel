import "./en.js";
import "./datepicker.js";

// Gắn event khi document ready
$(document).ready(function () {
    $('.datepicker').each(function () {
        $(this).datepicker({
            firstDayOfWeek: Date.dp_locales.firstday_of_week,
            inputFormat: [Date.dp_locales.short_format],
            outputFormat: Date.dp_locales.short_format,
            titleFormat: Date.dp_locales.full_format,
            weekDayFormat: 'short',
            theme: 'green', // Hoặc "bootstrap", "default", "blue", "maroon"
            markup: 'bootstrap4',
            buttonLabel: Date.dp_locales.texts.buttonLabel,
            buttonTitle: Date.dp_locales.texts.buttonTitle,
            closeButtonLabel: Date.dp_locales.texts.closeButtonLabel,
            closeButtonTitle: Date.dp_locales.texts.closeButtonTitle,
        });
    });
});