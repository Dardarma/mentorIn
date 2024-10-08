@extends('layout.dashboardlayout')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kalender mentroIn</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item ">Home</li>
                        <li class="breadcrumb-item active"><a href="#">Kalender</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

@endsection