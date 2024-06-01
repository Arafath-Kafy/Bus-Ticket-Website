$(document).ready(function () {
    function loadPage(page) {
      $.ajax({
        url: page + ".php",
        method: "GET",
        success: function (data) {
          $("#content").html(data);
        },
        error: function () {
          toastr.error("Failed to load page");
        },
      });
    }
  
    $("#dashboard-link").click(function () {
      loadPage("dashboard");
    });
  
    $("#buses-link").click(function () {
      loadPage("buses");
    });
  
    $("#customers-link").click(function () {
      loadPage("customers");
    });
  
    // Load dashboard by default
    loadPage("dashboard");
  });
  