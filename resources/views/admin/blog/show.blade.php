@extends('layouts.master')
@section('content') 
<div class="row">
    <div class="col-12">
        <h4 class="my-4">Show Blog</h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{$blog->image}}" alt="..." class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$blog->title}}</h5>
                                <p class="card-text">{{$blog->content}}</p>
                                <p class="card-text"><small class="text-muted">{{$blog->created_at->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection