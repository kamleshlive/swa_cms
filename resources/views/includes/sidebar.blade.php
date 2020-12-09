<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('/bower_components/admin-lte/dist/img/default-50x50.gif') }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>@if(Auth::user()) {{ucfirst(Auth::user()->name)}} @else {{'Testing'}} @endif</p>
                    <!-- Status -->
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENU</li>
                @if (Auth::check())


                    <li class="treeview ">
                        <a href="#"><i class="fa fa-home"></i>Home<span> <i class="fa fa-bars pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('home-banners')}}">Banner</a></li>
                            <li><a href="{{url('latest-videos')}}">Latest Video</a></li>
                            <li><a href="{{url('events')}}">SWA Events</a></li>
                            <li><a href="{{url('updates')}}">SWA Updates</a></li>
                            <li><a href="{{url('articles')}}">SWA Articles</a></li>
                            <li><a href="{{url('desi-script-writer')}}">Desi Script Writer</a></li>
                            <!-- <li><a href="{{url('media-center')}}">Media Center</a></li> -->
                            <li class="treeview">
                                <a href="#"><i class="fa fa-medium"></i>Media Center<span> <i class="fa fa-ellipsis-h pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    <li><a href="{{url('mediacenter')}}">Media Center Image<i class="fa fa-angle-right  pull-right"></i></a></li>
                                    <li><a href="{{url('media-center')}}">Media Center Docs<i class="fa fa-angle-right  pull-right"></i></a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-home"></i>Articles<span> <i class="fa fa-bars pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('author-articles')}}">Articles</a></li>
                            <li><a href="{{url('categories')}}">Categories</a></li>
                            <li><a href="{{url('authors')}}">Authors</a></li>
                        </ul>
                    </li>
                    <li class="treeview ">
                        <a href="#"><i class="fa fa-home"></i>Committee<span> <i class="fa fa-bars pull-right"></i></span></a>
                        <ul class="treeview-menu">
                          <li><a href="{{url('commitee')}}">Committee <i class="fa fa-angle-right  pull-right"></i></a></li>
                          <li><a href="{{url('member')}}">Members<i class="fa fa-angle-right  pull-right"></i></a></li>
                          <li><a href="{{url('staffs')}}">Staffs <i class="fa fa-angle-right  pull-right"></i></a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('legalquetions')}}">Legal Questions <i class="fa fa-chevron-right  pull-right"></i></a></li>
                    <li><a href="{{url('downloads')}}">Download  <i class="fa fa-chevron-right  pull-right"></i></a></li>
                    <li><a href="{{url('faq')}}">FAQ <i class="fa fa-chevron-right pull-right"></i></a></li>


                @endif
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
