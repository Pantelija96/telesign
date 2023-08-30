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

    <div class="card">
        <div class="table-responsive p-1">
            <table class="table table-dark table-bordered table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Risk Band</th>
                        <th>Total volume</th>
                        <th>%</th>
                        <th>True positive rate</th>
                        <th>Fraud</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="bg-very-low">1</td>
                        <td>Very-low</td>
                        <td>
                            <p id="very-low">{{$project['projectScore']['riskLevelBreakdown']['veryLow']}}</p>
                            <input type="hidden" id="veryLowNumbers" name="veryLowNumbers" value="{{$project['projectScore']['riskLevelBreakdown']['veryLow']}}"/>
                        </td>
                        <td>
                            {{round(floatval(($project['projectScore']['riskLevelBreakdown']['veryLow']/$numberOfNumbers)*100),2)}}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="bg-low">2</td>
                        <td>Low</td>
                        <td>
                            <p id="low">{{$project['projectScore']['riskLevelBreakdown']['low']}}</p>
                            <input type="hidden" id="lowNumbers" name="lowNumbers" value="{{$project['projectScore']['riskLevelBreakdown']['low']}}"/>
                        </td>
                        <td>
                            {{round(floatval(($project['projectScore']['riskLevelBreakdown']['low']/$numberOfNumbers)*100),2)}}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="bg-medium-low">3</td>
                        <td>Medium-low</td>
                        <td>
                            <p id="medium-low">{{$project['projectScore']['riskLevelBreakdown']['mediumLow']}}</p>
                            <input type="hidden" id="mediumLowNumbers" name="mediumLowNumbers" value="{{$project['projectScore']['riskLevelBreakdown']['mediumLow']}}"/>
                        </td>
                        <td>
                            {{round(floatval(($project['projectScore']['riskLevelBreakdown']['mediumLow']/$numberOfNumbers)*100),2)}}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="bg-medium">4</td>
                        <td>Medium</td>
                        <td>
                            <p id="medium">{{$project['projectScore']['riskLevelBreakdown']['medium']}}</p>
                            <input type="hidden" id="mediumNumbers" name="mediumNumbers" value="{{$project['projectScore']['riskLevelBreakdown']['medium']}}"/>
                        </td>
                        <td>
                            {{round(floatval(($project['projectScore']['riskLevelBreakdown']['medium']/$numberOfNumbers)*100),2)}}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="bg-high">5</td>
                        <td>High</td>
                        <td>
                            <p id="high">{{$project['projectScore']['riskLevelBreakdown']['high']}}</p>
                            <input type="hidden" id="highNumbers" name="highNumbers" value="{{$project['projectScore']['riskLevelBreakdown']['high']}}"/>
                        </td>
                        <td>
                            {{round(floatval(($project['projectScore']['riskLevelBreakdown']['high']/$numberOfNumbers)*100),2)}}
                        </td>
                        <td>
                            <input type="number" class="form-control closer-to-sign" id="highPositiveRate" name="highPositiveRate" value="50" max="100" min="0" step="1" style="text-align:center;" onchange="calculateFraudNumbers()">
                        </td>
                        <td>
                            <input type="number" class="form-control closer-to-sign" id="highPositiveRateNumbers" name="highPositiveRateNumbers" readonly style="text-align:center;">
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-very-high">6</td>
                        <td>Very-high</td>
                        <td>
                            <p id="very-high">{{$project['projectScore']['riskLevelBreakdown']['veryHigh']}}</p>
                            <input type="hidden" id="veryHighNumbers" name="veryHighNumbers" value="{{$project['projectScore']['riskLevelBreakdown']['veryHigh']}}"/>
                        </td>
                        <td>
                            {{round(floatval(($project['projectScore']['riskLevelBreakdown']['veryHigh']/$numberOfNumbers)*100),2)}}
                        </td>
                        <td>
                            <input type="number" class="form-control closer-to-sign" id="veryHighPositiveRate" name="veryHighPositiveRate" value="90" max="100" min="0" step="1" style="text-align:center;" onchange="calculateFraudNumbers()">
                        </td>
                        <td>
                            <input type="number" class="form-control closer-to-sign" id="veryHighPositiveRateNumbers" name="veryHighPositiveRateNumbers" readonly style="text-align:center;">
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td>
                            <p id="totalNumbers">{{$numberOfNumbers}}</p>
                            <input type="hidden" id="totalNumbersHidden" name="totalNumbersHidden" value="{{$numberOfNumbers}}"/>
                        </td>
                        <td>100%</td>
                        <td></td>
                        <td>
                            <p id="totalFraudNumbers"></p>
                            <input type="hidden" id="totalFraudNumbersHidden" name="totalFraudNumbersHidden" value="0"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row">

            <form action="@if($owner){{route('saveProject')}}@endif" method="POST">
                @if($owner)
                {{csrf_field()}}
                <input type="hidden" name="projectId" id="projectId" value="{{$id}}">
                <input type="hidden" name="numberOfNumbers" id="numberOfNumbers" value="{{$numberOfNumbers}}">
                <input type="hidden" name="scamNumbers" id="scamNumbers" value="{{$scamNumbers}}">
                @endif
                <fieldset>
                    <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Solution details</legend>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label" for="solutionName">Solution:</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Solution name" id="solutionName" name="solutionName" @if(!empty($project['description'])) value="{{$project['description']}}" @endif @if(!$owner) readonly @endif>
                        </div>
                        <label class="col-lg-3 col-form-label" for="jobDate">Job date:</label>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-calendar"></i>
                                </span>
                                <input type="text" class="form-control pick-date-basic" name="jobDate" id="jobDate" placeholder="Pick a job date" @if(!empty($project['jobDate'])) value="{{$project['jobDate']}}" @else value="{{date('m/d/Y')}}" @endif @if(!$owner) disabled @endif>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label" for="customerName">Customer:</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Customer name" id="customerName" name="customerName" @if(!empty($project['name'])) value="{{$project['name']}}" @endif @if(!$owner) readonly @endif>
                        </div>
                        <label class="col-lg-3 col-form-label" for="periodMultiplier">Period multiplier:</label>
                        <div class="col-lg-3">

                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control" min="1" placeholder="1" id="periodMultiplier" name="periodMultiplier" onchange="calculateFraudNumbers()" @if(!empty($project['periodMultiplier'])) value="{{$project['periodMultiplier']}}" @else value="1" @endif @if(!$owner) readonly @endif>
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
                                <input type="text" class="form-control" placeholder="From" name="periodFrom" id="periodFrom" onchange="setFrom()" @if(!empty($project['periodFrom'])) value="{{$project['periodFrom']}}" @else value="{{date('m/d/Y')}}" @endif @if(!$owner) disabled @endif>
                                <input type="text" class="form-control" placeholder="To" name="periodTo" id="periodTo" onchange="setTo()" @if(!empty($project['periodTo'])) value="{{$project['periodTo']}}" @else value="{{date('m/d/Y')}}" @endif @if(!$owner) disabled @endif>
                            </div>

                        </div>
                        <label class="col-lg-3 col-form-label" style="border-bottom: 2px solid white;" for="roi"><strong>ROI:</strong></label>
                        <div class="col-lg-3">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" style="outline: white; border: 2px solid white;" @if(!empty($project['roi'])) value="{{$project['roi']}}" @endif placeholder="0" id="roi" name="roi" readonly>
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
                            <input type="number" placeholder="0" step="1" id="transactionAvoided" onchange="calculateFraudAvoidedBy()" name="transactionAvoided" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="averageValOfTrans">Average value of fraudulent transaction:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" id="averageValOfTrans" onchange="calculateFraudAvoidedBy()" name="averageValOfTrans" @if(!empty($project['averageValOfTrans'])) value="{{$project['averageValOfTrans']}}" @else value="15.00" @endif @if(!$owner) readonly @endif>
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
                                <input type="number" class="form-control closer-to-sign" placeholder="0" id="fraudAvoidedBy" name="fraudAvoidedBy" @if(!empty($project['fraudAvoidedBy'])) value="{{$project['fraudAvoidedBy']}}" @endif readonly>
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
                                <input type="number" class="form-control closer-to-sign" placeholder="0" id="monthlyCost" onchange="calculateTotalCost()" name="monthlyCost" @if(!empty($project['monthlyCost'])) value="{{$project['monthlyCost']}}" @else value="5000" @endif @if(!$owner) readonly @endif>
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="otherCosts">Other costs - all numbers:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" step="0.01" placeholder="0" id="otherCostsAllNumbers" onchange="calculateTotalCost()" name="otherCostsAllNumbers" @if(!empty($project['otherCostsAllNumbers'])) value="{{$project['otherCostsAllNumbers']}}" @else value="0" @endif @if(!$owner) readonly @endif>
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-6 col-form-label" for="otherCosts">Other costs - fraud numbers:</label>
                        <div class="col-lg-6">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" step="0.01" placeholder="0" id="otherCostsFraudNumbers" onchange="calculateTotalCost()" name="otherCostsFraudNumbers" @if(!empty($project['otherCostsFraudNumbers'])) value="{{$project['otherCostsFraudNumbers']}}" @else value="0" @endif @if(!$owner) readonly @endif>
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
                                <input type="number" class="form-control closer-to-sign" placeholder="0" id="totalCost" name="totalCost" @if(!empty($project['totalCost'])) value="{{$project['totalCost']}}" @endif readonly>
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
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.001" id="costPerPhone" onchange="calculatePerPhone()" name="costPerPhone" @if(!empty($project['costPerPhone'])) value="{{$project['costPerPhone']}}" @else value="0.005" @endif @if(!$owner) readonly @endif>
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.001" id="totalPerPhone" name="totalPerPhone" @if(!empty($project['totalPerPhone'])) value="{{$project['totalPerPhone']}}" @endif @if(!$owner) readonly @endif>
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
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.010" id="averageSMS" onchange="calculateTotalSMS()" name="averageSMS" @if(!empty($project['averageSMS'])) value="{{$project['averageSMS']}}" @else value="0.060" @endif @if(!$owner) readonly @endif>
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-control-feedback form-control-feedback-start">
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.010" id="totalSMS" name="totalSMS" @if(!empty($project['totalSMS'])) value="{{$project['totalSMS']}}" @endif @if(!$owner) readonly @endif>
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
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.01" id="otherSavings" onchange="calculateTotalSavings()" name="otherSavings" @if(!empty($project['otherSavings'])) value="{{$project['otherSavings']}}" @else value="0.00" @endif @if(!$owner) readonly @endif>
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
                                <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.1" id="totalSavings" name="totalSavings" @if(!empty($project['totalSavings'])) value="{{$project['totalSavings']}}" @endif readonly>
                                <div class="form-control-feedback-icon">
                                    <i class="ph-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>

                @if($owner)
                    <div class="row d-flex flex-row-reverse">
                        <div class="col-lg-4" style="text-align: right;">
                            <button type="submit" class="btn btn-primary">
                                Save project
                                <i class="ph-pencil-line ms-2"></i>
                            </button>
                        </div>
                    </div>
                @endif
            </form>

    </div>

    <div class="row mt-4">

        <div class="card">
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="line_zoom" style="height: 600px;"></div>
                </div>
            </div>
        </div>

    </div>


@endsection
