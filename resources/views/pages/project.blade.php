@extends('layout2')

@section('title') Project @endsection

@section('project') active @endsection

@section('pageName')
    <i class="ph-house me-2"></i> New project
@endsection

@section('additionalThemeJS')
    <script src="{{asset('/')}}assets/js/vendor/tables/datatables/datatables.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/notifications/sweet_alert.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/visualization/echarts/echarts.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/maps/echarts/world.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/visualization/d3/d3v5.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/visualization/c3/c3.min.js"></script>
@endsection

@section('additionalPageJS')
    <script>
        var projectId = "{{$project['_id']}}";
    </script>
    <script src="{{asset('/')}}assets/js/project.js"></script>
@endsection

@section('pageTitle')
    New project
@endsection

@section('breadcrumb')
    <a href="{{url('/home2')}}" class="breadcrumb-item active">Projects</a>
    <span class="breadcrumb-item active">New</span>
@endsection

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-sm-flex py-sm-0">
                <h6 class="d-flex py-sm-3 mb-0">
                    Data overview
                    <a href="#card_header" class="text-body d-sm-none ms-auto align-self-center" data-card-action="collapse" data-bs-toggle="collapse">
                        <i class="ph-caret-down"></i>
                    </a>
                </h6>

                @if($owner)
                <div class="collapse d-sm-block ms-sm-auto my-sm-auto" id="card_header">
                    <div class="form-control-feedback form-control-feedback-end mt-3 mt-sm-0">
                        <form action="{{route('uploadCsv')}}" method="POST" class="modal-body row row-cols-lg-auto g-3 align-items-center justify-content-center" enctype='multipart/form-data'>
                            {{csrf_field()}}
                            <div class="col-12">
                                <input type="file" class="form-control wmin-200" data-bs-popup="popover" name="csvFile" id="csvFile" data-bs-trigger="hover" title="Upload CSV, EXCEL file">
                            </div>

                            <input type="hidden" name="projectId" value="{{$project['_id']}}"/>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                    <i class="ph-upload-simple ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

            </div>
            <div class="card-body">

                @if($owner)
                    <div class="card">
                    <div class="card-header border-bottom-0 pb-0 mb-3 d-flex align-items-center">
                        <h6 class="mb-0" id="addEditFormName">Add form</h6>
                        <div class="d-inline-flex ms-auto">
                            <a class="text-body" data-card-action="collapse">
                                <i class="ph-caret-down"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse show">
                        <div class="card-body">
                            <form action="#">
                                <div class="row mb-3">
                                    <label class="col-lg-2 col-form-label" style="text-align: right;" for="newNumber"><sup>*</sup>Phone #:</label>
                                    <div class="col-lg-2">
                                        <input type="text" id="newNumber" class="form-control" placeholder="+1234567890">
                                    </div>

                                    <label class="col-lg-1 col-form-label" style="text-align: right;"  for="newEmail">Email:</label>
                                    <div class="col-lg-2">
                                        <input type="text" id="newEmail" class="form-control" placeholder="Email">
                                    </div>

                                    <label class="col-lg-2 col-form-label" style="text-align: right;"  for="newIp">IP address:</label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" id="newIp" placeholder="IP address">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" id="addToTable" class="btn btn-primary" onclick="addEdit()">
                                        <span id="addButtonText">Add</span>
                                        <i id="addButtonIcon" class="ph-plus-circle ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif

                <div class="card p-lg-3">
                    <table class="table datatable-html">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Number</th>
                            <th>Ip address</th>
                            <th>Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($numbers) && count($numbers) > 0)
                            @foreach($numbers as $row)
                                <tr id="row{{$row['_id']}}">
                                    <td id="iteration{{$row['_id']}}">{{$loop->iteration}} </td>
                                    <td id="number{{$row['_id']}}">{{$row['number']}}</td>
                                    <td id="ip{{$row['_id']}}">{{$row['ip']}}</td>
                                    <td id="email{{$row['_id']}}">{{$row['email']}}</td>
                                    <td class="text-center">
                                        <div class="d-inline-flex">
                                            <div class="dropdown">
                                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                    <i class="ph-list"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @if($owner)
                                                        <a href="#" class="dropdown-item text-primary" onclick="editThisNumber('{{$row['_id']}}', '{{$row['number']}}')">
                                                            <i class="ph-pencil-simple me-2"></i>
                                                            Edit
                                                        </a>
                                                        <a href="#" class="dropdown-item text-danger" onclick="deleteThisNumber('{{$row['_id']}}')">
                                                            <i class="ph-x me-2"></i>
                                                            Remove
                                                        </a>
                                                    @endif
                                                    <a href="#" class="dropdown-item text-success" onclick="showOneNumberScores('{{$row['_id']}}')">
                                                        <i class="ph-chart-bar me-2"></i>
                                                        Show stats for this number
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <input type="hidden" id="_id{{$row['_id']}}" value="{{$row['_id']}}"/>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>


            </div>
            @if($owner)
            <div class="card-footer d-sm-flex justify-content-end align-items-sm-center py-sm-2">
                <form method="POST" action="{{route('scoreNumbers')}}" id="scoreForm">
                    {{csrf_field()}}
                    <input type="hidden" name="projectId" value="{{$project['_id']}}">
                    <button type="button" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto" onclick="checkBeforeSubmit()">
                        <i class="ph-gear-six me-2"></i>
                        SCORE
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>

    @if($scored)
        <div class="py-2 mb-3">
            <h3 class="mb-0">Scoring result</h3>
        </div>

        <ul class="nav nav-tabs nav-tabs-underline nav-justified mb-lg-2">
            <li class="nav-item"><a href="#" class="nav-link active scoreNavigation" id="allScore" onclick="showAllNumberScores()">All numbers</a></li>
            <li class="nav-item"><a href="#" class="nav-link scoreNavigation" id="oneScore">One number</a></li>
        </ul>

        <div id="allNumberScore" class="scoreNavigationDisplay">
            <div class="row">
                <div id="countriesMap">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Scattering of numbers</h5>
                        </div>

                        <div class="card-body">
                            <div class="map-container map-echarts" id="worldNumberScatter"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-8">
                    <div class="card" style="min-height: 700px;">
                        <div class="card-header">
                            <h5 class="mb-0">Countries</h5>
                        </div>
                        <div class="card-body text-center" style="overflow-x: hidden; overflow-y: scroll; height: 355px;">

                            <div class="card-group-vertical" id="allCountries">
                                @foreach($project['projectScore']['countryAndPhoneType'] as $country)
                                    <div class="card border shadow-none">
                                        <div class="card-header">
                                            <h6 class="mb-0">
                                                <a data-bs-toggle="collapse" class="d-flex align-items-center text-body countriesLink" href="#country-{{str_replace(' ', '',$country['countryName'])}}">
                                                    {{$country['countryName']}}
                                                    <i class="ph-caret-down collapsible-indicator ms-auto"></i>
                                                </a>
                                            </h6>
                                        </div>

                                        <div id="country-{{str_replace(' ', '',$country['countryName'])}}" class="collapse show countries">
                                            <div class="card-body chart-container">
                                                <div class="chart has-fixed-height" id="{{$country['countryName']}}Chart"></div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Recommendation breakdown</h5>
                        </div>
                        <div class="card-body text-center chart-container">
                            <div class="d-inline-block" id="recommendationBreakdown"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Risk level breakdown</h5>
                        </div>
                        <div class="card-body text-center chart-container">
                            <div class="d-inline-block" id="riskLevelBreakdown"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="oneNumberScore" class="d-none scoreNavigationDisplay">
            <h1>Showing calculations for: <span id="oneNumberNumber"></span></h1>
            <div class="row">

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white border-bottom-0" id="riskLevelTitle">
                            <h6 class="mb-0 text-black">Risk level:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0 oneNumberCapitalize" id="oneNumberRiskLevel"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white border-bottom-0 " id="recommendationTitle">
                            <h6 class="mb-0 text-black">Recommendation:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0 oneNumberCapitalize" id="oneNumberRecommendation"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white bg-light border-bottom-0 ">
                            <h6 class="mb-0">Score:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0" id="oneNumberNumberScore"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white bg-light border-bottom-0 ">
                            <h6 class="mb-0">Phone type:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0 oneNumberCapitalize" id="oneNumberType"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white bg-light border-bottom-0 ">
                            <h6 class="mb-0">Country:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0" id="oneNumberCountry"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white bg-light border-bottom-0 ">
                            <h6 class="mb-0">Carrier name:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0" id="oneNumberCarrier"> </h3>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" id="codeMapping">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Code mapping</h5>
                    </div>

                    <table class="table codeMappingDataT">
                        <thead>
                        <tr>
                            <th>Traffic type</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Risk</th>
                            <th>Trust</th>
                            <th>Details</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="row d-flex flex-row-reverse">
            <div class="col-lg-4" style="text-align: right;">
                <a href="{{url('/roi').'/'.$id}}" class="btn btn-primary">
                    ROI
                    <i class="ph-currency-circle-dollar ms-2"></i>
                </a>
            </div>
        </div>

        <script>
            var projectScore =  JSON.parse(`<?php Print($project); ?>`);
            var numbersScore = JSON.parse(`<?php Print($numbers); ?>`);

            mapInit(projectScore.projectScore);
            pieChartInit(projectScore.projectScore);
            stackedBarInit(projectScore.projectScore);

            $("#countriesData").height($("#countriesMap").height());
        </script>
    @endif
@endsection
