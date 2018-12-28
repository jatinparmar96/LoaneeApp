<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title></title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>



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
                <div class="card card-transparent">
                      <div class="card-header ">
                    
                        <div>
                        <a href="{{url('view-Loan')}}" class="btn btn-danger">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>Records View</h3>
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-success text-white" href="{{url('refreshPenalty')}}">Refresh Penalty</a>
                            </div>
                        </div>
                        <div class="row">
                                <div class=" container-fluid   container-fixed-lg bg-white">
                                    <!-- START card -->
                                    <div class="card card-transparent">
                                        <div class="card-body">
                                            <table class="table table-hover demo-table-search table-responsive-block"
                                                   id="tableWithSearch" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Records Id</th>
                                                    <th>Deadline</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                    <th>Method</th>
                                                    <th>Paid</th>
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

                <div class="card card-transparent">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Penalties for this Loan</h3>
                                <div class=" container-fluid   container-fixed-lg bg-white">
                                    <!-- START card -->
                                    <div class="card card-transparent">

                                        <div class="card-body">
                                            <table class="table table-hover demo-table-search table-responsive-block"
                                                   id="penalty-table" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Penalty Id</th>
                                                    <th>Amount</th>
                                                    <th>Penalty date</th>
                                                    <th>Next Penalty date</th>
                                                    <th>Paid</th>
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
            <!-- END CONTAINER FLUID -->
        </div>
       
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
    var i = 1;
    $('#tableWithSearch').DataTable({
            destroy: true,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
            ajax: {
                url:  "{{route('getRecords',$id)}}",
                dataSrc: ''
            },
            columns: [
                {data: 'id'},
                {data: 'record_date'},
                {data: 'record_amount'},
                {data: 'type'},
                {data: 'method'},
                {data:'paid',
                render:function (data,type,row) {
                    if (data === 0){
                        return "No"
                    }
                    else return "Yes";
                }
                }
            ]
        }
    );

    $('#penalty-table').DataTable({
            destroy: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            ajax: {
                url:  "{{route('getPenaltiesByLoan',$id)}}",
                dataSrc: ''
            },
            columns: [
              {data: 'id',
                render: function(data,type,row){
                        return i++;
                    }
                },
                {data: 'amount'},
                {data: 'penalty_date'},
                {data: 'next_penalty_date'},
                {data:'paid',
                    render:function (data,type,row) {
                        if (data === 0){
                            return "No"
                        }
                        else return "Yes";
                    }
                }@if(Auth::User()),
                {
                    data:'id',
                    render: function(data,type,row)
                    {
                         return "<div class='btn-group'>" +
                            "<a href={{url('payPenalty')}}/" + data + "> <button type='button' class='btn btn-xs btn-success'> " +
                            "Pay Full <i class='fa fa-arrow-circle-right'></i>" +
                            "</button></a> " +
                           "</div>";
                    }
                }
                @endif

            ]
        }
    );
       $(".dt-button").addClass('btn btn-primary btn-sm');
</script>

</body>
</html>