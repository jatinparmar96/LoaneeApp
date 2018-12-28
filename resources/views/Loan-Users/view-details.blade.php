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
            <div class=" container-fluid   container-fixed-lg">
                <!-- START card -->


                <div class="card card-transparent">

                    <div class="card-header ">
                        <div class="card-title">
                            Loan
                        </div>
                        <div>
                        <a href="{{url('view-Loanee')}}" class="btn btn-danger">Back</a>
                        </div>

                    </div>
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
                    
                    @if(Auth::User()->isAdmin)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Edit Loanee</h3>
                                <form method="post" action="{{route('editLoanee',$loanee->id)}}" role="form"
                                      autocomplete="off">
                                    {{csrf_field()}}
                                    <div class="row clearfix">
                                        <div class="col-md-4">
                                            <div class="form-group form-group-default">
                                                <label>Card Number</label>
                                                <input type="text" class="form-control" name="card-number"
                                                       value="{{$loanee->card_number}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default required">
                                                <label>Loanee name</label>
                                                <input type="text" class="form-control" name="loanee-name"
                                                       value="{{$loanee->name}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default required">
                                                <label>Mobile Number</label>
                                                <input type="number" class="form-control" name="mobile-number"
                                                       value="{{$loanee->mobile_no}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group form-group-default">
                                                <img src="{{asset('Images/'.$loanee->img.'.png')}}" height="150px" width="150px">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default">
                                                <label>Description</label>
                                                <input type="text" class="form-control" value="{{$loanee->description}}"
                                                       name="desc">
                                            </div>
                                        </div>
                                    </div>
                                    <input class="btn btn-primary" type="submit">
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- END card -->
                <div class="card card-transparent">
                    <div class="card-header ">
                        <div class="card-title">
                            Record
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Loans View</h3>
                                <div class=" container-fluid  bg-white">
                                    <!-- START card -->
                                    <div class="card card-transparent">
                                        <div class="card-header m-b-20">
                                            <div class="pull-center">
                                                <div class="col-lg-12">
                                                    <input type="text" id="search-table" class="form-control pull-right"
                                                           placeholder="Search" style="background-color: #e7e7e7;">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover demo-table-search table-responsive-block"
                                                   id="tableWithSearch" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Loan Id</th>
                                                    <th>Starting</th>
                                                    <th>Deadline</th>
                                                    <th>Type</th>
                                                    <th>Method</th>
                                                    <th>Amount</th>
                                                    <th>Repayment</th>

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


        <div class=" container-fluid  container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small no-margin pull-left sm-pull-reset">
                    <span class="hint-text">Copyright &copy; 2018 </span>
                    <span class="font-montserrat">BITMANITY</span>.
                    <span class="hint-text">All rights reserved. </span>
                    <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> <span
                                class="muted">|</span> <a href="#" class="m-l-10">Privacy Policy</a></span>
                </p>
                <p class="small no-margin pull-right sm-pull-reset">
                    Hand-crafted <span class="hint-text">&amp; made with Love</span>
                </p>
                <div class="clearfix"></div>
            </div>
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
<!-- END PAGE LEVEL JS -->
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{asset('assets/js/datatables.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/scripts.js')}}" type="text/javascript"></script>
<script>

    $('#tableWithSearch').DataTable({
            destroy: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            ajax: {
                url: '{{url('get-Loans')."/".$loanee->id}}/all',
                dataSrc: ''
            },
            columns: [
                {data: 'id'},
                {data: 'start_date'},
                {data: 'end_date'},
                {data: 'type'},
                {data: 'method'},
                {data: 'loan_amount'},
                {data: 'repay_amount'}

            ]
        }
    );
    $(".dt-button").addClass('btn btn-primary');
</script>

</body>
</html>