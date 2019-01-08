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
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"
          media="screen">
    <link href="assets/plugins/summernote/css/summernote.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"
          media="screen">
    <link href="assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"
          media="screen">
    <link href="assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css"
          media="screen"/>
    <link href="pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="pages/css/themes/corporate.css" rel="stylesheet" type="text/css"/>
    <
    <style type="text/css" media="screen">
        .container-fluid {
            padding-left: 0;
            padding-right: 30px;
            position: relative;
        }
    </style>
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
            <div class=" container-fluid container-fixed-lg">
                <div class="panel">
                    <ul class="nav nav-tabs nav-tabs-fillup">
                        <li class="active">
                            <a class="active" data-toggle="tab" href="#days"><h2 class="bold">Daily</h2></a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#percentage" onclick="loadPercentageTable();"><h2
                                        class="bold">Fixed</h2></a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" onclick="loadRoomTable();  $('.form-control.input-sm').focus();" href="#room"><h2 class="bold">Room</h2></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="days">
                            <div class="card card-transparent">
                                <div class="card-header ">
                                    <div class="card-title">
                                        Daily Records
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <h3>Daily View</h3>
                                            <div class=" container-fluid bg-white">
                                                <!-- START card -->
                                                <div class="card card-transparent">
                                                    <div class="card-body">
                                                        <table class="table  dt-responsive nowrap" id="daily"
                                                               style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th>User Name</th>
                                                                <th>Card Number</th>
                                                                <th>Starting</th>
                                                                <th>Deadline</th>
                                                                <th>Method</th>
                                                                <th>Amount</th>
                                                                <th>Pending</th>
                                                                <th>Penalty</th>
                                                                <th>Action</th>
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
                        <div class="tab-pane " id="percentage">
                            <div class="card card-transparent">
                                <div class="card-header ">
                                    <div class="card-title">
                                        Fixed Record
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <h3>Fixed View</h3>
                                            <div class=" container-fluid bg-white">
                                                <!-- START card -->
                                                <div class="card card-transparent">
                                                    <div class="card-body">
                                                        <table class="table dt-responsive nowrap" id="percent"
                                                               style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th>Loanee Name</th>
                                                                <th>Card Number</th>
                                                                <th>Starting</th>
                                                                <th>Deadline</th>
                                                                <th>Amount</th>
                                                                <th>Penalty</th>
                                                                <th>Action</th>
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
                        <div class="tab-pane " id="room">
                            <div class="card card-transparent">
                                <div class="card-header ">
                                    <div class="card-title">
                                        Room
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <h3>Room View</h3>
                                            <div class=" container-fluid bg-white">
                                                <!-- START card -->
                                                <div class="card card-transparent">
                                                    <div class="card-body">
                                                        <table class="table  dt-responsive nowrap" id="room_table"
                                                               style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th>User Name</th>
                                                                <th>Building Name</th>
                                                                <th>Room No</th>
                                                                <th>Starting</th>
                                                                <th>Deadline</th>
                                                                <th>Amount</th>
                                                                <th>Installment</th>
                                                                <th>Repayment</th>
                                                                {{--<th>Penalty</th>--}}
                                                                <th>Action</th>
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
                <!-- START card -->

                <!-- END card -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <!-- END COPYRIGHT -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTAINER -->
<!--START QUICKVIEW -->

<!-- END QUICKVIEW-->
<!-- START OVERLAY -->

<!-- END OVERLAY -->
<!-- BEGIN VENDOR JS -->
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="assets/plugins/classie/classie.js"></script>
<script src="assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-autonumeric/autoNumeric.js"></script>
<script type="text/javascript" src="assets/plugins/dropzone/dropzone.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-inputmask/jquery.inputmask.min.js"></script>
<script src="assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="assets/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/bootstrap-typehead/typeahead.bundle.min.js"></script>
<script src="assets/plugins/bootstrap-typehead/typeahead.jquery.min.js"></script>
<script src="assets/plugins/handlebars/handlebars-v4.0.5.js"></script>
<script src="assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js"
        type="text/javascript"></script>
<script src="assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js"
        type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="assets/plugins/datatables-responsive/js/lodash.min.js"></script>


<script type="text/javascript" src="{{asset('js/dataTable-buttons/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/buttons.flash.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/buttons.print.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTable-buttons/buttons.html5.min.js')}}"></script>
<!-- END VENDOR JS -->{{asset('')}}
<!-- BEGIN CORE TEMPLATE JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="pages/js/pages.js"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->

<!-- END PAGE LEVEL JS -->
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="assets/js/datatables.js" type="text/javascript"></script>
<script src="assets/js/form_elements.js" type="text/javascript"></script>
<script src="assets/js/form_layouts.js" type="text/javascript"></script>
<script src="assets/js/scripts.js" type="text/javascript"></script>
{{--//'{{url("get-Loans")}}/0/' + type,--}}

<script>

    var percentage_loaded = true;
    var room_loaded = true;
    $(document).ready(function () {
        initializeDaysDatatables();
        // initializePercentageDatatables();
        //initializeRoomDatatables();

        $('.form-control.input-sm').focus();
    });

    function fetchFixed() {
        initializeDatatables('percent', "Percentage");

    }

    function initializeDaysDatatables() {
        $('#daily').DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                ajax: {
                    url: '{{url('days_list')}}',
                    dataSrc: ''
                },
                columns: [
                    {data: 'name'},
                    {data: "card_number"},
                    {data: 'start_date'},
                    {data: 'end_date'},
                    {data: 'method'},
                    {data: 'repay_amount'},
                    {data: 'pending_amount'},
                    {data: 'penalty_amount'},
                    {
                        data: 'id',
                        render: function (data, type, row) {
                            return "<div class='btn-group'>" +
                                "<a href=view-LoanDetails/" + data + "> <button type='button' class='btn btn-xs btn-success'> " +
                                "<i class='fa fa-eye'></i>" +
                                "</button> </div>";
                        }
                    }

                ]
            }
        );
        $(".dt-button").addClass('btn btn-xs btn-primary');
        $('.form-control.input-sm').focus();
    }

    function initializePercentageDatatables() {
        if (percentage_loaded) {
            $('#percent').DataTable({
                    destroy: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf', 'print'
                    ],
                    ajax: {
                        url: '{{url('percentage_list')}}',
                        dataSrc: ''
                    },
                    columns: [
                        {data: 'name'},
                        {data: "card_number"},
                        {data: 'start_date'},
                        {data: 'end_date'},
                        {data: 'repay_amount'},
                        {data: 'penalty_amount'},
                        {
                            data: 'id',
                            render: function (data, type, row) {
                                return "<div class='btn-group'>" +
                                    "<a href=loan_percentage_show/" +
                                    "" + data + "> <button type='button' class='btn btn-xs btn-success'> " +
                                    "<i class='fa fa-eye'></i>" +
                                    "</button> </div>";
                            }
                        }

                    ]
                }
            );
            $(".dt-button").addClass('btn btn-xs btn-primary');

            percentage_loaded = false;
        }
        $('.form-control.input-sm').focus();
    }

    function loadPercentageTable() {
        if (percentage_loaded) {
            initializePercentageDatatables();
            percentage_loaded = false;
        }
        $('.form-control.input-sm').focus();
    }

    function loadRoomTable() {
        if (room_loaded) {
            initializeRoomDatatables();
            room_loaded = false;
        }
        $('.form-control.input-sm').focus();
    }

    function initializeRoomDatatables() {

            $('#room_table').DataTable({
                    destroy: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf', 'print'
                    ],
                    ajax: {
                        url: '{{url('room_list')}}',
                        dataSrc: ''
                    },
                    columns: [
                        {data: 'name'},
                        {data: "building_name"},
                        {data: 'room_no'},
                        {data: 'start_date'},
                        {data: 'end_date'},
                        {data: 'loan_amount'},
                        {data: 'installment'},
                        {data: 'repay_amount'},
                        //{data: 'penalty_amount'},
                        {
                            data: 'id',
                            render: function (data, type, row) {
                                return "<div class='btn-group'>" +
                                    "<a href=view-LoanDetails/" + data + "> <button type='button' class='btn btn-xs btn-success'> " +
                                    "<i class='fa fa-eye'></i>" +
                                    "</button> </div>";
                            }
                        }

                    ]
                }
            );
            $(".dt-button").addClass('btn btn-xs btn-primary');

    }
</script>


<!-- END PAGE LEVEL JS -->

</body>
</html>