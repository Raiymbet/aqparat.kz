<?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
@foreach($news as $index => $new)
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left @if($index%2==0) clear-left @endif focus-news">
        <div class="focus-border"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-none" style="background: #f1f0de;">
            <div class="rollover site main-news-image-content">
                <a href="#">
                    <img src="{{ URL::asset($new->avatar_picture) }}" alt="New focus image">
                    @if(!is_null($new->video_url))
                        <span class="image-has-video">
                                <i class="fa fa-video-camera"></i>
                            </span>
                    @endif
                    @if(!is_null($new->media_author))
                        <span class="image-author">{{$new->media_author}}</span>
                    @endif
                </a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 m-t-sm">
                <a href="{{ url('/newsread/'.$new->id) }}">
                    <h3>
                        <strong>{{ $new->title }}</strong>
                    </h3>
                </a>
                <div class="">
                    By
                    <a href="{{ url('/columnist/'.$new->author->id) }}">
                        <strong class="text-uppercase"><u>{{ $new->author->name }}</u></strong>
                    </a>
                </div>

                <div class="">
                    <p class="text-muted m-t-sm">
                        {{ $new->created_at->format('F j, Y') }}
                    </p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 focus-action">
                <div class="pull-right">
                <span class="m-l-sm">
                    <i class="fa fa-comment liked"></i>
                    {{ $new->comments_count() }}
                </span>
                </div>
                <div class="pull-right">
                <span id="new_likes">
                    <i class="fa fa-thumbs-o-up fa-lg liked"></i>
                    {{ $new->likes }}
                </span>
                </div>
            </div>
        </div>
    </div>
@endforeach
@if($news->hasMorePages())
    <div class="pagination" style="clear: both; display: flex;">
        <a class="btn btn-default center-block" href="{{ $news->nextPageUrl() }}">Load more...</a>
    </div>
@endif