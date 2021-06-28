$(document).ready(function() {
    $("select").change(function() {
        $('input[type="text"]').hide();
        $('input[type="button"]').hide();
        $('input[name*="' + $(this).val() + '"]').show();
        $('input[name*="' + $(this).val() + '"]').show();
        if ($(this).val() == "0") {
            $('input[type="text"]').show();
            $('input[type="button"]').show();
        }
    })
})