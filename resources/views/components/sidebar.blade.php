<nav class="page-sidebar" data-pages="sidebar">

    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <img src="{{asset('assets/img/logo_white.png')}}" alt="logo" class="brand"
             data-src="{{asset('assets/img/logo_white.png')}}"
             data-src-retina="{{asset('assets/img/logo_white_2x.png')}}" width="78" height="22">
        <div class="sidebar-header-controls">
            <!--Does Nothing-->
            <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" style="visibility: hidden"><i
                        class="fa fa-angle-down fs-16"></i>
            </button>
            <!--Does Nothing-->
            <button type="button"
                    class="btn btn-link d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none"
                    data-toggle-pin="sidebar"><i class="fa fs-12"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-menu">

        <ul class="menu-items">
            <li>
                <a href="{{ route('dashboard') }}">
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:;"><span class="title">Users</span>
                    <span class=" arrow"></span></a>
                <span class="icon-thumbnail"><i class="pg-alt_menu"></i></span>
                <ul class="sub-menu">
                    <li class="">
                        <a href="{{route('viewLoanee')}}">View Users</a>
                        <span class="icon-thumbnail">vl</span>
                    </li>
                    <li class="">
                        <a href="{{route('viewAgent')}}">View Agents</a>
                        <span class="icon-thumbnail">vl</span>
                    </li>
                </ul>
            </li>
            @if(Auth::User()->isAdmin)
                <li class="">
                    <a href="{{route('giveLoanView')}}">Give Payments</a>
                    <span class="icon-thumbnail">gl</span>
                </li>
            @endif
            <li class="">
                <a href="{{route('viewLoans')}}">View Payments</a>
                <span class="icon-thumbnail">vl</span>
            </li>
            <li class="">
                <a href="{{route('showRecordView')}}">Show all Pending Records</a>
                <span class="icon-thumbnail">ar</span>
            </li>
            {{--<li>--}}
                {{--<a href="javascript:;"><span class="title">Records</span>--}}
                    {{--<span class=" arrow"></span></a>--}}
                {{--<span class="icon-thumbnail"><i class="pg-note"></i></span>--}}
                {{--<ul class="sub-menu">--}}
                    {{--<li class="">--}}
                        {{--<a href="{{route('todaysRecords')}}">View Today's Records</a>--}}
                        {{--<span class="icon-thumbnail">vr</span>--}}
                    {{--</li>--}}
                    {{----}}


                {{--</ul>--}}
            {{--</li>--}}

            <!--   <li>
                  <a href="javascript:;"><span class="title">Penalty</span>
                      <span class=" arrow"></span></a>
                  <span class="icon-thumbnail"><i class="pg-calender"></i></span>
                  <ul class="sub-menu">
                      <li class="">
                          <a href="calendar.html">Charge Penaty</a>
                          <span class="icon-thumbnail">cp</span>
                      </li>
                      <li class="">
                          <a href="calendar_lang.html">View Penalties</a>
                          <span class="icon-thumbnail">vp</span>
                      </li>
                  </ul>
              </li> -->

        <!--   <li>
                <a href="javascript:;"><span class="title">Backup</span>
                    <span class=" arrow"></span></a>
                <span class="icon-thumbnail"><i class="pg-servers"></i></span>
                <ul class="sub-menu">
                    <li class="">
                        <a href="{{route('startBackup')}}">Export Backup</a>
                        <span class="icon-thumbnail">eb</span>
                    </li>
                    <li class="">
                        <a href="calendar_lang.html">Import Backup</a>
                        <span class="icon-thumbnail">ib</span>
                    </li>
                </ul>
            </li> -->

            <li>
                <a href="{{route('daily_reports')}}">Daily Reports</a>
            </li>
            @if(Auth::User())
                <li>
                    <a href="{{route('changePasswordView')}}">Change Password</a>
                </li>
            @endif
            @if(Auth::User()->isAdmin)
                <li>
                    <a href="{{ route('register') }}">CreateUser</a>
                </li>
            @endif
            <!--@if(Auth::User()->isAdmin)
                <li>
                    <a href="{{ route('startBackup') }}">Backup</a>
                </li>
            @endif
            @if(Auth::User()->isAdmin)
                <li>
                    <a href="{{ route('RestoreView') }}">Restore</a>
                </li>
            @endif -->
            @if(Auth::User())
                <li>

                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>