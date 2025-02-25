@extends('deepseek.layouts.app')
@push('styles')
<style>
        .message-box {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .message-box h1 {
            font-size: 2.5rem;
            color: #333;
            font-weight: 600;
        }
        .message-box p {
            font-size: 1.1rem;
            color: #555;
        }
        .btn-contact {
            background-color: #007bff;
            color: #fff;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-contact:hover {
            color: #fff;
            background-color: green;
        }
    </style>
@endpush

@section('content')

<div class="container">
    <div class="message-box text-center">
        <h1 class="display-4">Notice</h1>
        <p class="lead">This form is no longer accepting any requests. Please contact the institute for more information.</p>
        <p>If you need any further assistance, please don't hesitate to reach out to us directly.</p>
        <a href="mailto:iascoaching.sntcssc@gmail.com" class="btn-contact">Email Us</a>
    </div>
</div>
@endsection