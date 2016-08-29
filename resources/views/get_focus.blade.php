<?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
@foreach($news as $index => $new)
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 news-thumbnail pull-left @if($index%2==0) clear-left @endif">
        <div style="border-top: 5px solid;">
            <a href="{{ url('/categorynews/'.$new->category->id) }}">
                <h5 class="{{ $colors[$index%4] }} text-uppercase">{{ $new->category->name }}</h5>
            </a>
            <a href="{{ url('/newsread/'.$new->id) }}">
                <img class="img-responsive image-main-news" src="{{ asset($new->avatar_picture) }}">
            </a>
            <p class="text-muted m-t-sm">
                {{ $new->created_at->format('F j, H:i') }}
                <span class="m-l-sm">
                    <i class="fa fa-comment"></i>{{ $new->comments_count() }}
                </span>
            </p>
            <a href="{{ url('/newsread/'.$new->id) }}">
                <h3><strong>{{ $new->title }}</strong></h3>
            </a>
            <p>
                <a href="{{ url('/columnist/'.$new->author->id) }}">
                    <strong class="text-uppercase"><u>{{ $new->author->name }}</u></strong>
                </a>
                <span>{{ $new->short_description }}</span>
            </p>
        </div>
    </div>
@endforeach
@if($news->hasMorePages())
    <div class="pagination" style="clear: both; display: flex;">
        <a class="btn btn-default center-block" href="{{ $news->nextPageUrl() }}">Load more...</a>
    </div>
@endif