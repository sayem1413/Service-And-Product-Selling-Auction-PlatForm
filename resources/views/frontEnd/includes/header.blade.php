<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="logo">
                    <a href="{{url('/home')}}"><span>Re</span>sale</a>
                </div>
            </div>
            <div class="col-md-4">
            {!! Form::open(['url'=>'/header/search', 'method'=>'POST', 'class'=>'form-inline'])!!}
            {{ csrf_field() }}
                <form class="form-inline" style="float: right;">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="padding-top: 20px;">
                        <input type="search" class="form-control" id="searchHeader" name="searchHeader" placeholder="Search here">
                    </div>
                    <button type="submit" class="btn btn-circle btn-success" style="margin-top: 20px;"><i class="glyphicon glyphicon-search"></i></button>
                </form>
            {!! Form::close()!!}
                <script type="text/javascript">
                    $( function() {
                      $( "#searchHeader" ).autocomplete({
                        source: 'http://localhost/www.resale.com/search'
                      });
                    } );
                </script>
            </div>
            <div class="col-md-6">
                <div class="header-right">
                    <!-- Authentication Links -->

                    @guest
                    <a class="account" href="{{route('login')}}">Login</a>
                    @else
                    <a class="account" href="{{url('/post-ad/category-area-select')}}" style="padding-right: 20px; margin-right: 20px;">Post Ad</a>
                    <a class="account" href="{{url('/profile')}}" style="padding-right: 20px; margin-right: 20px;">Profile</a>
                    <ul class="navbar-nav" style="padding-top: 27px;">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link-text dropdown-toggle" href="{{url('/profile')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item btn btn-block" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>

<!-- <span class="active uls-trigger">Select language</span> -->
                    <!-- Large modal -->
                    <div class="selectregion">
                        <button class="btn btn-primary">
                            Select Your Region</button>
                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;</button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            Please Choose Your Location Manually</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <select id="basic2" class="show-tick form-control" multiple>
                                                    @foreach($divisions as $division)
                                                    <optgroup label="{{$division->divisionName}}">
                                                        @foreach($districts as $district)
                                                        @if($district->division_id == $division->id)
                                                        <option><a href="{{url('/search/result/')}}">{{$district->districtName}}</a></option>
                                                    @endif
                                                    @endforeach
                                                    </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form class="form-inline">
                <input type="search" class="form-control">
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>-->