<?php include('header.php'); ?>
<!-- hero area start -->
<div class="ar-hero-area p-relative aboutpage-hero-title">
    <div class="ar-about-us-4-shape">
        <span class="tp-about-shape-1 tp-bounce">
            <img src="assets/img/home-pages/logo/sky-icon-white.webp" alt="">
        </span>
    </div>
    <div class="container container-1230">
        <div class="ar-about-us-4-hero-ptb">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="ar-hero-title-box tp_fade_anim" data-delay=".3">
                        <h3 class="ar-about-us-4-title">Thank you</h3>
                        <p style="color: #fff;">Manufacturer & Exporter of Industrial Air Cooler</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- hero area end -->
<section class="content-page">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center thankyou-div">
                <!-- <img src="images/thankyou.png" width="100" /> -->
                <h2 class="text-center" style="color: green;">Thank You For Inquiry We Will Reply You Within 24 Hours!</h2>
                <a id="lnnk" href="pdf/<?php echo $_REQUEST['varname']; ?>" download>
                    <h4 class="text-center" style="color: #000;"><b></b></h4>
                    <div class="message" style="display:inline-grid;margin:0px 0 100px;text-align:center;color: #000;">
                        <img src="assets/img/download_gif.gif" class="" style="margin: 0 auto;"><b>Click Here For Your Requested Catalogue Download</b>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>
<script>
var hreff = jQuery("#lnnk").attr('href');
setTimeout(
    function() {
        window.location = hreff;
    }, 5000);
</script>