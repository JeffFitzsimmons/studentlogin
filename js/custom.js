$(document).ready(function () {
    $('.selectpicker').selectpicker();
});


$(document).ready(function() {
    $checks = $(":checkbox");
    $checks.on('click', function() {
        var string = $checks.filter(":checked").map(function(i,v){
            return this.value;
        }).get().join(", ");
        $('#classes').val(string);
    });
});


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


$("input#pid").blur(function() {
    var pid = $('input#pid').val();
    if ($.trim(pid) != '') {
        $.post('checkLoginCount.php', {pid: pid}, function(data) {
            if (data % 20 == 0) {
                $('#loginCountModal').modal('show');
            }
        });
    }
});
