@extends('layouts.master')

@section('title', 'Project Applications')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/applications/application-1.jpg') }}');">
    <div class="container position-relative">
        <h1>Choose the Right Talent</h1>
        <nav class="breadcrumbs">
            <ol>
                <li>
                    <a>
                        Here are the freelancers who applied for your project. Review their profiles, and pick the one
                        who fits your vision
                        best
                    </a>
                </li>
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

<!-- Application Section -->
<section id="application" class="application section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Applications for
            "
            {{ $project->title }}
            "
        </h2>
        <p>Evaluate freelancer applications and choose the best candidate</p>
    </div>
    <!-- /Section Title -->

    <div class="container mb-5">

        @foreach ($applications as $application)
            <div class="application-items d-flex align-items-center">
                <img src="{{ asset('storage/pictures/' . $application->freelancer->picture) }}"
                    class="rounded-circle flex-shrink-0 p-2" alt="">
                <div class="p-2">
                    <a href="{{ route('profile', ['id' => $application->freelancer->id]) }}">
                        <h4>{{ $application->freelancer->name }}</h4>
                    </a>
                    <p>
                        {{ $application->freelancer->email }}
                    </p>
                </div>
                <div class="d-flex flex-shrink-2 ms-auto p-2">
                    <form
                        action="{{ route('client.application.chooseFreelancer', ['project_id' => $project->id, 'application_id' => $application->id]) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want accept this freelancer to your project?');">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn-application">ACCEPT</button>
                    </form>
                </div>
            </div>
        @endforeach

    </div>

</section>
<!-- /Blog Author Section -->

<!-- /Project Pagination Section -->
@endsection