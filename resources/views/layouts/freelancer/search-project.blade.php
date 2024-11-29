@extends('layouts.master')

@section('title', 'Search Projects')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/projects/project-2.jpg') }}');">
    <div class="container position-relative">
        <h1>Find Projects to Explore Your Skills!</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a>Look for opportunities and start working!</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<div class="col-lg-12 col-md-6 align-items-center justify-content-center">
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
        <!-- /Alert Success -->
        <!-- Alert Error -->
    @elseif(session('error'))
        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- /Alert Error -->
</div>

<!-- Category Section -->
<section id="alt-services" class="alt-services section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Categories</h2>
    </div><!-- End Section Title -->
    <div class="container">
        <div class="row gy-4">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-body icon-box">
                            <h4>
                                <a href="{{ route('freelancer.search-project.category', $category->id) }}"
                                    class="stretched-link">{{ $category->name }}</a>
                            </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /End Category Section -->

<!-- Project Section -->
<section id="services" class="services get-started section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>
            @isset($selectedCategory)
                Projects in {{ $selectedCategory->name }}
            @else
                All Projects
            @endisset
        </h2>
    </div>
    <!-- End Section Title -->

    <!-- Search Section -->
    <div class="container">
        <div class="row justify-content-between gy-4">
            <div class="col-lg-7" data-aos="zoom-out" data-aos-delay="200">
                <form action="{{ route('freelancer.search-project') }}" method="GET" class="php-search">
                    <h3>Search Project</h3>
                    <div class="row gy-3">
                        <div class="col-6 col-md-6">
                            <input type="text" name="keyword" class="form-control" placeholder="Enter your keyword"
                                required="">
                        </div>

                        <div class="col-6 col-md-6">
                            <button type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Search Section -->

    <!-- Project Section -->
    <div class="container">
        <div class="row gy-4">
            @if ($projects->count())
                @foreach ($projects as $project)
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
                            <div class="row gy-4 justify-content-between">
                                <div class="col-lg-6 col-md-6">
                                    <h2>${{ $project->budget }}</h2>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <form action="{{ route('freelancer.apply', $project->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-application">APPLY</button>
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
<!-- /Project Section -->

<!-- Project Pagination Section -->
<section id="project-pagination" class="project-pagination section">
    <div class="container">
        <div class="d-flex justify-content-center">
            {{ $projects->links() }}
        </div>
    </div>
</section>
@endsection