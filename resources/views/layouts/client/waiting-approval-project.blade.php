@extends('layouts.master')

@section('title', 'Pending Project Approvals')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/applications/application-2.jpg') }}');">
    <div class="container position-relative">
        <h1>Review Incoming Applications</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a>Browse projects with pending applications and choose the right fit for your needs.</a></li>
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

<!-- Project Section -->
<section id="waiting-approval-project" class="waiting-approval-project section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Projects Awaiting Your Approval</h2>
        <p>Explore applications and connect with skilled freelancers ready to bring your project to life.</p>
    </div>
    <!-- End Section Title -->

    <!-- Project Section -->
    <div class="container">
        <div class="row gy-4">
            @if ($waitingApprovalProjects->count())
                @foreach ($waitingApprovalProjects as $project)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
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
                            <div class="row gy-4 justify-content-between align-items-center">
                                <div class="col-lg-5 col-md-6">
                                    <h2>${{ $project->budget }}</h2>
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <a href="{{ route('client.application', $project->id) }}"><button type="submit"
                                            class="btn-application">SEE APPLICATIONS</button></a>
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
<!-- /Project Section -->

<!-- Project Pagination Section -->
<section id="project-pagination" class="project-pagination section">
    <div class="container">
        <div class="d-flex justify-content-center">
            {{ $waitingApprovalProjects->links() }}
        </div>
    </div>
</section>
<!-- /Project Pagination Section -->
@endsection