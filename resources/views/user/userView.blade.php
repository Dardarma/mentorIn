@extends('layout.dashboardlayout')
@section('style')
.user-photo {
    width: 100px; 
    height: 100px;
    border: 3px solid #fff; 
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); 
    vertical-align: bottom;
}


    .card-large {
        display: none;
    }

    .card-small {
        display: block;
    }


    @media (min-width: 768px) {
        .user-photo {
            width: 200px; 
            height: 200px; 
        }
    }


@endsection
@section('content')

<div class="container-fluid">

    <div class="row d-flex flex-column flex-md-row">
        
        <div class="card col-12 mt-2" >
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-1">
                        <button type="button" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i></button>
                    </div>
                    <div class="col-7">
                        <h3>User View</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card col-12 col-md-3 ml-md-5 mr-md-2 mt-2">
            <div class="card-body d-flex flex-column align-items-center" style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('storage/user_profile/default.png') }}" alt="User Photo" class="rounded-circle user-photo" />
                <h2 class="mt-3">Nama User</h2>
                <h6>User Name</h6>
            </div>
        </div>

        <div class="card col-12 col-md-8 ml-md-2 mt-2" style="height: 80vh;">
            <div class="card-body d-flex align-items-center justify-content-center"> 
                <table style="width:50%; table-layout: fixed;" class="mt-5"> 
                    <tr>
                        <td style="width:40%; text-align:center; font-weight:bold; padding: 10px; vertical-align: bottom;">Asal Instansi</td>
                        <td style="width:60%; padding: 10px; word-wrap: break-word;">
                            SMK SMA SD SMP KULYAH
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%; text-align:center; font-weight:bold; padding: 10px; vertical-align: bottom;">
                            Role
                        </td>
                        <td style="width:80%; padding: 10px; word-wrap: break-word;">
                            Mentee
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%; text-align:center; font-weight:bold; padding: 10px; vertical-align: bottom;">
                            Asal Instasi
                        </td>
                        <td style="width:80%; padding: 10px; word-wrap: break-word;">
                            PENS
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%; text-align:center; font-weight:bold; padding: 10px; vertical-align: bottom;">
                            Status
                        </td>
                        <td style="width:80%; padding: 10px; word-wrap: break-word;">
                            Aktif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        
        

    </div>
</div>

@endsection