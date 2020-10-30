<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-primary-dark justify-content-center rounded-left"><em class="icon-globe fa-3x"></em></div>
            <div class="col-8 py-3 bg-primary rounded-right">
                <div class="h2 mt-0">{{ $number_of_online_users }}</div>
                <div class="text-uppercase">Online</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-purple-dark justify-content-center rounded-left"><em class="fa fa-exclamation-circle fa-3x"></em></div>
            <div class="col-8 py-3 bg-purple rounded-right">
                <div class="h2 mt-0">{{ $number_of_offline_users }}</div>
                <div class="text-uppercase">Offline</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-green-dark justify-content-center rounded-left"><em class="fa fa-users fa-3x"></em></div>
            <div class="col-8 py-3 bg-green rounded-right">
                <div class="h2 mt-0">{{ $number_of_students }}</div>
                <div class="text-uppercase">Students</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-info-dark justify-content-center rounded-left">
                <em class="fa fa-users fa-3x"></em></div>
            <div class="col-8 py-3 bg-info rounded-right">
                <div class="h2 mt-0">{{ $number_of_parents }}</div>
                <div class="text-uppercase">Parents</div>
            </div>
        </div>
    </div>
</div><!-- END cards box-->