@extends('layouts.master')
@section('content') 
<div class="row">
    <div class="col-12">
        <h4 class="my-4">Show Vlog</h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <video width="400" controls>
                                <source src="{{$vlog->video}}" type="video/mp4">
                              </video>                        
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$vlog->title}}</h5>
                                <p class="card-text">{{$vlog->content}}</p>
                                <p class="card-text"><small class="text-muted">{{$vlog->created_at->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection