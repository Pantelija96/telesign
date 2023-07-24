@extends('layout2')

@section('title') Project - ROI @endsection

@section('project') active @endsection

@section('pageName')
    <i class="ph-house me-2"></i> New project - ROI
@endsection

@section('additionalThemeJS')
    <script src="{{asset('/')}}assets/js/vendor/ui/moment/moment.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/pickers/daterangepicker.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/pickers/datepicker.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/visualization/echarts/echarts.min.js"></script>
@endsection

@section('additionalPageJS')
    <script src="{{asset('/')}}assets/js/roi2.js"></script>
@endsection

@section('pageTitle')
    New project - ROI
@endsection

@section('breadcrumb')
    <a href="{{url('/home2')}}" class="breadcrumb-item">Projects</a>
    <span class="breadcrumb-item"><a href="{{url('/project').'/'.$id}}" class="breadcrumb-item">Project numbers</a></span>
    <span class="breadcrumb-item active">Project roi</span>
@endsection

@section('content')

    <div class="row">

            <form action="{{route('saveProject')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="projectId" id="projectId" value="{{$id}}">
                <fieldset>
                    <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Solution details</legend>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label" for="solutionName">Solution:</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Solution name" id="solutionName" name="solutionName">
                        </div>
                        <label class="col-lg-3 col-form-label" for="jobDate">Job date:</label>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-calendar"></i>
                                </span>
                                <input type="text" class="form-control pick-date-basic" name="jobDate" id="jobDate" placeholder="Pick a job date">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label" for="customerName">Customer:</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Customer name" id="customerName" name="customerName">
                        </div>
                        <label class="col-lg-3 col-form-label" for="periodMultiplier">Period multiplier:</label>
                        <div class="col-lg-3">

                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control" placeholder="0" id="periodMultiplier" name="periodMultiplier">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-x-circle"></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label" for="periodFrom">Period:</label>
                        <div class="col-lg-3">

                            <div class="input-group datepicker-range-one-side">
                                <input type="text" class="form-control" placeholder="From" name="preiodFrom" id="periodFrom">
                                <input type="text" class="form-control" placeholder="To" name="periodTo" id="periodTo">
                            </div>

                        </div>
                        <label class="col-lg-3 col-form-label" style="border-bottom: 2px solid white;" for="roi"><strong>ROI:</strong></label>
                        <div class="col-lg-3">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" style="outline: white; border: 2px solid white;" placeholder="0" id="roi" name="roi">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <fieldset>
                    <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Benefits - Fraud losses reduction</legend>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="transactionAvoided">Amount of fraudulent transaction avoided:</label>
                        <div class="col-lg-6">
                            <input type="number" placeholder="0" step="1" id="transactionAvoided" name="transactionAvoided" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="averageValOfTrans">Average value of fraudulent transaction:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" id="averageValOfTrans" name="averageValOfTrans">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="fraudAvoidedBy">Fraud avoided by XXXX:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" id="fraudAvoidedBy" name="fraudAvoidedBy">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <fieldset>
                    <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Additional cost</legend>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="monthlyCost">Monthly cost of Telesign solution:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" id="monthlyCost" name="monthlyCost">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="otherCosts">Other costs:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" step="0.01" placeholder="0" id="otherCosts" name="otherCosts">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="totalCost">Total cost:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" id="totalCost" name="totalCost">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <fieldset>
                    <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Additional savings</legend>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="costPerPhone">Cost per phone number lookup:</label>
                        <div class="col-lg-3">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.001" id="costPerPhone" name="costPerPhone">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.1" id="totalPerPhone" name="totalPerPhone">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="averageSMS">Average SMS tansaction cost:</label>
                        <div class="col-lg-3">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.010" id="averageSMS" name="averageSMS">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.10" id="totalSMS" name="totalSMS">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="otherSavings">Other savings:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.01" id="otherSavings" name="otherSavings">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="totalSavings">Total savings:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.1" id="totalSavings" name="totalSavings">
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <div class="row d-flex flex-row-reverse">
                    <div class="col-lg-4" style="text-align: right;">
                        <button type="submit" class="btn btn-primary">
                            Save project
                            <i class="ph-pencil-line ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>

    </div>

    <div class="row mt-4">

        <div class="card">
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="line_zoom"></div>
                </div>
            </div>
        </div>

    </div>


@endsection
