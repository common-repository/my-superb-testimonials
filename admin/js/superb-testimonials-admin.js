(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

    var formOptions = {
        beforeSubmit:  showRequest,  // pre-submit callback
        success:       showResponse
    };
    var id = 0;
    var term_id = 0;
    var code_id = 0;
    var clone_code_id = 0;
    var code_new_name = "";

    $(document).ready(function() {

        //$(".sc-third-column").show();

        //Stars rating
        $('#stars li').on('mouseover', function () {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function (e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function () {
            $(this).parent().children('li.star').each(function (e) {
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('#stars li').on('click', function(){
            var i;
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            $("#st_stars").val(ratingValue);
        });

        //Upload client image
        $(document).on("click", ".remove-image", function(){
            $('.client-image-preview').html("");
            $('#client_image').val("");
            $(this).removeClass("active");
        });
        $(document).on("click", ".upload-image", function(){
            var imageTst = wp.media({
                title: 'Upload Image',
                multiple: false,
                library: {
                    type: 'image'
                }
            }).open()
                .on('select', function (e) {
                    var uploaded_image = imageTst.state().get('selection').first();
                    var imageData = uploaded_image.toJSON();
                    $('.remove-image').addClass("active");
                    $('#client_image').val(imageData.id);
                    $('.client-image-preview').html("<img src='"+imageData.url+"' />");
                });
        });

        //Sumoselect dropdown for testimonial categories
        $("select.st-categories").SumoSelect({
            placeholder : 'Select Category'
        });

        //Sumoselect dropdown for shortcode category settings
        $("select.st-setting-categories").SumoSelect({
            placeholder : 'Select Category'
        });

        //Sumoselect dropdown for shortcode order settings
        $("select.st-setting-order").SumoSelect();

        //Shortcodes radio button
        //$(document).on("click", ".sc-type-radio", function() {
        //    $('.sc-type-radio').removeClass('active');
        //    var value = $(this).data('value');
        //    $('#sc_type_' + value).addClass('active');
        //    $('.sc-type').attr("checked", false);
        //    //$(this).find('.sc-type').attr("isChecked", true);
        //    $(this).find('.sc-type').attr("checked", true);
        //    if($(".sc-type-radio").hasClass("active")){
        //        $("#sc_style_button").removeAttr('disabled');
        //        $(".create-shortcode").removeClass('active');
        //        $('#sc_style').addClass('active');
        //        $("#sc_type_button").addClass('active');
        //        $("#sc_style_button").addClass('active');
        //    }
        //});
        //
        //if($("input[name='setting[sc_type]']:checked")){
        //    var type = $("input[name='setting[sc_type]']:checked").val();
        //    $("#sc_type_"+type).addClass("active");
        //}
        //
        //if($(".sc-type-radio").hasClass("active")){
        //    $("#sc_style_button").removeAttr('disabled');
        //    $(".create-shortcode").removeClass('active');
        //    $('#sc_style').addClass('active');
        //    $("#sc_type_button").addClass('active');
        //    $("#sc_style_button").addClass('active');
        //}

        //Shortcodes styling
        $(document).on("click", ".style-box", function() {
            $('.style-box').removeClass('active');
            var style = $(this).data('style');
            $('#sc_style_' + style).addClass('active');
            $("#sc_style_value").val(style);
            var style_preview = $(this).find('.grid-col-3').html();
            $(".styling-preview").html(style_preview);
            $(".styling-preview").attr("class",'styling-preview');
            $(".styling-preview").addClass("superb-style-"+style);
            if($(".style-box").hasClass('active')){
                $("#sc_styling_button").removeAttr('disabled');
                $("#sc_setting_button").removeAttr('disabled');
                $(".create-shortcode").removeClass('active');
                $('#sc_styling').addClass('active');
                $("#sc_type_button").addClass('sc-first-button');
                $("#sc_styling_button").addClass('sc-third-button');
            }
            $(".sc-first-column").addClass("button-3").removeClass("button-1 button-2 button-4");
            $(".sc-second-column").addClass("step-2").removeClass("step-1");
        });

        if($("#sc_style_value").val() != ''){
            var style = $("#sc_style_value").val();
            $('#sc_style_' + style).addClass('active');
            var style_preview = $("#sc_style_" + style).find('.grid-col-3').html();
            $(".styling-preview").html(style_preview);
            $(".styling-preview").attr("class",'styling-preview');
            $(".styling-preview").addClass("superb-style-"+style);
        }

        if($(".style-box").hasClass('active')){
            $("#sc_styling_button").removeAttr('disabled');
            $("#sc_setting_button").removeAttr('disabled');
            $(".create-shortcode").removeClass('active');
            $('#sc_styling').addClass('active');
            $("#sc_type_button").addClass('sc-first-button');
            $("#sc_styling_button").addClass('sc-third-button');

            //For Free
            $('#sc_style').addClass('active');
        }

        $(document).on("click", "#sc_type_button", function() {
            $(this).addClass('sc-first-button');
            $(".create-shortcode").removeClass('active');
            $('#sc_type').addClass('active');
            $(".sc-first-column").addClass("button-1").removeClass("button-2 button-3 button-4");
            $(".sc-second-column").addClass("step-1").removeClass("step-2");
        });

        $(document).on("click", "#sc_style_button", function() {
            $(this).addClass('sc-second-button');
            $(".create-shortcode").removeClass('active');
            $('#sc_style').addClass('active');
            $(".sc-first-column").addClass("button-2").removeClass("button-1 button-3 button-4");
            $(".sc-second-column").addClass("step-1").removeClass("step-2");
        });

        $(document).on("click", "#sc_styling_button", function() {
            $(this).addClass('sc-third-button');
            $(".create-shortcode").removeClass('active');
            $('#sc_styling').addClass('active');
            $(".sc-first-column").addClass("button-3").removeClass("button-1 button-2 button-4");
            $(".sc-second-column").addClass("step-2").removeClass("step-1");
        });

        if($("#sc_style_button").hasClass("sc-second-button")) {
            $(".sc-second-column").addClass("step-1");
        }

        $(document).on("click", "#sc_setting_button", function() {
            //if($(".sc-button.active").length > 1){
            //    $(this).addClass('active');
            //}else{
            $(this).addClass('sc-fourth-button');
            //}
            $(".create-shortcode").removeClass('active');
            $('#sc_setting').addClass('active');
            $(".sc-first-column").addClass("button-4").removeClass("button-1 button-2 button-3");
            $(".sc-second-column").addClass("step-2").removeClass("step-1");
        });

        $(document).on("click",".sc-column-radio",function(){
            $(".sc-column-radio").attr("checked",false);
            $(this).attr("checked",true);
        });

        $(document).on("click",".prev-style",function(){
            $(window).scrollTop(0);
            $(".create-shortcode").removeClass('active');
            $('#sc_style').addClass('active');
            $(".sc-second-column").addClass("step-1").removeClass("step-2");
            $(".sc-first-column").addClass("button-2").removeClass("button-1 button-3 button-4");
            //$("#sc_style_button").addClass("sc-second-button");
        });

        $(document).on("click",".next-setting",function(){
            $(window).scrollTop(0);
            $(".create-shortcode").removeClass('active');
            $('#sc_setting').addClass('active');
            $(".sc-first-column").addClass("button-4").removeClass("button-1 button-2 button-3");
            $("#sc_setting_button").addClass("sc-fourth-button");
        });

        $(document).on("click",".prev-styling",function(){
            $(window).scrollTop(0);
            $(".create-shortcode").removeClass('active');
            $('#sc_styling').addClass('active');
            $(".sc-first-column").addClass("button-3").removeClass("button-1 button-2 button-4");
            $("#sc_styling_button").addClass("sc-third-button");
        });

        $(document).on("click",".copy-code-text",function(){
            var code = $(this).data("code");
            var copyText = document.getElementById("code_"+code);
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            $(this).attr("data-ginger-tooltip","Shortcode Copied");
            setTimeout(function(){
                $(".copy-code-text").attr("data-ginger-tooltip","Copy Shortcode");
            },5000);
        });

        // Delete Testimonial
        $(document).on("click",".remove-testimonial",function(){
            id = $(this).data("id");
            $("#delete-testimonial").addClass("active");
        });

        $(document).on("click", ".gp-popup .hide-gp-popup", function() {
            $(this).closest(".gp-popup").removeClass("active");
        });

        $(document).on("click", ".gp-popup-overlay", function() {
            $(this).closest(".gp-popup").removeClass("active");
        });

        $(document).on("click", "#delete_testimonial:not(.disabled)", function(e){
            $(this).addClass("disabled");
            e.preventDefault();
            $.ajax({
                url: SUPERB_TESTIMONIAL.AJAX_URL,
                data: {
                    testimonial_id: id,
                    nonce: $("tr.testimonial-col-"+id).data("nonce"),
                    action: "superb_testimonials_remove_testimonial"
                },
                type: 'post',
                success: function(responseText) {
                    $("#delete-testimonial").removeClass("active");
                    $("#delete_testimonial").removeClass("disabled");
                    responseText = $.parseJSON(responseText);
                    const swipeHandler = new SwipeHandler();
                    const toastsHandler = new ToastsHandler(swipeHandler);
                    if(responseText.status == 1) {
                        $("tr.testimonial-col-"+id).remove();
                        toastsHandler.createToast({
                            type: "success",
                            icon: "info-circle",
                            message: responseText.message,
                            duration: 5000
                        });
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    } else {
                        $(".save-changes").prop("disabled", false);
                        toastsHandler.createToast({
                            type: "error",
                            icon: "info-circle",
                            message: responseText.message,
                            duration: 5000
                        });
                    }
                }
            });
        });

        // Delete Taxonomy
        $(document).on("click",".remove-term",function(){
            term_id = $(this).data("id");
            $("#delete-term").addClass("active");
        });

        $(document).on("click", "#delete_term:not(.disabled)", function(e){
            $(this).addClass("disabled");
            e.preventDefault();
            $.ajax({
                url: SUPERB_TESTIMONIAL.AJAX_URL,
                data: {
                    term_id: term_id,
                    nonce: $("tr.term-col-"+term_id).data("nonce"),
                    action: "superb_testimonials_remove_term"
                },
                type: 'post',
                success: function(responseText) {
                    $("#delete-term").removeClass("active");
                    $("#delete_term").removeClass("disabled");
                    responseText = $.parseJSON(responseText);
                    const swipeHandler = new SwipeHandler();
                    const toastsHandler = new ToastsHandler(swipeHandler);
                    if(responseText.status == 1) {
                        $("tr.term-col-"+term_id).remove();
                        toastsHandler.createToast({
                            type: "success",
                            icon: "info-circle",
                            message: responseText.message,
                            duration: 5000
                        });
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    } else {
                        $(".save-changes").prop("disabled", false);
                        toastsHandler.createToast({
                            type: "error",
                            icon: "info-circle",
                            message: responseText.message,
                            duration: 5000
                        });
                    }
                }
            });
        });

        // Delete Shortcode
        $(document).on("click",".remove-shortcode",function(){
            code_id = $(this).data("id");
            $("#delete-shortcode").addClass("active");
        });

        $(document).on("click", "#delete_shortcode:not(.disabled)", function(e){
            $(this).addClass("disabled");
            e.preventDefault();
            $.ajax({
                url: SUPERB_TESTIMONIAL.AJAX_URL,
                data: {
                    code_id: code_id,
                    nonce: $("tr.shortcode-col-"+code_id).data("nonce"),
                    action: "superb_testimonials_remove_shortcode"
                },
                type: 'post',
                success: function(responseText) {
                    $("#delete-shortcode").removeClass("active");
                    $("#delete_shortcode").removeClass("disabled");
                    responseText = $.parseJSON(responseText);
                    const swipeHandler = new SwipeHandler();
                    const toastsHandler = new ToastsHandler(swipeHandler);
                    if(responseText.status == 1) {
                        $("tr.shortcode-col-"+code_id).remove();
                        toastsHandler.createToast({
                            type: "success",
                            icon: "info-circle",
                            message: responseText.message,
                            duration: 5000
                        });
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    } else {
                        $(".save-changes").prop("disabled", false);
                        toastsHandler.createToast({
                            type: "error",
                            icon: "info-circle",
                            message: responseText.message,
                            duration: 5000
                        });
                    }
                }
            });
        });

        // Clone Shortcode
        $(document).on("click",".clone-shortcode",function(){
            clone_code_id = $(this).data("id");
            var code_name = $(this).data("name");
            code_new_name = code_name + " #2";
            $("#copy-shortcode").addClass("active");
            $("#colne_name").val(code_new_name);
        });

        $(document).on("click", "#copy_shortcode:not(.disabled)", function(e){
            $(this).addClass("disabled");
            e.preventDefault();
            $.ajax({
                url: SUPERB_TESTIMONIAL.AJAX_URL,
                data: {
                    clone_code_name: $("#colne_name").val(),
                    clone_code_id: clone_code_id,
                    nonce: $("tr.shortcode-col-"+clone_code_id).data("nonce"),
                    action: "superb_testimonials_clone_shortcode"
                },
                type: 'post',
                success: function(responseText) {
                    $("#copy-shortcode").removeClass("active");
                    $("#copy_shortcode").removeClass("disabled");
                    responseText = $.parseJSON(responseText);
                    const swipeHandler = new SwipeHandler();
                    const toastsHandler = new ToastsHandler(swipeHandler);
                    if(responseText.status == 1) {
                        toastsHandler.createToast({
                            type: "success",
                            icon: "info-circle",
                            message: responseText.message,
                            duration: 5000
                        });
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    } else {
                        $(".save-changes").prop("disabled", false);
                        toastsHandler.createToast({
                            type: "error",
                            icon: "info-circle",
                            message: responseText.message,
                            duration: 5000
                        });
                    }
                }
            });
        });

        $(".fab-color-picker").wpColorPicker({
            change: function(event, ui){
                stylePreview();
            }
        });

        /* AJAX Form Submit */
        $(document).on("submit", "#new_testimonial_form", function(){
            var errorCount = 0;
            $(this).find(".has-error").removeClass("has-error");
            $(this).find(".is-required").each(function(){
                if($.trim($(this).val()) == "") {
                    $(this).addClass("has-error");
                    errorCount++;
                }
            });
            $(this).find(".select-required").each(function(){
                if($.trim($(this).val()) == "") {
                    $(this).addClass("has-error");
                    errorCount++;
                }
            });
            if(errorCount == 0) {
                $(this).find(".gp-submit-btn").addClass("disabled");
                $(this).ajaxSubmit(formOptions);
            } else {
                $(this).find(".has-error:first").focus();
                const swipeHandler = new SwipeHandler();
                const toastsHandler = new ToastsHandler(swipeHandler);
                toastsHandler.createToast({
                    type: "error",
                    icon: "info-circle",
                    message: "Some values are missing",
                    duration: 5000
                });
            }
            return false;
        });

        //Pagination Link
        $(document).on("click",".ajax-pagination a", function (e) {
            e.preventDefault();
            var thisLink = $(this).prop("href");
            $(".gp-loader").addClass("disabled");
            history.pushState({}, "", thisLink);
            $("#ajax-table").load(thisLink + " #ajax-table-data", function () {
                $(".gp-loader").removeClass("disabled");
            });
        });

        $(document).on("keyup",".sc-columns input",function(){
            stylePreview();
        });

        $(document).on("change",".sc-columns input, .sc-columns select",function(){
            stylePreview();
        });

        $(document).on("click","input[type='checkbox']",function(){
            stylePreview();
        });

        //Show selected star for update testimonial form
        var star = $(".stars-value").val();
        var stars = $("#stars li").parent().children('li.star');
        for (var i = 0; i < star; i++) {
            $(stars[i]).addClass('selected');
        }

        //Show remove image button
        var img_src = $("#test_img").attr('src');
        if(img_src){
            $('.remove-image').addClass("active");
        }

        stylePreview();

    });

    function showRequest(formData, jqForm, options) {
        $(".save-changes").prop("disabled", true);
        $(".gp-loader").addClass("disabled");
    }

    function showResponse(responseText, statusText, xhr, $form) {
        $(".gp-loader").removeClass("disabled");
        responseText = $.parseJSON(responseText);
        const swipeHandler = new SwipeHandler();
        const toastsHandler = new ToastsHandler(swipeHandler);
        if(responseText.status == 1) {
            toastsHandler.createToast({
                type: "success",
                icon: "info-circle",
                message: responseText.message,
                duration: 5000
            });
            setTimeout(function(){
                window.location = responseText.data.URL;
            }, 1000);
        } else {
            $(".gp-loader").removeClass("disabled");
            $(".gp-submit-btn").removeClass("disabled");
            $(".save-changes").prop("disabled", false);
            toastsHandler.createToast({
                type: "error",
                icon: "info-circle",
                message: responseText.message,
                duration: 5000
            });
            //setTimeout(function(){
            //    window.location.reload();
            //}, 5000);
        }
    }

    function stylePreview(){
        var temp = "";
        var css = "";

        //Testimonial title color
        temp = $("input[name='setting_color[title_color]']").val();
        $(".styling-preview .superb-content .superb-title").css("color", temp);

        //Testimonial description color
        temp = $("input[name='setting_color[description_color]']").val();
        $(".styling-preview .superb-content").css("color", temp);

        //Author name color
        temp = $("input[name='setting_color[author_name]']").val();
        $(".styling-preview .author-name").css("color", temp);

        //Designation color
        temp = $("input[name='setting_color[designation]']").val();
        $(".styling-preview .author-info .author-designation").css("color", temp);

        //Company color
        temp = $("input[name='setting_color[company]']").val();
        $(".styling-preview .author-info .author-company").css("color", temp);

        //Location color
        temp = $("input[name='setting_color[location]']").val();
        $(".styling-preview .author-info .author-location").css("color", temp);

        //Rating color
        temp = $("input[name='setting_color[rating]']").val();
        $(".styling-preview .author-rating").css("color", temp);


        //Description box color
        temp = $("input[name='setting_color[desc_bg]']").val();
        $(".styling-preview .superb-content").css("background", temp);

        $("#custom_css").remove();

        css = "<style id='custom_css'>";
        css += ".styling-preview.superb-style-1 .superb-content:after {border-top:8px solid" + temp + "}";
        css += ".styling-preview.superb-style-2 .superb-content:after {border-bottom:8px solid" + temp + "}";
        css += "</style>";

        $("head").append(css);

        //Testimonial box color
        temp = $("input[name='setting_color[box_bg]']").val();
        $(".styling-preview").css("background", temp);

        //Hide Title fields
        if($("input[name='setting[fields][title]']").is(":checked")) {
            $(".styling-preview .superb-title").show();
        }else{
            $(".styling-preview .superb-title").hide();
        }

        //Hide name field
        if($("input[name='setting[fields][name]']").is(":checked")) {
            $(".styling-preview .author-name").show();
        }else {
            $(".styling-preview .author-name").hide();
        }

        //Hide image field
        if($("input[name='setting[fields][image]']").is(":checked")) {
            $(".styling-preview .author-image").show();
        }else{
            $(".styling-preview .author-image").hide();
        }

        //Hide designation field
        if($("input[name='setting[fields][designation]']").is(":checked")) {
            $(".styling-preview .author-designation").show();
        }else {
            $(".styling-preview .author-designation").hide();
        }

        //Hide company field
        if($("input[name='setting[fields][company]']").is(":checked")) {
            $(".styling-preview .author-company").show();
        }else {
            $(".styling-preview .author-company").hide();
        }

        //Hide location field
        if($("input[name='setting[fields][location]']").is(":checked")) {
            $(".styling-preview .author-location").show();
        }else{
            $(".styling-preview .author-location").hide();
        }

        //Hide rating field
        if($("input[name='setting[fields][rating]']").is(":checked")) {
            $(".styling-preview .author-rating").show();
        }else {
            $(".styling-preview .author-rating").hide();
        }

    }


})( jQuery );
