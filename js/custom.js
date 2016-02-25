// Necessary for bootstrap multiselect design
$(document).ready(function () {
    $('.selectpicker').selectpicker();
});


// Populates the Classes based on checkboxes
$(document).ready(function() {
    $checks = $(":checkbox");
    $checks.on('click', function() {
        var string = $checks.filter(":checked").map(function(i,v){
            return this.value;
        }).get().join(", ");
        $('#classes').val(string);
    });
});


// Auto populates the Last Name based PID's in database
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


// Checks the login count to trigger modal if it is a multiple of 20
$("input#pid").blur(function() {
    var pid = $('input#pid').val();
    if ($.trim(pid) != '') {
        $.post('checkLoginCount.php', {pid: pid}, function(data) {
            if (data % 20 == 0 && data != 0) {
                $('#loginCountModal').modal('show');
            }
        });
    }
});
