@extends('user.layout')
@section('title', 'Car')

@section('user-page')
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay innerpage" style="background-image: url({{asset('images/hero_2.jpg')}})">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                    <h1>The best cars available for rent</h1>
                    <p>Vehicles from all manufacturers at unbelievable prices</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            @foreach ($cars as $car )
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="item-1">
                    <a href="/cars/{{$car->id}}"><img src="{{ $car->carImages->get(0)?->image_link ?? "images/img_1.jpg" }}" alt=" {{ $car->model }} Image" class="img-fluid"></a>
                    <div class="item-1-contents">
                        <div class="text-center">
                            <h3><a href="/cars/{{$car->id}}">{{ $car->brand.' '.$car->model }}</a></h3>
                            <div class="rent-price"><span>${{$car->hourly_rate}}/</span>hour</div>
                        </div>
                        <ul class="specs">
                            <li>
                                <span>Color</span>
                                <span class="spec">
                                    <span style="background-color: {{strtolower($car->color)}}; width:15px;min-width:15px;height:15px; border-radius:50%;display: inline-block"></span>
                                </span>
                            </li>
                            <li>
                                <span>Brand</span>
                                <span class="spec">{{$car->brand}}</span>
                            </li>
                            <li>
                                <span>Model</span>
                                <span class="spec">{{$car->model}}</span>
                            </li>
                        </ul>
                        <div class="d-flex action">
                            @if (auth()->check())
                            <a href="/cars/{{$car->id}}" class="btn btn-block btn-primary">Rent Now</a>
                            @else
                            <a href="/login" class="btn btn-block btn-primary">Login before rent </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-12">
                @foreach(range(1, $cars->lastPage()) as $page)
                    <a href="{{ Request::fullUrlWithQuery(['page' => $page]) }}" class="p-3">{{ $page }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="container site-section mb-5">
    <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
            <h2>How it works</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
        </div>
    </div>
    <div class="how-it-works d-flex">
        <div class="step">
            <span class="number"><span>01</span></span>
            <span class="caption">Time &amp; Place</span>
        </div>
        <div class="step">
            <span class="number"><span>02</span></span>
            <span class="caption">Car</span>
        </div>
        <div class="step">
            <span class="number"><span>03</span></span>
            <span class="caption">Details</span>
        </div>
        <div class="step">
            <span class="number"><span>04</span></span>
            <span class="caption">Checkout</span>
        </div>
        <div class="step">
            <span class="number"><span>05</span></span>
            <span class="caption">Done</span>
        </div>

    </div>
</div>
@endsection
