<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Electron</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="{{asset('assets/plugins/pace/pace-theme-flash.css" rel="stylesheet')}}" type="text/css"/>
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
          type="text/css" media="screen">
    <link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet"
          type="text/css" media="screen">
    <link href="{{asset('pages/css/pages-icons.css')}}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{asset('pages/css/themes/corporate.css')}}" rel="stylesheet" type="text/css"/>


</head>

<body class="fixed-header dashboard menu-pin menu-behind">

@include('components.sidebar')


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
                <div class="card card-transparent">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-lg-1">
                                <a href="{{url()->previous()}}" class="btn btn-danger">Back</a>
                            </div>
                            <div class="col-lg-1">
                                <a href="{{route('refreshPenalty')}}" class="btn btn-primary">Refresh Penalty</a>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-4">
                                <h6>Name</h6>
                                <h3 class="bold">{{$user->name}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="row d-flex flex-column mt-5">
                                    <h6>Card Number</h6>
                                    <h2 class="m-0 semi-bold">{{$user->card_number}}</h2>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="row d-flex flex-column mt-5">
                                    <h6>Agent</h6>
                                    <h2 class="m-0 semi-bold"> {{$agent->name}}</h2>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="row d-flex flex-column mt-5">
                                    <h6>Phone</h6>
                                    <h2 class="m-0 semi-bold">{{$user->mobile_no}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row d-flex flex-column mt-5">
                                    <h6>Loan Amount</h6>
                                    <h2 class="m-0 semi-bold"><span>₹</span>{{$loan->repay_amount}}</h2>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="row d-flex flex-column mt-5">
                                    <h6>Pending Amount</h6>
                                    <h2 class="m-0 semi-bold"><span>₹</span>{{$pending_amount}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row d-flex flex-column mt-5">
                                    <h6>Next Payment Amount</h6>
                                    <a href="">
                                        <h2 class="m-0 text-error bold"><span>₹</span>{{$loan->installment}}</h2>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row d-flex flex-column mt-5">
                                    <h6>Last Payment</h6>
                                    <h2 class="m-0 semi-bold">{{$latest_paid_date}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row d-flex flex-column mt-5">
                                    <h6>Next Due</h6>
                                    <h2 class="m-0 semi-bold">{{$end_date}}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td><h2>Pending Amount</h2></td>
                                            <td>
                                                <h2 class="semi-bold  semi-bold"><span>₹</span>{{$pending_amount}}
                                                </h2></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2>Total Penalty
                                                </h2></td>
                                            <td><h2 class="semi-bold  semi-bold"><span>₹</span>{{$penalty_amount}}
                                                </h2></td>
                                        </tr>
                                        <tr>
                                            <td><h2>Total Amount to be paid
                                                </h2></td>
                                            <td><h2 class="semi-bold text-danger bold"><span>₹</span>{{$total_amount}}
                                                </h2></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if(Auth::User()->isAdmin)
                                <div class="col-lg-2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row d-flex flex-column mt-5">
                                                <button class="btn btn-danger text-white toggle-btn" data-toggle="modal"
                                                        data-target="#confirmClose" id="btnToggleSlideUpSize">Close Card
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row d-flex flex-column mt-5">
                                                <button class="btn btn-primary text-white toggle-btn"
                                                        data-toggle="modal" data-target="#closePenalty"
                                                        id="btnToggleSlideUpSize">Close Penalty
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row d-flex flex-column mt-5">
                                                <button class="btn btn-success text-white toggle-btn"
                                                        data-toggle="modal" data-target="#bulkPayModal"
                                                        id="btnToggleSlideUpSize">Pay Bulk Records
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row d-flex flex-column mt-5">
                                                <button class="btn btn-warning toggle-btn"
                                                        data-toggle="modal" data-target="#extendRecord"
                                                        id="btnToggleSlideUpSize">Extend Loan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal fade stick-up" id="closePenalty" tabindex="-1" role="dialog"
                             style="display: none;"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header clearfix text-left">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                                    class="pg-close fs-14"></i>
                                        </button>
                                        <h5>Payment <span class="semi-bold">Information</span></h5>
                                        <p>Enter the amount for the record</p>
                                    </div>
                                    <div class="modal-body">
                                        <form id="modalForm" action="{{url('pay-custom-penalty')}}/{{$loan->id}}"
                                              role="form">
                                            <div class="form-group-attached">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Penalty Amount</label>
                                                            <input name="penalty_amount" type="number"
                                                                   class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8"></div>
                                                <div class="col-md-4 m-t-10 sm-m-t-10">
                                                    <input type="submit" value="Submit" id="modalSubmit"
                                                           class="btn btn-primary btn-block m-t-5">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade slide-up disable-scroll" id="confirmClose" tabindex="-1" role="dialog"
                             aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content-wrapper">
                                    <div class="modal-content">
                                        <div class="modal-body text-center m-t-20">
                                            <h4 class="no-margin p-b-10">Are you sure?</h4>
                                            <div class="btn-group-xs">
                                                <a type="button" href="{{route('closeCard',$loan->id)}}"
                                                   class="btn btn-danger btn-xs text-white">Yes</a>
                                                <a type="button" class="btn btn-primary btn-xs"
                                                   data-dismiss="modal">No</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade stick-up" id="bulkPayModal" tabindex="-1" role="dialog"
                             style="display: none;"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header clearfix text-left">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                                    class="pg-close fs-14"></i>
                                        </button>
                                        <h5>Payment <span class="semi-bold">Information</span></h5>
                                        <p>Fill Details for the Bulk Record</p>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('payBulkRecords')}}/{{$loan->id}}" role="form"
                                              autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                    <div class="row d-flex flex-row">
                                                        <div class="col-lg-6">
                                                            <label>Start Date</label>
                                                            <input type="text" class="form-control date" name="start_date">   
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label>End Date</label>
                                                            <input type="text" class="form-control date" name = "end_date">   
                                                        </div>
                                                        </div>     
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade stick-up" id="extendRecord" tabindex="-1" role="dialog"
                             style="display: none;"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header clearfix text-left">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                                    class="pg-close fs-14"></i>
                                        </button>
                                        <h5>Payment <span class="semi-bold">Information</span></h5>
                                        <p>Fill Details for the Bulk Record</p>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('extendRecord')}}/{{$loan->id}}" role="form"
                                              autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default input-group ">
                                                        <div class="form-input-group">
                                                            <label>Starting Date</label>
                                                            <input id="extend_date" type="text" class="form-control date" name="extend_date" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </form>
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
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/classie/classie.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/switchery/js/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}"
        type="text/javascript"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{asset('pages/js/pages.js')}}"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script type="text/javascript" src="{{asset('js/dataTable-buttons/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/buttons.flash.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/buttons.print.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/buttons.html5.min.js')}}"></script>

<script src="{{asset('assets/js/scripts.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/datatables.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/form_layouts.js')}}" type="text/javascript"></script>

<script>
    function showConfirmModal() {
        $('#confirmClose').show();
    }
    $('.form-control.date').datepicker({
        format: 'dd/mm/yyyy'
    })
</script>

</body>

</html>