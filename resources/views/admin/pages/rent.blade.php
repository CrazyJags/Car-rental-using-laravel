@extends('admin.layout')
@section('title', 'Rents')
@section('page')
<div class="rents  m-3 card">
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
    <div class="card-body">
        <div class="card-title d-flex align-item-center justify-content-between">
            <div class="left">
                <h5>View rents</h5>
            </div>
            <div class="right d-flex  justify-content-between dropdown" style="align-items: center;">
                <button role="button" class="btn btn-secondary ml-2" type="submit" data-toggle="dropdown"><i class="fas fa-filter" aria-hidden="true"></i></button>
                <form class="dropdown-menu p-3" action="#" method="get" aria-labelledby="dropdownMenuButton">
                    <div class="form-group">
                        <label for="perpage">Per Page</label>
                        <input type="number" class="form-control" name="perPage" id="perpage" min="0">
                    </div>
                    <div class="form-group">
                        <label for="page">Page</label>
                        <input type="number" class="form-control" name="page" id="page" min="1">
                    </div>
                    <div class="form-group">
                        <label for="start_date_before">Start date Before</label>
                        <input type="datetime_local" class="form-control" name="start_date_before" id="start_date_before">
                    </div>
                    <div class="form-group">
                        <label for="start_date_after">Start date After</label>
                        <input type="datetime_local" class="form-control" name="start_date_after" id="start_date_after">
                    </div>
                    <div class="form-group">
                        <label for="start_date_before">End date Before</label>
                        <input type="datetime_local" class="form-control" name="end_date_before" id="end_date_before">
                    </div>
                    <div class="form-group">
                        <label for="end_date_after">End date After</label>
                        <input type="datetime_local" class="form-control" name="end_date_after" id="end_date_after">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                    <a href="/admin/rents" class="btn btn-secondary btn-block">Reset Filters</a>
                </form>

            </div>
        </div>
        <div class="card-content">
            <table class="table table-striped">
                <caption>The rents made</caption>
                <thead>
                    <tr>
                        <th scope="col">User </th>
                        <th scope="col">Car</th>
                        <th scope="col">Rent Date</th>
                        <th scope="col">Duration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rents as $rent )
                    <tr>
                        <td>
                            {{$rent->user->name}} <br>
                            <span class="text-muted">{{$rent->user->email}}</span>
                        </td>
                        <td>
                            {{'Brand: '.$rent->car->brand }} <br>
                            {{'Model: '.$rent->car->model}} <br>
                            {{'Color: '.$rent->car->color}}
                        </td>
                        <td>
                            {{'Start Date: '.$rent->start_date}} <br>
                            {{'Return Date: '.$rent->end_date}}
                        </td>
                        <td>
                            {{
                                date_diff( new DateTime($rent->end_date) , new DateTime($rent->start_date))->format('%m Months, %d days')
                            }}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="paginator">
                <nav aria-label="Page navigation example" class="d-flex align-item-center justify-content-between">
                    <div class="span">
                        Show {{count($rents->items())}} on Page {{$rents->currentPage()}} of {{$rents->lastPage()}}
                    </div>
                    <ul class="pagination justify-content-end">
                        @if($rents->currentPage() !== 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ Request::fullUrlWithQuery(['page' => $rents->currentPage() - 1]) }}" tabindex="-1">Previous</a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        @endif
                        @foreach(range(1, $rents->lastPage()) as $page)
                        <li class="page-item">
                            <a class="page-link" href="{{ Request::fullUrlWithQuery(['page' => $page]) }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        @if($rents->currentPage() !== $rents->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ Request::fullUrlWithQuery(['page' => $rents->currentPage() + 1]) }}">Next</a>
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
@endsection
