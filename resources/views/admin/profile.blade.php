@extends('layouts.admin')
@section('style')
<style>
    .loader {
        width: 32px;
        height: 32px;
        position: relative;
        border-radius: 50%;
        color: #FF3D00;
        display: block;
        animation: fill 1s ease-in infinite alternate;
    }

    .loader::before,
    .loader::after {
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        border-radius: 50%;
        left: 48px;
        top: 0;
        animation: fill 0.9s ease-in infinite alternate;
    }

    .loader::after {
        left: auto;
        right: 48px;
        animation-duration: 1.1s;
    }

    @keyframes fill {
        0% {
            box-shadow: 0 0 0 2px inset
        }

        100% {
            box-shadow: 0 0 0 10px inset
        }
    }
</style>
@endsection
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="dashboard-ecommerce">
                <div class="row bg-white p-2 match-height">
                    <div class="col-md-6 offset-md-3 col-sm-12">
                        <form method="POST" action="{{ route('updateProfile') }}">
                            @csrf
                            <div class="form-group">
                                <Label for="client_name">Name</Label>
                                <input type="text" value="{{ $user->name }}" name="name" id="client_name"
                                    class="form-control" placeholder="Enter Your Name..." >
                                    @if ($errors->has('name'))<p style="color:red;">{{ $errors->first('name') }}</p>@endif
                            </div>
                            <div class="form-group">
                                <Label for="client_email">Email</Label>
                                <input type="email" name="email" value="{{ $user->email }}" id="client_email"
                                    class="form-control" placeholder="Enter Your Email..." >
                                    @if ($errors->has('email'))<p style="color:red;">{{ $errors->first('email') }}</p>@endif
                            </div>
                            <div class="form-group">
                                <Label for="client_password">Password</Label>
                                <input type="password" name="password" id="client_password" autocomplete="off"
                                    class="form-control" placeholder="Enter New Password...">
                                    @if ($errors->has('password'))<p style="color:red;">{{ $errors->first('password') }}</p>@endif
                            </div>
                            <button class="btn btn-primary d-block mx-auto">Update</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection