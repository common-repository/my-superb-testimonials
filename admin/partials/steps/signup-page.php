<div class="sign-up-container">
    <div class="sign-up-box">
        <div class="sign-up-data">
            <div class="left-section">
                <img src="<?php echo esc_url(SUPERB_TESTIMONIALS_URL."admin/images/left-section.png") ?>" class="left-section-img">
            </div>
            <form id="gp_sticky_sign_up" autocomplete="off">
                <div class="right-section">
                    <div class="sign-up-header">
                        <span style="color: #5067F3;">Stay</span>
                        Updated with All the Latest Implementations and Tips by Subscribing Here. 💼
                    </div>
                    <div class="sign-up-desc">
                        Subscribe now to get quick updates regarding our new features, the latest developments, exciting offers and discounts.
                    </div>
                    <div class="sign-up-email-box">
                        <input type="email" required="" name="email_id" class="input-email" placeholder="example@domain.com">
                        <button type="submit" class="sign-up-btn"><i class="fas fa-angle-right icon-right"></i></button>
                    </div>
                    <div class="sign-up-content">
                        If you don't want updates in future from us, you can easily unsubscribe with a single click.
                    </div>
                    <div class="skip-link">
                        <a href="#" id="skip_now">Skip for now</a>
                    </div>
                </div>
                <input type="hidden" name="action" value="superb_testimonials_save_sign_up_info" />
            </form>
        </div>
    </div>
</div>
<script>
    (function($) {
        var emailId = $("input[name='email_id']").val();
        $(document).on("submit", "#gp_sticky_sign_up", function(e){
            e.preventDefault();
            $.ajax({
                url: "<?php echo admin_url('admin-ajax.php') ?>",
                data: {
                    email_id: emailId,
                    is_signup : 1,
                    nonce: "<?php echo wp_create_nonce("superb_testimonials_save_sign_up_info_nonce") ?>",
                    action: "superb_testimonials_save_sign_up_info"
                },
                type: 'post',
                success: function(responseText) {
                    window.location.reload();
                }
            });
        });

        $(document).on("click", "#skip_now", function(){
            $.ajax({
                url: "<?php echo admin_url('admin-ajax.php') ?>",
                data: {
                    skip: "skip",
                    is_signup : 1,
                    nonce: "<?php echo wp_create_nonce("superb_testimonials_save_sign_up_info_nonce") ?>",
                    action: "superb_testimonials_save_sign_up_info"
                },
                type: 'post',
                success: function(responseText) {
                    window.location.reload();
                }
            });
        });
    })(jQuery);
</script>