@extends('layouts.master')

@section('title', 'Update Review')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/reviews/review-3.jpg') }}');">
    <div class="container position-relative">
        <h1>Share Your Experience Working with Our Freelancers!</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a>Your feedback helps us grow and helps other clients find the right talent.</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Contact Section -->
<section id="general-form" class="general-form section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Review Project: {{ $project->title }}</h2>
        <p>Tell us about your experience with this project and the freelancer’s performance.</p>
    </div><!-- End Section Title -->

    <!-- /Create Project Section -->
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <form action="{{route('client.update-review.update', [$review->project->id, $review->id])}}" method="POST"
            class="php-email-form" data-aos="fade-up" data-aos-delay="400">
            @csrf
            @method('PUT')
            <div class="row gy-4">

                <div class="col-md-12">
                    <label for="review" class="label-control">Review :</label>
                    <textarea class="form-control" name="review" rows="6" placeholder="Your Review"
                        id="desc-editor">{{ $review->review }}</textarea>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit">Update Review</button>
                </div>

            </div>
        </form>


    </div>

</section><!-- /Contact Section -->
@endsection

@push('scripts')
    <script>
        const {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } = CKEDITOR;

        ClassicEditor
            .create(document.querySelector('#desc-editor'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endpush