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
                        <input type="file" class="form-control wmin-200" data-bs-popup="popover" data-bs-trigger="hover" title="Upload CSV, EXCEL file">
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
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ph-file-pdf me-2"></i>
                                                        Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ph-file-csv me-2"></i>
                                                        Remove
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ph-file-doc me-2"></i>
                                                        Show stats for this number
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                    EXECUTE
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
                                            <p class="mb-3">

                                            </p>
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
                            <a class="text-body" data-bs-toggle="collapse" href="#collapsible-card2">Show calculations for one number:</a>
                        </h6>
                    </div>

                    <div id="collapsible-card2" class="collapse border-top show">
                        <div class="card-body">
                            Тon cupidatat skateboard dolor brunch. Тesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda.
                        </div>
                    </div>
                </div>

                <div class="card border shadow-none">
                    <div class="card-header border-bottom-0">
                        <h6 class="mb-0">
                            <a class="text-body" data-bs-toggle="collapse" href="#collapsible-card3">ROI</a>
                        </h6>
                    </div>

                    <div id="collapsible-card3" class="collapse border-top show">

                        <div class="card">

                            <div class="card-body border-top">
                                <form action="#">
                                    <fieldset>
                                        <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Solution details</legend>

                                        <div class="row mb-3">
                                            <label class="col-lg-3 col-form-label">Solution:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="XXXXX">
                                            </div>
                                            <label class="col-lg-3 col-form-label">Job date:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="06/01/2023">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-3 col-form-label">Cistomer:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="Customer1">
                                            </div>
                                            <label class="col-lg-3 col-form-label">Period multiplier:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="0">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-3 col-form-label">Period:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="06/01/2023-06/01/2025">
                                            </div>
                                            <label class="col-lg-3 col-form-label">ROI:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="2154$">
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset>
                                        <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Benefits - Fraud losses reduction</legend>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Amount of fraudulent transaction avoided:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="474">
                                            </div>

                                            <label class="col-lg-6 col-form-label">Average value of fraudulent transaction:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="15.00$">
                                            </div>

                                            <label class="col-lg-6 col-form-label">Fraud avoided by XXXX:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="7110$">
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset>
                                        <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Additional cost</legend>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Monthly cost of Telesign solution:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="5000$">
                                            </div>

                                            <label class="col-lg-6 col-form-label">Other costs:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="00.00$">
                                            </div>

                                            <label class="col-lg-6 col-form-label">Total cost:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="5000$">
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset>
                                        <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Additional savings</legend>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Cost per phone number lookup:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="0.005$">
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="15.60$">
                                            </div>

                                            <label class="col-lg-6 col-form-label">Average SMS tansaction cost:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="0.060$">
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="28.40$">
                                            </div>

                                            <label class="col-lg-6 col-form-label">Other savings:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="00.00$">
                                            </div>

                                            <label class="col-lg-6 col-form-label">Total savings:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="44.00$">
                                            </div>
                                        </div>

                                    </fieldset>

{{--                                    <div class="text-end">--}}
{{--                                        <button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>--}}
{{--                                    </div>--}}
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="chart-container">
                                    <div class="chart has-fixed-height" id="line_zoom"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
