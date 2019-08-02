@extends('layouts.app')

@section('content')

    @if ($message = Session::get('success'))
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container card-main-wrap">
        <div class="row justify-content-center">
            <div class="col-md-6 text-right">
                <div class="row">
                    <form action="{{route('upload_img_wear', $wear->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="offset-md-1 col-md-11">
                            <div class="row">
                                <div class="col-md-9">
                                    <div>
                                        <input type="file" class="" name="wear_image">
                                    </div>
                                </div>
                                <div class="col-md-2 text-left">
                                    <button class="btn btn-dark">upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
            </div>
            @if($img_exist)
                <div class="col-md-6 text-left" >
                    <div class="row">
                        <div class="col-md-11">
                            <form action="{{route('download_img_wear', $wear->id)}}">
                                <button class="btn btn-dark">download</button>
                            </form>
                        </div>
                    </div>
                    <br>
                </div>
            @endif
        </div>
        <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-body card-body-wear text-center">
                        <h1>{{$wear->name}}</h1>
                        @if($img_exist)
                            <img src="{{$wear->image_url}}" alt="" class="card-body-wear-img">
                        @endif
                        @if($sex == 1)
                            <img src="/images/man_rectangle.png" alt="">
                        @else
                            <img src="/images/woman_rectangle.png" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
