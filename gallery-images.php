<?php include('header.php'); ?>
<!-- breadcurmb area start -->
<div class="tp-breadcrumb-area tp-breadcrumb-ptb">
    <div class="container container-1430">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="tp-portfolio-inner-box pb-100">
                    <div class="tp-portfolio-heading pb-30 d-flex p-relative tp_fade_anim">
                        <span class="tp-section-subtitle pre orange-color tp_fade_anim mr-95">Our Projects  <svg xmlns="http://www.w3.org/2000/svg" width="82" height="9" viewBox="0 0 82 9" fill="none">
                                <path d="M78 7.95425L81.5 4.47169L78 0.989136M1 3.98977H81V4.98977H1V3.98977Z" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>

                        <h3 class="tp-blog-title fs-80 tp_fade_anim">We Make 
                            <span class="tp-about-shape-1 tp-bounce">
								<img src="assets/img/home-pages/logo/sky-icon-white.webp" alt="">
							</span> <br>
                            Recent Projects</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcurmb area end -->


<!-- Our Projects area start -->
<div class="tp-portfolio-inner-ptb our-projects-container pb-0 pt-120">
    <div class="container container-1430">
        <div class="tp-portfolio-tab-content-wrap">
            <div class="row">
				<?php
					$data = glob("assets/img/inner-pages/installation/*.*");
				?> 
				<?php 
					foreach($data as $p){
				?>
                <div class="col-md-4">
                    <div class="tp-portfolio-inner-item mb-0">
                        <div class="tp-portfolio-inner-thumb tp--hover-item">
                            <a href="javascript:;"><img src="<?php echo $p; ?>" alt=""></a>
                        </div>
                    </div>
                </div>
				<?php
				} ?>
            </div>
        </div>
    </div>
</div>
<!-- Our Projects area end -->
<?php include('footer.php'); ?>