@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 text-center m-t-md">
            <h2>
                Welcome to Homer Theme
            </h2>

            <p>
                Special <strong>Admin Theme</strong> for small, medium and large webapp with very clean and
                aesthetic style and feel.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="hpanel">
                <div class="panel-body text-center h-200">
                    <h1 class="m-xs">$1 206,90</h1>
                    <h3 class="font-extra-bold no-margins text-success">All Income</h3>
                    <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit vestibulum.</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="hpanel stats">
                <div class="panel-body h-200">
                    <div class="stats-title pull-left">
                        <h4>Users Activity</h4>
                    </div>
                    <div class="stats-icon pull-right">
                        <i class="pe-7s-share fa-4x"></i>
                    </div>
                    <div class="m-t-xl">
                        <h3 class="m-b-xs">210</h3>
                                <span class="font-bold no-margins">
                                    Social users
                                </span>

                        <div class="progress m-t-xs full progress-small">
                            <div style="width: 55%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="55"
                                 role="progressbar" class=" progress-bar progress-bar-success">
                                <span class="sr-only">35% Complete (success)</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>7.80</h4>
                            </div>

                            <div class="col-xs-6">
                                <small class="stats-label">% New Visits</small>
                                <h4>76.43%</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="hpanel stats">
                <div class="panel-body h-200">
                    <div class="stats-title pull-left">
                        <h4>Page Views</h4>
                    </div>
                    <div class="stats-icon pull-right">
                        <i class="pe-7s-monitor fa-4x"></i>
                    </div>
                    <div class="m-t-xl">
                        <h1 class="text-success">860k+</h1>
                                <span class="font-bold no-margins">
                                    Social users
                                </span>
                        <br/>
                        <small>
                            Lorem Ipsum is simply dummy text of the printing and <strong>typesetting
                                industry</strong>. Lorem Ipsum has been.
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="hpanel stats">
                <div class="panel-body h-200">
                    <div class="stats-title pull-left">
                        <h4>Today income</h4>
                    </div>
                    <div class="stats-icon pull-right">
                        <i class="pe-7s-cash fa-4x"></i>
                    </div>
                    <div class="clearfix"></div>
                    <div class="m-t-xs">
                        <div class="row">
                            <div class="col-xs-5">
                                <small class="stat-label">Today</small>
                                <h4>$230,00 </h4>
                            </div>
                            <div class="col-xs-7">
                                <small class="stat-label">Last week</small>
                                <h4>$7 980,60 <i class="fa fa-level-up text-success"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection