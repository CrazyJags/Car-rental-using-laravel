@extends('user.layout')
@section('title', 'Home')

@section('user-page')
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay" style="background-image: url('images/hero_1.jpg')">
        <div class="container">
            <div class="row align-items-center">
                @isset($cars[0])
                <div class="col-lg-5">
                    <div class="feature-car-rent-box-1">
                        <h3>{{$cars->first()->brand.' '.$cars->first()->model}}</h3>
                        <ul class="specs list-unstyled">
                            <li>
                                <span>Color</span>
                                <span class="spec">
                                    <div style="background-color: {{strtolower($cars->get(0)->color)}}; width:15px;min-width:15px;height:15px; border-radius:50%;"></div>
                                </span>
                            </li>
                            <li>
                                <span>Brand</span>
                                <span class="spec">{{$cars->first()->brand}}</span>
                            </li>
                            <li>
                                <span>Model</span>
                                <span class="spec">{{$cars->first()->model}}</span>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center bg-light p-3">
                            <div class="rent-price"><span>${{$cars->first()->hourly_rate}}/</span>hour</div>
                            @if (auth()->check())
                            <a href="/cars/{{$cars->first()->id}}" class="ml-auto btn btn-primary">Rent Now</a>
                            @else
                            <a href="/login" class="ml-auto btn btn-primary">Login to rent</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h3>Our Offer</h3>
                <p class="mb-4 text-justify">
                    For nearly 60 years, Locartion has believed in going the extra mile to make car buying,
                    selling and trading easy. Whether you start your purchase online or visit one of our dealerships,
                    our exceptional customer service – enhanced by a streamlined digital car buying experience – makes
                    your vehicle purchase fast, easy and transparent.
                </p>
                <p>
                    <a href="#" class="btn btn-primary custom-prev">Previous</a>
                    <span class="mx-2">/</span>
                    <a href="#" class="btn btn-primary custom-next">Next</a>
                </p>
            </div>
            <div class="col-lg-9">
                <div class="nonloop-block-13 owl-carousel ">
                    @foreach ($cars as $car)
                    <div class="item-1">
                        <a href="#"><img src="{{ $car->carImages->get(0)?->image_link ?? "images/img_1.jpg" }}" alt=" {{ $car->model }} Image" class="img-fluid"></a>
                        <div class="item-1-contents">
                            <div class="text-center">
                                <h3><a href="/cars/{{$car->id}}">{{ $car->brand.' '.$car->model }}</a></h3>
                                <div class="rent-price"><span>${{$car->hourly_rate}}/</span>hour</div>
                            </div>
                            <ul class="specs">
                                <li>
                                    <span>Color</span>
                                    <span class="spec">
                                        <div style="background-color: {{strtolower($car->color)}}; width:15px;min-width:15px;height:15px; border-radius:50%;"></div>

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
                                <a href="/cars/{{$cars->get(0)->id}}" class="btn btn-block btn-primary">Rent Now</a>
                                @else
                                <a href="/login" class="btn btn-block btn-primary">Login before rent </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

<div class="site-section section-3" style="background-image: url('images/hero_2.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="text-white">Our services</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="service-1">
                    <span class="service-1-icon">
                        <span class="flaticon-car-1"></span>
                    </span>
                    <div class="service-1-contents">
                        <h3>Repair</h3>
                        <p>Our repairmen take care of the repair and maintenance of your car, no matter the make or model.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-1">
                    <span class="service-1-icon">
                        <span class="flaticon-traffic"></span>
                    </span>
                    <div class="service-1-contents">
                        <h3>Car Accessories</h3>
                        <p>More than 2000 products are at your disposal for the equipment and maintenance of your car. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-1">
                    <span class="service-1-icon">
                        <span class="flaticon-valet"></span>
                    </span>
                    <div class="service-1-contents">
                        <h3>Own a Car</h3>
                        <p>From SUVs to pickup trucks, wherever you go, we’ve got your ride.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container site-section mb-5">
    <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
            <h2>How it works</h2>
            <p>Check the car you want, specify the date, pay, and it's done !</p>
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


<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-7 text-center mb-5">
                <h2>Customer Testimony</h2>
                <p>Some opinions of our customers and partners</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="testimonial-2">
                    <blockquote class="mb-4">
                        <p>"Quality vehicles, immediate delivery and very responsive customer service"</p>
                    </blockquote>
                    <div class="d-flex v-card align-items-center">
                        <img src="images/jagspic.jpg" alt="Image" class="img-fluid mr-3">
                        <span>Jagadeesh Chilukuri</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="testimonial-2">
                    <blockquote class="mb-4">
                        <p>"I wanted to try this service to go to a conference and since then, I am addicted "</p>
                    </blockquote>
                    <div class="d-flex v-card align-items-center">
                        <img src="images/shravanipic.jpg" alt="Image" class="img-fluid mr-3">
                        <span>Shravani Ramula</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="testimonial-2">
                    <blockquote class="mb-4">
                        <p>"Vehicles from all manufacturers at unbelievable prices"</p>
                    </blockquote>
                    <div class="d-flex v-card align-items-center">
                        <img src="images/mritunjaypic.jpg" alt="Image" class="img-fluid mr-3">
                        <span>Mritunjay Jha</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-white">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-7 text-center mb-5">
                <h2>Our Blog</h2>
                <p>Bringing the most popular cars of this year to you. Drive your dream car and go easy on your pocket as well.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="post-entry-1 h-100">
                    <a href="#">
                        <img src="images/post_1.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="post-entry-1-contents">
                        <h2><a href="#">Enjoy your drive. We take care of your car</a></h2>
                        <span class="meta d-inline-block mb-3">Mar 17, 2022 <span class="mx-2">by</span> Admin</span>
                        <p>Want to go on a trip with your dream car? Say no more.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="post-entry-1 h-100">
                    <a href="#">
                        <img src="images/img_2.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="post-entry-1-contents">
                        <h2><a href="#">Quality and Punctuality</a></h2>
                        <span class="meta d-inline-block mb-3">July 17, 2021 <span class="mx-2">by</span> Admin</span>
                        <p>We promise to deliver you the car in best condition. Whatever the time you pick, the car will be arriving in your doorstep.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="post-entry-1 h-100">
                    <a href="#">
                        <img src="images/img_3.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="post-entry-1-contents">
                        <h2><a href="#">The best car rental in the entire planet</a></h2>
                        <span class="meta d-inline-block mb-3">July 17, 2019 <span class="mx-2">by</span> Admin</span>
                        <p>Our service is known to be the best because of our quality service and wide range of services.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
