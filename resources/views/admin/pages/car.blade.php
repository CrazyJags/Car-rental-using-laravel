@extends('admin.layout')
@section('title', 'Car')
@section('page')
<div class="cars m-3 card">
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
    @if(session()->has('message'))
    <div class="alert alert-success">
        <p>{{ session('message') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card-body">
        <div class="card-title d-flex align-item-center justify-content-between">
            <div class="left">
                <h5>Manage cars</h5>
            </div>
            <div class="right d-flex  justify-content-between" style="align-items: center;">
                <button role="button" data-toggle="modal" data-target="#create" class="btn btn-success ml-2" type="submit"><i class="fas fa-plus" aria-hidden="true"></i></button>
                <button role="button" class="btn btn-secondary ml-2" type="submit" data-toggle="dropdown"><i class="fas fa-filter" aria-hidden="true"></i></button>
                <form class="dropdown-menu p-3" action="{{ route('admin_cars') }}" method="get" aria-labelledby="dropdownMenuButton" role="search">
                    <div class="form-group">
                        <label for="perPage">Per Page</label>
                        <input type="number" class="form-control" name="perPage" id="perPage" min="0">
                    </div>
                    <div class="form-group">
                        <label for="page">Page</label>
                        <input type="number" class="form-control" name="page" id="page" min="1">
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" name="model" id="model">
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="email" class="form-control" name="brand" id="brand">
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" name="color" id="color">
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" class="form-control" name="year" id="year" min="1900" max="2023" value="2022">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                    <a href="{{ route('admin_cars') }}" class="btn btn-secondary btn-block">Reset Filters</a>
                </form>
            </div>
        </div>
        <div class="card-content">
            @error('error')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong>{{$errors->first('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror

            <table class="table table-striped">
                <caption>List of cars</caption>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th scope="col" style="width: 33%;">Brand</th>
                        <th scope="col">Model</th>
                        <th scope="col">Year</th>
                        <th scope="col">Color</th>
                        <th scope="col">Price per hour</th>
                        <th scope="col" style="width: fit-content;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car )
                    <tr>
                        <td>
                            @if ($car->carImages->get(0))
                            <img src="{{ $car->carImages->get(0)->image_link }}" style="width: 70px; height:50px" alt="">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->year }}</td>
                        <td>{{ $car->color }}</td>
                        <td>{{ $car->hourly_rate }}</td>
                        <td>
                            <div class="content d-flex align-items-center justify-content-center">
                                <a href="/cars/{{$car->id}}" class="mx-2">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                                <button class="btn " data-toggle="modal" data-target="#update{{$car->id}}" class="mx-2">
                                    <i class="fa fa-pencil text-success "></i>
                                </button>
                                <form action="{{ route('admin_cars').'/'.$car->id}}" method="post" style="width: fit-content; height:fit-content" class="d-flex align-items-center justify-content-center">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn"><i class="fa fa-trash text-danger"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="update{{$car->id}}" tabindex="-1" role="dialog" aria-labelledby="update{{$car->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content px-3">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Update Car {{$car->model.' '.$car->brand}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/admin/cars/{{$car->id}}" class="form m-3 " method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Brand</label>
                                        <input type="text" value="{{$car->brand}}" class="form-control @error('brand') is-invalid @enderror" name="brand" required id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <input type="text" value="{{$car->model}}" class="form-control @error('model') is-invalid @enderror" name="model" required id="model">
                                    </div>
                                    <div class="form-group">
                                        <label for="model">Description</label>
                                        <input type="text" value="{{$car->description}}" class="form-control @error('description') is-invalid @enderror" name="description" required id="model">
                                    </div>

                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="number" min="1900" value="{{$car->year}}" max="2050" placeholder="ex: 1990" class="form-control @error('year') is-invalid @enderror" name="year" required id="year">
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <input type="text" value="{{$car->color}}" class="form-control @error('color') is-invalid @enderror" name="color" placeholder="ex: Red" required id="color">
                                    </div>
                                    <div class="form-group">
                                        <label for="hourly_rate">Hourly rate</label>
                                        <input type="number" min="0" value="{{$car->hourly_rate}}" class="form-control @error('hourly_rate') is-invalid @enderror" name="hourly_rate" required id="hourly_rate">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>

            <div class="paginator">
                <nav aria-label="Page navigation example" class="d-flex align-item-center justify-content-between">
                    <div class="span">
                        Show {{ count($cars->items()) }} on Page {{$cars->currentPage()}} of {{$cars->lastPage()}}
                    </div>
                    <ul class="pagination justify-content-end">
                        @if($cars->currentPage() !== 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ Request::fullUrlWithQuery(['page' => $cars->currentPage() - 1]) }}" tabindex="-1">Previous</a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        @endif
                        @foreach(range(1, $cars->lastPage()) as $page)
                        <li class="page-item">
                            <a class="page-link" href="{{ Request::fullUrlWithQuery(['page' => $page]) }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        @if($cars->currentPage() !== $cars->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ Request::fullUrlWithQuery(['page' => $cars->currentPage() + 1]) }}">Next</a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Next</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create new Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin_cars') }}" class="form m-3" method="POST" enctype="multipart/form-data">
                @csrf
                <h4>Pictures</h4>
                <div class="form-group">
                    <label for="images">Pictures</label>
                    <input type="file" multiple accept="image/*" name="images[]" class="form-control" required id="images">
                </div>
                <div class="form-group">
                    <label for="name">Brand</label>
                    <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" required id="name">
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" required id="model">
                </div>
                <div class="form-group">
                    <label for="model">Description</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" required id="model">
                </div>

                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" min="1900" max="2050" placeholder="ex: 1990" class="form-control @error('year') is-invalid @enderror" name="year" required id="year">
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" placeholder="ex: Red" required id="color">
                </div>
                <div class="form-group">
                    <label for="hourly_rate">Hourly rate</label>
                    <input type="number" min="0" class="form-control @error('hourly_rate') is-invalid @enderror" name="hourly_rate" required id="hourly_rate">
                </div>
                @error('error')
                <p class="text-danger mt-1 text-center error">{{$errors->first('error')}}</p>
                @enderror
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Register Car</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
