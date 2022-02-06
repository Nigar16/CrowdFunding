@extends('layouts.master')
@section("title", "Home")
@section('content')

    <main id="main-container " class=" mt-4 mb-5">
        @include('layouts.errors')
        <div class="container-fluid mt-2 pb-5">

            <div class="d-flex flex-wrap justify-content-center">
                @foreach($projects as $key=>$project)
                    @if($project->idUser!=session('user')->idUser)
                        <div class="card m-2 mb-3">
                    <div class="card-body">
                        <h4 class="card-title text-center"><b>{{ $project->projectName}}</b></h4>
                        <table class="table table-hover">
                            <tr>
                                <th>Owner</th>
                                <td>{{\Illuminate\Support\Facades\DB::table('users')->where("idUser","=",$project->idUser)->value("firstname")." ". \Illuminate\Support\Facades\DB::table('users')->where("idUser","=",$project->idUser)->value("lastname")}}</td>
                            </tr>
                            <tr>
                                <th>End date</th>
                                <td>{{ $project->projectEndDate	}}</td>
                            </tr>
                            <tr>
                                <th>Requested fund</th>
                                <td>{{ $project->requestedFund	}} $</td>
                            </tr>
                            <tr>
                                @if(\Illuminate\Support\Facades\DB::table('projects_investors')->where("idUser","=",session('user')->idUser)->where("idProject","=",$project->idProject)->doesntExist())
                                    <th>Status</th>
                                    <td><button type="button" class="btn btn-danger" onclick="ShowInvestView({{ $project->idProject }})">Invest</button></td>
                                @else
                                    <th>Status</th>
                                    <td><button type="button" class="btn btn-success" >InvesteD</button></td>
                                @endif
                            </tr>
                            <tr>
                                <th>Graphic form</th>
                                <td><button type="button" class="btn btn-warning" onclick="graphView({{\Illuminate\Support\Facades\DB::table('projects_investors')->where('idProject','=',$project->idProject)->sum('investmentFund')}},{{$project->requestedFund}} )">View</button></td>
                            </tr>
                        </table>
                        <p class="card-text"><i>{{ $project->projectDescription}}</i></p>

                    </div>
                </div>
                    @endif
                @endforeach
            </div>

        </div>


        <div class="modal fade" id="invest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Invest</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('Invest') }}" >
                            @csrf
                            <input type="hidden" name="id_project" id="id_project" />
                            <div class="form-group">
                                <label for="project" class="col-form-label">Project:</label>
                                <input type="text" class="form-control" name="project" id="project" disabled="disabled">
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="email" class="col-form-label">Email:</label>--}}
{{--                                <input type="email" class="form-control" name="email" id="email" disabled="disabled" value="{{session('user')->email}}">--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="money" class="col-form-label">The fund you want to invest:</label>
                                <input type="number" class="form-control" name="money" id="money">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">Invest</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="graph" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Graphical form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body" id="modal-graph-body">
                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
@section("js")
<script>
    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    const ShowInvestView = (id) =>{

        $.ajax({
            type: "POST",
            url: "/project/view",
            data: {
                _token: CSRF_TOKEN, id: id,
            },
            success: function (data) {
                if(data){
                    document.getElementById("id_project").value =id;
                    document.getElementById("project").value =data[0].projectName;

                    $('#invest').modal('show');
                }
            },
            error: function () {
                alert('Error... 5011');
            }
        })
    };



    const graphView=(invested ,requested)=>{
        $('#graph').modal('show');
        let xValues = ["Total amount raised (with dollars)", "Expected amount (with dollars)"];
        let expected=requested-invested;
        let yValues = [invested, expected];
        let barColors = [
            "#1e7145",
            "#b91d47"
        ];

        new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },

        });

    }

</script>

@endsection
