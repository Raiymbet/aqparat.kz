@foreach($news as $index => $new)
    @if($index==0 || $index==1 || $index%6==0 || $index%6==1)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 news-thumbnail pull-left @if($index%2==0) clear-left @endif">
            <div class="p-t-xs" style="border-top: 5px solid;">
                <a href="{{ url('/newsread/'.$new->id) }}">
                    <img class="img-responsive image-main-news" src="{{ asset($new->avatar_picture) }}">
                </a>
                <p class="text-muted m-t-sm">
                    {{ $new->created_at->format('F j, H:i') }}
                    <span class="m-l-sm">
                                                        <i class="fa fa-comment"></i>
                        {{ $new->comments_count() }}
                                                    </span>
                </p>
                <a href="{{ url('/newsread/'.$new->id) }}">
                    <h3>
                        <strong>{{ $new->title }}</strong>
                    </h3>
                </a>
                <p>
                    <a href="{{ url('/columnist/'.$new->author->id) }}">
                        <strong class="text-uppercase"><u>{{ $new->author->name }}</u></strong>
                    </a>
                    <span>{{ $new->short_description }}</span>
                </p>
            </div>
        </div>
    @else
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 news-thumbnail pull-left @if($index%2==0) clear-left @endif">
            <div class="media p-t-xs" style="border-top: 1px dashed;">
            <!--
                <div class="media-left">
                    <a href="{{ url('/newsread/'.$new->id) }}">
                       <img alt="64x64" class="media-object" src="{{ asset($new->author->avatar) }}"
                                      data-holder-rendered="true" width="80" height="80">
                     </a>
                </div>
            -->
                <div class="media-body">
                    <p class="m-t-xx3">
                        <span class="text-muted m-l-sm">
                            {{ $new->created_at->format('F j, H:i') }}
                        </span>
                        <span class="text-muted m-l-sm">
                            <i class="fa fa-comment"></i>
                            {{ $new->comments_count() }}
                        </span>
                    </p>
                    <h4 class="news-without-image-title">
                        <a href="{{ url('/newsread/'.$new->id) }}">
                            <strong>{{ $new->title }}</strong>
                        </a>
                    </h4>
                    <p>
                        <a href="{{ url('/columnist/'.$new->author->id) }}">
                            <strong class="text-uppercase"><u>{{ $new->author->name }}</u></strong>
                        </a>
                        <span>{{ $new->short_description }}</span>
                    </p>
                </div>
            </div>
        </div>
    @endif
@endforeach
@if($news->hasMorePages())
    <div class="pagination" style="clear: both; display: flex;">
        <a class="btn btn-default center-block" href="{{ $news->nextPageUrl() }}">Load more...</a>
    </div>
@endif