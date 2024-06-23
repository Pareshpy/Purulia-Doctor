<?php
include ('./common/header.php');
?>
<br>
<br>
<br>
<br>

<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="doctor-widget">
                    <div class="doctor-info-left">
                        <div class="doctor-img">
                            <img src="assets/img/doctors/dortor1.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="doctor-info-cont">
                            <h4 class="doc-name">Dr.Joydeep Mandal </h4>
                            <p class="doc-speciality">MS ORTHOPEDICS &amp; Surgeon</p>
                            <p class="doc-department">ORTHOPEDICS</p>
                            <div class="clinic-details">
                                <p class="doc-location">
                                    <i class="ri-map-pin-2-fill"></i> Deep medical, E Lake Rd, <br> near science museum
                                    <a href="javascript:void(0);">Get Directions</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="doc-info-right">
                        <div class="clini-infos">
                            <ul>
                                <li><i class="ri-thumb-up-fill"></i> 99%</li>
                                <li><i class="ri-chat-1-fill"></i> 35 Feedback</li>
                                <li>
                                    <i class="ri-map-pin-2-fill"></i> Deep Medical
                                </li>
                                <li>
                                    <i class="ri-money-rupee-circle-fill"></i> ₹550
                                </li>
                            </ul>
                        </div>
                        <div class="doctor-action">
                            <a href="javascript:void(0)" class="btn btn-white fav-btn">
                                <i class="ri-bookmark-fill"></i>
                            </a>
                            <a href="chat.html" class="btn btn-white msg-btn">
                                <i class="ri-message-3-fill"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal"
                                data-target="#voice_call">
                                <i class="ri-phone-fill"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal"
                                data-target="#video_call">
                                <i class="ri-video-chat-fill"></i>
                            </a>
                        </div>
                        <div class="clinic-booking">
                            <a class="apt-btn" href="booking.html">Book Appointment</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body pt-0">
                <!-- Tab Menu -->
                <nav class="user-tabs mb-4">
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_locations" data-toggle="tab">Locations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>
                        </li>
                    </ul>
                </nav>
                <!-- /Tab Menu -->

                <!-- Tab Content -->
                <div class="tab-content pt-0">
                    <!-- Overview Content -->
                    <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-md-12 col-lg-9">
                                <!-- About Details -->
                                <div class="widget about-widget">
                                    <h4 class="widget-title">About Me</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip
                                        ex ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur. Excepteur sint occaecat
                                        cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                                <!-- /About Details -->

                                <!-- Education Details -->
                                <div class="widget education-widget">
                                    <h4 class="widget-title">Education</h4>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">American Dental Medical University</a>
                                                        <div>BDS</div>
                                                        <span class="time">1998 - 2003</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">American Dental Medical University</a>
                                                        <div>MDS</div>
                                                        <span class="time">2003 - 2005</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Education Details -->

                                <!-- Experience Details -->
                                <div class="widget experience-widget">
                                    <h4 class="widget-title">Work &amp; Experience</h4>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Glowing Smiles Family Dental
                                                            Clinic</a>
                                                        <span class="time">2010 - Present (5 years)</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Comfort Care Dental Clinic</a>
                                                        <span class="time">2007 - 2010 (3 years)</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Dream Smile Dental Practice</a>
                                                        <span class="time">2005 - 2007 (2 years)</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Experience Details -->

                                <!-- Awards Details -->
                                <div class="widget awards-widget">
                                    <h4 class="widget-title">Awards</h4>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <p class="exp-year">July 2019</p>
                                                        <h4 class="exp-title">Humanitarian Award</h4>
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit. Proin a ipsum tellus.
                                                            Interdum et malesuada fames ac ante ipsum
                                                            primis in faucibus.
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <p class="exp-year">March 2011</p>
                                                        <h4 class="exp-title">
                                                            Certificate for International Volunteer
                                                            Service
                                                        </h4>
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit. Proin a ipsum tellus.
                                                            Interdum et malesuada fames ac ante ipsum
                                                            primis in faucibus.
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <p class="exp-year">May 2008</p>
                                                        <h4 class="exp-title">
                                                            The Dental Professional of The Year Award
                                                        </h4>
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit. Proin a ipsum tellus.
                                                            Interdum et malesuada fames ac ante ipsum
                                                            primis in faucibus.
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Awards Details -->

                                <!-- Services List -->
                                <div class="service-list">
                                    <h4>Services</h4>
                                    <ul class="clearfix">
                                        <li>Tooth cleaning</li>
                                        <li>Root Canal Therapy</li>
                                        <li>Implants</li>
                                        <li>Composite Bonding</li>
                                        <li>Fissure Sealants</li>
                                        <li>Surgical Extractions</li>
                                    </ul>
                                </div>
                                <!-- /Services List -->

                                <!-- Specializations List -->
                                <div class="service-list">
                                    <h4>Specializations</h4>
                                    <ul class="clearfix">
                                        <li>Children Care</li>
                                        <li>Dental Care</li>
                                        <li>Oral and Maxillofacial Surgery</li>
                                        <li>Orthodontist</li>
                                        <li>Periodontist</li>
                                        <li>Prosthodontics</li>
                                    </ul>
                                </div>
                                <!-- /Specializations List -->
                            </div>
                        </div>
                    </div>
                    <!-- /Overview Content -->

                    <!-- Locations Content -->
                    <div role="tabpanel" id="doc_locations" class="tab-pane fade">
                        <!-- Location List -->
                        <div class="location-list">
                            <div class="row">
                                <!-- Clinic Content -->
                                <div class="col-md-6">
                                    <div class="clinic-content">
                                        <h4 class="clinic-name">
                                            <br>
                                            <a href="#">Deep Medical</a>
                                        </h4>
                                        <p class="doc-speciality">
                                            <br>
                                            MS ORTHOPEDICS & Surgeon
                                        </p>
                                        <div class="clinic-details mb-0">
                                            <h5 class="clinic-direction">
                                            <i class="ri-map-pin-2-fill"></i>  Deep medical, E Lake Rd,
                                                near science museum <br><br><a href="javascript:void(0);">Get
                                                    Directions</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Clinic Content -->

                                <!-- Clinic Timing -->
                                <div class="col-md-4">
                                    <div class="clinic-timing">
                                        <div>
                                            <p class="timings-days">
                                                <span> Mon - Sat </span>
                                            </p>
                                            <p class="timings-times">
                                                <div>10:00 AM - 2:00 PM</div>
                                                <div>4:00 PM - 9:00 PM</div>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="timings-days">
                                                <span>Sun</span>
                                            </p>
                                            <p class="timings-times">
                                                <span>10:00 AM - 2:00 PM</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Clinic Timing -->

                                <div class="col-md-2">
                                    <div class="consult-price">$250</div>
                                </div>
                            </div>
                        </div>
                        <!-- /Location List -->
                    </div>
                    <!-- /Locations Content -->

                    <!-- Business Hours Content -->
                    <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <!-- Business Hours Widget -->
                                <div class="widget business-widget">
                                    <div class="widget-content">
                                        <div class="listing-hours">
                                            <div class="listing-day current">
                                                <div class="day">
                                                    Today <span>5 Nov 2019</span>
                                                </div>
                                                <div class="time-items">
                                                    <span class="open-status"><span class="badge bg-success-light">Open
                                                            Now</span></span>
                                                    <span class="time">07:00 AM - 09:00 PM</span>
                                                </div>
                                            </div>
                                            <div class="listing-day">
                                                <div class="day">Monday</div>
                                                <div class="time-items">
                                                    <span class="time">07:00 AM - 09:00 PM</span>
                                                </div>
                                            </div>
                                            <div class="listing-day">
                                                <div class="day">Tuesday</div>
                                                <div class="time-items">
                                                    <span class="time">07:00 AM - 09:00 PM</span>
                                                </div>
                                            </div>
                                            <div class="listing-day">
                                                <div class="day">Wednesday</div>
                                                <div class="time-items">
                                                    <span class="time">07:00 AM - 09:00 PM</span>
                                                </div>
                                            </div>
                                            <div class="listing-day">
                                                <div class="day">Thursday</div>
                                                <div class="time-items">
                                                    <span class="time">07:00 AM - 09:00 PM</span>
                                                </div>
                                            </div>
                                            <div class="listing-day">
                                                <div class="day">Friday</div>
                                                <div class="time-items">
                                                    <span class="time">07:00 AM - 09:00 PM</span>
                                                </div>
                                            </div>
                                            <div class="listing-day">
                                                <div class="day">Saturday</div>
                                                <div class="time-items">
                                                    <span class="time">07:00 AM - 09:00 PM</span>
                                                </div>
                                            </div>
                                            <div class="listing-day closed">
                                                <div class="day">Sunday</div>
                                                <div class="time-items">
                                                    <span class="time"><span
                                                            class="badge bg-danger-light">Closed</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Business Hours Widget -->
                            </div>
                        </div>
                    </div>
                    <!-- /Business Hours Content -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.nav-tabs a').click(function () {
            $(this).tab('show');
        });
    });
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



<script src="assets/js/script.js"></script>
<?php
include ('./common/about.php');
?>