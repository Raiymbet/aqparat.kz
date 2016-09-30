<?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
@foreach($searchNews as $index => $searchNew)
    <div class="hpanel filter-item">
        <div class="panel-body">
            <p class="">
                <a href="{{ url('/categorynews/'.$searchNew->category->id) }}"
                   class="{{ $colors[$index%4] }} text-uppercase p-r-l-xxs"
                   style="border: 1px solid;">
                    <strong>
                        @if ($searchNew->category->type=='point')
                            Round Table
                        @elseif ($searchNew->category->type=='focus')
                            Focus
                        @else
                            {{ $searchNew->category->name }}
                        @endif
                    </strong>
                </a>
                <span class="text-muted m-l-sm">{{ $searchNew->created_at->format('F j, Y, H:i') }}</span>
            </p>
            <h4 class="news-without-image-title" style="">
                <a href="{{ url('/newsread/'.$searchNew->id) }}">
                    <strong>{{ $searchNew->title }}</strong>
                </a>
            </h4>
            <p>
                <a href="{{ url('/columnist/'.$searchNew->author->id) }}">
                    <strong class="text-uppercase"><u>{{ $searchNew->author->name }}</u></strong>
                </a>
                <span>{{ $searchNew->short_description }}</span>
            </p>
            <div class="small statistics-style">
                <span> <i class="fa fa-eye fa-lg"></i> {{ $searchNew->views }}</span>
                <span class="m-l-md"> <i class="fa fa-comment fa-lg"></i> {{ $searchNew->comments_count() }}</span>
                <span  class="m-l-md"> <i role="button" class="fa fa-thumbs-o-up fa-lg"></i> {{ $searchNew->likes }}</span>
            </div>
        </div>
    </div>
@endforeach
@if($searchNews->hasMorePages())
    <div class="pagination" style="clear: both; display: flex;">
        <a class="btn btn-default center-block" href="{{ $searchNews->nextPageUrl() }}">Load more...</a>
    </div>
@endif