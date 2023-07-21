@extends('layout')

@section('title') Main @endsection

@section('homePage') active @endsection

@section('pageName') <i class="ph-house me-2"></i> Home page @endsection

@section('additionalThemeJS')
    <script src="{{asset('/')}}assets/js/vendor/tables/datatables/datatables.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/tables/datatables/extensions/responsive.min.js"></script>

    <script src="{{asset('/')}}assets/js/vendor/visualization/echarts/echarts.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/maps/echarts/world.js"></script>
@endsection

@section('additionalPageJS')
    <script src="{{asset('/')}}assets/js/home.js"></script>
    <script>
        @if(isset($csvNumbers))
            var csvNumbers = <?php echo(json_encode($csvNumbers)) ?>;
            console.log(csvNumbers);
        @endif
    </script>
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
                        <form action="{{route('uploadNumbersCsv')}}" method="POST" class="modal-body row row-cols-lg-auto g-3 align-items-center justify-content-center" enctype='multipart/form-data'>
                            {{csrf_field()}}
                            <div class="col-12">
                                <input type="file" class="form-control wmin-200" data-bs-popup="popover" name="csvFile" id="csvFile" data-bs-trigger="hover" title="Upload CSV, EXCEL file">
                            </div>

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
                        <h6 class="mb-0">Add/Edit form</h6>
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
                                    <label class="col-lg-2 col-form-label" for="phoneNum"><sup>*</sup>Phone #:</label>
                                    <div class="col-lg-2">
                                        <input type="text" id="phoneNum" class="form-control" placeholder="+1234567890">
                                    </div>

                                    <label class="col-lg-1 col-form-label" for="email">Email:</label>
                                    <div class="col-lg-2">
                                        <input type="text" id="email" class="form-control" placeholder="Email">
                                    </div>

                                    <label class="col-lg-2 col-form-label" for="ipAddress">IP address:</label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" id="ipAddress" placeholder="IP address">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" id="addToTable" class="btn btn-primary">
                                        Add
                                        <i class="ph-plus-circle ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header border-bottom-0 pb-0 mb-3 d-flex align-items-center">
                        <h6 class="mb-0">Data table</h6>
                        <div class="d-inline-flex ms-auto">
                            <a class="text-body" data-card-action="collapse">
                                <i class="ph-caret-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body">
{{--                            table table-bordered table-hover datatable-highlight--}}
                            <table class="table datatable-responsive table-bordered table-hover datatable-highlight">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Phone number</th>
                                    <th>Email</th>
                                    <th>IP Address</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(isset($csvNumbers))
                                        @foreach($csvNumbers as $number)
                                            @if($number[0] !== "")
                                            <tr>
                                                <td>{{ ($loop->index+1) }}</td>
                                                <td>{{$number[0]}}</td>
                                                <td>{{$number[1]}}</td>
                                                <td>{{$number[2]}}</td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <div class="dropdown">
                                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                                <i class="ph-list"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item text-primary">
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
                                            </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>1</td>
                                            <td>+1234567890</td>
                                            <td>test@test1.com</td>
                                            <td>1.1.1.1</td>
                                            <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <div class="dropdown">
                                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                                <i class="ph-list"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item text-primary">
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
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>+1234567890</td>
                                            <td>test@test2.com</td>
                                            <td>2.2.2.2</td>
                                            <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <div class="dropdown">
                                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                                <i class="ph-list"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item text-primary">
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
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>+1234567890</td>
                                            <td>test@test3.com</td>
                                            <td>3.3.3.3</td>
                                            <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <div class="dropdown">
                                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                                <i class="ph-list"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item text-primary">
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
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <script>
                    function test(){
                        alert('test');
                    }
                </script>

            </div>
            <div class="card-footer d-sm-flex justify-content-end align-items-sm-center py-sm-2">
                <button type="button" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">
                    <i class="ph-gear-six me-2"></i>
                    SCORE
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="card border shadow-none">
                    <div class="card-header border-bottom-0">
                        <h6 class="mb-0">
                            <a data-bs-toggle="collapse" class="text-body" href="#collapsible-card1">Show calculations for all numbers</a>
                        </h6>
                    </div>

                    <div id="collapsible-card1" class="collapse border-top show">

                        <div class="card-body">

                            <div class="row">
                                <div class="card">
                                    <div class="card-header d-flex flex-wrap">
                                        <h6 class="mb-0">Recommendation by country and phone type</h6>
                                        <div class="d-inline-flex ms-auto">
                                            <a class="text-body" data-card-action="collapse">
                                                <i class="ph-caret-down"></i>
                                            </a>
                                            <a class="text-body mx-2" data-card-action="reload">
                                                <i class="ph-arrows-clockwise"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="collapse show">
                                        <div class="card-body row">
                                            <div class="map-container map-echarts col-lg-8" id="worldMap"></div>

                                            <div class="col-lg-4 overflow-auto" style="max-height: 500px;">

                                                <div class="card border shadow-none">
                                                    <div class="card-header border-bottom-0">
                                                        <h6 class="mb-0">
                                                            <a data-bs-toggle="collapse" class="text-body" id="countryRussiaLink" href="#countryRussia">Russia</a>
                                                        </h6>
                                                    </div>

                                                    <div id="countryRussia" class="collapse border-top show">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="chart-container">
                                                                    <div class="chart has-fixed-height" id="country1Map"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card">
                                                            <div class="card-header border-bottom-0 pb-0 mb-3 d-flex align-items-center">
                                                                <h6 class="mb-0">Numbers in Russia</h6>
                                                                <div class="d-inline-flex ms-auto">
                                                                    <a class="text-body" data-card-action="collapse">
                                                                        <i class="ph-caret-down"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    {{--                            table table-bordered table-hover datatable-highlight--}}
                                                                    <table class="table datatable-responsive table-bordered table-hover datatable-highlight">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Phone number</th>
                                                                            <th>Email</th>
                                                                            <th>Score</th>
                                                                            <th>IP Address</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>+1234567890</td>
                                                                            <td>test@test1.com</td>
                                                                            <td>1</td>
                                                                            <td>1.1.1.1</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2</td>
                                                                            <td>+1234567890</td>
                                                                            <td>test@test2.com</td>
                                                                            <td>2</td>
                                                                            <td>2.2.2.2</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>3</td>
                                                                            <td>+1234567890</td>
                                                                            <td>test@test3.com</td>
                                                                            <td>3</td>
                                                                            <td>3.3.3.3</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="card border shadow-none">
                                                    <div class="card-header border-bottom-0">
                                                        <h6 class="mb-0">
                                                            <a data-bs-toggle="collapse" class="text-body" href="#country2">USA</a>
                                                        </h6>
                                                    </div>

                                                    <div id="country2" class="collapse border-top show">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="chart-container">
                                                                    <div class="chart has-fixed-height" id="country2Map"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card">
                                                            <div class="card-header border-bottom-0 pb-0 mb-3 d-flex align-items-center">
                                                                <h6 class="mb-0">Numbers in USA</h6>
                                                                <div class="d-inline-flex ms-auto">
                                                                    <a class="text-body" data-card-action="collapse">
                                                                        <i class="ph-caret-down"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    {{--                            table table-bordered table-hover datatable-highlight--}}
                                                                    <table class="table datatable-responsive table-bordered table-hover datatable-highlight">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Phone number</th>
                                                                            <th>Email</th>
                                                                            <td>Score</td>
                                                                            <th>IP Address</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>4</td>
                                                                            <td>+1234567890</td>
                                                                            <td>test@test4.com</td>
                                                                            <td>5</td>
                                                                            <td>4.4.4.4</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>5</td>
                                                                            <td>+1234567890</td>
                                                                            <td>test@test5.com</td>
                                                                            <td>2</td>
                                                                            <td>5.5.5.5</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>6</td>
                                                                            <td>+1234567890</td>
                                                                            <td>test@test6.com</td>
                                                                            <td>7</td>
                                                                            <td>6.6.6.6</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="card border shadow-none">
                                                    <div class="card-header border-bottom-0">
                                                        <h6 class="mb-0">
                                                            <a data-bs-toggle="collapse" class="text-body" href="#country3">China</a>
                                                        </h6>
                                                    </div>

                                                    <div id="country3" class="collapse border-top show">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="chart-container">
                                                                    <div class="chart has-fixed-height" id="country3Map"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card">
                                                            <div class="card-header border-bottom-0 pb-0 mb-3 d-flex align-items-center">
                                                                <h6 class="mb-0">Numbers in China</h6>
                                                                <div class="d-inline-flex ms-auto">
                                                                    <a class="text-body" data-card-action="collapse">
                                                                        <i class="ph-caret-down"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <table class="table datatable-responsive table-bordered table-hover datatable-highlight">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Phone number</th>
                                                                            <th>Email</th>
                                                                            <td>Score</td>
                                                                            <th>IP Address</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>7</td>
                                                                            <td>+1234567890</td>
                                                                            <td>test@test7.com</td>
                                                                            <td>11</td>
                                                                            <td>7.7.7.7</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header d-flex flex-wrap">
                                            <h6 class="mb-0">Recommendation breakdown</h6>
                                            <div class="d-inline-flex ms-auto">
                                                <a class="text-body" data-card-action="collapse">
                                                    <i class="ph-caret-down"></i>
                                                </a>
                                                <a class="text-body mx-2" data-card-action="reload">
                                                    <i class="ph-arrows-clockwise"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="collapse show">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="chart-container">
                                                        <div class="chart has-fixed-height" id="pie_basic"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header d-flex flex-wrap">
                                            <h6 class="mb-0">Risk level breakdown</h6>
                                            <div class="d-inline-flex ms-auto">
                                                <a class="text-body" data-card-action="collapse">
                                                    <i class="ph-caret-down"></i>
                                                </a>
                                                <a class="text-body mx-2" data-card-action="reload">
                                                    <i class="ph-arrows-clockwise"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="collapse show">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="chart-container">
                                                        <div class="chart has-fixed-height" id="pie_donut"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card border shadow-none">
                    <div class="card-header border-bottom-0">
                        <h6 class="mb-0">
                            <a class="text-body" data-bs-toggle="collapse" href="#collapsible-card2">Show calculations for one number: <b>+1234567890</b> </a>
                        </h6>
                    </div>

                    <div id="collapsible-card2" class="collapse border-top show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 mb-5">
                                    <div class="card">
                                        <div class="card-header bg-very-high text-white border-bottom-0 ">
                                            <h6 class="mb-0 text-black">Risk level:</h6>
                                        </div>

                                        <div class="card-body text-center">
                                            <h3 class="mb-0">Very high</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-5">
                                    <div class="card">
                                        <div class="card-header bg-very-high text-white border-bottom-0 ">
                                            <h6 class="mb-0 text-black">Recommendation:</h6>
                                        </div>

                                        <div class="card-body text-center">
                                            <h3 class="mb-0">Block</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-5">
                                    <div class="card">
                                        <div class="card-header text-white bg-light border-bottom-0 ">
                                            <h6 class="mb-0">Score:</h6>
                                        </div>

                                        <div class="card-body text-center">
                                            <h3 class="mb-0">971</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-5">
                                    <div class="card">
                                        <div class="card-header text-white bg-light border-bottom-0 ">
                                            <h6 class="mb-0">Phone type:</h6>
                                        </div>

                                        <div class="card-body text-center">
                                            <h3 class="mb-0">VOIP</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-5">
                                    <div class="card">
                                        <div class="card-header text-white bg-light border-bottom-0 ">
                                            <h6 class="mb-0">Country:</h6>
                                        </div>

                                        <div class="card-body text-center">
                                            <h3 class="mb-0">Russia</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-5">
                                    <div class="card">
                                        <div class="card-header text-white bg-light border-bottom-0 ">
                                            <h6 class="mb-0">Carrier name:</h6>
                                        </div>

                                        <div class="card-body text-center">
                                            <h3 class="mb-0"> T2 Mobile</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="card">
                                    <div class="card-header border-bottom-0 pb-0 mb-3 d-flex align-items-center">
                                        <h6 class="mb-0">Code mapping</h6>
                                        <div class="d-inline-flex ms-auto">
                                            <a class="text-body" data-card-action="collapse">
                                                <i class="ph-caret-down"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse show">
                                        <div class="card-body">
                                            <table class="table datatable-responsive table-bordered table-hover datatable-highlight">
                                                <thead>
                                                <tr>
                                                    <th>Traffic type</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Risk</th>
                                                    <th>Trust</th>
                                                    <th class="text-center">Read more</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><b>A2P</b> / Activity</td>
                                                        <td>20006</td>
                                                        <td>Sparse long-term activity</td>
                                                        <td class="text-center"><i class="ph-x-circle text-danger ph-2x"></i></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            <a href="#"><i class="ph-book-open ph-2x text-primary"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>A2P</b> / Range</td>
                                                        <td>20101</td>
                                                        <td>No range activity</td>
                                                        <td class="text-center"><i class="ph-x-circle text-danger ph-2x"></i></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            <a href="#"><i class="ph-book-open ph-2x text-primary"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>A2P</b> / Recency</td>
                                                        <td>22007</td>
                                                        <td>Seen in the last 7 days</td>
                                                        <td class="text-center"><i class="ph-x-circle text-danger ph-2x"></i></td>
                                                        <td class="text-center"><i class="ph-check-circle text-success ph-2x"></i></td>
                                                        <td class="text-center">
                                                            <a href="#"><i class="ph-book-open ph-2x text-primary"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{url('/roi')}}" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"><i class="ph-database mx-2"></i> SHOW ROI</a>


            </div>
        </div>
    </div>

@endsection
