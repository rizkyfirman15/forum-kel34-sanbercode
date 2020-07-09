@extends('adminlte.master')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Halaman Diskusi</h1>

<div class="container mb-4"><center>

<!-- Post -->
<div class="card gedf-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <img class="rounded-circle" width="45" src="{{asset('images/user.jpg')}}"alt="">
                </div>
                <div class="ml-2 ">
                    <div class="h5 m-0 ">{{Auth::user()->name}}</div>
                    <div class="h7 text-muted">{{Auth::user()->email}}</div>
                </div>
            </div>
            <div>
            <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                        <div class="h6 dropdown-header">Aksi</div>
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body" style=" text-align: left!important;">
        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>10 min ago</div>
        <a class="card-link" href="#">
            <h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adip.</h5>
        </a>

        <p class="card-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo recusandae nulla rem eos ipsa praesentium esse magnam nemo dolor
            sequi fuga quia quaerat cum, obcaecati hic, molestias minima iste voluptates.
        </p>
    </div>
    <div class="mb-4 ml-3" style="text-align: left!important;">
            <span class="badge badge-primary">JavaScript</span>
            <span class="badge badge-primary">Android</span>
            <span class="badge badge-primary">PHP</span>
            <span class="badge badge-primary">Node.js</span>
            <span class="badge badge-primary">Ruby</span>
            <span class="badge badge-primary">Paython</span>
    </div>
    <div class="card-footer">
        <a href="#" class="card-link" style="color: green;"><i class="fa fa-arrow-up"></i> UpVote</a>
        <a href="#" class="card-link" style="color: red;"><i class="fa fa-arrow-down"></i> DownVote</a>
        <a href="#" class="card-link"><i class="fa fa-comments"></i> Beri Jawaban</a>
    </div>
</div>
</br>
<!-- end Post -->
<!-- Post -->
<div class="card gedf-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <img class="rounded-circle" width="45" src="{{asset('images/user.jpg')}}"alt="">
                </div>
                <div class="ml-2 ">
                    <div class="h5 m-0 ">{{Auth::user()->name}}</div>
                    <div class="h7 text-muted">{{Auth::user()->email}}</div>
                </div>
            </div>
            <div>
            <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                        <div class="h6 dropdown-header">Aksi</div>
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body" style=" text-align: left!important;">
        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>10 min ago</div>
        <a class="card-link" href="#">
            <h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adip.</h5>
        </a>

        <p class="card-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo recusandae nulla rem eos ipsa praesentium esse magnam nemo dolor
            sequi fuga quia quaerat cum, obcaecati hic, molestias minima iste voluptates.
        </p>
    </div>
    <div class="mb-4 ml-3" style="text-align: left!important;">
            <span class="badge badge-primary">JavaScript</span>
            <span class="badge badge-primary">Android</span>
            <span class="badge badge-primary">PHP</span>
            <span class="badge badge-primary">Node.js</span>
            <span class="badge badge-primary">Ruby</span>
            <span class="badge badge-primary">Paython</span>
        </div>
    <div class="card-footer">
        <a href="#" class="card-link" style="color: green;"><i class="fa fa-arrow-up"></i> UpVote</a>
        <a href="#" class="card-link" style="color: red;"><i class="fa fa-arrow-down"></i> DownVote</a>
        <a href="#" class="card-link"><i class="fa fa-comments"></i> Beri Jawaban</a>
    </div>
</div>
</br>
<!-- end Post -->
</div>

@endsection

@push('scripts')
@endpush