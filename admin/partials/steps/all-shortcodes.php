<?php
/**
 * List shortcode functionality of the plugin.
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */

if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;
$tbPost       = $wpdb->prefix."posts";
$numOfRecords = 10;
$page         = filter_input(INPUT_GET, 'paged');
$paged        = isset($page)&&!empty($page)&&is_numeric($page)&&$page > 0 ? sanitize_text_field($page) : 1;
$start        = (($paged - 1) * $numOfRecords);
$query        = "SELECT ID FROM  $tbPost WHERE post_type = 'superb_code' AND post_status = 'publish' LIMIT {$start}, $numOfRecords";
$codeData     = $wpdb->get_results($query);
$noRecords    = (empty($codeData) && $paged == 1)?1:0;
?>
<div class="gp-form-wrapper">
    <?php if($noRecords) { ?>
        <style>
            #wpcontent, #wpfooter {
                background-color:  #EEF0FF;
            }
            #wpfooter {
                display: none;
            }
            #wpcontent, #wpbody-content {
                padding: 0;
            }
            .gp-no-records {
                width: 100%;
                position: relative;
                min-height: 640px;
                background-color: #EEF0FF;
                height: calc(100vh - 32px);
            }
            .gp-no-records-box {
                width: 800px;
                margin: 0 auto;
                position: absolute;
                left: 0;
                right: 0;
                height: auto;
                transform: translate(0, -50%);
                top: 50%;
            }
            .gp-no-records-top {
                width: 350px;
                margin: 0 auto 50px;
            }
            .gp-no-records-top svg {
                width: 100%;
            }
            .no-records-title {
                font-size: 24px;
                text-align: center;
                position: relative;
                padding: 0 0 10px 0;
                margin: 0 0 40px 0;
                font-family: 'Fjalla One', sans-serif;
                line-height: 32px;
            }
            .no-records-title:after {
                content: "";
                width: 120px;
                height: 2px;
                background: #5067f3;
                position: absolute;
                left: 0;
                right: 0;
                top: 100%;
                margin: 0 auto;
            }
            .no-records-features {
                max-width: 1024px;
                margin: 0 auto;
            }
            .no-records-features ul {
                margin: 0;
                padding: 0;
            }
            .no-records-features ul li {
                display: block;
                padding: 0 0 4px 0;
                font-size: 18px;
                line-height: 28px;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
                font-style: normal;
                font-weight: 500;
            }
            .no-records-features ul li i {
                color: #5067f3;
                font-size: 16px;
            }
            .gp-no-records-bottom {
                text-align: center;
                margin: 40px 0 30px;
            }
            .text-color {
                color: #1B2B8D;
            }
        </style>
        <div class="gp-no-records">
            <div class="gp-no-records-box">
                <div class="gp-no-records-top">
                    <svg viewBox="0 0 196 123" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_26_3372)">
                            <path d="M162.75 80.0578C162.75 42.6576 132.37 12.3723 94.9242 12.3723C57.4782 12.3723 27.0987 42.6891 27.0987 80.0578C27.0987 95.7672 32.4616 110.186 41.4209 121.677H148.396C157.387 110.186 162.75 95.7357 162.75 80.0578Z" fill="#F8E9F6"/>
                            <path d="M55.7115 14.3871H31.2628C30.8212 14.3871 30.4426 14.0408 30.4426 13.5686V6.76855C30.4426 6.32781 30.7896 5.95003 31.2628 5.95003H55.7115C56.1532 5.95003 56.5318 6.29633 56.5318 6.76855V13.6001C56.5002 14.0408 56.1532 14.3871 55.7115 14.3871Z" fill="#DD4C88"/>
                            <path d="M34.3228 8.84634H51.0111" stroke="#FDFCFF" stroke-width="1.9364" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M34.3228 11.113H40.506" stroke="#FDFCFF" stroke-width="1.9364" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M52.3676 13.4741V16.4334C52.3676 16.5279 52.273 16.5593 52.2099 16.5279L48.3927 13.5056H52.3676V13.4741Z" fill="#DD4C88"/>
                            <path d="M34.4806 92.556H17.7608C16.1519 92.556 14.827 91.2338 14.827 89.6283V74.1393C14.827 72.9115 15.8365 71.9041 17.0668 71.9041H34.4806C35.7109 71.9041 36.7204 72.9115 36.7204 74.1393V90.3208C36.6889 91.5486 35.6794 92.556 34.4806 92.556Z" fill="#00377E"/>
                            <path d="M29.1176 79.8375C28.2974 79.0189 26.9725 79.0504 26.1523 79.8689L25.616 80.4041L25.0797 79.8689C24.2594 79.0504 22.9345 79.0819 22.1143 79.9004C21.294 80.7189 21.3256 82.0412 22.1458 82.8597L24.1648 84.843C24.4803 85.1579 24.8904 85.3467 25.3005 85.4097C25.9314 85.5041 26.6255 85.3153 27.0987 84.8116L29.0861 82.7652C29.9694 81.9467 29.9379 80.6245 29.1176 79.8375Z" fill="white"/>
                            <path d="M172.435 79.4912H153.759C151.929 79.4912 150.478 78.0115 150.478 76.2171V58.9022C150.478 57.517 151.582 56.4151 152.97 56.4151H172.435C173.823 56.4151 174.927 57.517 174.927 58.9022V77.0356C174.927 78.3893 173.823 79.4912 172.435 79.4912Z" fill="#AB8BDB"/>
                            <path d="M161.33 71.4633C163.065 71.4948 164.8 71.5263 166.378 71.4004C166.882 71.3689 167.324 70.5819 166.693 70.33C166.945 70.2041 167.198 70.0781 167.324 69.7948C167.419 69.5115 167.292 69.1652 167.009 69.0707C167.608 69.2281 167.829 68.2837 167.387 67.9689C167.639 67.7485 167.829 67.4967 167.892 67.1504C167.955 66.8355 167.797 66.4578 167.513 66.3004C167.324 66.2059 167.103 66.2059 166.882 66.2059C166.157 66.2059 165.431 66.2059 164.737 66.1744C164.926 65.0411 164.99 63.8448 164.422 62.8374C164.264 62.554 163.791 62.1763 163.412 62.4281C163.065 62.6485 163.16 63.1837 163.191 63.4985C163.254 64.8837 162.466 66.3004 161.235 66.9615C161.267 66.9615 161.362 69.9522 161.33 71.4633Z" fill="#FAFAFA"/>
                            <path d="M160.731 66.9615H158.112V71.4319H160.731V66.9615Z" fill="#FAFAFA"/>
                            <path d="M154.674 9.31857C155.911 9.31857 156.914 8.31784 156.914 7.08337C156.914 5.84891 155.911 4.84818 154.674 4.84818C153.437 4.84818 152.434 5.84891 152.434 7.08337C152.434 8.31784 153.437 9.31857 154.674 9.31857Z" stroke="#FDFCFF" stroke-width="1.7845" stroke-miterlimit="10"/>
                            <path d="M2.87074 104.519C4.10776 104.519 5.11056 103.518 5.11056 102.284C5.11056 101.049 4.10776 100.049 2.87074 100.049C1.63372 100.049 0.63092 101.049 0.63092 102.284C0.63092 103.518 1.63372 104.519 2.87074 104.519Z" stroke="#FDFCFF" stroke-width="1.7845" stroke-miterlimit="10"/>
                            <path d="M195.716 60.6966C195.716 61.5151 195.054 62.1763 194.233 62.1763C193.413 62.1763 192.751 61.5151 192.751 60.6966C192.751 59.8781 193.413 59.217 194.233 59.217C195.054 59.217 195.716 59.8781 195.716 60.6966Z" stroke="#FDFCFF" stroke-width="1.7845" stroke-miterlimit="10"/>
                            <path d="M9.02238 18.6057C9.02238 18.6057 8.26525 19.8649 9.3063 20.6205C10.3473 21.376 11.2306 19.9594 12.3663 20.8408C13.502 21.6909 12.5556 22.7612 12.5556 22.7612" stroke="#FDFCFF" stroke-width="1.7845" stroke-miterlimit="10"/>
                            <path d="M185.842 87.3931C185.842 87.3931 185.274 89.1246 186.725 89.7542C188.176 90.3838 188.902 88.432 190.511 89.1875C192.151 89.9431 191.268 91.4542 191.268 91.4542" stroke="#FDFCFF" stroke-width="1.7845" stroke-miterlimit="10"/>
                            <path d="M12.6818 58.1151C12.6818 59.1855 11.83 60.0355 10.7575 60.0355C9.68486 60.0355 8.8331 59.1855 8.8331 58.1151C8.8331 57.0447 9.68486 56.1947 10.7575 56.1947C11.7985 56.1947 12.6818 57.0447 12.6818 58.1151Z" fill="#AB8BDB"/>
                            <path d="M177.135 28.0501C177.135 29.1205 176.283 29.9705 175.211 29.9705C174.138 29.9705 173.286 29.1205 173.286 28.0501C173.286 26.9798 174.138 26.1298 175.211 26.1298C176.283 26.1298 177.135 26.9798 177.135 28.0501Z" fill="#DD4C88"/>
                            <path d="M173.696 103.826C173.696 104.645 173.034 105.306 172.214 105.306C171.394 105.306 170.731 104.645 170.731 103.826C170.731 103.008 171.394 102.347 172.214 102.347C173.034 102.347 173.696 103.008 173.696 103.826Z" fill="#AB8BDB"/>
                            <path d="M83.2203 1.47964C83.2203 2.29816 82.5579 2.95928 81.7376 2.95928C80.9174 2.95928 80.2549 2.29816 80.2549 1.47964C80.2549 0.661115 80.9174 0 81.7376 0C82.5579 0 83.2203 0.661115 83.2203 1.47964Z" fill="#CFBBEB"/>
                            <path d="M172.655 46.9391H185.432" stroke="#FDFCFF" stroke-width="1.9364" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M0 43.4762H22.5559" stroke="#FDFCFF" stroke-width="1.9364" stroke-miterlimit="10"/>
                            <path d="M94.3564 1.47964H107.921" stroke="#FDFCFF" stroke-width="1.9364" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M67.5731 25.6575C67.5731 25.6575 66.6898 32.1113 59.0555 36.1409C50.9164 40.4224 56.6895 53.3299 70.854 53.7707C86.2173 54.2429 94.6087 40.4224 83.1257 23.1075L67.5731 25.6575Z" fill="#3A1616"/>
                            <path d="M72.3367 45.7113L72.3998 34.5983H79.2139L79.3716 45.8373L72.3367 45.7113Z" fill="#D6906E"/>
                            <path d="M71.5481 37.8409C71.201 36.865 73.9141 42.4058 76.7217 42.028C79.1508 41.7132 79.5609 37.3687 79.5609 37.3687C79.5609 37.3687 78.4252 39.0372 75.87 39.0372C73.0307 39.0687 71.5481 37.8409 71.5481 37.8409Z" fill="#3A1616"/>
                            <path d="M67.4785 28.4594C68.3303 33.4335 71.2326 37.5891 75.87 37.5891C80.5073 37.5891 83.6936 33.465 84.2614 28.4594C84.9239 22.7927 80.5073 19.4242 75.87 19.4242C71.2326 19.4242 66.5952 23.3594 67.4785 28.4594Z" fill="#3A1616"/>
                            <path d="M68.6142 31.0409C68.6142 31.0409 68.0148 30.0965 66.7529 30.5687C65.5226 31.0409 66.0589 34.0631 67.9517 34.4409C67.9517 34.4409 68.6142 34.5983 69.1505 34.1261C69.1505 34.1261 68.6773 31.8909 68.6142 31.0409Z" fill="#D6906E"/>
                            <path d="M67.0053 31.6076C67.0053 31.6076 68.0464 31.2613 68.8035 32.8039" stroke="#161311" stroke-width="1.0236" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M82.9364 31.0409C82.9364 31.0409 83.5358 30.0965 84.7977 30.5687C86.028 31.0409 85.4917 34.0631 83.5989 34.4409C83.5989 34.4409 82.9364 34.5983 82.4001 34.1261C82.4001 34.1261 82.8418 31.8909 82.9364 31.0409Z" fill="#D6906E"/>
                            <path d="M84.5138 31.6076C84.5138 31.6076 83.4727 31.2613 82.7156 32.8039" stroke="#161311" stroke-width="1.0236" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M68.488 28.4594C68.488 30.3798 68.6773 34.0317 69.9392 36.4243C71.1064 38.6909 73.22 39.8243 75.7753 39.8243C78.299 39.8243 80.602 38.1243 81.6115 36.1724C83.1257 33.2446 83.0626 28.4909 83.0626 28.4909C83.0626 28.4909 83.0626 21.5649 75.8384 21.5649C68.2672 21.5649 68.488 28.4594 68.488 28.4594Z" fill="#D6906E"/>
                            <path d="M74.1664 28.1131L70.2231 29.1205C70.2231 29.1205 70.4124 28.0187 72.0212 27.6094C73.6301 27.2316 74.1664 28.1131 74.1664 28.1131Z" fill="#1A1A1A"/>
                            <path d="M76.6902 28.1131L80.6335 29.1205C80.6335 29.1205 80.4442 28.0187 78.8353 27.6094C77.2264 27.2316 76.6902 28.1131 76.6902 28.1131Z" fill="#1A1A1A"/>
                            <path d="M75.2075 31.3872L75.0182 32.8039H76.0592" stroke="#161311" stroke-width="1.0236" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M78.583 34.0002H72.8099C72.8099 34.0002 72.9676 36.1095 75.6807 36.1095C78.1729 36.1095 78.583 34.0002 78.583 34.0002Z" fill="white"/>
                            <path d="M73.3462 30.3798C73.3462 30.3798 72.2421 29.8131 71.3272 30.3798" stroke="#161311" stroke-width="1.0236" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M79.6556 30.3798C79.6556 30.3798 78.5514 29.8131 77.6366 30.3798" stroke="#161311" stroke-width="1.0236" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M82.9364 31.0409C82.9364 31.0409 81.0121 27.2316 82.3686 23.8631C82.3686 23.8631 83.6935 23.8946 83.662 29.152L82.9364 31.0409Z" fill="#3A1616"/>
                            <path d="M68.6142 31.0409C68.6142 31.0409 70.5385 27.0113 69.182 23.8631C69.182 23.8631 67.8571 23.8946 67.8886 29.152L68.6142 31.0409Z" fill="#3A1616"/>
                            <path d="M84.3245 26.7909C84.3245 26.7909 73.914 26.1613 70.8856 21.9742C70.8856 21.9742 71.8635 19.3612 76.5009 20.0853C81.1383 20.8094 84.3245 26.7909 84.3245 26.7909Z" fill="#3A1616"/>
                            <path d="M75.1444 20.9038C75.1444 20.9038 72.2105 27.0113 67.9832 26.7909C68.0148 26.7909 70.3177 20.9668 75.1444 20.9038Z" fill="#3A1616"/>
                            <path d="M69.1505 115.412C69.1505 115.412 72.2421 100.112 74.0402 95.9561C74.198 95.5783 74.7658 95.6413 74.8604 96.019C75.3021 97.5931 75.8699 102.284 75.6176 116.073V121.708H87.7315L89.6243 108.139C89.719 107.101 93.5992 90.1005 83.8197 77.0041H64.8286C64.8286 77.0041 57.1627 90.1634 56.0901 106.282C55.8693 109.871 55.7746 115.349 55.2699 121.677H67.7309L69.1505 115.412Z" fill="#00377E"/>
                            <path d="M59.8757 47.6632C59.8757 47.6632 55.9008 48.2299 52.9985 58.1781L60.8221 62.6485L65.4595 56.2892L59.8757 47.6632Z" fill="#FF87C3"/>
                            <path d="M60.8221 62.6485C60.8221 62.6485 55.6169 70.8022 54.3866 72.2504C53.1247 73.7615 51.1688 74.5171 49.4968 73.4782C47.9826 72.5337 47.4148 70.6134 48.2034 69.0078L53.5979 58.4929L60.8221 62.6485Z" fill="#D6906E"/>
                            <path d="M48.2665 47.6947L54.4812 67.9059L47.8249 70.8022L43.85 47.978L48.2665 47.6947Z" fill="#D6906E"/>
                            <path d="M47.8249 48.7021L48.8028 47.7577C49.5284 47.0651 49.9701 46.1521 50.0332 45.1762L50.2855 42.4373C50.2855 42.4373 50.4433 40.9891 47.5725 41.3669C44.7018 41.7447 44.5125 41.7447 44.544 42.5947C44.544 42.5947 45.0803 43.791 46.9416 44.0113L47.8249 48.7021Z" fill="#D6906E"/>
                            <path d="M44.197 49.1114C44.197 49.1114 41.3578 47.5373 41.2316 42.5632C41.2316 41.9965 41.5155 41.4613 41.9887 41.1465C42.7143 40.6743 44.8595 39.4465 45.9952 40.2336L47.9826 42.815L47.8564 48.7336L44.197 49.1114Z" fill="#D6906E"/>
                            <path d="M48.3612 41.9336L49.9385 33.9372C50.0332 33.465 49.7177 32.9928 49.2445 32.8983C48.7713 32.8039 48.2981 33.0872 48.2034 33.5594L46.8154 39.6039L46.1529 39.7298L43.8184 33.5909C43.6607 33.1502 43.156 32.9613 42.7459 33.1187C42.3673 33.2761 42.178 33.6854 42.2727 34.0631L44.544 42.5317L48.3612 41.9336Z" fill="#D6906E"/>
                            <path d="M48.4874 41.3039C48.4874 41.3039 44.5756 40.9261 44.544 42.5947C44.544 42.5947 44.4494 43.8539 46.9416 44.0114C46.9416 44.0114 45.3958 44.4521 45.3327 46.1521" stroke="#BF704F" stroke-width="0.9962" stroke-miterlimit="10"/>
                            <path d="M52.3361 60.917L53.9765 66.3004" stroke="#BF704F" stroke-width="0.9962" stroke-miterlimit="10"/>
                            <path d="M86.5643 59.28C86.5643 59.28 92.7475 81.0023 95.1135 99.1987L99.0884 98.4431C99.0884 98.4431 98.489 71.7782 94.451 55.2818L86.5643 59.28Z" fill="#D6906E"/>
                            <path d="M99.0884 97.5302C99.0884 97.5302 105.082 106.376 97.8896 110.343C97.4164 110.595 96.817 110.501 96.47 110.091L96.4384 110.028C96.0599 109.588 96.0914 108.895 96.5015 108.486C97.511 107.447 98.8991 105.306 96.7223 102.504C96.7223 102.504 95.5867 102.788 95.7759 105.086C95.839 105.684 95.3343 106.156 94.7349 106.125C94.3248 106.093 94.0093 105.81 93.9147 105.401C93.5361 103.889 92.9052 100.175 95.3343 98.1598L99.0884 97.5302Z" fill="#D6906E"/>
                            <path d="M90.3815 49.4892C90.3815 49.4892 96.0599 51.3466 97.0694 60.3189L87.8262 63.8133L85.7441 58.1466L90.3815 49.4892Z" fill="#DD4C88"/>
                            <path d="M84.9239 47.4114L90.4761 49.5207L83.8513 74.4541H64.8917L59.8757 47.6632L66.4375 46.1521L84.9239 47.4114Z" fill="#FF87C3"/>
                            <path d="M83.8828 74.4541H64.8917V77.0356H83.8828V74.4541Z" fill="#1A1A1A"/>
                            <path d="M62.3048 60.6337L60.8221 53.9595" stroke="#C12D71" stroke-width="1.9923" stroke-miterlimit="10"/>
                            <path d="M87.1637 61.9874L89.1511 54.5577" stroke="#C12D71" stroke-width="1.9923" stroke-miterlimit="10"/>
                            <path d="M77.605 44.5151L84.9239 47.4114C84.9239 47.4114 84.0721 50.2762 75.4914 50.2762C68.0148 50.2762 66.4375 46.1521 66.4375 46.1521L73.5355 44.5151H77.605Z" fill="#D6906E"/>
                            <path d="M125.461 81.3171L133.411 121.865H118.016L112.117 95.0746L110.761 95.0116L110.729 121.865H95.3658L96.1545 81.3171H125.461Z" fill="#FF87C3"/>
                            <path d="M108.142 94.8227H116.912" stroke="#C12D71" stroke-width="1.9923" stroke-miterlimit="10"/>
                            <path d="M132.559 52.8577L147.039 49.1743C149.942 48.3558 151.645 45.3965 150.888 42.5002C150.099 39.5095 147.039 37.7465 144.042 38.5965L129.531 42.7206L132.559 52.8577Z" fill="#E8ABA2"/>
                            <path d="M134.137 40.0761L120.004 41.9336L124.042 56.3522L137.544 53.5503L134.137 40.0761Z" fill="#00377E"/>
                            <path d="M140.888 22.1316C141.235 19.8649 140.383 16.9686 140.383 16.9686L140.699 11.8686C140.762 11.3964 140.446 10.9241 139.973 10.8297C139.468 10.7038 138.963 11.0186 138.806 11.5223L138.396 14.7964H137.954L137.355 9.50745C137.323 8.87782 136.724 8.4056 136.093 8.53152C135.556 8.62597 135.178 9.09819 135.209 9.63338L135.619 15.3316L135.146 15.426L133.537 9.72783C133.348 9.06671 132.686 8.68893 132.023 8.87782C131.424 9.06671 131.077 9.69634 131.203 10.2945L132.875 16.8112L132.276 16.9686L130.067 12.4038C129.815 11.8686 129.152 11.6797 128.648 11.9945C128.238 12.2464 128.08 12.7186 128.238 13.1908L130.477 19.2982L128.616 19.2668C127.764 19.2668 127.07 20.0223 127.165 20.8723C127.228 21.4705 127.67 21.9742 128.238 22.1316L130.667 22.7297C130.667 22.7297 132.307 24.9964 135.02 25.9724C135.02 25.9409 140.635 23.8631 140.888 22.1316Z" fill="#E8ABA2"/>
                            <path d="M130.446 19.2668C130.446 19.2668 133.979 19.0464 136.061 21.0297" stroke="#D8857D" stroke-width="0.9962" stroke-miterlimit="10"/>
                            <path d="M150.699 41.9021L140.888 22.1316L134.736 24.7131L140.951 46.4669L150.699 41.9021Z" fill="#E8ABA2"/>
                            <path d="M139.09 40.0132L140.068 43.3502" stroke="#D8857D" stroke-width="0.9962" stroke-miterlimit="10"/>
                            <path d="M107.354 41.1465L95.7444 43.5391L96.1545 81.3171H125.461L126.376 42.5002L115.366 41.5558L107.354 41.1465Z" fill="#00377E"/>
                            <path d="M126.061 55.9429V51.0632" stroke="#00306D" stroke-width="1.9923" stroke-miterlimit="10"/>
                            <path d="M103.6 59.5948C101.612 59.5948 100.003 57.9892 100.003 56.0059V52.4169H107.196V56.0059C107.196 57.9892 105.587 59.5948 103.6 59.5948Z" fill="#00377E"/>
                            <path d="M87.353 53.141L78.9931 68.2522C77.5419 70.8967 78.4568 74.2337 81.0752 75.7448C83.662 77.2245 86.9744 76.4059 88.5517 73.8874L97.2271 60.067L87.353 53.141Z" fill="#E8ABA2"/>
                            <path d="M84.7661 55.2503L96.7539 62.9318L98.6782 53.7706C100.697 50.4966 103.284 46.5614 100.035 44.4836C96.7539 42.3743 92.3689 43.3502 90.2868 46.6243L84.7661 55.2503Z" fill="#00377E"/>
                            <path d="M95.9652 62.4281V52.1336" stroke="#00306D" stroke-width="1.9923" stroke-miterlimit="10"/>
                            <path d="M83.0942 76.4059L105.051 75.8078L106.565 68.7559L81.7692 65.6077L83.0942 76.4059Z" fill="#E8ABA2"/>
                            <path d="M92.8737 67.0244L87.1637 66.3003" stroke="#D8857D" stroke-width="0.9962" stroke-miterlimit="10"/>
                            <path d="M105.082 69.0392C105.082 69.0392 107.89 65.2614 111.202 69.0392L109.877 71.6522L105.082 69.0392Z" fill="#E8ABA2"/>
                            <path d="M108.395 65.0096L107.543 70.2985L114.231 71.0541L115.303 65.954C115.43 65.4189 115.051 64.8837 114.483 64.8207L109.467 64.2225C108.962 64.1596 108.489 64.5059 108.395 65.0096Z" fill="#1A1A1A"/>
                            <path d="M106.502 68.567L114.42 68.7559C115.335 68.7874 116.061 69.5429 116.061 70.4559C116.061 71.117 115.682 71.6837 115.114 71.967L114.704 72.1559C114.704 72.1559 115.524 78.1374 110.761 78.8615C105.997 79.5856 103.347 75.8078 103.347 75.8078L106.502 68.567Z" fill="#E8ABA2"/>
                            <path d="M115.808 41.5558L115.682 29.6242H107.007L106.817 41.2724L115.808 41.5558Z" fill="#E8ABA2"/>
                            <path d="M106.281 33.1187C105.839 32.0798 109.31 38.8169 112.843 38.4391C115.871 38.1243 115.997 32.615 115.997 32.615C115.997 32.615 114.925 34.3465 111.707 34.3465C108.142 34.378 106.281 33.1187 106.281 33.1187Z" fill="#3A1616"/>
                            <path d="M120.319 23.0446C119.404 28.365 116.281 32.8354 111.329 32.8354C106.344 32.8354 102.937 28.3965 102.338 23.0446C101.612 16.9686 106.344 12.9075 111.329 12.9075C116.281 12.9075 121.266 17.5983 120.319 23.0446Z" fill="#2F1118"/>
                            <path d="M119.089 25.815C119.089 25.815 119.751 24.7761 121.076 25.2798C122.401 25.7835 121.802 29.0261 119.815 29.4354C119.815 29.4354 119.089 29.5928 118.521 29.0891C118.521 29.1205 119.026 26.7279 119.089 25.815Z" fill="#E8ABA2"/>
                            <path d="M120.824 26.4446C120.824 26.4446 119.72 26.0668 118.9 27.7039" stroke="#161311" stroke-width="1.0982" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M103.757 25.815C103.757 25.815 103.095 24.7761 101.77 25.2798C100.445 25.7835 101.044 29.0261 103.032 29.4354C103.032 29.4354 103.757 29.5928 104.325 29.0891C104.325 29.1205 103.82 26.7279 103.757 25.815Z" fill="#E8ABA2"/>
                            <path d="M102.022 26.4446C102.022 26.4446 103.126 26.0668 103.947 27.7039" stroke="#161311" stroke-width="1.0982" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M119.215 23.0446C119.215 25.1224 118.994 29.4668 117.638 32.0483C116.376 34.4724 114.294 35.7632 111.549 35.8576C109.373 35.9206 106.218 33.8743 105.114 31.7965C103.473 28.6483 103.568 23.1075 103.568 23.1075C103.568 23.1075 103.568 15.6779 111.297 15.6779C119.468 15.6464 119.215 23.0446 119.215 23.0446Z" fill="#E8ABA2"/>
                            <path d="M108.679 25.5631C108.679 25.8779 108.426 26.1613 108.079 26.1613C107.764 26.1613 107.48 25.9094 107.48 25.5631C107.48 25.2483 107.732 24.965 108.079 24.965C108.426 24.965 108.679 25.2168 108.679 25.5631Z" fill="#1A1A1A"/>
                            <path d="M114.862 25.5631C114.862 25.8779 114.609 26.1613 114.262 26.1613C113.947 26.1613 113.663 25.9094 113.663 25.5631C113.663 25.2483 113.915 24.965 114.262 24.965C114.609 24.965 114.862 25.2168 114.862 25.5631Z" fill="#1A1A1A"/>
                            <path d="M109.72 23.1075L105.461 24.2094C105.461 24.2094 105.65 23.0131 107.385 22.6038C109.12 22.1631 109.72 23.1075 109.72 23.1075Z" fill="#1A1A1A"/>
                            <path d="M112.401 23.1075L116.66 24.2094C116.66 24.2094 116.471 23.0131 114.736 22.6038C113 22.1631 112.401 23.1075 112.401 23.1075Z" fill="#1A1A1A"/>
                            <path d="M110.634 27.0742V28.5853H111.739" stroke="#161311" stroke-width="1.0982" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M114.641 29.8446H108.142C108.142 29.8446 108.332 31.5446 111.234 31.5446C113.884 31.5761 114.641 29.8446 114.641 29.8446Z" fill="white"/>
                            <path d="M103.757 25.8149C103.757 25.8149 106.66 21.376 104.388 18.1019C104.388 18.1019 102.969 18.1334 103 23.7686L103.757 25.8149Z" fill="#2F1118"/>
                            <path d="M119.089 25.8149C119.089 25.8149 116.187 21.376 118.458 18.1019C118.458 18.1019 119.878 18.1334 119.846 23.7686L119.089 25.8149Z" fill="#2F1118"/>
                            <path d="M103.6 17.9131C103.6 17.9131 107.354 22.1316 115.051 21.3131C121.928 20.589 122.528 15.7408 120.887 13.8519C118.553 11.1445 113.379 12.1519 110.603 15.1742L103.6 17.9131Z" fill="#2F1118"/>
                            <path d="M106.817 41.2724L111.392 47.128L115.808 41.5558L106.817 41.2724Z" fill="#E8ABA2"/>
                            <path d="M106.817 40.4224L104.104 41.8076L107.164 47.9151L110.224 45.6169L106.817 40.4224Z" fill="#032C60"/>
                            <path d="M115.808 40.4224L118.868 41.8706L115.65 47.9151L112.622 45.5539L115.808 40.4224Z" fill="#032C60"/>
                            <path d="M8.2337 121.897H182.877" stroke="#FDFCFF" stroke-width="1.9923" stroke-miterlimit="10"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_26_3372">
                                <rect width="196" height="122.212" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="gp-no-records-middle">
                    <div class="no-records-features">
                        <ul>
                            <li><i class="fas fa-check"></i> <?php esc_html_e("Add and display","superb-testimonials") ?> <span class="text-color"><?php esc_html_e("unlimited testimonials","superb-testimonials") ?></span><?php esc_html_e(", customer reviews or quotes in ","superb-testimonials") ?><span class="text-color"><?php esc_html_e("multiple ways","superb-testimonials") ?></span><?php esc_html_e(" on any post, page on your ","superb-testimonials") ?><span class="text-color"><?php esc_html_e("website.","superb-testimonials") ?></span></span></li>
                            <li><i class="fas fa-check"></i> <span class="text-color"><?php esc_html_e("Customize","superb-testimonials") ?></span><?php esc_html_e(" your testimonials style ","superb-testimonials") ?><span class="text-color"><?php esc_html_e("according to","superb-testimonials") ?></span><?php esc_html_e(" your ","superb-testimonials") ?><span class="text-color"><?php esc_html_e("requirement.","superb-testimonials") ?></span></li>
                            <li><i class="fas fa-check"></i> <span class="text-color"><?php esc_html_e("Use different","superb-testimonials")?></span><?php esc_html_e(" types of layout ","superb-testimonials") ?><span class="text-color"><?php esc_html_e("for build","superb-testimonials") ?></span><?php esc_html_e(" a awesome and unique ","superb-testimonials") ?><span class="text-color"><?php esc_html_e("testimonials with","superb-testimonials") ?></span><?php esc_html_e(" responsive layout and customizable ","superb-testimonials") ?><span class="text-color"><?php esc_html_e("styles.","superb-testimonials") ?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="gp-no-records-bottom">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=superb-testimonials-short-codes&task=add-new-shortcode')) ?>" class="add-new-form"><i class="fas fa-plus"></i> <?php esc_html_e(" Create Your First Shortcode", "superb-testimonials"); ?></a>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="gp-form-header">
            <div class="gp-header-left">
                <?php esc_html_e("All Shortcodes", "superb-testimonials"); ?>
            </div>
        </div>
        <div class="gp-dashboard-data">
            <div class="gp-header">
                <a href="<?php echo esc_url(admin_url('admin.php?page=superb-testimonials-short-codes&task=add-new-shortcode')) ?>" class="add-new-form"><i class="fas fa-plus"></i> <?php esc_html_e(" Create New", "superb-testimonials"); ?></a>
            </div>
            <div class="gp-form-data">
                <div id="ajax-table">
                    <div id="ajax-table-data">
                        <?php

                        if (!empty($codeData)) {
                            ?>
                        <table class="dashboard-list-table">
                            <thead>
                            <tr>
                                <th><?php esc_html_e("Type", "superb-testimonials"); ?></th>
                                <th><?php esc_html_e("Name", "superb-testimonials"); ?></th>
                                <th><?php esc_html_e("Widget Shortcode", "superb-testimonials"); ?></th>
                                <th class="status-col"><?php esc_html_e("Edit", "superb-testimonials"); ?></th>
                                <th class="action-col"><?php esc_html_e("Actions", "superb-testimonials"); ?></th>
                            </tr>
                            </thead>
                            <tbody id="code_items">
                            <?php

                            foreach ($codeData as $code) {
                                $settings = get_post_meta($code->ID, "shortcode_settings", true);
                                $settings = is_array($settings) && !empty($settings) ? $settings : [];
                                ?>
                                <tr data-nonce="<?php echo wp_create_nonce("shortcode_action_".esc_attr($code->ID)) ?>" class="shortcode-col-<?php echo esc_attr($code->ID) ?>">
                                    <td><?php echo esc_attr($settings['sc_type']) ?></td>
                                    <td><?php echo esc_attr($settings['shortcode_name']) ?></td>
                                    <td><?php echo "[fabulo_testimonial id=$code->ID]" ?> <a class="copy-code-text" data-code="<?php echo esc_attr($code->ID) ?>" data-ginger-tooltip="<?php esc_html_e("Copy Shortcode", "superb-testimonials"); ?>" href="javascript:;"><i class="far fa-copy"></i></a></td>
                                    <input type="text" class="sr-only" id="code_<?php echo esc_attr($code->ID) ?>" value="[fabulo_testimonial id=<?php echo esc_attr($code->ID) ?>]">
                                    <td class="status-col actions">
                                        <a data-ginger-tooltip="<?php esc_html_e("Edit shortcode", "superb-testimonials"); ?>"
                                           href="<?php echo esc_url(admin_url('admin.php?page=superb-testimonials-short-codes&task=edit-shortcode&edit='.esc_attr($code->ID).'&nonce='.wp_create_nonce('edit_shortcodes_'.esc_attr($code->ID)).'&paged='.esc_attr($paged))) ?>"" class="edit-form"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td class="action-col actions">
                                        <a data-ginger-tooltip="<?php esc_html_e("Duplicate", "superb-testimonials"); ?>"
                                           href="#" class="clone-shortcode" data-id="<?php echo esc_attr($code->ID) ?>" data-name="<?php echo esc_attr($settings['shortcode_name']) ?>"><i class="fas fa-clone"></i></a>
                                        <a data-ginger-tooltip="<?php esc_html_e("Remove", "superb-testimonials"); ?>" href="#"
                                           class="remove-shortcode remove-item" data-id="<?php echo esc_attr($code->ID) ?>"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php }//end foreach
                            ?>
                            </tbody>
                        </table>
                        <?php } else {
                            ?>
                            <p class="no-data"><?php esc_html_e("No records are found", "superb-testimonials"); ?></p>
                        <?php }//end if
                        ?>
                        <div class="ajax-pagination">
                            <?php

                            $totalTestimonials = $wpdb->get_var("SELECT count(*) as count_num FROM  $tbPost WHERE post_type = 'superb_code' AND post_status = 'publish'");

                            $totalPages = ceil($totalTestimonials / $numOfRecords);

                            if ($totalPages > 1) {
                                $pages       = filter_input(INPUT_GET, 'paged');
                                $currentPage = isset($pages) ? sanitize_text_field($pages) : 1;

                                echo '<div class="gp-navigation">';

                                echo paginate_links(
                                    [
                                        'base'      => get_pagenum_link(1).'%_%',
                                        'format'    => '&paged=%#%',
                                        'current'   => $currentPage,
                                        'total'     => $totalPages,
                                        'prev_text' => '<i class="fas fa-angle-left"></i> '.esc_html__("Prev"),
                                        'next_text' => esc_html__("Next ").'<i class="fas fa-angle-right"></i>',
                                        'type'      => 'list',
                                    ]
                                );

                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php require_once dirname(__FILE__)."/../others/common.php";
