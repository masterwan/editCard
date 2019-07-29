@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
{{--                <div class="card-header text-center">Dashboard</div>--}}
                <div class="card-body text-center">
                    <div class="row search-card-panel">
                        <div class="col-md-12">
                            <form action="{{route('cards')}}" method="GET">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <a href="{{route('cards')}}" class="btn btn-dark btn-block">SHOW ALL</a>
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" placeholder="BY ID" name="id" value="{{$search_data['wear_id']}}">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="category" id="">
                                            <option value="">SELECT CATEGORY</option>
                                            @foreach($categories as $category)
                                                <option @if($category->id == $search_data['cetegory_id']) selected @endif value="{{$category->id}}">
                                                    {{$category->name}} @if ($category->sex_id == 1) {{'(муж)'}} @else {{'(жен)'}} @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input class="btn btn-dark btn-block" type="submit" value="FIND">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="cards-wrap">
                        @forelse($wears as $wear)
                            <a href="{{$wear->id}}" class="card-link-wrap">
                                <div class="card-item">
                                    <img src="{{$wear->image_url}}" alt="">
                                    <p>{{$wear->name}}</p>
                                </div>
                            </a>
                        @empty
                            <div class="col-md-12 text-center">
                                <p class="no-results">NO RESULTS FOUND</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="paginator-wrap">{{ $wears->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
