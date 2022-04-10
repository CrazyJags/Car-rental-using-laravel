@extends('admin.layout')
@section('title', 'home')
@section('another-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
@endsection
@section('page')
    <div class="home p-3 mx-3 mt-3" style=" height:auto; overflow-x:hidden">
        <div class="h3">Key numbers</div>
        <div class="row ">
            <div class="col-md-4 card card-body m-1 mx-auto ">
                <div class="h3">{{ \App\Models\User::count() }}</div>
                <div class="p">Users</div>
            </div>
            <div class="col-md-3 card card-body  m-1 mx-auto ">
                <div class="h3">{{ \App\Models\Car::count() }}</div>
                <div class="p">Cars</div>
            </div>
            <div class="col-md-4 card card-body  m-1 mx-auto">
                <div class="h3">{{ \App\Models\CarRent::count() }}</div>
                <div class="p">Rents</div>
            </div>
        </div>
        <div class="row m-0 mt-3 d-flex align-items-center justify-content-between">
            <div class="h3">Statistics per day</div>
            <form class="select" style="height: fit-content; width:fit-content">
                <div class="form-group form-inline">
                    <label for="since" class="mx-2">Since </label>
                    <select name="since" class="form-control mx-2" id="since">
                        <option value="1">1 Week</option>
                        <option value="2">2 Week</option>
                        <option value="4">1 Month</option>
                        <option value="12">3 Month</option>
                        <option value="24">6 Month</option>
                        <option value="52">1 Year</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
        <div class="row m-3 card card-body ">
            <canvas class="canvas" id="chartDashboard" aria-label="Stats plot" role="img"></canvas>
        </div>
        <script defer>
            const label = @json($labels);
            const userDataSet = @json($userDataSet);
            const rentDataSet = @json($rentDataSet);
            const carDataSet = @json($carDataSet);
            const ctx = document.getElementById("chartDashboard").getContext("2d");
            const chart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: label,
                    datasets: [
                        {
                            label: "Users stats",
                            data: userDataSet,
                            backgroundColor: "rgba(215,0,0,0.9)",
                        },
                        {
                            label: "Cars stats",
                            data: carDataSet,
                            backgroundColor: "rgba(0,255,0,0.7)",
                        },
                        {
                            label: "Rents stats",
                            data: rentDataSet,
                            backgroundColor: "rgba(0,0,255,0.6)",
                        },
                    ],
                },
            });
        </script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </div>
@endsection
