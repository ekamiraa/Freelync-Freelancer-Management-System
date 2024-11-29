@extends('layouts.master')

@section('title', 'Landing Page')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

    <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6 text-center">
                    <h2>Welcome to Freelync</h2>
                    <h3>A Simple Way to Connect Clients and Freelancers</h3>
                    <p>Freelync is a trusted platform where clients can hire skilled freelancers for any project, and
                        freelancers can find
                        opportunities to showcase their talents. From creative jobs to tech projects, everything is here
                    </p>
                    <a href="{{ route('login')}}" class="btn-get-started">Get Started</a>
                </div>
            </div>
        </div>
    </div>

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item">
            <img src="{{ asset('assets/img/hero-carousel/hero-carousel-1.jpg') }}" alt="">
        </div>

        <div class="carousel-item active">
            <img src="{{ asset('assets/img/hero-carousel/hero-carousel-2.jpg') }}" alt="">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('assets/img/hero-carousel/hero-carousel-3.jpg') }}" alt="">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('assets/img/hero-carousel/hero-carousel-4.jpg') }}" alt="">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('assets/img/hero-carousel/hero-carousel-5.jpg') }}" alt="">
        </div>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

    </div>

</section><!-- /Hero Section -->

<!-- Stats Counter Section -->
<section id="stats-counter" class="stats-counter section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Why Choose Freelync?</h2>
        <p>Freelync isn't just a platform. it's your ultimate partner in freelancing and project management</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-people-fill color-blue flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="632" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Clients</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-kanban color-orange flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Projects</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-person-workspace color-green flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Freelancers</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-list-task color-pink flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="5500" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Tasks</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

        </div>

    </div>

</section><!-- /Stats Counter Section -->

<!-- Alt Services 2 Section -->
<section id="alt-services-2" class="alt-services-2 section">

    <div class="container">

        <div class="row justify-content-around gy-4">

            <div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-1" data-aos="fade-up"
                data-aos-delay="100">
                <h3>For Clients: Find the Right Freelancer for Your Project</h3>

                <div class="row">

                    <div class="col-lg-6 icon-box d-flex">
                        <i class="bi bi-easel flex-shrink-0"></i>
                        <div>
                            <h4>Access Skilled Talent</h4>
                            <p>Browse a curated list of top freelancers specializing in various fields to suit your
                                project's needs </p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="col-lg-6 icon-box d-flex">
                        <i class="bi bi-patch-check flex-shrink-0"></i>
                        <div>
                            <h4>Direct Communication</h4>
                            <p>Coordinate with freelancers in real-time using our integrated chat system, ensuring
                                smooth and clear collaboration</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="col-lg-6 icon-box d-flex">
                        <i class="bi bi-brightness-high flex-shrink-0"></i>
                        <div>
                            <h4>Organized Project Management</h4>
                            <p>Easily track progress, deadlines, and deliverables from start to finish on your
                                personalized dashboard</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="col-lg-6 icon-box d-flex">
                        <i class="bi bi-brightness-high flex-shrink-0"></i>
                        <div>
                            <h4>Effortless Coordination</h4>
                            <p>Build long-term working relationships with trusted freelancers through seamless and
                                transparent workflows</p>
                        </div>
                    </div><!-- End Icon Box -->

                </div>

            </div>

            <div class="vector-image col-lg-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/img/client.png') }}" alt="client.png">
            </div>

        </div>

    </div>

</section><!-- /Alt Services 2 Section -->

<!-- Alt Services 2 Section -->
<section id="alt-services-2" class="alt-services-2 section">

    <div class="container">

        <div class="row justify-content-around gy-4">
            <div class="vector-image col-lg-5 order-1 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/img/freelance.png') }}" alt="freelance.png">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-2" data-aos="fade-up"
                data-aos-delay="100">
                <h3>For Freelancers: Boost Your Freelance Career</h3>

                <div class="row">

                    <div class="col-lg-6 icon-box d-flex">
                        <i class="bi bi-easel flex-shrink-0"></i>
                        <div>
                            <h4>Explore Tailored Opportunities</h4>
                            <p>Get matched with projects that align with your expertise and interests </p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="col-lg-6 icon-box d-flex">
                        <i class="bi bi-patch-check flex-shrink-0"></i>
                        <div>
                            <h4>Stay Connected with Clients</h4>
                            <p>Use the built-in chat system to discuss project details, share updates, and ensure client
                                satisfaction</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="col-lg-6 icon-box d-flex">
                        <i class="bi bi-brightness-high flex-shrink-0"></i>
                        <div>
                            <h4>Showcase Your Portfolio</h4>
                            <p>Highlight your skills and past work to attract potential clients and stand out from the
                                crowd</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="col-lg-6 icon-box d-flex">
                        <i class="bi bi-brightness-high flex-shrink-0"></i>
                        <div>
                            <h4>Flexible Workflows</h4>
                            <p>Manage your time and tasks efficiently with clear project goals and milestones provided
                                by clients</p>
                        </div>
                    </div><!-- End Icon Box -->

                </div>

            </div>



        </div>

    </div>

</section><!-- /Alt Services 2 Section -->

<!-- Alt Services Section -->
<section id="freelync-work" class="freelync-work section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>How Freelync Works?</h2>
        <p>Experience a simple and intuitive process for freelancers and clients to collaborate and succeed together</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row justify-content-around gy-4">
            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <h3>For Freelancers</h3>
                <p>Connect with clients, showcase your skills, and grow your career effortlessly.</p>
                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-person-lines-fill flex-shrink-0"></i>
                    <div>
                        <h4><a class="stretched-link">1. Create Your Profile</a></h4>
                        <p>Build a professional profile showcasing your skills and experience.</p>
                    </div>
                </div><!-- End Icon Box -->

                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-briefcase flex-shrink-0"></i>
                    <div>
                        <h4><a class="stretched-link">2. Apply to Projects</a></h4>
                        <p>Search for projects that match your expertise and submit applications.</p>
                    </div>
                </div><!-- End Icon Box -->

                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="500">
                    <i class="bi bi-list-check flex-shrink-0"></i>
                    <div>
                        <h4><a class="stretched-link">3. Work on Tasks</a></h4>
                        <p>Deliver high-quality work by following the client's requirements.</p>
                    </div>
                </div><!-- End Icon Box -->

                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="600">
                    <i class="bi bi-wallet2 flex-shrink-0"></i>
                    <div>
                        <h4><a class="stretched-link">4. Get Paid Securely</a></h4>
                        <p>Receive payments securely upon successful project completion.</p>
                    </div>
                </div><!-- End Icon Box -->
            </div>

            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <h3>For Clients</h3>
                <p>Effortlessly find the right freelancer for your projects and track progress in one place.</p>

                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-pencil-square flex-shrink-0"></i>
                    <div>
                        <h4><a class="stretched-link">1. Post a Project</a></h4>
                        <p>Create a detailed project listing with requirements and budget.</p>
                    </div>
                </div><!-- End Icon Box -->

                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-search flex-shrink-0"></i>
                    <div>
                        <h4><a class="stretched-link">2. Review Applications</a></h4>
                        <p>Browse through freelancer profiles and applications to find the perfect fit.</p>
                    </div>
                </div><!-- End Icon Box -->

                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="500">
                    <i class="bi bi-person-check flex-shrink-0"></i>
                    <div>
                        <h4><a class="stretched-link">3. Hire the Best Freelancer</a></h4>
                        <p>Select and hire the freelancer that meets your needs.</p>
                    </div>
                </div><!-- End Icon Box -->

                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="600">
                    <i class="bi bi-bar-chart flex-shrink-0"></i>
                    <div>
                        <h4><a class="stretched-link">4. Track Progress</a></h4>
                        <p>Monitor project progress and communicate through the platform.</p>
                    </div>
                </div><!-- End Icon Box -->



            </div>
        </div>

    </div>

</section><!-- /Alt Services Section -->

<!-- Category Section -->
<section id="alt-services" class="alt-services section  light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Categories</h2>
        <p>You can search projects by categories and adjust them to the skills you have</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-body icon-box">
                        <h4><a class="stretched-link">Web Development</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-body icon-box">
                        <h4><a class="stretched-link">Graphic Design</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-body icon-box">
                        <h4><a class="stretched-link">Digital Marketing</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-body icon-box">
                        <h4><a class="stretched-link">Content Writing</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-body icon-box">
                        <h4><a class="stretched-link">Data Science/Analyst</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-body icon-box">
                        <h4><a class="stretched-link">UI/UX Design</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-body icon-box">
                        <h4><a class="stretched-link">Software Development</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-body icon-box">
                        <h4><a class="stretched-link">Video Editor</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /End Category Section -->

<!-- CTA Section -->
<section id="alt-services" class="alt-services section">

    <div class="container">

        <div class="row justify-content-around gy-4">
            <div class="vector-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img
                    src="{{ asset('assets/img/investment.png') }}" alt="investment.png"></div>

            <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <h3>Take Your Projects to the Next Level</h3>
                <p>Whether you’re looking for creative designers, skilled developers, or expert consultants, we’ve got
                    the right freelancers for you. Post your project today and get started on making your ideas a
                    reality.</p>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn-get-started">Post Your Project</a>
                    <a href="{{ route('login') }}" class="btn-get-started">Browse Freelancers</a>
                </div>

            </div>
        </div>

    </div>

</section>
<!-- /CTA Section -->

@endsection