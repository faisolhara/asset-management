@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row row-in">
                <div class="col-lg-3 col-sm-6 row-in-br">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15">23</h3>
                        </li>
                        <li class="col-middle">
                            <h4>New projects</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-info"><i class="ti-wallet"></i></span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15">76</h3>
                        </li>
                        <li class="col-middle">
                            <h4>Total Earnings</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 row-in-br">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15">93</h3>
                        </li>
                        <li class="col-middle">
                            <h4>Total Projects</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6  b-0">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-warning"><i class="fa fa-dollar"></i></span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15">83</h3>
                        </li>
                        <li class="col-middle">
                            <h4>Net Earnings</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--row -->
<!-- /.row -->
<div class="row">
    <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Products Yearly Sales</h3>
            <ul class="list-inline text-right">
                <li>
                    <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5>
                </li>
                <li>
                    <h5><i class="fa fa-circle m-r-5 text-danger"></i>Windows</h5>
                </li>
            </ul>
            <div id="ct-visits" style="height: 285px;"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
        <div class="bg-theme-alt">
            <div id="ct-daily-sales" class="p-t-30" style="height: 300px"></div>
        </div>
        <div class="white-box">
            <div class="row">
                <div class="col-xs-8">
                    <h2 class="m-b-0 font-medium">Week Sales</h2>
                    <h5 class="text-muted m-t-0">Ios app - 160 sales</h5>
                </div>
                <div class="col-xs-4">
                    <div class="circle circle-md bg-info pull-right m-t-10"><i class="ti-shopping-cart"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xs-12">
        <div class="bg-theme white-box m-b-0">
            <ul class="expense-box">
                <li><i class="wi wi-day-cloudy text-white"></i>
                    <div>
                        <h1 class="text-white m-b-0">35<sup>o</sup></h1>
                        <h4 class="text-white">Clear and sunny</h4>
                    </div>
                </li>
            </ul>
            <div id="ct-weather" style="height: 120px"></div>
            <ul class="dp-table text-white">
                <li>05 AM</li>
                <li>10 AM</li>
                <li>03 PM</li>
                <li>08 PM</li>
            </ul>
        </div>
        <div class="white-box">
            <div class="row">
                <div class="col-xs-8">
                    <h2 class="m-b-0 font-medium">Sunday</h2>
                    <h5 class="text-muted m-t-0">March 2017</h5>
                </div>
                <div class="col-xs-4">
                    <div class="circle circle-md bg-success pull-right m-t-10"><i class="wi wi-day-sunny"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@parent
  <!-- chartist chart -->
    <script src="{{ asset('plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <!-- Calendar JavaScript -->
    <script src="{{ asset('plugins/bower_components/calendar/dist/cal-init.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/dashboard1.js') }}"></script>
@endsection