(function ($) {
  "use strict";
  $("#sky-enterprise-dismiss-notice").on("click", ".notice-dismiss", function () {
    $.ajax({
      url: ajaxurl,
      data: {
        action: "sky_enterprise_dismissble_notice",
      },
    });
  });
  $("#sky-enterprise-dashboard-tabs-nav li:first-child").addClass("active");
  $(".tab-content").hide();
  $(".tab-content:first").show();
  $("#sky-enterprise-dashboard-tabs-nav li").click(function () {
    $("#sky-enterprise-dashboard-tabs-nav li").removeClass("active");
    $(this).addClass("active");
    $(".tab-content").hide();
    var activeTab = $(this).find("a").attr("href");
    $(activeTab).fadeIn();
    return false;
  });
})(jQuery);
