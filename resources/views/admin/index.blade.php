<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')
    <body>
        <div class="wrapper">
            <!-- top navbar-->
            @include('layouts.header')
            @include('layouts.sidebar')
            <aside class="offsidebar d-none">
                @include('layouts.navbar')
            </aside>
            <!-- Main section-->
            <section class="section-container">
                <!-- Page content-->
                <div class="content-wrapper">
                    <div class="content-heading">
                        <div>Dashboard<small data-localize="dashboard.WELCOME"></small></div>
                        <!-- START Language list-->
                    </div>
                    <!-- START cards box-->
                    @include('layouts.cards')
                    <div class="row">
                        <!-- START dashboard main content-->
                        <div class="col-xl-12">
                            <!-- START chart-->
                            <div class="row">
                                <div class="col-xl-12">
                                    <!-- START card-->
                                    <!-- START messages and activity-->
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <div class="card-title">Upload Logs</div>
                                        </div>
                                        <!-- START list group-->
                                        <div class="list-group">
                                            <!-- START list group item-->
                                            @foreach ($file_logs as $log)
                                            <div class="list-group-item">
                                                <div class="media">
                                                    <div class="align-self-start mr-2"><span class="fa-stack"><em class="fa fa-circle fa-stack-2x text-purple"></em><em class="fas fa-cloud-upload-alt fa-stack-1x fa-inverse text-white"></em></span></div>
                                                    <div class="media-body text-truncate">
                                                        <p class="mb-1"><a class="text-purple m-0" href="#" style="text-transform: capitalize">{{ $log->subject }}</a></p>
                                                        <p class="m-0"><small style="text-transform: capitalize">Class : <a href="#">{{ $log->class }}</a></small></p>
                                                        <p class="m-0"><small style="text-transform: capitalize">Type : <a href="#">{{ $log->document_type }}</a></small></p>
                                                        <p class="m-0"><small style="text-transform: capitalize">Uploaded By : <a href="#">{{ $log->teachers_name }}</a></small></p>
                                                    </div>
                                                    <div class="ml-auto"><small class="text-muted ml-2">Date : {{ date($log->created_at) }}</small></div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <!-- END list group-->
                                        <!-- START card footer-->
                                        <div class="card-footer"><a class="text-sm" href="#">Load more</a></div>
                                        <!-- END card-footer-->
                                    </div>
                                    <!-- END messages and activity-->
                                </div>
                            </div>
                            <!-- END chart-->
                        </div>
                        <!-- END dashboard main content-->
                        <!-- START dashboard sidebar-->
                        {{-- <aside class="col-xl-3">
                            <!-- START loader widget-->
                            <div class="card card-default">
                                <div class="card-body">
                                    <a class="text-muted float-right" href="#"><em class="fa fa-arrow-right"></em></a>
                                    <div class="text-info">Average Monthly Uploads</div>
                                    <div class="text-center py-4">
                                        <div class="easypie-chart easypie-chart-lg" data-easypiechart data-percent="70" data-animate="{&quot;duration&quot;: &quot;800&quot;, &quot;enabled&quot;: &quot;true&quot;}" data-bar-color="#23b7e5" data-track-Color="rgba(200,200,200,0.4)" data-scale-Color="false" data-line-width="10" data-line-cap="round" data-size="145"><span>70%</span></div>
                                    </div>
                                    <div class="text-center" data-sparkline="" data-bar-color="#23b7e5" data-height="30" data-bar-width="5" data-bar-spacing="2" data-values="5,4,8,7,8,5,4,6,5,5,9,4,6,3,4,7,5,4,7"></div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-muted"><em class="fa fa-upload fa-fw"></em><span>This Month</span><span class="text-dark">1000 Gb</span></p>
                                </div>
                            </div>
                            <!-- END loader widget-->
                        </aside> --}}
                        <!-- END dashboard sidebar-->
                    </div>
                </div>
            </section>
            <!-- Page footer-->
            @include('layouts.footer')
        </div>
        <!-- =============== VENDOR SCRIPTS ===============-->
        <!-- MODERNIZR-->
        @include('layouts.javascript')
    </body>
</html>