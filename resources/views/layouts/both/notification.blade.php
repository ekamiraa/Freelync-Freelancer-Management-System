@extends('layouts.master')

@section('title', 'Notifications')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/projects/notification.jpg') }}');">
    <div class="container position-relative">
        <h1>Stay Updated with Your Notifications!</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a>Check your latest updates and stay informed!</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Notification Section -->
<section id="notification" class="notification section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Notifications</h2>
    </div><!-- End Section Title -->

    <div class="container">

        @foreach ($notifications as $notification)
            <div class="notification-list">
                <p>
                    {{ $notification->data['message'] }}
                </p>
            </div>
        @endforeach

    </div>

</section><!-- /Notification Section -->
@endsection