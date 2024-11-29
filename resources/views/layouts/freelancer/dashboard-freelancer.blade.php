@extends('layouts.master')

@section('title', 'Freelancer Dashboard')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

    <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6 text-center">
                    <h2>Welcome to Freelync</h2>
                    <p>Connect with clients, manage your projects, and turn your freelance journey into success. Whether
                        you’re starting a new collaboration or wrapping up a project, Freelync empowers you to make an
                        impact. Dive in, deliver excellence, and grow with Freelync</p>
                    <a href="{{ route('freelancer.search-project')}}" class="btn-get-started">Get Started</a>
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
        <h2>Your Project Summary</h2>
        <p>Stay on top of your projects with an at-a-glance view of your progress on Freelync</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

            <div class="col-lg-4 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-hourglass-split color-green flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $waitingApplication->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Waiting</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-4 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-person-check color-orange flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $acceptedApplication->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Accepted</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-4 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-clipboard-x color-green flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $rejectedApplication->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Rejected</p>
                    </div>
                </div>
            </div><!-- End Stats Item -->

        </div>

        <!-- Row for Charts -->
        <div class="row gy-4 d-flex mt-5">
            <div class="col-lg-6 chart-bar-freelancer">
                <canvas id="taskProgressChart"></canvas>
            </div>
            <div class="col-lg-6 chart-line">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>

    </div>

</section><!-- /Stats Counter Section -->

<!-- Team Section -->
<section id="team" class="team section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Your Project Clients</h2>
        <p>Manage your clients and track their projects</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row gy-5">

            @foreach ($projects as $project)
                <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-img">
                        <img src="{{ asset('storage/pictures/' . $project->client->picture) }}" class="img-fluid" alt="">
                        <div class="social">
                            <a href="#"><i class="bi bi-twitter-x"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="member-info text-center">
                        <a href="{{ route('profile', ['id' => $project->client->id]) }}">
                            <h4>{{ $project->client->name }}</h4>
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

        const taskProgress = document.getElementById('taskProgressChart');

        new Chart(taskProgress, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Task Progress',
                    data: @json($data),
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

        const income = document.getElementById('incomeChart');

        new Chart(income, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Monthly Income',
                    data: @json($incomeData),
                    fill: false,
                    borderColor: '#feb900',
                    tension: 0.1
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