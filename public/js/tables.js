// Datatables

$(document).ready(() => {
    $("#dt_users").DataTable({
        responsive: true,
    });

  setTimeout(function () {
    // $("#dt_users").DataTable({
    //   responsive: true,
    // });

    // $('#dt_users').DataTable({
    //   processing: true,
    //   serverSide: true,
    //   ajax: '../server_side/scripts/server_processing.php',
    // });

    $("#example2").DataTable({
      scrollY: "292px",
      scrollCollapse: true,
      paging: false,
      searching: false,
      info: false,
    });
  }, 2000);
});
