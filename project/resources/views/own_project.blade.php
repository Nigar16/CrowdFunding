@extends('layouts.master')
@section("title", "Own projects")
@section('content')

    <main id="main-container " class=" mt-4">
        @include('layouts.errors')
        <div class="container-fluid mt-2 ">

            <div class="d-flex flex-wrap justify-content-center ">
                @foreach($projects as $key=>$project)
                    @if($project->idUser == session('user')->idUser)
                        <div class="card m-2">
                            <div class="card-body">
                                <h4 class="card-title text-center"><b>{{ $project->projectName}}</b></h4>
                                <table class="table table-hover">
                                    <tr>
                                        <th>Owner</th>
                                        <td>You</td>
                                    </tr>
                                    <tr>
                                        <th>Start and end date</th>
                                        <td>{{ $project->projectStartDate	}} and {{ $project->projectEndDate	}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total amount raised</th>
                                        <td>{{ DB::table('projects_investors')->where('idProject','=',$project->idProject)->sum('investmentFund')}} $</td>
                                    </tr>
                                    <tr>
                                        <th>Requested fund</th>
                                        <td>{{ $project->requestedFund	}} $</td>
                                    </tr>
                                    <tr>
                                        <th>List of Investors</th>
                                        <td><a  href="{{ route('viewInvestors', ['id' =>$project->idProject ]) }}"> <button type="button" class="btn btn-warning">View</button></a></td>
                                    </tr>
                                </table>
                                <p class="card-text"> <i>{{ $project->projectDescription}}</i></p>

                            </div>
                        </div>
                        @break
                    @else
                        <div  class="d-flex flex-column justify-content-evenly  align-items-center mt-5 mb-5">
                            <h1 class=" mt-md-5 mb-5 text-center">Nothing to show.You don't have any project.</h1>
                            <a href="{{route("index")}}"> <button class="btn btn-warning">Back to projects</button></a>
                        </div>

                        @break
                    @endif
                @endforeach
            </div>

        </div>

    </main>
@endsection

