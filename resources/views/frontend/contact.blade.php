
<body id="about">

    <!--================ Offcanvus Menu Area =================-->
    <div class="side_menu">
        <div class="logo">
            <a href="index.html">
                <img src="https://i2.wp.com/urbannepol.com.np/wp-content/uploads/2019/08/1.jpg?w=120" alt="image is not available">
            </a>
        </div>
        <ul class="list menu-left">
            <li>
                <a href="{{('index')}}">Home</a>
            </li>
            <li>
                <a href="{{('about')}}">About</a>
            </li>
            <li>
                <a href="{{('Service')}}">Service</a>
            </li>
            <li>
                <div class="dropdown">
                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                        Projects
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="project.html">Project</a>
                        <a class="dropdown-item" href="project-details.html">Project Details</a>
                    </div>
                </div>
            </li>
            <li>
                <a href="{{('Team')}}">Team</a>
            </li>
            <li>
                <div class="dropdown">
                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                        Pages
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="elements.html">Elements</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                        Blog
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="blog.html">Blog</a>
                        <a class="dropdown-item" href="single-blog.html">Blog Details</a>
                    </div>
                </div>
            </li>
            <li>
                <a href="{{('contact')}}">Contact</a>
            </li>
        </ul>
    </div>
    <!--================ End Offcanvus Menu Area =================-->

    <!--================ Canvus Menu Area =================-->
    <div class="canvus_menu">
        <div class="container">
            <div class="toggle_icon" title="Menu Bar">
                <span></span>
            </div>
        </div>
    </div>
    <!--================ End Canvus Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="banner_area ">
        <div class="banner_inner overlay d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-left">
                    <div class="page_link">
                        <a href="index.html">Home</a>
                        <a href="contact.html">Contact</a>
                    </div>
                    <h2>Contact Us</h2>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Contact Area =================-->
    <section class="contact_area section-gap">
        <div class="container">
            <div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
                data-mlat="40.701083" data-mlon="-74.1522848">
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="lnr lnr-home"></i>
                            <h6>kathmandu , nepal</h6>
                            <p>near norwegian embassy</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-phone-handset"></i>
                            <h6><a href="#">+97700000000</a></h6>
                            <p>Mon to Fri 9am to 6 pm</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-envelope"></i>
                            <h6><a href="#">xyz@abc.com</a></h6>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <form class="row contact_form" action="contact_process.php" method="post" id="contactForm"
                        novalidate="novalidate">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Enter Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="submit" value="submit" class="primary-btn">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->
