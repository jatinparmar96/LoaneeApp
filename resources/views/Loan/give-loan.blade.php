<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Give Loan</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="{{asset('assets/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css"
          media="screen"/>
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"
          media="screen"/>
    <link href="{{asset('assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" type="text/css"
          media="screen"/>
    <link href="{{asset('assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" type="text/css"
          media="screen">
    <link href="{{asset('assets/plugins/summernote/css/summernote.css')}}" rel="stylesheet" type="text/css"
          media="screen">
    <link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{asset('pages/css/pages-icons.css')}}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{asset('pages/css/themes/corporate.css')}}" rel="stylesheet" type="text/css"/>
</head>
<body class="fixed-header dashboard menu-pin menu-behind">
<!-- BEGIN SIDEBPANEL-->
@include('components.sidebar')
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->
<!-- START PAGE-CONTAINER -->
<div class="page-container">
    <!-- START HEADER -->

    <!-- END HEADER -->
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content pt-0">
            <!-- START CONTAINER FLUID -->
            <div class=" container-fluid   container-fixed-lg">
                <!-- START card -->
                <div class="panel">
                    <ul class="nav nav-tabs nav-tabs-fillup">
                        <li class="active">
                            <a class="active" data-toggle="tab" href="#days"><h2 class="bold">Daily</h2></a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#percentage"><h2 class="bold">Fixed</h2></a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#room"><h2 class="bold">Room</h2></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                <strong>Success: </strong>{{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::get('error'))
                            <div class="alert alert-danger" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                <strong>Error: </strong>{{Session::get('error')}}
                            </div>
                        @endif
                        {{---------------------------- ////Form For Days Loan////-------------------------------}}
                        <div class="tab-pane active" id="days">
                            <div class="card card-transparent">
                                <div class="card-header ">
                                    <div class="card-title">
                                        Payment to be given
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <form method="post" id="mainForm" action="{{route('storeLoan')}}">
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row clearfix">
                                                            <div class="col-md-4">
                                                                <div class="form-group form-group-default">
                                                                    <label>Card Number</label>
                                                                    <input type="text" class="form-control"
                                                                           name="card-number"
                                                                           value="{{old('card-number')}}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-8">
                                                                <div class="form-group form-group-default required">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control"
                                                                           name="loanee-name"
                                                                           value="{{old('loanee-name')}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-md-4">
                                                                <div class="form-group form-group-default required">
                                                                    <label>Mobile Number</label>
                                                                    <input type="number" class="form-control"
                                                                           value="{{old('mobile-number')}}"
                                                                           name="mobile-number"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group form-group-default">
                                                                    <label>Agent</label>
                                                                    <input type="text" class="typeahead form-control"
                                                                           value="{{old('agent')}}"
                                                                           id="agentTypeahead" name="agent">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <img id="image" class="icon">
                                                    </div>
                                                </div>
                                                <!--end Add User -->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default input-group required">
                                                            <div class="form-input-group required">
                                                                <label>Start Date</label>
                                                                <input id="start-date" type="text"
                                                                       value="{{old('startDate')}}"
                                                                       onchange="updateStartingDate()"
                                                                       class="form-control date"
                                                                       name="startDate"></div>
                                                            <div class="input-group-append ">
                                                                <span class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default input-group required">
                                                            <div class="form-input-group required">
                                                                <label>Ending Date</label>
                                                                <input id="endDate" type="text"
                                                                       value="{{old('endDate')}}"
                                                                       class="form-control date text-muted"
                                                                       name="endDate">
                                                            </div>
                                                            <div class="input-group-append ">
                                                                <span class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default required">
                                                            <label>Amount</label>
                                                            <input type="number" id="loanAmount"
                                                                   value="{{old('loanAmount')}}"
                                                                   onchange="updateInstallment()" name="loanAmount"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <label class="label label-default">Payment
                                                                    Method</label>
                                                                <div class="radio radio-success">
                                                                    <input type="radio" onchange=" updateInstallment()"
                                                                           checked="checked" value="Daily"
                                                                           name="Method" id="Daily">
                                                                    <label for="Daily">Daily</label>
                                                                    <input type="radio" onchange=" updateInstallment()"
                                                                           value="Weekly" name="Method" id="Weekly">
                                                                    <label for="Weekly">Weekly</label>
                                                                    <input type="radio" onchange="updateInstallment()"
                                                                           value="Monthly" name="Method" id="Monthly">
                                                                    <label for="Monthly">Monthly</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-default required">
                                                            <label id="type-label">Days</label>
                                                            <input type="number" id="lending_period"
                                                                   name="lending_period"
                                                                   value="{{old('lending_period')? old('lending_period'):60 }}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-default required">
                                                            <label id="repay-amount">Period(in Days)</label>
                                                            <input type="number" name="grace_period" id="period"
                                                                   value="{{old('grace_period')? old('grace_period'):75 }}"
                                                                   onchange="updateInstallment();updateStartingDate()"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 offset-6">
                                                        <div class="col-lg-8 offset-4">
                                                            <div class="form-group form-group-default required">
                                                                <label id="installment_label">Daily Installment</label>
                                                                <input type="number" name="installment" id="installment"
                                                                       value="{{old('installment')}}"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Image</label>
                                                            <input type="file" name="image"
                                                                   accept="image/x-png,image/gif,image/jpeg"
                                                                   onchange="updateImage(this,'')" value="{{old('image')}}"
                                                                   class="form-control">
                                                            <input type="hidden" value="{{old('imageSrc')}}"
                                                                   name="imageSrc" id="imageSrc">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Description</label>
                                                            <input type="text" name="description"
                                                                   value="{{old('description')}}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="{{old('room_active')?old('room_active'):0}}"
                                                       name="room_active" id="room_active">
                                                <input class="btn btn-primary" type="submit"
                                                       onclick="set_current_val(1,'Days')">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{---------------------------- ////Form For Percentage Loan////-------------------------------}}
                        <div class="tab-pane" id="percentage">
                            <div class="card card-transparent">
                                <div class="card-header ">
                                    <div class="card-title">
                                        Payment to be given
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <form method="post" id="percentage_form"
                                                  action="{{route('storePercentageLoan')}}">
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row clearfix">
                                                            <div class="col-md-4">
                                                                <div class="form-group form-group-default">
                                                                    <label>Card Number</label>
                                                                    <input type="text" class="form-control"
                                                                           name="p_card_number"
                                                                           value="{{old('p_card_number')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group form-group-default required">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control"
                                                                           name="p_loanee_name"
                                                                           value="{{old('p_loanee_name')}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-md-4">
                                                                <div class="form-group form-group-default required">
                                                                    <label>Mobile Number</label>
                                                                    <input type="number" class="form-control"
                                                                           value="{{old('p_mobile_number')}}"
                                                                           name="p_mobile_number"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group form-group-default">
                                                                    <label>Agent</label>
                                                                    <input type="text" class="typeahead form-control"
                                                                           value="{{old('agent')}}"
                                                                           id="p_agent_typeahead" name="agent">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <img id="p_image" class="icon">
                                                    </div>
                                                </div>
                                                <!--end Add User -->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default input-group required">
                                                            <div class="form-input-group required">
                                                                <label>Start Date</label>
                                                                <input id="p_start_date" type="text"
                                                                       value="{{old('p_start_date')}}"
                                                                       onchange="p_update_starting_date()"
                                                                       class="form-control date"
                                                                       name="p_start_date"></div>
                                                            <div class="input-group-append ">
                                                                <span class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default input-group required">
                                                            <div class="form-input-group required">
                                                                <label>Ending Date</label>
                                                                <input id="p_end_date" type="text"
                                                                       value="{{old('p_end_date')}}"
                                                                       class="form-control date text-muted"
                                                                       name="p_end_date">
                                                            </div>
                                                            <div class="input-group-append ">
                                                                <span class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default required">
                                                            <label>Amount</label>
                                                            <input type="number" id="p_loan_amount"
                                                                   value="{{old('p_loan_amount')}}"
                                                                   onchange="p_update_installment()"
                                                                   name="p_loan_amount"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <label class="label label-default">Payment
                                                                    Method</label>
                                                                <div class="radio radio-success">
                                                                    <input type="radio" value="Monthly"
                                                                           name="percentage_monthly"
                                                                           id="percentage_monthly" checked="checked">
                                                                    <label for="percentage_monthly">Monthly</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-default required">
                                                            <label id="type-label">Percentage</label>
                                                            <input type="number" id="p_percentage"
                                                                   name="p_percentage"
                                                                   value="{{old('p_percentage')? old('p_percentage'):10 }}"
                                                                   class="form-control"
                                                                   onchange="p_update_installment()">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-default required">
                                                            <label id="repay-amount">Period(in Months)</label>
                                                            <input type="number" name="p_grace_period"
                                                                   id="p_grace_period"
                                                                   value="{{old('p_grace_period')? old('p_grace_period'):12 }}"
                                                                   onchange="p_update_installment();p_update_starting_date()"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 offset-6">
                                                        <div class="col-lg-8 offset-4">
                                                            <div class="form-group form-group-default required">
                                                                <label id="installment_label">Monthly
                                                                    Installment</label>
                                                                <input type="number" name="p_installment"
                                                                       id="p_installment"
                                                                       value="{{old('p_installment')}}"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Image</label>
                                                            <input type="file" name="image"
                                                                   accept="image/x-png,image/gif,image/jpeg"
                                                                   onchange="updateImage(this,'p_')" value="{{old('p_image_src')}}"
                                                                   class="form-control">
                                                            <input type="hidden" value="{{old('p_image_src')}}"
                                                                   name="p_image_src" id="p_image_src">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Description</label>
                                                            <input type="text" name="p_description"
                                                                   value="{{old('p_description')}}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden"
                                                       value="{{old('percentage_active')?old('percentage_active'):0}}"
                                                       name="percentage_active" id="percentage_active">
                                                <input class="btn btn-primary" type="submit"
                                                       onclick="set_current_val(2,'percentage')">
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{---------------------------- ////Form For Room Loan////-------------------------------}}
                        <div class="tab-pane" id="room">
                            <div class="card card-transparent">
                                <div class="card-header ">
                                    <div class="card-title">
                                        Payment to be given
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <form method="post" id="mainForm" action="{{route('storeRoomLoan')}}">
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row clearfix">
                                                            <div class="col-md-4">
                                                                <div class="form-group form-group-default">
                                                                    <label>Building Name</label>
                                                                    <input type="text" class="form-control"
                                                                           name="r_building_name"
                                                                           value="{{old('r_building_name')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group form-group-default">
                                                                    <label>Room No</label>
                                                                    <input type="text" class="form-control"
                                                                           name="r_room_no"
                                                                           value="{{old('r_room_no')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group form-group-default required">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control"
                                                                           name="r_loanee_name"
                                                                           value="{{old('r_loanee_name')}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-md-4">
                                                                <div class="form-group form-group-default required">
                                                                    <label>Mobile Number</label>
                                                                    <input type="number" class="form-control"
                                                                           value="{{old('r_mobile_number')}}"
                                                                           name="r_mobile_number"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group form-group-default">
                                                                    <label>Agent</label>
                                                                    <input type="text" class="typeahead form-control"
                                                                           value="{{old('agent')}}"
                                                                           id="r_agent_typeahead" name="agent">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <img id="r_image" class="icon">
                                                    </div>
                                                </div>
                                                <!--end Add User -->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default input-group required">
                                                            <div class="form-input-group required">
                                                                <label>Start Date</label>
                                                                <input id="r_start_date" type="text"
                                                                       value="{{old('r_start_date')}}"
                                                                       onchange="r_update_starting_date()"
                                                                       class="form-control date"
                                                                       name="r_start_date"></div>
                                                            <div class="input-group-append ">
                                                                <span class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default input-group required">
                                                            <div class="form-input-group required">
                                                                <label>Ending Date</label>
                                                                <input id="r_end_date" type="text"
                                                                       value="{{old('r_end_date')}}"
                                                                       class="form-control date text-muted"
                                                                       name="r_end_date">
                                                            </div>
                                                            <div class="input-group-append ">
                                                                <span class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default required">
                                                            <label>Amount</label>
                                                            <input type="number" id="r_loan_amount"
                                                                   value="{{old('r_loan_amount')}}"
                                                                   onchange="r_update_installment()"
                                                                   name="r_loan_amount"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <label class="label label-default">Payment
                                                                    Method</label>
                                                                <div class="radio radio-success">
                                                                    <input type="radio"
                                                                           onchange="r_update_installment()"
                                                                           value="Monthly" name="r_method"
                                                                           id="r_method" checked="checked">
                                                                    <label for="r_method">Monthly</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-default required">
                                                            <label id="type-label">Grace Period</label>
                                                            <input type="number" id="r_lending_period"
                                                                   name="r_lending_period"
                                                                   value="{{old('r_lending_period')? old('r_lending_period'):60 }}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group required">
                                                            <label for="r_grace_period">Period(in Years)</label>
                                                            <select name="r_grace_period" id="r_grace_period"
                                                                    onchange="r_update_installment();r_update_starting_date()">
                                                                <option value=5>5 Years</option>
                                                                <option value=10>10 Years</option>
                                                            </select>
                                                            {{--<input type="number" name="r_grace_period"--}}
                                                            {{--id="r_grace_period"--}}
                                                            {{--value="{{old('r_grace_period')? old('r_grace_period'):10 }}"--}}
                                                            {{--onchange="r_update_installment();r_update_starting_date()"--}}
                                                            {{--class="form-control">--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 offset-6">
                                                        <div class="col-lg-8 offset-4">
                                                            <div class="form-group form-group-default required">
                                                                <label id="installment_label">Monthly
                                                                    Installment</label>
                                                                <input type="number" name="r_installment"
                                                                       id="r_installment"
                                                                       value="{{old('r_installment')}}"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Image</label>
                                                            <input type="file" name="r_image"
                                                                   accept="image/x-png,image/gif,image/jpeg"
                                                                   onchange="updateImage(this,'r_')" value="{{old('r_image')}}"
                                                                   class="form-control">
                                                            <input type="hidden" value="{{old('r_image')}}"
                                                                   name="r_image_src" id="r_image_src">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label for="description">Description</label>
                                                            <input type="text" id="description" name="description"
                                                                   value="{{old('description')}}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="{{old('room_active')?old('room_active'):0}}"
                                                       name="room_active" id="room_active">
                                                <input class="btn btn-primary" type="submit"
                                                       onclick="set_current_val(3,'room')">
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- END card -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>

    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>

<!-- BEGIN VENDOR JS -->
<script src="{{asset('assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/modernizr.custom.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/popper/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery/jquery-easy.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-ios-list/jquery.ioslist.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-actual/jquery.actual.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/classie/classie.js')}}"></script>

<script src="{{asset('assets/plugins/switchery/js/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<!-- <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script> -->
<script src="{{asset('js/InputMaskDate.js')}}" type="text/javascript"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="pages/js/pages.js"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="assets/js/form_layouts.js" type="text/javascript"></script>
<script src="assets/js/scripts.js" type="text/javascript"></script>
<script src="{{asset('js/typeahead.js')}}"></script>
<script src={{asset('js/date-hi-IN.js')}}></script>
<script src="{{asset('js/Give-Loan/give-Loan-Days.js')}}"></script>
<script src="{{asset('js/Give-Loan/give-Loan-Percentage.js')}}"></script>
<!-- END PAGE LEVEL JS -->
<script>
    $(document).ready(
        function () {
            $.get('getAgent', function (data) {
                data = parseData(data);
                initBloodHound(data)
            });
            let active = [];
            let days = $('#days_active').val();
            let percentage = $('#percentage_active').val();
            let room = $('#room_active').val();
            console.log(days, percentage, room);
            if (days == 'Days') {
                $('#days').addClass('active');
                $('#percentage').removeClass('active');
                $('#room').removeClass('active');
            }
            else if (percentage == 'percentage') {
                $('#percentage').addClass('active');
                $('#days').removeClass('active');
                $('#room').removeClass('active');
            }
            else if (room == 'room') {
                $('#room').addClass('active');
                $('#percentage').removeClass('active');
                $('#days').removeClass('active');
            }

        }
    );

    function compare(active) {
        for (let i = 0; i < active.length; i++) {
            if (active[i] != 0) {
                return active[i];
            }
        }
    }

    function r_update_starting_date() {
        let date = $('#r_start_date').val();
        let d = Date.parse(date);
        let endDate;
        endDate = d.add(Number($('#r_grace_period').val())).years();
        let end = endDate.toString('dd/MM/yyyy');
        $('#r_end_date').val(end);
    }

    function r_update_installment() {
        let loanAmount = $('#r_loan_amount');
        let period = $('#r_grace_period').val();
        const base_amt = 100000;
        const base_installment_small = 2300;
        const base_installment_large = 1500;
        let ratio = 1;
        let installment = 0;
        if (period == 5) {
            ratio = Number(loanAmount.val()) / base_amt;
            installment = ratio * base_installment_small;
        }
        else {
            ratio = Number(loanAmount.val()) / base_amt;
            installment = ratio * base_installment_large;
        }
        let installmentSelector = $('#r_installment');
        installment = Math.ceil(installment);
        installmentSelector.val(installment);
    }

    function set_current_val(data, value) {
        switch (data) {
            case 1:
                $('#days_active').val(value);
                break;
            case 2:
                $('#percentage_active').val(value);
                break;
            case 3:
                $('#room_active').val(value);
                break;
        }
    }

</script>
</body>
</html>