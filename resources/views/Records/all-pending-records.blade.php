<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Electron</title>
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
                    @if(Session::has('success'))
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

                    <div class="tab-pane active" id="days">
                        <div class="card card-transparent">
                            <div class="card-header ">
                                <div class="card-title">
                                    <h3>Today's Pending Records</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class=" container-fluid   container-fixed-lg bg-white">
                                            <!-- START card -->
                                            <div class="card card-transparent">
                                                <div class="card-body">
                                                    <table class="table" id="days_table"
                                                           style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 5px !important;">User Name</th>
                                                            <th style="width: 5% !important;">Card Number</th>
                                                            <th style="width: 7% !important;">Amount</th>
                                                            <th style="width: 7% !important;">Penalty_amount</th>
                                                            <th style="width: 10% !important;">Record Date</th>
                                                            @if(Auth::User()->isAdmin)

                                                                <th style="width: 5%;">Pay Full</th>
                                                                <th style="width: 5%;">Pay Bulk</th>
                                                                <th style="width: 5%;">Pay Penalty</th>
                                                                <th style="width: 5%;">Loan Details</th>
                                                            @endif
                                                        </tr>
                                                        </thead>

                                                    </table>
                                                </div>
                                            </div>
                                            <!-- END card -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="percentage">
                        <div class="card card-transparent">

                            <div class="card-header ">
                                <div class="card-title">
                                    <h3>Today's Pending Records</h3>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class=" container-fluid   container-fixed-lg bg-white">
                                            <!-- START card -->
                                            <div class="card card-transparent">
                                                <div class="card-body">

                                                    <table class="table data-table" id="percentage_table"
                                                           style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 20%;">User Name</th>
                                                            <th style="width: 5%;">Card Number</th>
                                                            <th style="width: 7%;">Amount</th>
                                                            <th style="width: 7%;">Penalty_amount</th>
                                                            <th style="width: 10%;">Record Date</th>
                                                            @if(Auth::User()->isAdmin)

                                                                <th style="width: 5%;">Pay Full</th>
                                                                <th style="width: 5%;">Pay Bulk</th>
                                                                <th style="width: 5%;">Pay Penalty</th>
                                                                <th style="width: 5%;">Loan Details</th>
                                                            @endif
                                                        </tr>
                                                        </thead>

                                                    </table>

                                                </div>
                                            </div>
                                            <!-- END card -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="room">
                        <div class="card card-transparent">

                            <div class="card-header ">
                                <div class="card-title">
                                    <h3>Today's Pending Records</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class=" container-fluid   container-fixed-lg bg-white">
                                            <!-- START card -->
                                            <div class="card card-transparent">
                                                <div class="card-body">

                                                    <table class="table data-table" id="room_table"
                                                           style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 20%;">User Name</th>
                                                            <th style="width: 5%;">Building Name</th>
                                                            <th style="width: 5%;">Room No</th>
                                                            <th style="width: 7%;">Amount</th>
                                                            <th style="width: 7%;">Penalty_amount</th>
                                                            <th style="width: 10%;">Record Date</th>
                                                            @if(Auth::User()->isAdmin)

                                                                <th style="width: 5%;">Pay Full</th>
                                                                <th style="width: 5%;">Pay Bulk</th>
                                                                <th style="width: 5%;">Pay Penalty</th>
                                                                <th style="width: 5%;">Loan Details</th>
                                                            @endif
                                                        </tr>
                                                        </thead>

                                                    </table>

                                                </div>
                                            </div>
                                            <!-- END card -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
        <div class="modal fade stick-up" id="myModal" tabindex="-1" role="dialog" style="display: none;"
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
                        <form id="modalForm" role="form">
                            <div class="form-group-attached">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Penalty Amount</label>
                                            <input name="penalty_amount" type="number" class="form-control">
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
    </div>

    <div class="modal fade stick-up" id="bulkPayModal" tabindex="-1" role="dialog" style="display: none;"
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
                    <form id="bulkPayModelForm" role="form" autocomplete="off">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row d-flex flex-row">
                                        <div class="col-lg-6">
                                            <label>Start Date</label>
                                            <input type="text" class="form-control date" id="pay_bulk_record_start_date"
                                                   name="start_date">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>End Date</label>
                                            <input type="text" class="form-control date" id="pay_bulk_record_end_date"
                                                   name="end_date">
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

</div>

<!-- END COPYRIGHT -->
</div>
<!-- END PAGE CONTENT WRAPPER -->

<!-- END PAGE CONTAINER -->
<!--START QUICKVIEW -->

<!-- END QUICKVIEW-->
<!-- START OVERLAY -->

<!-- END OVERLAY -->
<!-- BEGIN VENDOR JS -->

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
<script src="{{asset('assets/js/demo.js')}}"></script>

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

<script type="text/javascript" src="{{asset('js/dataTable-buttons/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/buttons.flash.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/buttons.print.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('js/InputMaskDate.js')}}" type="text/javascript"></script>

<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{asset('pages/js/pages.js')}}"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{asset('assets/js/scripts.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{asset('assets/js/datatables.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/scripts.js')}}" type="text/javascript"></script>
<script src={{asset('js/date-hi-IN.js')}}></script>
<script>

    $(document).ready(function () {
        initializeDaysDatatable();
        initializePercentageDatatable();
        initializeRoomDatatable();
        // initializePercentageDatatables();
        //initializeRoomDatatables();

        $('.form-control.input-sm').focus();
    });

    function initializeDaysDatatable() {
        $('#days_table').DataTable({
            destroy: true,
            ajax: {
                url: "{{route('pending_list')}}",
                dataSrc: ''
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'card_number'
                },
                {
                    data: 'remaining_amount'
                },
                {
                    data: 'penalty_amount'
                },
                {
                    data: 'record_date'
                },
                    @if(Auth::User() -> isAdmin)
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return "<div class='btn-group'>" +
                            "<a href=record/pay-Full-record/" + data +
                            "> <button type='button' class='btn btn-xs btn-success'> " +
                            "Daily EMI <i class='fa fa-arrow-circle-right'></i>" +
                            "</button></a> " +
                            "</div>"
                    }
                },
                {
                    data: getIdAndDate,
                    render: function (data, type, row) {
                        return "<button type='button' id='btnStickUpSizeToggler' onclick='openBulkModal(\"" +
                            data + "\")' class='toggle-btn btn btn-xs btn-danger'>" +
                            "Bulk <i class='fa fa-arrow-circle-right'></i></button>";
                    }
                },
                {
                    data: 'loan_id',
                    render: function (data, type, row) {
                        return "<button type='button' id='btnStickUpSizeToggler' onclick=\"openModel('" +
                            data + "')\" class='toggle-btn btn btn-xs btn-outline-primary m-l-5'>" +
                            "Penalty <i class='fa fa-arrow-circle-right'></i>" +
                            "</button>";
                    }
                },
                    @endif
                {
                    data: 'loan_id',
                    render: function (data, type, row) {
                        return "<a href='view-LoanDetails/" + data + "'>" +
                            "  <i class='fa fa-eye red fs-15'></i>" +
                            "</a> ";
                    }
                }
            ]
        });
        $('.dataTables_length').hide();
        $('.form-control.input-sm').focus();
    }

    function initializePercentageDatatable() {
        $('#percentage_table').DataTable({
            destroy: true,
            ajax: {
                url: "{{route('pending_percentage_records')}}",
                dataSrc: ''
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'card_number'
                },
                {
                    data: 'record_amount'
                },
                {
                    data: 'penalty_amount'
                },
                {
                    data: 'record_date'
                },
                    @if(Auth::User() -> isAdmin)
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return "<div class='btn-group'>" +
                            "<a href=record/pay-Full-record/" + data +
                            "> <button type='button' class='btn btn-xs btn-success'> " +
                            "Daily EMI <i class='fa fa-arrow-circle-right'></i>" +
                            "</button></a> " +
                            "</div>"
                    }
                },
                {
                    data: getIdAndDate,
                    render: function (data, type, row) {
                        return "<button type='button' id='btnStickUpSizeToggler' onclick='openBulkModal(\"" +
                            data + "\")' class='toggle-btn btn btn-xs btn-danger'>" +
                            "  Bulk <i class='fa fa-arrow-circle-right'></i></button>";
                    }
                },
                {
                    data: 'loan_id',
                    render: function (data, type, row) {
                        return "<button type='button' id='btnStickUpSizeToggler' onclick=\"openModel('" +
                            data + "')\" class='toggle-btn btn btn-xs btn-outline-primary m-l-5'>" +
                            "  Penalty <i class='fa fa-arrow-circle-right'></i>" +
                            "</button> ";
                    }
                },
                    @endif
                {
                    data: 'loan_id',
                    render: function (data, type, row) {
                        return "<a href='loan_percentage_show/" + data + "'>" +
                            "  <i class='fa fa-eye red fs-15'></i>" +
                            "</a> ";
                    }
                }
            ]
        });
        $('.dataTables_length').hide();
        $('.form-control.input-sm').focus();
    }

    function initializeRoomDatatable() {
        $('#room_table').DataTable({
            destroy: true,
            ajax: {
                url: "{{route('pending_room_records')}}",
                dataSrc: ''
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'building_name'
                },
                {
                    data: 'room_no'
                },
                {
                    data: 'record_amount'
                },
                {
                    data: 'penalty_amount'
                },
                {
                    data: 'record_date'
                },
                    @if(Auth::User() -> isAdmin)
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return "<div class='btn-group'>" +
                            "<a href=record/pay-Full-record/" + data +
                            "> <button type='button' class='btn btn-xs btn-success'> " +
                            "Daily EMI <i class='fa fa-arrow-circle-right'></i>" +
                            "</button></a> " +
                            "</div>"
                    }
                },
                {
                    data: getIdAndDate,
                    render: function (data, type, row) {
                        return "<button type='button' id='btnStickUpSizeToggler' onclick='openBulkModal(\"" +
                            data + "\")' class='toggle-btn btn btn-xs btn-danger'>" +
                            "  Bulk <i class='fa fa-arrow-circle-right'></i></button>";
                    }
                },
                {
                    data: 'loan_id',
                    render: function (data, type, row) {
                        return "<button type='button' id='btnStickUpSizeToggler' onclick=\"openModel('" +
                            data + "')\" class='toggle-btn btn btn-xs btn-outline-primary m-l-5'>" +
                            "Penalty <i class='fa fa-arrow-circle-right'></i>" +
                            "</button> ";
                    }
                },
                    @endif
                {
                    data: 'loan_id',
                    render: function (data, type, row) {
                        return "<a href='loan_room_show/" + data + "'>" +
                            "  <i class='fa fa-eye red fs-15'></i>" +
                            "</a> ";
                    }
                }
            ]
        });
        $('.dataTables_length').hide();
        $('.form-control.input-sm').focus();
    }

    function getIdAndDate(data, type, dataToSet) {
        return data.loan_id + ',' + data.record_date;
    }

    function openBulkModal(id) {
        let loan_id = id.split(',')[0];
        let record_date = Date.parse(id.split(',')[1]).toString('dd/MM/yyyy');
        //    record_date = record_date.toString('dd/MM/yyyy');
        console.log(record_date);
        $('#bulkPayModal').modal('show');
        $('#bulkPayModelForm').attr('action', "{{url('payBulkRecords')}}/" + loan_id);
    }

    function openModel(value) {
        $('#myModal').modal('show');
        $('#modalForm').attr('action', "{{url('pay-custom-penalty')}}/" + value);
    }


    $('.form-control.date').datepicker({
        format: 'd/m/yyyy'
    });

    $('#modelForm').submit(function () {
        $(this).find(':input[type=submit]').prop('disabled', true);
    })
</script>

</body>

</html>