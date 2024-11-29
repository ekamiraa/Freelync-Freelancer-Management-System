@extends('layouts.master')

@section('title', 'Update Profile')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/projects/project-5.jpg') }}');">
    <div class="container position-relative">
        <h1>Profile</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a>Shape your journey. Showcase your strengths. Connect with the right opportunities</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Profile Section -->
<section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Your Profile</h2>
        <p>Manage your projects efficiently, whether you are working as a freelancer or hiring talent as a client</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        @if(auth()->user()->id == $user->id)

            <div class="row gy-4 mt-1">

                <div class="col-lg-12">
                    <form action="{{ route('update-profile.update', $user->id) }}" method="POST" class="php-email-form"
                        data-aos="fade-up" data-aos-delay="400" enctype="multipart/form-data">
                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif
                        <div class="row gy-4">

                            <div class="col-md-6 ">
                                <label for="name" class="label-control">Name :</label>
                                <input type="text" class="form-control" name="name" placeholder="-"
                                    value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="col-md-6 ">
                                <label for="picture" class="label-control">Picture :</label>
                                <input type="file" class="form-control" name="picture" placeholder="-">
                            </div>
                            <div class="col-md-6 ">
                                <label for="email" class="label-control">Email :</label>
                                <input type="email" class="form-control" name="email" placeholder="-"
                                    value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="col-md-6 ">
                                <label for="contact_info" class="label-control">Contact Info :</label>
                                <input type="text" class="form-control" name="contact_info" placeholder="-"
                                    value="{{ old('contact_info', $user->contact_info) }}">
                            </div>

                            @if(auth()->user()->hasRole('freelancer'))
                                <div class="col-md-12">
                                    <label for="portofolio" class="label-control">Portofolio :</label>
                                    <input type="text" class="form-control" name="portofolio" placeholder="-"
                                        value="{{ old('portofolio', $user->portofolio) }}">
                                </div>

                                <div class="col-md-12">
                                    <label for="skills" class="label-control">Skills :</label>
                                    <input type="text" class="form-control" name="skills" placeholder="-"
                                        value="{{ old('skills', $user->skills) }}">
                                </div>

                            @elseif(auth()->user()->hasRole('client'))

                                <div class="col-md-12">
                                    <label for="company_name" class="label-control">Company's Name :</label>
                                    <input type="text" class="form-control" name="company_name" placeholder="-"
                                        value="{{ old('company_name', $user->company_name) }}">
                                </div>

                            @endif

                            <div class="col-md-12">
                                <label for="about_me" class="label-control">About Me :</label>
                                <textarea class="form-control" name="about_me" rows="6" placeholder="-"
                                    id="aboutme-editor">{{ $user->about_me }}</textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit">Update Profile</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>
        @endif
    </div>

</section>
<!-- /Profile Section -->

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
            .create(document.querySelector('#aboutme-editor'), {
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