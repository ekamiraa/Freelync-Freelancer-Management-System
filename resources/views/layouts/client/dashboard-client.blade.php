@extends('layouts.master')

@section('title', 'Client Dashboard')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

    <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6 text-center">
                    <h2>Welcome to Freelync</h2>
                    <p>Connect with top freelancers and bring your projects to life. Whether you’re starting a new
                        venture or expanding your business, find skilled professionals ready to make your vision a
                        reality. Explore, collaborate, and succeed with Freelync</p>
                    <a href="{{ route('client.my-projects') }}" class="btn-get-started">Get Started</a>
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
        <h2>Project Overview</h2>
        <p>Discover the progress of projects on Freelync, where collaboration and completion meet</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-envelope-open color-blue flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $openProjects->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Open</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-person-check color-orange flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $waitingApprovalProjects->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Waiting Approval</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-hourglass-split color-green flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $inProgressProjects->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>In Progress</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-check-circle color-pink flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $completedProjects->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Completed</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

        </div>

        <!-- Row for Charts -->
        <div class="row gy-4 d-flex mt-5 justify-content-between align-items-center text-center">
            <div class="col-lg-5 chart-doughnut">
                <canvas id="projectStatusChart"></canvas>
            </div>
            <div class="col-lg-7 chart-bar-client">
                <canvas id="freelancerApplicationsChart"></canvas>
            </div>
        </div>

    </div>

</section><!-- /Stats Counter Section -->

<!-- Team Section -->
<section id="team" class="team section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Freelancers In Your Project</h2>
        <p>Organize your freelancer</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row gy-5">

            @foreach ($projects as $project)
                <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-img">
                        <img src="{{ asset('storage/pictures/' . $project->freelancer->picture) }}" class="img-fluid"
                            alt="">
                        <div class="social">
                            <a href="#"><i class="bi bi-twitter-x"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="member-info text-center">
                        <a href="{{ route('profile', ['id' => $project->freelancer->id]) }}">
                            <h4>{{ $project->freelancer->name }}</h4>
                        </a>
                        <span>{{ $project->title }}</span>
                        <p>{!! Str::limit($project->desc, 100) !!}</p>
                    </div>
                </div><!-- End Team Member -->
            @endforeach

        </div>

    </div>

</section><!-- /Team Section -->
@endsection

@push('chartjs')
    <script>
        const projectStatus = document.getElementById('projectStatusChart');

        new Chart(projectStatus, {
            type: 'doughnut',
            data: {
                labels: [
                    'Open',
                    'Waiting Approval',
                    'In progress',
                    'Completed'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [
                                                                                                                                                                {{ $openProjects->count() }},
                                                                                                                                                                {{ $waitingApprovalProjects->count() }},
                                                                                                                                                                {{ $inProgressProjects->count() }},
                        {{ $completedProjects->count() }}
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(201, 203, 207)'
                    ],
                    hoverOffset: 4
                }]
            }
        });

        const freelancerApplications = document.getElementById('freelancerApplicationsChart');

        new Chart(freelancerApplications, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Number of application',
                    data: @json($applicationData),
                    backgroundColor: '#feb900',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


    </script>


@endpush