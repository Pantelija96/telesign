@extends('layout2')

@section('title') Project @endsection

@section('project') active @endsection

@section('pageName')
    <i class="ph-house me-2"></i> New project
@endsection

@section('additionalThemeJS')
    <script src="{{asset('/')}}assets/js/vendor/tables/datatables/datatables.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/notifications/sweet_alert.min.js"></script>
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

            </div>
            <div class="card-body">

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
                        @if(isset($project['numbers']) && count($project['numbers']) > 0)
                            @foreach($project['numbers'] as $row)
                                <tr id="row{{$row['number']}}">
                                    <td id="iteration{{$row['number']}}">{{$loop->iteration}} </td>
                                    <td id="number{{$row['number']}}">{{$row['number']}}</td>
                                    <td id="ip{{$row['number']}}">{{$row['ip']}}</td>
                                    <td id="email{{$row['number']}}">{{$row['email']}}</td>
                                    <td class="text-center">
                                        <div class="d-inline-flex">
                                            <div class="dropdown">
                                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                    <i class="ph-list"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item text-primary" onclick="editThisNumber('{{$row['number']}}', '{{$project['_id']}}')">
                                                        <i class="ph-pencil-simple me-2"></i>
                                                        Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item text-danger">
                                                        <i class="ph-x me-2"></i>
                                                        Remove
                                                    </a>
                                                    <a href="#" class="dropdown-item text-success">
                                                        <i class="ph-chart-bar me-2"></i>
                                                        Show stats for this number
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <input type="hidden" id="_id{{$row['number']}}" value="{{$row['_id']}}"/>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="card-footer d-sm-flex justify-content-end align-items-sm-center py-sm-2">
                <button type="button" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">
                    <i class="ph-gear-six me-2"></i>
                    SCORE
                </button>
            </div>
        </div>
    </div>
@endsection
