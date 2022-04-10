@extends('user.layout')
@section('title', 'My Rents')

@section('user-page')
<div class="rents card card-body m-4">
    @if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        <p>{{ session('message') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
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

    <h3>My Rents</h3>
    <table class="table">
        <caption>Rents of the current user</caption>
        <thead>
            <tr>
                <th scope="col">Car</th>
                <th scope="col">Model</th>
                <th scope="col">Brand</th>
                <th scope="col">Journey date</th>
                <th scope="col">Return Date</th>
                <th scope="col" class="text-right" style="width: fit-content;">Actions</th>
            </tr>
        </thead>
        @foreach ($rents as $rent )
        <tr>
            <td>
                @if ($rent->car->carImages->get(0))
                <img src="{{$rent->car->carImages->get(0)->image_link}}" alt="Car image" height="200">
                @else
                No Image
                @endif

            </td>
            <td>
                {{$rent->car->model}}
            </td>
            <td>
                {{$rent->car->brand}}
            </td>
            <td>
                {{$rent->start_date}}
            </td>
            <td>
                {{$rent->end_date}}
            </td>
            <td class="d-flex align-items-center justify-content-end">
                <form action="/rents/{{$rent->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Cancel</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
