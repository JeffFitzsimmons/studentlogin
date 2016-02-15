$('input#pid').keyup(function(event) {
    if (this.value.length == 6) {
        var pid = $('input#pid').val();
        if ($.trim(pid) != '') {
            $.post('autocomplete.php', {pid: pid}, function(data) {
                $('input#lastName').val(data)
            });
        }
    }
});


$(document).ready(function () {
    $('.selectpicker').selectpicker();
});
