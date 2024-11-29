@extends('layouts.master')

@section('title', 'User Profile')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/projects/project-5.jpg') }}');">
    <div class="container position-relative">
        <h1>Profile</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a>Shape your journey. Showcase your strengths. Connect with the right opportunities</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Alert Success -->
@if(session('success'))
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<!-- /Alert Success -->

<!-- Profile Section -->
<section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>{{ $user->name }}'s Profile</h2>
        <p>Connecting You with the Right Freelancer or Client</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                    data-aos-delay="200">
                    <img src="{{ asset('storage/pictures/' . $user->picture) }}" alt="Profile Picture"
                        class="img-fluid">
                    <h3>Name</h3>
                    <p>{{ $user->name }}</p>
                </div>
            </div><!-- End Info Item -->

            <div class="col-lg-3 col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                    data-aos-delay="300">
                    <i class="bi bi-telephone"></i>
                    <h3>Contact Info</h3>
                    <p>{{ $user->contact_info }}</p>
                </div>
            </div><!-- End Info Item -->

            <div class="col-lg-3 col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                    data-aos-delay="400">
                    <i class="bi bi-envelope"></i>
                    <h3>Email</h3>
                    <p>{{ $user->email }}</p>
                </div>
            </div><!-- End Info Item -->

        </div>

        <div class="row gy-4 mt-1">

            <div class="col-lg-12">
                <form action="" method="" class="php-email-form" data-aos="fade-up" data-aos-delay="400">
                    <div class="row gy-4">
                        <div class="col-md-6 ">
                            <label for="role" class="label-control">Role :</label>
                            <input type="text" class="form-control" name="role" placeholder="-"
                                value="{{ ucfirst($user->roles->first()->name) }}" readonly>
                        </div>

                        @if(auth()->user()->hasRole('freelancer'))
                            <div class="col-md-6">
                                <label for="portofolio" class="label-control">Portofolio :</label>
                                <a href="{{ $user->portofolio }}"><input type="text" class="form-control" name="portofolio"
                                        placeholder="-" value="{{ $user->portofolio }}" readonly></a>
                            </div>

                            <div class="col-md-12">
                                <label for="skills" class="label-control">Skills :</label>
                                <input type="text" class="form-control" name="skills" placeholder="-"
                                    value="{{ $user->skills }}" readonly>
                            </div>

                        @elseif(auth()->user()->hasRole('client'))


                            <div class="col-md-6">
                                <label for="company_name" class="label-control">Company's Name :</label>
                                <input type="text" class="form-control" name="company_name" placeholder="-"
                                    value="{{ $user->company_name }}" readonly>
                            </div>
                        @endif


                        <div class="col-md-12">
                            <label for="about_me" class="label-control">About Me :</label>
                            <div class="row gy-4 d-flex justify-content-center">
                                <div class="col-md-10 d-flex justify-content-center align-items-start text-center">
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <p>{!! $user->about_me !!}</p>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div><!-- End Contact Form -->

        </div>

        @if($user->hasRole('freelancer'))
            <!-- Testimonials Section -->
            <section id="testimonials" class="testimonials section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Client Testimonials & Project Feedback</h2>
                    <p>Read through client experiences and gain insights into freelancer performance on past projects</p>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                                                {
                                                  "loop": true,
                                                  "speed": 600,
                                                  "autoplay": {
                                                    "delay": 5000
                                                  },
                                                  "slidesPerView": "auto",
                                                  "pagination": {
                                                    "el": ".swiper-pagination",
                                                    "type": "bullets",
                                                    "clickable": true
                                                  },
                                                  "breakpoints": {
                                                    "320": {
                                                      "slidesPerView": 1,
                                                      "spaceBetween": 40
                                                    },
                                                    "1200": {
                                                      "slidesPerView": 2,
                                                      "spaceBetween": 20
                                                    }
                                                  }
                                                }
                                              </script>
                        <div class="swiper-wrapper">

                            @foreach ($reviews as $review)
                                <div class="swiper-slide">
                                    <div class="testimonial-wrap">
                                        <div class="testimonial-item">
                                            <img src="{{ asset('storage/pictures/' . $review->client->picture) }}"
                                                class="testimonial-img" alt="">
                                            <h3>{{ $review->client->name }}</h3>
                                            <h4>Project: {{ $review->project->title }}</h4>
                                            <p>
                                                <i class="bi bi-quote quote-icon-left"></i>
                                                <span>{!! $review->review !!}</span>
                                                <i class="bi bi-quote quote-icon-right"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- End testimonial item -->
                            @endforeach


                            <div class="swiper-slide">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                            alt="">
                                        <h3>Sara Wilsson</h3>
                                        <h4>Designer</h4>
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Export tempor illum tamen malis malis eram quae irure esse labore quem
                                                cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua
                                                noster fugiat irure amet legam anim culpa.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                            alt="">
                                        <h3>Jena Karlis</h3>
                                        <h4>Store Owner</h4>
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla
                                                quem veniam duis minim tempor labore quem eram duis noster aute amet eram
                                                fore quis sint minim.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                            alt="">
                                        <h3>Matt Brandon</h3>
                                        <h4>Freelancer</h4>
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export
                                                minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt
                                                elit fore quem dolore labore illum veniam.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img"
                                            alt="">
                                        <h3>John Larson</h3>
                                        <h4>Entrepreneur</h4>
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam
                                                tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum
                                                fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End testimonial item -->

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                </div>

            </section><!-- /Testimonials Section -->
        @endif
    </div>

</section>
<!-- /Profile Section -->

@endsection