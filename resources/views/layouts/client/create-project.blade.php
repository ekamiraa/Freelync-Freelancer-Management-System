@extends('layouts.master')

@section('title', 'Create New Project')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/projects/project-4.jpg') }}');">
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

<!-- Contact Section -->
<section id="general-form" class="general-form section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Your Project</h2>
        <p>Organize your project according to what you want</p>
    </div><!-- End Section Title -->

    <!-- /Create Project Section -->
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <form action="{{route('client.create-project.store')}}" method="post" class="php-email-form" data-aos="fade-up"
            data-aos-delay="400">
            @csrf
            <div class="row gy-4">

                <div class="col-md-6">
                    <label for="title" class="label-control">Title :</label>
                    <input type="text" name="title" class="form-control" placeholder="Your Project's Title" required>
                </div>
                <!-- error message untuk title -->
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="col-md-6">
                    <label for="budget" class="label-control">Budget :</label>
                    <input type="text" class="form-control" name="budget" placeholder="Your Project's Budget" required>
                </div>
                <!-- error message untuk budget -->
                @error('budget')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror


                <div class="col-md-6">
                    <label for="desc" class="label-control">Description :</label>
                    <textarea class="form-control" name="desc" rows="6" placeholder="Description"
                        id="desc-editor"></textarea>
                </div>
                <!-- error message untuk desc -->
                @error('desc')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="col-md-6">
                    <label for="category" class="label-control">Category :</label>
                    <div class="row gy-4">


                        @foreach($categories as $category)
                            <div class="form-check col-md-6">
                                <input class="form-check-input" type="checkbox" name="category_id[]"
                                    value="{{ $category->id }}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- error message untuk category -->
                @error('category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="col-md-6">
                    <label for="deadline" class="label-control">Deadline :</label>
                    <input type="date" class="form-control" name="deadline" placeholder="Your Project's Deadline"
                        required>
                </div>
                <!-- error message untuk deadline -->
                @error('deadline')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="col-md-12 text-center">
                    <button type="submit">Create Project</button>
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