@extends('frontEnd.master2')

@section('title')
{{$auctionDetails->auctionTitle}}
@endsection

@section('mainContent')
<!--single-page-->
<div class="single-page main-grid-border">
    <div class="container">
        <div class="product-desc">
            <div class="col-md-7 product-view">
                <h2>{{$auctionDetails->auctionTitle}}</h2>
                <p> <i class="glyphicon glyphicon-map-marker"></i><a href="#">{{$auctionDetails->districtName}}</a>, <a href="#">{{$auctionDetails->divisionName}}</a>| Added at {{$auctionDetails->created_at}}, Ad ID: {{$auctionDetails->id}}</p>
                <div class="flexslider">
                    <ul class="slides">
                        <li data-thumb="{{asset($auctionDetails->adImage1)}}">
                            <img src="{{asset($auctionDetails->adImage1)}}" />
                        </li>
                        <li data-thumb="{{asset($auctionDetails->adImage2)}}">
                            <img src="{{asset($auctionDetails->adImage2)}}" />
                        </li>
                        <li data-thumb="{{asset($auctionDetails->adImage3)}}">
                            <img src="{{asset($auctionDetails->adImage3)}}" />
                        </li>
                    </ul>
                </div>
                <!-- FlexSlider -->
                <script defer src="{{asset('public/frontEnd/js/jquery.flexslider.js')}}"></script>
                <link rel="stylesheet" href="{{asset('public/frontEnd/css/flexslider.css')}}" type="text/css" media="screen" />

                <script>
                // Can also be used with $(document).ready()
                $(window).load(function () {
                    $('.flexslider').flexslider({
                        animation: "slide",
                        controlNav: "thumbnails"
                    });
                });
                </script>
                <!-- //FlexSlider -->
                <div class="product-details">
                    <!--                    <h4>Brand : <a href="#">Company name</a></h4>
                                        <h4>Views : <strong>150</strong></h4>
                                        <p><strong>Display </strong>: 1.5 inch HD LCD Touch Screen</p>-->
                    <p><strong>Description</strong> : {{$auctionDetails->auctionDescription}}</p>

                </div>
            </div>
            <div class="col-md-5 product-details-grid">
                <div class="item-price">
                    <div class="product-price">
                        <p class="p-price">Price : </p>
                        <h3 class="rate">&#x9f3 {{$auctionDetails->price}}tk </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="condition">
                        <p class="p-price">Condition : </p>
                        <p><strong>{{$auctionDetails->condition == 1 ? 'Used':'New' }}</strong></p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="itemtype">
                        <p class="p-price">Item Type : </p>
                        <p><strong>{{$auctionDetails->subCategoryName}}</strong></p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="itemtype">
                        @if($currentTime >= $auctionEndDateTime)
                        <p class="p-price"><strong>Auction Time Over </strong></p>
                        @else
                        <p class="p-price"><strong>Time Remaining: </strong></p>
                        <table style="border:0px;">
                            <tr>
                                <td colspan="8"><span id="future_date"></span></td>
                            </tr>
                        </table>
                        <div class="clearfix"></div>
                        @endif
                    </div>
                    <div class="itemtype">
                        @guest
                        @if($currentTime >= $auctionEndDateTime)
                        @if(count($bidWinner) === 1)
                            <h4>Auction has been completed!<small>Winner Profile: <a href="{{url('/user/profile-view/'.$winnerInfo->id)}}">{{$winnerInfo->name}}</a></small></h4>
                            <p>The bidding price is: <strong>{{$bidWinner->fee}}</strong></p>
                        @else
                            <h4>Auction has been completed!<small>But unfortunately! No one bid here!</small></h4>
                            <p>The Auction price was: <strong>{{$auctionDetails->price}}</strong></p>
                        @endif
                        @else
                            <h4>Interested for bid?<br/><small> Click the bid button!</small></h4>
                            <a href="{{route('login')}}" class="btn btn-success btn-block">Login for Place Bid</a>
                        @endif
                        @else
                        @if($currentTime >= $auctionEndDateTime)
                        @if(count($bidWinner) === 1)
                            <h4>Auction has been completed!<small>Winner Profile: <a href="{{url('/user/profile-view/'.$winnerInfo->id)}}">{{$winnerInfo->name}}</a></small></h4>
                            <p>The bidding price is: <strong>{{$bidWinner->fee}}</strong></p>
                        @else
                            <h4>Auction has been completed!<small>But unfortunately! No one bid here!</small></h4>
                            <p>The Auction price was: <strong>{{$auctionDetails->price}}</strong></p>
                        @endif
                        @else
                        @if(Auth::user()->id == $auctionDetails->user_id)
                            <h4>You can't bid here</h4>
                            <p><strong>Because, you created this auction!</strong></p>
                        @else
                        @if(count($isUserHasBid) === 1)
                            <h4>Your bid is completed!</h4>
                            <p><strong> You have already bid this auction. Your bidding price is: {{$isUserHasBid->fee}} </strong></p>
                        @else
                            <h4>Interested for bid?<br/><small> Click the bid button!</small></h4>
                            <button class="btn btn-success btn-block"  data-toggle="modal" data-target="#myModal">Place Bid</button>
                        @endif
                        @endif
                        @endif
                        @endguest
                    </div>
                </div>
                <script type="text/javascript" src="{{asset('public/frontEnd/timer/js/jQuery.countdownTimer.js')}}"></script>
                <script type="text/javascript">
                    $(function () {

                        $('#future_date').countdowntimer({
                            dateAndTime: "{{$auctionDetails->auctionExpiryDate}}",
                            labelsFormat: true,
                            displayFormat: "YODHMS"
                        });
                    });
                </script>
                <div class="interested text-center">
                    @if(count($hasBids) > 0)
                    <table class="table table-borderless table-info">
                        <thead>
                            <th>Bider</th>
                            <th>Biding Price</th>
                        </thead>
                        @foreach($hasBids as $hasBid)
                        <tbody>
                        <td  scope="row"><a href="{{url('/user/profile-view/'.$hasBid->user_id)}}">{{$hasBid->name}}</a></td>
                        <td>{{$hasBid->fee}}</td>
                        </tbody>
                        @endforeach
                    </table>
                    @else
                    <h2>No one bids here!</h2>
                    @endif
                </div>
                <div class="interested text-center">
                    <h4>Interested in this Ad?<br/><small> Contact the Seller!</small></h4>
                    <p><i class="glyphicon glyphicon-earphone"></i>{{$auctionDetails->phoneNumber}}</p>
                    <br/>
                    <h4><small> View seller profile!</small></h4>
                    <p><i class="glyphicon glyphicon-user"></i><a href="{{url('/user/profile-view/'.$auctionDetails->user_id)}}"><b>{{$auctionDetails->name}}</b></a> </p>
                </div>
<!--                @guest
                @if($currentTime >= $auctionEndDateTime)
                @if(count($bidWinner) === 1)
                <div class="interested text-center">
                    <h4>Auction has been completed!<small>Winner Profile: <a href="{{url('/user/profile-view/'.$winnerInfo->id)}}">{{$winnerInfo->name}}</a></small></h4>
                    <p>The bidding price is: <strong>{{$bidWinner->fee}}</strong></p>
                </div>
                @else
                <div class="interested text-center">
                    <h4>Auction has been completed!<small>But unfortunately! No one bid here!</small></h4>
                    <p>The Auction price was: <strong>{{$auctionDetails->price}}</strong></p>
                </div>
                @endif
                @else
                <div class="interested text-center">
                    <h4>Interested for bid?<br/><small> Click the bid button!</small></h4>
                    <a href="{{route('login')}}" class="btn btn-success btn-block">Login for Place Bid</a>
                </div>
                @endif
                @else
                @if($currentTime >= $auctionEndDateTime)
                @if(count($bidWinner) === 1)
                <div class="interested text-center">
                    <h4>Auction has been completed!<small>Winner Profile: <a href="{{url('/user/profile-view/'.$winnerInfo->id)}}">{{$winnerInfo->name}}</a></small></h4>
                    <p>The bidding price is: <strong>{{$bidWinner->fee}}</strong></p>
                </div>
                @else
                <div class="interested text-center">
                    <h4>Auction has been completed!<small>But unfortunately! No one bid here!</small></h4>
                    <p>The Auction price was: <strong>{{$auctionDetails->price}}</strong></p>
                </div>
                @endif
                @else
                @if(count($isUserHasBid) === 1)
                <div class="interested text-center">
                    <h4>Your bid is completed!</h4>
                    <p><strong> You have already bid this auction. Your bidding price is: {{$isUserHasBid->fee}} </strong></p>
                </div>
                @else
                <div class="interested text-center">
                    <h4>Interested for bid?<br/><small> Click the bid button!</small></h4>
                    <button class="btn btn-success btn-block"  data-toggle="modal" data-target="#myModal">Place Bid</button>
                </div>
                @endif
                @endif
                @endguest-->
                
                
                
<!--                @if(count($bidWinner) === 1)
                <div class="interested text-center">
                    <h4>Auction has been completed!<small>Winner Profile: <a href="{{url('/user/profile-view/'.$winnerInfo->id)}}">{{$winnerInfo->name}}</a></small></h4>
                    <p>The bidding price is: <strong>{{$bidWinner->fee}}</strong></p>
                </div>
                @else
                <div class="interested text-center">
                    <h4>Interested for bid?<br/><small> Click the bid button!</small></h4>
                    @guest
                    <a href="{{route('login')}}" class="btn btn-success btn-block">Login for Place Bid</a>
                    @else
                    @if(count($isUserHasBid) === 1)
                    <p><strong> You have already bid this auction. Your bidding price is: {{$isUserHasBid->fee}} </strong></p>
                    @else
                    <button class="btn btn-success btn-block"  data-toggle="modal" data-target="#myModal">Place Bid</button>
                    @endif
                    @endguest
                </div>
                @endif-->
                <div class="tips">
                    <h4>Safety Tips for Buyers</h4>
                    <ol>
                        <li><a href="#">please, Stay safe from fake seller.</a></li>
                        <li><a href="#">Justify product first.</a></li>
                    </ol>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4>Comments</h4>
                <hr/>
                <div id="comments">
                    @foreach($comments as $comment)
                    <p><a href="{{url('/user/profile-view/'.$comment->user_id)}}"><b>{{$comment->userName}}</b></a> {{$comment->commentBody}}</p><br/>
                    @endforeach
                </div>
                <br/>
                @guest
                <a class="account" href="{{route('login')}}">Please Login for commenting this auction</a>
                @else
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <div class="col-sm-12">
                            Comment
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="hidden" value="{{Auth::user()->id}}" id="user_id" name="user_id">
                            <input type="hidden" value="{{Auth::user()->name}}" id="userName" name="userName">
                            <input type="hidden" value="{{$auctionDetails->id}}" id="auction_id" name="auction_id">
                            <textarea class="form-control" name="commentBody" id="commentBody" cols="15" style="height: 100px; width: 320px;"></textarea>
                        </div>
                    </div>
                </form>
                <div class="form-group row">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-circle" id="add">post Comment</button>
                    </div>
                </div>
                @endguest
            </div>
        </div>
    </div>
</div>
<!--<script type="text/javascript" src="{{asset('public/js/jquery-3.3.1.js')}}"></script>-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ url('/user-bid/auction/'.$auctionDetails->id) }}">
        {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Place Bid</h4>
                </div>
                <div class="modal-body">
                    <p>{{ $auctionDetails->auctionTitle }}</p>
                    <p>
                        Min Bid: {{ $auctionDetails->price }}
                    </p>
                    <input name="price" type="number" min="{{ $auctionDetails->price }}" class="form-control" value="{{ $auctionDetails->price }}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Place Bid</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    {{-- ajax Form Add Comment--}}
    $("#add").click(function() {
      $.ajax({
        type: 'POST',
        url: "{{url('addComment')}}",
        data: {
          '_token': $('input[name=_token]').val(),
          'commentBody': $('textarea[name=commentBody]').val(),
          'user_id': $('input[name=user_id]').val(),
          'userName': $('input[name=userName]').val(),
          'auction_id': $('input[name=auction_id]').val()
        },
        success: function(data){
          $('#comments').append("<p><a href='#'><b>"+ data.userName +" </b></a> "+ data.commentBody +"</p>");
        },
      });
      $('#commentBody').val('');
    });

// function Edit POST
//$(document).on('click', '.edit-modal', function() {
//$('#footer_action_button').text(" Update Post");
//$('#footer_action_button').addClass('glyphicon-check');
//$('#footer_action_button').removeClass('glyphicon-trash');
//$('.actionBtn').addClass('btn-success');
//$('.actionBtn').removeClass('btn-danger');
//$('.actionBtn').addClass('edit');
//$('.modal-title').text('Post Edit');
//$('.deleteContent').hide();
//$('.form-horizontal').show();
//$('#fid').val($(this).data('id'));
//$('#t').val($(this).data('title'));
//$('#b').val($(this).data('body'));
//$('#myModal').modal('show');
//});
//
//$('.modal-footer').on('click', '.edit', function() {
//  $.ajax({
//    type: 'POST',
//    url: 'editPost',
//    data: {
//'_token': $('input[name=_token]').val(),
//'id': $("#fid").val(),
//'title': $('#t').val(),
//'body': $('#b').val()
//    },
//success: function(data) {
//      $('.post' + data.id).replaceWith(" "+
//      "<tr class='post" + data.id + "'>"+
//      "<td>" + data.id + "</td>"+
//      "<td>" + data.title + "</td>"+
//      "<td>" + data.body + "</td>"+
//      "<td>" + data.created_at + "</td>"+
// "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
//      "</tr>");
//    }
//  });
//});
//
//// form Delete function
//$(document).on('click', '.delete-modal', function() {
//$('#footer_action_button').text(" Delete");
//$('#footer_action_button').removeClass('glyphicon-check');
//$('#footer_action_button').addClass('glyphicon-trash');
//$('.actionBtn').removeClass('btn-success');
//$('.actionBtn').addClass('btn-danger');
//$('.actionBtn').addClass('delete');
//$('.modal-title').text('Delete Post');
//$('.id').text($(this).data('id'));
//$('.deleteContent').show();
//$('.form-horizontal').hide();
//$('.title').html($(this).data('title'));
//$('#myModal').modal('show');
//});
//
//$('.modal-footer').on('click', '.delete', function(){
//  $.ajax({
//    type: 'POST',
//    url: 'deletePost',
//    data: {
//      '_token': $('input[name=_token]').val(),
//      'id': $('.id').text()
//    },
//    success: function(data){
//       $('.post' + $('.id').text()).remove();
//    }
//  });
//});
//
//  // Show function
//  $(document).on('click', '.show-modal', function() {
//  $('#show').modal('show');
//  $('#i').text($(this).data('id'));
//  $('#ti').text($(this).data('title'));
//  $('#by').text($(this).data('body'));
//  $('.modal-title').text('Show Post');
//  });
</script>
<!--//single-page-->
@endsection

