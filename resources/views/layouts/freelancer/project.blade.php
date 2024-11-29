@extends('layouts.master')

@section('title', 'Project List')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/projects/project-4.jpg') }}');">
    <div class="container position-relative">
        <h1>Your Active Projects</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a>Keep track of your current projects and stay on top of deadlines</a></li>
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

<!-- Project In Progress Section -->
<section id="freelancer-project" class="freelancer-project section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Projects In Progress</h2>
        <p>Manage your active projects efficiently and stay focused on delivering great results</p>
    </div>
    <!-- End Section Title -->

    <!-- Project In Progress Section -->
    <div class="container">
        <div class="row gy-4">
            @if ($projects->count())
                @foreach ($projects as $project)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative d-flex flex-column">
                            <div class="row gy-4 mb-4">
                                <div class="col-lg-4 col-md-6">
                                    <img src="{{ asset('storage/pictures/' . $project->client->picture) }}" class="img-fluid"
                                        alt="Profile Picture">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div>
                                        <h4>{{ $project->client->name }}</h4>
                                        <p>Posted {{ Carbon\Carbon::parse($project->created_at)->format('d M') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 text-center">
                                    <div>
                                        <h5>{{ ucfirst($project->status) }}</h5>
                                    </div>
                                </div>
                            </div>

                            <h3>{{ $project->title }}</h3>
                            <p>{!! Str::limit($project->desc, 100) !!}</p>
                            <a href="{{ route('detail-project', $project->id) }}" class="readmore">Read more
                                <i class="bi bi-arrow-right"></i></a>
                            <div class="row gy-4">
                                <div class="col-lg-4 col-md-6 p-2">
                                    <h2>${{ $project->budget }}</h2>
                                </div>
                                <div class="col-lg-8 col-md-4 d-flex justify-content-end align-items-center">
                                    <a href="{{ route('task', $project->id) }}"><button type="submit"
                                            class="btn-application">SEE
                                            TASK</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p>No projects available at the moment.</p>
                </div>
            @endif
        </div>
    </div>


</section>
<!-- /Project In Progress Section -->

<!-- Project Completed Section -->
<section id="freelancer-project" class="freelancer-project section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Projects Completed</h2>
        <p>Those projects you've completed</p>
    </div>
    <!-- End Section Title -->

    <!-- Project Completed Section -->
    <div class="container">
        <div class="row gy-4">
            @if ($completedProjects->count())
                @foreach ($completedProjects as $project)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative d-flex flex-column">
                            <div class="row gy-4 mb-4">
                                <div class="col-lg-4 col-md-6">
                                    <img src="{{ asset('storage/pictures/' . $project->client->picture) }}" class="img-fluid"
                                        alt="Profile Picture">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div>
                                        <h4>{{ $project->client->name }}</h4>
                                        <p>Posted {{ Carbon\Carbon::parse($project->created_at)->format('d M') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 text-center">
                                    <div>
                                        <h5>{{ ucfirst($project->status) }}</h5>
                                    </div>
                                </div>
                            </div>

                            <h3>{{ $project->title }}</h3>
                            <p>{!! Str::limit($project->desc, 100) !!}</p>
                            <a href="{{ route('detail-project', $project->id) }}" class="readmore">Read more
                                <i class="bi bi-arrow-right"></i></a>
                            <div class="row gy-4">
                                <div class="col-lg-4 col-md-6 p-2">
                                    <h2>${{ $project->budget }}</h2>
                                </div>
                                <div class="col-lg-8 col-md-4 d-flex justify-content-end align-items-center">
                                    <a href="{{ route('task', $project->id) }}"><button type="submit"
                                            class="btn-application">SEE
                                            TASK</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p>No projects available at the moment.</p>
                </div>
            @endif
        </div>
    </div>


</section>
<!-- /Project Completed Section -->

<!-- Project Pagination Section -->
<section id="project-pagination" class="project-pagination section">
    <div class="container">
        <div class="d-flex justify-content-center">
            {{ $projects->links() }}
        </div>
    </div>
</section>
<!-- /Project Pagination Section -->
@endsection