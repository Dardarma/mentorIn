@extends('layout.layout')

@section('background-style')
        body {
            background-image: url('{{ asset('storage/login_background/default.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background-color: #d9d9d9
            height: 70vh; /* Pastikan satuan height dan width benar */
            width: 70vw;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            border-radius: 10px; 
            opacity: 0.95;
        }

        .card-body {
            padding: 20px;
        }

        .page-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
@endsection

@section('layout')

<div class="page-container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <img src="{{ asset('storage/logo_icon_apps/logo-dark.png') }}" alt="" style="width: 100%; height: auto;margin-top:15% " >
                </div>
                <div class="col-6">
                    <h1 style="text-align: center">mentorIn</h1>
                    <h5>Login</h5>
                    <form>
                        <input type="text" placeholder="Username" class="form-control mb-3">
                        <input type="password" placeholder="Password" class="form-control mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
