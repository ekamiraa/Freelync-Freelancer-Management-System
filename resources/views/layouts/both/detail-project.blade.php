@extends('layouts.master')

@section('title', 'Project Details')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/projects/project-3.jpg') }}');">
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

<div class="container">
    <div class="row">

        <div class="col-lg-8">
            <!-- Blog Author Section -->
            <section id="blog-author" class="blog-author section">

                <div class="container">
                    <div class="author-container d-flex align-items-center">
                        <img src="{{ asset('storage/pictures/' . $project->client->picture) }}"
                            class="rounded-circle flex-shrink-0" alt="Profile Picture">
                        <div>
                            <h4>{{ $project->client->name }}</h4>
                            <div class="social-links">
                                <a href="https://x.com/#"><i class="bi bi-twitter-x"></i></a>
                                <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                                <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                            </div>
                            <p>
                                Work at {{ $project->client->company_name }}
                            </p>
                        </div>
                    </div>
                </div>

            </section><!-- /Blog Author Section -->
            <!-- Project Details Section -->
            <section id="blog-details" class="blog-details section">
                <div class="container">

                    <article class="article">

                        <h2 class="title">{{ $project->title }}</h2>

                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-cash-stack"></i></i> <a
                                        href="blog-details.html">${{ $project->budget }}</a>
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                        href="blog-details.html"><time
                                            datetime="2020-01-01">{{ Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</time></a>
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-cursor"></i></i> <a
                                        href="blog-details.html">{{ ucfirst($project->status) }}</a>
                                </li>
                            </ul>
                        </div><!-- End meta top -->

                        @if(auth()->user()->hasRole('freelancer'))
                            <div class="content">
                                <p>
                                    {!! $project->desc !!}
                                </p>
                                <a href="#" class="btn-application text-center" type="submit">APPLY</a>
                            </div>
                        @elseif(auth()->user()->hasRole('client'))
                            <div class="content">
                                <p>
                                    {!! $project->desc !!}
                                </p>
                                <div class="row gy-4 d-flex justify-content-between">
                                    <div class="col-lg-6 col-md-4 d-flex text-center">
                                        <a href="#" class="btn-application" type="submit">UPDATE</a>
                                    </div>
                                    <div class="col-lg-6 col-md-4 d-flex text-center">
                                        <a href="#" class="btn-application" type="submit">DELETE</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </article>
                </div>
            </section><!-- /Project Details Section -->

        </div>

        <div class="col-lg-4 sidebar">

            <div class="widgets-container">

                <!-- Category Widget -->
                <div class="tags-widget widget-item">

                    <h3 class="widget-title">Category</h3>
                    <ul>
                        @foreach($project->categories as $category)
                            <li><a
                                    href="{{ route('freelancer.search-project.category', $category->id) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div><!--/Tags Widget -->
            </div>
        </div>
    </div>
</div>
<!-- /Project Details Section -->
@endsection