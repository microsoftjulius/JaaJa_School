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
                        <div class="user-block-status"><img class="img-thumbnail rounded-circle" src="{{ asset('design/img/Logo.png')}}" alt="Avatar" width="60" height="60">
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
                <div class="float-right badge badge-success"><i class="fa fa-arrow-down"></i></div><em class="icon-speedometer"></em><span data-localize="sidebar.nav.DASHBOARD">Dashboard</span>
            </a>
            @if(in_array("Can view home dashboard", auth()->user()->getUserPermisions()) || 
                in_array("Can view notes reports", auth()->user()->getUserPermisions()) ||
                in_array("Can view homework reports", auth()->user()->getUserPermisions()) ||
                in_array("Can view questions reports", auth()->user()->getUserPermisions()) ||
                in_array("Can view answers reports", auth()->user()->getUserPermisions()))
            <ul class="sidebar-nav sidebar-subnav collapse" id="dashboard">
                <li class="sidebar-subnav-header">Dashboard</li>
                @if(in_array("Can view home dashboard", auth()->user()->getUserPermisions()))
                    <li @if(request()->route()->getName() == "home")class=" active" @else class=" " @endif><a href="/home" title="Home"><span>Home</span></a></li>
                @endif
                @if(in_array("Can view notes reports", auth()->user()->getUserPermisions()))
                    <li @if(request()->route()->getName() == "Notes Reports")class=" active" @else class=" " @endif><a href="/get-class-notes-reports" title="Notes Reports"><span>Notes Reports</span></a></li>
                @endif
                @if(in_array("Can view homework reports", auth()->user()->getUserPermisions()))
                    <li @if(request()->route()->getName() == "Home Work Reports")class=" active" @else class=" " @endif><a href="/get-homeworks-reports" title="Home Work Reports"><span>Home work Reports</span></a></li>
                @endif
                @if(in_array("Can view questions reports", auth()->user()->getUserPermisions()))
                <li @if(request()->route()->getName() == "Questions Reports")class=" active" @else class=" " @endif><a href="/get-questions-reports" title="Questions Reports"><span>Questions Reports</span></a></li>
                @endif
                @if(in_array("Can view answers reports", auth()->user()->getUserPermisions()))
                <li @if(request()->route()->getName() == "Answers Reports")class=" active"@else class=" " @endif><a href="/get-answers-reports" title="Answers Reports"><span>Answers Reports</span></a></li>
                @endif
            </ul>
            @endif
            </li>
            @if(in_array("Can view classes page", auth()->user()->getUserPermisions()))
            <li @if(request()->route()->getName() == "Classes")class=" active" @else class=" " @endif>
                <a href="/display-classes" title="Classes">
                    <em class="fa fa-home"></em><span data-localize="sidebar.nav.WIDGETS">Classes</span>
                </a>
            </li>
            @endif
            <li @if(request()->route()->getName() == "Subjects")class=" active" @else class=" " @endif>
                <a href="/display-subjects" title="Subjects" >
                    <em class="fa fa-list"></em><span data-localize="sidebar.nav.WIDGETS">Subjects</span>
                </a>
            </li>
            @if(in_array("Can view homeworks page", auth()->user()->getUserPermisions()))
            <li @if(request()->route()->getName() == "Home Work")class=" active" @else class=" " @endif>
                <a href="/display-home-work" title="Home Work" >
                    <em class="fa fa-tasks"></em><span data-localize="sidebar.nav.WIDGETS">Home work</span>
                </a>
            </li>
            @endif
            @if(in_array("Can view questions page", auth()->user()->getUserPermisions()))
            <li @if(request()->route()->getName() == "Questions")class=" active" @else class=" " @endif>
                <a href="/get-all-questions" title="Questions">
                    <em class="fa fa-question"></em><span data-localize="sidebar.nav.WIDGETS">Questions</span>
                </a>
            </li>
            @endif
            @if(in_array("Can view notes page", auth()->user()->getUserPermisions()))
            <li @if(request()->route()->getName() == "Notes")class=" active" @else class=" " @endif>
                <a href="/display-notes" title="Notes">
                    <em class="fa fa-book"></em><span data-localize="sidebar.nav.WIDGETS">Notes</span>
                </a>
            </li>
            @endif
            @if(in_array("Can view past papers page", auth()->user()->getUserPermisions()))
            <li @if(request()->route()->getName() == "Past Papers")class=" active" @else class=" " @endif>
                <a href="/get-past-papers" title="Notes">
                    <em class="fa fa-book"></em><span data-localize="sidebar.nav.WIDGETS">Past Papers</span>
                </a>
            </li>
            @endif
            @if(in_array("Can view parents page", auth()->user()->getUserPermisions()))
            <li @if(request()->route()->getName() == "Parents")class=" active" @else class=" " @endif>
                <a href="/get-parents" title="Parents">
                    <em class="fa fa-users"></em><span data-localize="sidebar.nav.WIDGETS">Parents</span>
                </a>
            </li>
            @endif
            @if(in_array("Can view students page", auth()->user()->getUserPermisions()))
            <li @if(request()->route()->getName() == "Students")class=" active" @else class=" " @endif>
                <a href="/students" title="Students">
                    <em class="fa fa-users"></em><span data-localize="sidebar.nav.WIDGETS">Students</span>
                </a>
            </li>
            @endif
            {{-- <li @if(request()->route()->getName() == "Schools")class=" active" @else class=" " @endif>
                <a href="/get-schools" title="Schools">
                    <em class="fa fa-university"></em><span data-localize="sidebar.nav.WIDGETS">Schools</span>
                </a>
            </li> --}}
            @if(in_array("Can view teachers page", auth()->user()->getUserPermisions()))
            <li @if(request()->route()->getName() == "Teachers")class=" active" @else class=" " @endif>
                <a href="/display-teachers" title="Teachers">
                    <em class="fa fa-users"></em><span data-localize="sidebar.nav.WIDGETS">Teachers</span>
                </a>
            </li>
            @endif
            @if(in_array("Can view all users", auth()->user()->getUserPermisions()))
            <li @if(request()->route()->getName() == "Users")class=" active" @else class=" " @endif>
                <a href="/get-users" title="All Users">
                    <em class="fa fa-users"></em><span data-localize="sidebar.nav.WIDGETS">All Users</span>
                </a>
            </li>
            @endif
            <li class=" ">
                <a href="#settings" title="Dashboard" data-toggle="collapse">
                    <div class="float-right badge badge-success"><i class="fa fa-arrow-down"></i></div><em class="fa fa-cogs"></em><span data-localize="sidebar.nav.DASHBOARD">Settings</span>
                </a>
            <ul class="sidebar-nav sidebar-subnav collapse" id="settings">
                <li class="sidebar-subnav-header">Settings</li>
                @if(in_array("Can View Roles and Permissions", auth()->user()->getUserPermisions()))
                <li @if(request()->route()->getName() == "Settings")class=" active" @else class=" " @endif>
                    <a href="/get-settings-page" title="Settings">
                        <span data-localize="sidebar.nav.WIDGETS">Roles And Permissions</span>
                    </a>
                </li>
                @endif
                @if(in_array("Can assign permissions to a role", auth()->user()->getUserPermisions()))
                <li @if(request()->route()->getName() == "Assign Roles")class=" active" @else class=" " @endif>
                    <a href="/get-assign-roles-page" title="Settings">
                        <span data-localize="sidebar.nav.WIDGETS">Assign Roles</span>
                    </a>
                </li>
                @endif
                <li @if(request()->route()->getName() == "Change Password")class=" active" @else class=" " @endif>
                    <a href="/change-password" title="Change Password">
                        <span data-localize="sidebar.nav.WIDGETS">Change Password</span>
                    </a>
                </li>
            </ul>
            </li>
            <li class=" ">
                <a href="/logout" title="Lock">
                    <em class="fa fa-lock"></em><span data-localize="sidebar.nav.WIDGETS">Logout</span>
                </a>
            </li>
        </ul><!-- END sidebar nav-->
    </nav>
</div><!-- END Sidebar (left)-->
</aside><!-- offsidebar-->