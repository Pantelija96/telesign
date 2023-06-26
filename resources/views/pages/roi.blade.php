@extends('layout')

@section('title') Main @endsection

@section('homePage') active @endsection

@section('pageName') <i class="ph-currency-circle-dollar me-2"></i> <a href="{{url('/home')}}" style="color: white">Home page</a> / ROI @endsection

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
            //console.log(csvNumbers);
        @endif
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="card">
            <div class="card-body">
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
                                            <label class="col-lg-3 col-form-label bg-success">ROI:</label>
                                            <div class="col-lg-3 bg-success">
                                                <input type="text" class="form-control bg-success" style="outline: white; border: 1px solid white;" value="$2154">
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
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Average value of fraudulent transaction:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="$15.00">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Fraud avoided by XXXX:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="$7110">
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset>
                                        <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Additional cost</legend>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Monthly cost of Telesign solution:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="$5000">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Other costs:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="$00.00">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Total cost:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="$5000">
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset>
                                        <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Additional savings</legend>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Cost per phone number lookup:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="$0.005">
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="$15.60">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Average SMS tansaction cost:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="$0.060">
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="$28.40">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Other savings:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="$00.00">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-6 col-form-label">Total savings:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="$44.00">
                                            </div>
                                        </div>

                                    </fieldset>

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

                        <div class="card-footer d-sm-flex justify-content-end align-items-sm-center py-sm-2">
                            <button type="button" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">
                                <i class="ph-database mx-2"></i>
                                SAVE PROJECT
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
