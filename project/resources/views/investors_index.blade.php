@extends('layouts.master')
@section("title", "Investors' list")
@section('content')

    <main id="main-container " class=" mt-4 mb-5">
        @include('layouts.errors') <div class="d-grid mb-3">
            <button type="button" class="btn btn-warning" onclick="graphView({{\Illuminate\Support\Facades\DB::table('projects_investors')->where('idProject','=',$project->idProject)->sum('investmentFund')}},{{$project->requestedFund}} )">Graphical form</button>
        </div>

        <div class="container-fluid mt-2 mb-5 pb-5 d-flex justify-content-center">
            <table id="table_id" class="display">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Investors</th>
                    <th>Investment Fund</th>
                    <th>Investment Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects_investors as $key=>$pi)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td> {{\Illuminate\Support\Facades\DB::table('users')->where("idUser","=",$pi->idUser)->value("firstname")." ". \Illuminate\Support\Facades\DB::table('users')->where("idUser","=",$pi->idUser)->value("lastname")}}</td>
                        <td>{{ $pi->investmentFund}} $</td>
                        <td>{{ $pi->investmentDate}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


        <div class="modal fade" id="own_graph" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        const graphView=(invested ,requested)=>{
            $('#own_graph').modal('show');
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
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
@endsection
