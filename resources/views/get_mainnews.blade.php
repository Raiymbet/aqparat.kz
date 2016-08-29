<?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
@if($screen == 'lg')
    <?php $divider = 3; ?>
@elseif($screen == 'sm')
    <?php $divider = 2; ?>
@else
    <?php $divider = 1;?>
@endif
@foreach($main_news as $index => $main_new)
    @if($index < $divider || $index%pow($divider, 2) < $divider)
        <div class="col-xs-12 col-sm-6 col-md-4 news-thumbnail pull-left @if($index%$divider==0) clear-left @endif">
            <div style="border-top: 5px solid;">
                <a href="{{ url('/categorynews/'.$main_new->category->id) }}">
                    <h5 class="{{ $colors[$index%4] }} text-uppercase">
                        @if ($main_new->category->type=='point')
                            Round Table
                        @elseif ($main_new->category->type=='focus')
                            Focus
                        @else
                            {{ $main_new->category->name }}
                        @endif
                    </h5>
                </a>
                <a href="{{ url('/newsread/'.$main_new->id) }}">
                    <img class="img-responsive image-main-news"
                         src="{{ asset($main_new->avatar_picture) }}">
                </a>
                <p class="text-muted m-t-sm">
                    {{ $main_new->created_at->format('M j, H:i') }}
                    <span class="m-l-sm"><i
                                class="fa fa-comment"></i>{{ $main_new->comments_count() }}</span>
                </p>
                <h3>
                    <a href="{{ url('/newsread/'.$main_new->id) }}">
                        <strong>{{ $main_new->title }}</strong>
                    </a>
                </h3>
                <p>
                    <a href="{{ url('/columnist/'.$main_new->author->id) }}">
                        <strong class="text-uppercase"><u>{{ $main_new->author->name }}</u></strong>
                    </a>
                    <span>{{ $main_new->short_description }}</span>
                </p>
            </div>
        </div>
    @else
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 news-thumbnail pull-left @if($index%$divider==0) clear-left @endif">
            <div class="media p-t-sm" style="border-top: 1px dashed;">
                <div class="media-body">
                    <p class="m-t-xx3">
                        <a href="{{ url('/categorynews/'.$main_new->category->id) }}"
                           class="{{ $colors[$index%4] }} text-uppercase p-r-l-xxs"
                           style="border: 1px solid;">
                            <strong>
                                @if ($main_new->category->type=='point')
                                    Round Table
                                @elseif ($main_new->category->type=='focus')
                                    Focus
                                @else
                                    {{ $main_new->category->name }}
                                @endif
                            </strong>
                        </a>
                        <span class="text-muted m-l-sm">{{ $main_new->created_at->format('M j, H:i') }}</span>
                        <span class="text-muted m-l-sm"><i
                                    class="fa fa-comment"></i>{{ $main_new->comments_count() }}</span>
                    </p>

                    <h4 class="news-without-image-title" style="">
                        <a href="{{ url('/newsread/'.$main_new->id) }}">
                            <strong>{{ $main_new->title }}</strong>
                        </a>
                    </h4>
                    <p>
                        <a href="{{ url('/columnist/'.$main_new->author->id) }}">
                            <strong class="text-uppercase"><u>{{ $main_new->author->name }}</u></strong>
                        </a>
                        <span>{{ $main_new->short_description }}</span>
                    </p>
                </div>
            </div>
        </div>
    @endif
@endforeach
@if($main_news->hasMorePages())
    <div class="pagination" style="clear: both; display: flex;">
        <a class="btn btn-default center-block" href="{{ $main_news->nextPageUrl() }}">Load more...</a>
    </div>
@endif