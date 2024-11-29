@extends('layouts.master')

@section('title', 'Review Project')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/reviews/review-1.jpg') }}');">
    <div class="container position-relative">
        <h1>Reflect on Your Project Journey!</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a>Share valuable insights and help us recognize outstanding freelancers.</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Testimonials Section -->
<section id="reviews" class="reviews section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Client Testimonials & Project Feedback</h2>
        <p>Read through client experiences and gain insights into freelancer performance on past projects.</p>
    </div>
    <!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            @if(auth()->user()->hasRole('client'))
                @if ($reviews->count())

                    @foreach ($reviews as $review)
                        <div class="col-lg-6 d-flex">
                            <div class="swiper-slide">
                                <div class="review-wrap">
                                    <div class="review-item">
                                        <img src="{{ asset('storage/pictures/' . $review->client->picture) }}" class="review-img"
                                            alt="">
                                        <h3>{{ $review->client->name }}</h3>
                                        <h4>Project: {{ $review->project->title }}</h4>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>{!! $review->review !!}</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('client.update-review', [$review->project->id, $review->id]) }}">
                                                <button type="button" class="btn-application">UPDATE</button>
                                            </a>
                                            <form action="{{ route('client.delete-review', [$review->project->id, $review->id]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this review?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-application">DELETE</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- End testimonial item -->
                        </div>
                    @endforeach

                @else
                    <div class="col-12">
                        <p>No reviews available at the moment</p>
                    </div>
                @endif
            @elseif(auth()->user()->hasRole('freelancer'))
                @if ($reviews->count())

                    @foreach ($reviews as $review)
                        <div class="col-lg-6 d-flex">
                            <div class="swiper-slide">
                                <div class="review-wrap">
                                    <div class="review-item">
                                        <img src="{{ asset('storage/pictures/' . $review->client->picture) }}" class="review-img"
                                            alt="">
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
                        </div>
                    @endforeach

                @else
                    <div class="col-12">
                        <p>No reviews available at the moment</p>
                    </div>
                @endif

            @endif


        </div>


    </div>
    <div class="swiper-pagination"></div>

</section><!-- /Testimonials Section -->

@endsection