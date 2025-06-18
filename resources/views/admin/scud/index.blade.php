@extends('admin')

@section('content-admin')
    @foreach ($cameras as $camera)
        <div class="col-md-4">
            <div class="card">
                <img src="" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{$camera->name_camera}}</h5>
                    <p class="card-text">{{$camera->firm_id}}</p>
                    <p class="card-text">{{$camera->model}}</p>
                    <p class="card-text">{{$camera->serial_namber}}</p>
                    <p class="price">{{$camera->price}} BYN</p>
                    <a href="#" class="btn btn-success">Подробнее</a>                                                
                </div>
            </div>
        </div>
    @endforeach
@endsection