@extends('layouts.master')

@section('title', 'My Projects')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/projects/project-1.jpg') }}');">
    <div class="container position-relative">
        <h1>Find Talented Freelancers to Bring Your Projects to Life!</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a>Post your project and connect with top talent to get things done.</a></li>
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

<!-- Create Project Section -->
<section id="alt-services" class="alt-services section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Your Project</h2>
        <p>Organize your project according to what you want</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row justify-content-around gy-4">
            <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img
                    src="{{ asset('assets/img/projects/project-2.jpg') }}" alt="project-2.jpg"></div>

            <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <h3>Discover the Perfect Freelancer for Your Project</h3>
                <p>Finding the right talent is just a few clicks away. Browse a pool of highly skilled freelancers who
                    are ready to help you turn your vision into reality. From design to development, get the expertise
                    you need, right
                    when you need it.</p>
                <a href="{{ route('client.create-project') }}" class="btn-created">Create Project</a>
            </div>
        </div>

    </div>

</section>
<!-- /Create Project Section -->

<!-- My Project Section -->
<section id="features" class="features section">

    <div class="container">

        <ul class="nav nav-tabs row  g-2 d-flex" data-aos="fade-up" data-aos-delay="100" role="tablist">

            <li class="nav-item col-3" role="presentation">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1"
                    aria-selected="true" role="tab">
                    <h4>Open</h4>
                </a>
            </li><!-- End tab nav item -->

            <li class="nav-item col-3" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2" aria-selected="false"
                    tabindex="-1" role="tab">
                    <h4>Waiting Approval</h4>
                </a><!-- End tab nav item -->

            </li>
            <li class="nav-item col-3" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3" aria-selected="false"
                    tabindex="-1" role="tab">
                    <h4>In Progress</h4>
                </a>
            </li><!-- End tab nav item -->

            <li class="nav-item col-3" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4" aria-selected="false"
                    tabindex="-1" role="tab">
                    <h4>Completed</h4>
                </a>
            </li><!-- End tab nav item -->

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            <div class="tab-pane fade active show" id="features-tab-1" role="tabpanel">
                <!-- Project Section -->
                <section id="list-project" class="list-project section">
                    <div class="container">
                        <div class="row gy-4">
                            @if ($openProjects->count())
                                @foreach ($openProjects as $project)
                                    <div class="col-lg-4 col-md-6 d-flex justify-content-between" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <div class="service-item position-relative">
                                            <div class="row gy-4 mb-4">
                                                <div class="col-lg-4 col-md-6">
                                                    <img src="{{ asset('storage/pictures/' . auth()->user()->picture) }}"
                                                        alt="Profile Picture" class="img-fluid">
                                                </div>
                                                <div class="col-lg-5 col-md-6">
                                                    <div>
                                                        <h4>{{ $project->client->name }}</h4>
                                                        <p>Posted
                                                            {{ Carbon\Carbon::parse($project->created_at)->format('d M') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 text-center">
                                                    <div>
                                                        <h5>{{ ucfirst($project->status) }}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <h3>{{ $project->title }}</h3>
                                            <p>{!! Str::limit($project->desc, 100) !!}</p>
                                            <a href="{{ route('detail-project', $project->id) }}" class="readmore">Read more
                                                <i class="bi bi-arrow-right"></i></a>
                                            <div class="row gy-4 d-flex justify-content-between">
                                                <div class="col-lg-4">
                                                    <h2>${{ $project->budget }}</h2>
                                                </div>
                                                <div class="col-lg-8 col-md-4 d-flex text-center">
                                                    <a href="{{ route('client.update-project', $project->id) }}"><button
                                                            type="submit" class="btn-application">UPDATE</button></a>
                                                    <form action="{{ route('client.delete-project', $project->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this project?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-application">DELETE</button>
                                                    </form>
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

                <!-- Project Pagination Section -->
                <section id="project-pagination" class="project-pagination section">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            {{ $openProjects->links() }}
                        </div>
                    </div>
                </section>
            </div><!-- End tab content item -->

            <div class="tab-pane fade" id="features-tab-2" role="tabpanel">
                <!-- Project Section -->
                <section id="list-project" class="list-project section">
                    <div class="container">
                        <div class="row gy-4">
                            @if ($waitingApprovalProjects->count())
                                @foreach ($waitingApprovalProjects as $project)
                                    <div class="col-lg-4 col-md-6 d-flex justify-content-between" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <div class="service-item position-relative">
                                            <div class="row gy-4 mb-4 justify-content-between position-relative">
                                                <div class="col-lg-4">
                                                    <img src="{{ asset('storage/pictures/' . auth()->user()->picture) }}"
                                                        alt="Profile Picture" class="img-fluid">
                                                </div>
                                                <div class="col-lg-5">
                                                    <h4>{{ $project->client->name }}</h4>
                                                    <p>Posted {{ Carbon\Carbon::parse($project->created_at)->format('d M') }}
                                                    </p>
                                                </div>
                                                <div class="col-lg-3 text-center">
                                                    <h5>{{ ucfirst($project->status) }}</h5>
                                                </div>
                                            </div>

                                            <h3>{{ $project->title }}</h3>
                                            <p>{!! Str::limit($project->desc, 100) !!}</p>
                                            <a href="{{ route('detail-project', $project->id) }}" class="readmore">Read more
                                                <i class="bi bi-arrow-right"></i></a>
                                            <div class="row gy-4 d-flex justify-content-between">
                                                <div class="col-lg-4">
                                                    <h2>${{ $project->budget }}</h2>
                                                </div>
                                                <div class="col-lg-8 col-md-4 d-flex text-center">
                                                    <a href="{{ route('client.update-project', $project->id) }}"><button
                                                            type="submit" class="btn-application">UPDATE</button></a>
                                                    <form action="{{ route('client.delete-project', $project->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this project?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-application">DELETE</button>
                                                    </form>
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

                <!-- Project Pagination Section -->
                <section id="project-pagination" class="project-pagination section">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            {{ $waitingApprovalProjects->links() }}
                        </div>
                    </div>
                </section>
            </div><!-- End tab content item -->

            <div class="tab-pane fade" id="features-tab-3" role="tabpanel">
                <!-- Project Section -->
                <section id="list-project" class="list-project section">
                    <div class="container">
                        <div class="row gy-4">
                            @if ($inProgressProjects->count())
                                @foreach ($inProgressProjects as $project)
                                    <div class="col-lg-4 col-md-6 d-flex justify-content-between" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <div class="service-item position-relative">
                                            <div class="row gy-4 mb-4 justify-content-between position-relative">
                                                <div class="col-lg-4">
                                                    <img src="{{ asset('storage/pictures/' . auth()->user()->picture) }}"
                                                        alt="Profile Picture" class="img-fluid">
                                                </div>
                                                <div class="col-lg-5">
                                                    <h4>{{ $project->client->name }}</h4>
                                                    <p>Posted {{ Carbon\Carbon::parse($project->created_at)->format('d M') }}
                                                    </p>
                                                </div>
                                                <div class="col-lg-3 text-center">
                                                    <h5>{{ ucfirst($project->status) }}</h5>
                                                </div>
                                            </div>

                                            <h3>{{ $project->title }}</h3>
                                            <p>{!! Str::limit($project->desc, 100) !!}</p>
                                            <a href="{{ route('detail-project', $project->id) }}" class="readmore">Read more
                                                <i class="bi bi-arrow-right"></i></a>
                                            <div class="row gy-4 d-flex justify-content-between">
                                                <div class="col-lg-4">
                                                    <h2>${{ $project->budget }}</h2>
                                                </div>
                                                <div class="col-lg-8 col-md-4 d-flex text-center">
                                                    <a href="{{ route('task', $project->id) }}"><button type="submit"
                                                            class="btn-application">
                                                            TASK</button></a>
                                                    <a href="{{ route('client.update-project', $project->id) }}"><button
                                                            type="submit" class="btn-application">UPDATE</button></a>
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

                <!-- Project Pagination Section -->
                <section id="project-pagination" class="project-pagination section">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            {{ $inProgressProjects->links() }}
                        </div>
                    </div>
                </section>
            </div><!-- End tab content item -->

            <div class="tab-pane fade" id="features-tab-4" role="tabpanel">
                <!-- Project Section -->
                <section id="list-project" class="list-project section">
                    <div class="container">
                        <div class="row gy-4">
                            @if ($completedProjects->count())
                                @foreach ($completedProjects as $project)
                                    <div class="col-lg-4 col-md-6 d-flex justify-content-between" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <div class="service-item position-relative">
                                            <div class="row gy-4 mb-4 justify-content-between position-relative">
                                                <div class="col-lg-4">
                                                    <img src="{{ asset('storage/pictures/' . auth()->user()->picture) }}"
                                                        alt="Profile Picture" class="img-fluid">
                                                </div>
                                                <div class="col-lg-5">
                                                    <h4>{{ $project->client->name }}</h4>
                                                    <p>Posted {{ Carbon\Carbon::parse($project->created_at)->format('d M') }}
                                                    </p>
                                                </div>
                                                <div class="col-lg-3 text-center">
                                                    <h5>{{ ucfirst($project->status) }}</h5>
                                                </div>
                                            </div>

                                            <h3>{{ $project->title }}</h3>
                                            <p>{!! Str::limit($project->desc, 100) !!}</p>
                                            <a href="{{ route('detail-project', $project->id) }}" class="readmore">Read more
                                                <i class="bi bi-arrow-right"></i></a>
                                            <div class="row gy-4 d-flex justify-content-between">
                                                <div class="col-lg-4">
                                                    <h2>${{ $project->budget }}</h2>
                                                </div>
                                                <div class="col-lg-8 col-md-4 d-flex text-center align-items-center">

                                                    @if ($project->review)

                                                        <a href="{{ route('review', $project->id) }}">
                                                            <button type="button" class="btn-application">SEE REVIEW</button>
                                                        </a>

                                                    @else


                                                        <a href="{{ route('client.create-review', $project->id) }}">
                                                            <button type="button" class="btn-application">CREATE REVIEW</button>
                                                        </a>

                                                    @endif

                                                    <form action="{{ route('client.delete-project', $project->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this project?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-application">DELETE</button>
                                                    </form>
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

                <!-- Project Pagination Section -->
                <section id="project-pagination" class="project-pagination section">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            {{ $completedProjects->links() }}
                        </div>
                    </div>
                </section>
            </div><!-- End tab content item -->

        </div>
    </div>
</section><!-- /My Project Section -->

@endsection