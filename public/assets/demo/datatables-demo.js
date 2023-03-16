// Call the dataTables jQuery plugin
$(document).ready(function () {
    $("#dataTable").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
    });
});
