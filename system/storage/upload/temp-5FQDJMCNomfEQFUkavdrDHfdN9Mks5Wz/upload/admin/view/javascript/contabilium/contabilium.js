jQuery(document).ready(function($) {
  $("#form-contabilium input").keyup(function() {
    var $this = $(this);
    text = $this.val();
    if (text.length > 0) {
      $this
        .closest(".form-group")
        .removeClass("has-error")
        .addClass("has-success");
    } else {
      $this
        .closest(".form-group")
        .removeClass("has-success")
        .addClass("has-error");
    }
  });

  $('input[name="module_contabilium_active[]"]').change(function() {
    $('input[name="module_contabilium_status"]').val($(this).val());
  });

  $(".update").click(function(e) {
    e.preventDefault();
    $this = $(this);
    l = $(this).ladda();
    var link = $this.data("link");
    var alert = $("#contabilium_alert");

    alert
      .removeClass("alert-success")
      .removeClass("alert-error")
      .addClass("alert-default")
      .text("Procesando...");

    l.ladda("start");
    $.ajax({
      type: "GET",
      url: link,
      success: function(data) {
        l.ladda("stop");
        if (data.error) {
          alert
            .removeClass("alert-default")
            .removeClass("alert-warning")
            .removeClass("alert-success")
            .addClass("alert-error")
            .text(data.message)
            .fadeIn();
        } else if (data.warning) {
          alert
            .removeClass("alert-default")
            .removeClass("alert-error")
            .removeClass("alert-success")
            .addClass("alert-warning")
            .text(data.message)
            .fadeIn();
        } else {
          alert
            .removeClass("alert-default")
            .removeClass("alert-warning")
            .removeClass("alert-error")
            .addClass("alert-success")
            .text(data.message)
            .fadeIn();
        }
      },
      dataType: "json"
    });
  });
});
