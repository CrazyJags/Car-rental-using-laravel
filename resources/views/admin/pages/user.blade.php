@extends('admin.layout')
@section('title', 'User')
@section('page')
<div class="cars  m-3 card">
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
                <h5>Manage users</h5>
            </div>
            <div class="right d-flex  justify-content-between" style="align-items: center;">
                <button role="button" class="btn btn-secondary ml-2" type="submit" data-toggle="dropdown"><i class="fas fa-filter" aria-hidden="true"></i></button>
                <form class="dropdown-menu p-3" action="/admin/users" method="get" aria-labelledby="dropdownMenuButton">
                    <div class="form-group">
                        <label for="perpage">Per Page</label>
                        <input type="number" class="form-control" name="perPage" id="perpage" min="0">
                    </div>
                    <div class="form-group">
                        <label for="page">Page</label>
                        <input type="number" class="form-control" name="page" id="page" min="1">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="start_date_after">Email</label>
                        <input type="email" class="form-control" name="email" id="start_date_after">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" name="role" id="role">
                    </div>
                    <div class="form-group">
                        <label for="register_before">Register date Before</label>
                        <input type="datetime_local" class="form-control" name="register_before" id="register_before">
                    </div>
                    <div class="form-group">
                        <label for="register_after">Register date After</label>
                        <input type="datetime_local" class="form-control" name="register_after" id="register_after">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                    <a href="/admin/users" class="btn btn-secondary btn-block">Reset Filter</a>
                </form>
            </div>
        </div>
        <div class="card-content">
            <table class="table table-striped">
                <caption>Users list</caption>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at }}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="paginator">
                <nav aria-label="Page navigation example" class="d-flex align-item-center justify-content-between">
                    <div class="span">
                        Show {{count($users->items())}} on Page {{$users->currentPage()}} of {{$users->lastPage()}}
                    </div>
                    <ul class="pagination justify-content-end">
                        @if($users->currentPage() !== 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ Request::fullUrlWithQuery(['page' => $users->currentPage() - 1]) }}" tabindex="-1">Previous</a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        @endif
                        @foreach(range(1, $users->lastPage()) as $page)
                        <li class="page-item">
                            <a class="page-link" href="{{ Request::fullUrlWithQuery(['page' => $page]) }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        @if($users->currentPage() !== $users->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ Request::fullUrlWithQuery(['page' => $users->currentPage() + 1]) }}">Next</a>
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
