@extends('admin.master')

@section('title')
Manage Auctions
@endsection

@section('content')

<hr/>
<div class="row">
    <div class="col-md-2">
        {!! Form::open(['url'=>'/admin/auction-id/', 'method'=>'POST', 'class'=>'form-inline'])!!}
        {{ csrf_field() }}
            <form class="form-inline" style="float: right;">
                <div class="input-group">
                    <input type="number" id="auctionId" max="" name="auctionId" style="width: 100px;">
                </div>
                <button type="submit" class="btn btn-circle btn-success"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        {!! Form::close()!!}
    </div>
    <div class="col-md-3">
        {!! Form::open(['url'=>'/admin/auction-ondate/', 'method'=>'POST', 'class'=>'form-inline'])!!}
        {{ csrf_field() }}
            <form class="form-inline" style="float: right;">
                <label>Auction On</label>
                <div class="input-group">
                    <input type="date" id="auctionOnDate" name="auctionOnDate">
                </div>
                <button type="submit" class="btn btn-circle btn-success"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        {!! Form::close()!!}
    </div>
    <div class="col-md-3">
        {!! Form::open(['url'=>'/admin/auction-enddate/', 'method'=>'POST', 'class'=>'form-inline'])!!}
        {{ csrf_field() }}
            <form class="form-inline" style="float: right;">
                <label>Auction Off</label>
                <div class="input-group">
                    <input type="date" id="auctionExpiryDate" name="auctionExpiryDate">
                </div>
                <button type="submit" class="btn btn-circle btn-success"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        {!! Form::close()!!}
    </div>
    <div class="col-md-3">
        {!! Form::open(['url'=>'/admin/auction-search/', 'method'=>'POST', 'class'=>'form-inline'])!!}
        {{ csrf_field() }}
            <form class="form-inline" style="float: right;">
                <div class="input-group">
                    <input type="search" class="form-control" id="searchAuctionTitle" name="searchAuctionTitle" placeholder="Search here">
                </div>
                <button type="submit" class="btn btn-circle btn-success"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        {!! Form::close()!!}
        <script type="text/javascript">
            $( function() {
              $( "#searchAuctionTitle" ).autocomplete({
                source: 'http://localhost/www.resale.com/search'
              });
            } );
        </script>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-12">
       {!! Form::open(['url'=>'/admin/auction-price/', 'method'=>'POST', 'class'=>'form-inline'])!!}
        {{ csrf_field() }}
            <form class="form-inline" style="float: right;">
                <label>Minimum Price</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="minPrice" name="minPrice">
                </div>
                <label>Maximum Price</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="maxPrice" name="maxPrice">
                </div>
                <button type="submit" class="btn btn-circle btn-success"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        {!! Form::close()!!}
    </div>
</div>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Ad ID</th>
            <th>Auction Title</th>
            <th>Auction Description</th>
            <th>Condition</th>
            <th>Price</th>
            <th>Images</th>
            <th>Comments</th>
            <th>Bids</th>
            <th>Auctioneer Profile</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allAuctions as $allAuction)
        <tr>
            <td scope="row">{{$allAuction->id}}</td>
            <td>{{$allAuction->auctionTitle}}</td>
            <td>{{$allAuction->auctionDescription}}</td>
            <td>{{$allAuction->condition == 1 ? 'Used':'New' }}</td>
            <td>{{$allAuction->price}}</td>
            <td><img src="{{asset($allAuction->adImage1)}}" alt="adImage1" height="100px" width="100px">
                <br/><hr/><img src="{{asset($allAuction->adImage2)}}" alt="adImage2" height="100px" width="100px">
                <br/><hr/><img src="{{asset($allAuction->adImage3)}}" alt="adImage3" height="100px" width="100px">
            </td>
            <td>
                <a href="{{url('admin/auction-comments/'.$allAuction->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('admin/auction-bids/'.$allAuction->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('admin/user-details/'.$allAuction->user_id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('/admin/auction/show/'.$allAuction->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-info-sign"></span>
                </a>
                <a href="{{url('/admin/auction/delete/'.$allAuction->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$allAuctions->links()}}
@endsection
