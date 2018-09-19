@extends('frontEnd.master')

@section('title')
Category
@endsection

@section('mainContent')
<!-- Categories -->
<!--Vertical Tab-->
<div class="categories-section main-grid-border">
    <div class="container">
        <h2 class="head">Main Categories</h2>
        <div class="category-list">
            <div id="partialTab">
                <ul class="resp-tabs-list hor_1">
                    @foreach($categories as $category)
                    <li id="categories" value="{{$category->id}}">{{$category->categoryName}}</li>
                    @endforeach
                    <a href="all-classifieds.html">All Ads</a>
                </ul>
                <div class="resp-tabs-container hor_1">
                    <span class="active total" style="display:block;" data-toggle="modal" data-target="#myModal"><strong>All Bangladesh</strong> (Select your city to see local ads)</span>
                    <div>
                        <div class="sub-categories">
                            <ul id="subcategories">
                                <li></li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!--Plug-in Initialisation-->
<script type="text/javascript">
    $(document).ready(function () {
        //Vertical Tab
        $('#partialTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        
        $('#categories').on('change', function (e) {
            console.log(e);
            var category_id = e.target.value;
            $.get("{{url('/json-subcategories')}}?category_id=" + category_id, function (data) {
                console.log(data);
                $.each(data, function (index, SubCategoryObj) {
                    $('#subcategories').append('<li>'+ SubCategoryObj.subCategoryName +'</li>');
                });
            });
        });
        
    });
</script>
@endsection

