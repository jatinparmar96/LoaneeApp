<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Electron</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/summernote/css/summernote.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="pages/css/themes/corporate.css" rel="stylesheet" type="text/css" />
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
                            Record
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Table View</h3>
                                <div class=" container-fluid   container-fixed-lg bg-white">
                                    <!-- START card -->
                                    <div class="card card-transparent">
                                        <div class="card-header m-b-20">
                                            <div class="pull-center">
                                                <div class="col-lg-12">
                                                    <input type="text" id="search-table" class="form-control pull-right" placeholder="Search" style="background-color: #e7e7e7;">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
                                                <thead>
                                                <tr>
                                                    <th>Loanee Name</th>
                                                    <th>Card Number</th>
                                                    <th>Starting</th>
                                                    <th>Deadline</th>
                                                    <th>Type</th>
                                                    <th>Basic</th>
                                                    <th>TPA</th>
                                                    <th>RAP</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>01-2018</p>
                                                    </td>
                                                    <td class="v-align-middle semi-bold" width="20%">
                                                        <p>Rehman Deraiya</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>08/11/2018</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>08/12/2018</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>Days</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>Weekly</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>1000</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>1050</p>
                                                    </td>
                                                    <td class="v-align-middle" width="20%">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-success"><i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>01-2018</p>
                                                    </td>
                                                    <td class="v-align-middle semi-bold" width="20%">
                                                        <p>Rehman Deraiya</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>08/11/2018</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>08/12/2018</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>Days</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>Weekly</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>1000</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>1050</p>
                                                    </td>
                                                    <td class="v-align-middle" width="20%">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-success"><i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>01-2018</p>
                                                    </td>
                                                    <td class="v-align-middle semi-bold" width="20%">
                                                        <p>Rehman Deraiya</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>08/11/2018</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>08/12/2018</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>Days</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>Weekly</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>1000</p>
                                                    </td>
                                                    <td class="v-align-middle" width="10%">
                                                        <p>1050</p>
                                                    </td>
                                                    <td class="v-align-middle" width="20%">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-success"><i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid  container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small no-margin pull-left sm-pull-reset">
                    <span class="hint-text">Copyright &copy; 2018 </span>
                    <span class="font-montserrat">BITMANITY</span>.
                    <span class="hint-text">All rights reserved. </span>
                    <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> <span class="muted">|</span> <a href="#" class="m-l-10">Privacy Policy</a></span>
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
<script src="assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<!-- END VENDOR JS -->
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

<!-- END PAGE LEVEL JS -->
</body>
</html>