@extends('user.layout')
@section('title', $car->brand.' '.$car->model)

@section('user-page')
<div class="site-section pt-0 pb-0 mt-4 bg-light">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <div class="row mb-3">
            <div class="col-6">
                <div class="row">
                    @foreach($car->carImages as $image)
                    <div class="col-md-12">
                        <img src="{{$image?->image_link}}" alt="" style="width:100%" class="img-responsive img">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-6 p-3">
                <div class=" d-flex align-items-center justify-content-between ">
                    <span class="h2">Brand</span>
                    <div class="h2">{{ $car->brand }}</div>
                </div>
                <hr class="divider">
                <div class=" d-flex align-items-center justify-content-between ">
                    <span class="h2">Model</span>
                    <div class="h2">{{ $car->model }}</div>
                </div>
                <hr class="divider">
                <div class=" d-flex align-items-center justify-content-between ">
                    <span class="h2">Year</span>
                    <div class="h2">{{ $car->year }}</div>
                </div>
                <hr class="divider">
                <div class=" d-flex flex-column align-items-start justify-content-start ">
                    <span class="h2">About</span>
                    <div class="h2">{{ $car->description }}</div>
                </div>
                <hr class="divider">
                <div class=" d-flex align-items-center justify-content-between ">
                    <span class="h2">Price per hour</span>
                    <div class="h2">{{ $car->hourly_rate }}</div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <button class="btn-block btn btn-lg btn-primary" data-toggle="modal" data-target="#modal">Rent</button>
        </div>
        <div class="h2 mt-5">Related Cars</div>
        <div class="row mt-5">
            @foreach ($related as $rel )
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="item-1">
                    <a href="/cars/{{$car->id}}"><img src="{{ $rel->carImages->get(0)?->image_link ?? "images/img_1.jpg" }}" alt=" {{ $rel->model }} Image" class="img-fluid"></a>
                    <div class="item-1-contents">
                        <div class="text-center">
                            <h3><a href="/cars/{{$rel->id}}">{{ $rel->brand.' '.$rel->model}}</a>
                            </h3>
                            <div class="rent-price"><span>{{ $rel->hourly_rate }}/</span>hour</div>
                        </div>
                        <ul class="specs">
                            <li>
                                <span>Color</span>
                                <span class="spec">
                                    <div style="background-color: {{ strtolower($car->color) }}; width:15px;min-width:15px;height:15px; border-radius:50%;"></div>
                                </span>
                            </li>
                            <li>
                                <span>Brand</span>
                                <span class="spec">{{$rel->brand}}</span>
                            </li>
                            <li>
                                <span>Model</span>
                                <span class="spec">{{$rel->model}}</span>
                            </li>
                        </ul>
                        <div class="d-flex action">
                            @if (auth()->check())
                            <a href="/cars/{{$rel->id}}" class="btn btn-block btn-primary">Rent Now</a>
                            @else
                            <a href="/login" class="btn btn-block btn-primary">Login before rent </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<div class="modal" id="modal">
    <div class="site-section pt-0 pb-0 bg-transparent modal-dialog-centered">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form class="trip-form" action="/cars/{{$car->id}}/rent" method="post">
                        @csrf
                        <h3>Fill fields for renting car</h3>
                        <div class="form-group ">
                            <label for="cf-3">Journey date</label>
                            <input type="datetime-local" id="cf-3" placeholder="Your pickup address" name="start_date" class="form-control  px-3">
                        </div>
                        <div class="form-group">
                            <label for="cf-4">Return date</label>
                            <input type="datetime-local" id="cf-4" placeholder="Your pickup address" name="end_date" class="form-control  px-3">
                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary btn-block">Rent a car</button>
                            <button type="submit" class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close">Dismiss</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
