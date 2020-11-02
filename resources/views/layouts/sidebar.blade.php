<aside class="aside-container">
<!-- START Sidebar (left)-->
<div class="aside-inner">
    <nav class="sidebar" data-sidebar-anyclick-close="">
        <!-- START sidebar nav-->
        <ul class="sidebar-nav">
            <!-- START user info-->
            <li class="has-user-block">
            <div class="collapse" id="user-block">
                <div class="item user-block">
                    <!-- User picture-->
                    <div class="user-block-picture">
                        <div class="user-block-status"><img class="img-thumbnail rounded-circle" src="{{ asset('design/img/user/02.jpg')}}" alt="Avatar" width="60" height="60">
                        <div class="circle bg-success circle-lg"></div>
                        </div>
                    </div><!-- Name and Job-->
                    <div class="user-block-info"><span class="user-block-name">Hello, {{ auth()->user()->name }}</span><span class="user-block-role">{{ auth()->user()->category }}</span></div>
                </div>
            </div>
            </li><!-- END user info-->
            <!-- Iterates over all sidebar items-->
            <li class="nav-heading "><span data-localize="sidebar.heading.HEADER">Main Navigation</span></li>
            <li class=" "><a href="#dashboard" title="Dashboard" data-toggle="collapse">
                <div class="float-right badge badge-success">3</div><em class="icon-speedometer"></em><span data-localize="sidebar.nav.DASHBOARD">Dashboard</span>
            </a>
            <ul class="sidebar-nav sidebar-subnav collapse" id="dashboard">
                <li class="sidebar-subnav-header">Dashboard</li>
                <li @if(request()->route()->getName() == "home")class=" active" @else class=" " @endif><a href="/home" title="Home"><span>Home</span></a></li>
                <li @if(request()->route()->getName() == "Notes Reports")class=" active" @else class=" " @endif><a href="/" title="Dashboard v1"><span>Notes Reports</span></a></li>
                <li @if(request()->route()->getName() == "Home Work Reports")class=" active" @else class=" " @endif><a href="/" title="Dashboard v2"><span>Home work Reports</span></a></li>
                <li @if(request()->route()->getName() == "Questions Reports")class=" active" @else class=" " @endif><a href="/" title="Dashboard v3"><span>Questions Reports</span></a></li>
                <li @if(request()->route()->getName() == "Answers Reports")class=" active"@else class=" " @endif><a href="/" title="Dashboard v3"><span>Answers Reports</span></a></li>
            </ul>
            </li>
            <li @if(request()->route()->getName() == "Classes")class=" active" @else class=" " @endif>
                <a href="/display-classes" title="Classes">
                    <em class="fa fa-home"></em><span data-localize="sidebar.nav.WIDGETS">Classes</span>
                </a>
            </li>
            <li @if(request()->route()->getName() == "Subjects")class=" active" @else class=" " @endif>
                <a href="/display-subjects" title="Subjects" >
                    <em class="fa fa-list"></em><span data-localize="sidebar.nav.WIDGETS">Subjects</span>
                </a>
            </li>
            <li @if(request()->route()->getName() == "Home Work")class=" active" @else class=" " @endif>
                <a href="/display-home-work" title="Home Work" >
                    <em class="fa fa-tasks"></em><span data-localize="sidebar.nav.WIDGETS">Home work</span>
                </a>
            </li>
            <li @if(request()->route()->getName() == "Questions")class=" active" @else class=" " @endif>
                <a href="/get-all-questions" title="Questions">
                    <em class="fa fa-question"></em><span data-localize="sidebar.nav.WIDGETS">Questions</span>
                </a>
            </li>
            <li @if(request()->route()->getName() == "Notes")class=" active" @else class=" " @endif>
                <a href="/display-notes" title="Notes">
                    <em class="fa fa-book"></em><span data-localize="sidebar.nav.WIDGETS">Notes</span>
                </a>
            </li>
            <li @if(request()->route()->getName() == "Past Papers")class=" active" @else class=" " @endif>
                <a href="/get-past-papers" title="Notes">
                    <em class="fa fa-book"></em><span data-localize="sidebar.nav.WIDGETS">Past Papers</span>
                </a>
            </li>
            <li @if(request()->route()->getName() == "Parents")class=" active" @else class=" " @endif>
                <a href="/get-parents" title="Parents">
                    <em class="fa fa-users"></em><span data-localize="sidebar.nav.WIDGETS">Parents</span>
                </a>
            </li>
            <li @if(request()->route()->getName() == "Students")class=" active" @else class=" " @endif>
                <a href="/students" title="Students">
                    <em class="fa fa-users"></em><span data-localize="sidebar.nav.WIDGETS">Students</span>
                </a>
            </li>
            {{-- <li @if(request()->route()->getName() == "Schools")class=" active" @else class=" " @endif>
                <a href="/get-schools" title="Schools">
                    <em class="fa fa-university"></em><span data-localize="sidebar.nav.WIDGETS">Schools</span>
                </a>
            </li> --}}
            <li @if(request()->route()->getName() == "Teachers")class=" active" @else class=" " @endif>
                <a href="/display-teachers" title="Teachers">
                    <em class="fa fa-users"></em><span data-localize="sidebar.nav.WIDGETS">Teachers</span>
                </a>
            </li>
            <li @if(request()->route()->getName() == "Users")class=" active" @else class=" " @endif>
                <a href="/get-users" title="All Users">
                    <em class="fa fa-users"></em><span data-localize="sidebar.nav.WIDGETS">All Users</span>
                </a>
            </li>
            <li @if(request()->route()->getName() == "Change Password")class=" active" @else class=" " @endif>
                <a href="/change-password" title="Change Password">
                    <em class="fa fa-key"></em><span data-localize="sidebar.nav.WIDGETS">Change Password</span>
                </a>
            </li>
            {{-- <li class=" ">
                <a href="#" title="Settings">
                    <em class="fa fa-cog"></em><span data-localize="sidebar.nav.WIDGETS">Settings</span>
                </a>
            </li> --}}
            <li class=" ">
                <a href="/logout" title="Lock">
                    <em class="fa fa-lock"></em><span data-localize="sidebar.nav.WIDGETS">Logout</span>
                </a>
            </li>
        </ul><!-- END sidebar nav-->
    </nav>
</div><!-- END Sidebar (left)-->
</aside><!-- offsidebar-->