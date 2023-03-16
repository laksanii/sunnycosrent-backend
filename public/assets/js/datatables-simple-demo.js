window.addEventListener("DOMContentLoaded", (event) => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById("datatablesSimple");
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            responsive: true,
            info: false,
            lengthChange: false,
            lengthMenu: [1, 2, 3, 4],
        });
    }
});
