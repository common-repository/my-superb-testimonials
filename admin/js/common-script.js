(function($) {
    "use strict";
    var errorCounter = 0;
    var errorMessage;
    var tempString;
    $(document).on("click", ".plan-switch", function(){
        if($(this).find("input[type='checkbox']").is(":checked")) {
            $(this).closest(".price-switch").find(".yearly-plan").removeClass("active");
            $(this).closest(".price-switch").find(".annualy-plan").addClass("active");
            var planPrice = $(this).closest(".price-switch").find(".annualy-plan").data("price");
            var planUrl = $(this).closest(".price-switch").find(".annualy-plan").data("url");
            var planDesc = $(this).closest(".price-switch").find(".annualy-plan").data("desc");
            var planType = $(this).closest(".price-switch").find(".annualy-plan").data("plan");
            $(this).closest(".price-table").find(".package-desc").text(planDesc);
            $(this).closest(".price-table").find(".package-price").html(planPrice+"<span>"+planType+"</span>");
            $(this).closest(".price-table").find(".checkout-url").attr("href", planUrl);
        } else {
            $(this).closest(".price-switch").find(".yearly-plan").addClass("active");
            $(this).closest(".price-switch").find(".annualy-plan").removeClass("active");
            var planPrice = $(this).closest(".price-switch").find(".yearly-plan").data("price");
            var planUrl = $(this).closest(".price-switch").find(".yearly-plan").data("url");
            var planDesc = $(this).closest(".price-switch").find(".yearly-plan").data("desc");
            var planType = $(this).closest(".price-switch").find(".yearly-plan").data("plan");
            $(this).closest(".price-table").find(".package-desc").text(planDesc);
            $(this).closest(".price-table").find(".package-price").html(planPrice+"<span>"+planType+"</span>");
            $(this).closest(".price-table").find(".checkout-url").attr("href", planUrl);
        }
    });
})(jQuery);