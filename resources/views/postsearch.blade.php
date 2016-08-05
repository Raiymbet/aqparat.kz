<?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
@foreach($searchNews as $index => $searchNew)
    <div class="hpanel filter-item">
        <a href="{{ url('/newsread/'.$searchNew->id) }}">
            <div class="panel-body">
                <h4 class=""><small>{{ $searchNew->created_at }}</small></h4>
                <h4>{{ $searchNew->title }}</h4>
                <p>{!! str_limit(strip_tags($searchNew->text), 100) !!}</p>
                <div class="text-left">
                    <h5 class="{{ $colors[$index%4] }}">{{ $searchNew->category->name }}</h5>
                </div>
                <div class="small statistics-style">
                    <span> <i class="fa fa-eye fa-lg"></i> {{ $searchNew->views }}</span>
                    <span class="margin-left-20"> <i class="fa fa-comment fa-lg"></i> {{ $searchNew->comments_count() }}</span>
                    <span  class="margin-left-20"> <i role="button" class="fa fa-heart fa-lg"></i> {{ $searchNew->likes }}</span>
                    <span class="margin-left-20"> <i role="button" class="fa fa-share-alt fa-lg"></i> {{ $searchNew->shares }}</span>
                </div>
            </div>
        </a>
    </div>
@endforeach
<div id="pagination" class="pagination">
    {!! $searchNews->render() !!}
</div>