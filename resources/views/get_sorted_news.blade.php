@if(count($news)>0)
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
    @if($screen == 'lg')
        <?php $divider = 3; ?>
    @elseif($screen == 'sm')
        <?php $divider = 2; ?>
    @else
        <?php $divider = 1;?>
    @endif
    @foreach($news as $index => $new)
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 news-thumbnail pull-left @if($index%$divider==0) clear-left @endif">
            <div class="media p-t-sm" style="border-top: 1px dashed;">
                <div class="media-left news-author-avatar">
                    <a href="{{ url('/newsread/'.$new->id) }}">
                        <img alt="64x64" class="media-object"
                             src="{{ asset($new->author->avatar) }}"
                             data-holder-rendered="true" width="80" height="80">
                    </a>
                </div>
                <div class="media-body">
                    <p class="m-t-xx3">
                        <a href="{{ url('/categorynews/'.$new->category->id) }}"
                           class="{{ $colors[$index%4] }} text-uppercase p-r-l-xxs"
                           style="border: 1px solid;">
                            <strong>
                                @if ($new->category->type=='point')
                                    Round Table
                                @elseif ($new->category->type=='focus')
                                    Focus
                                @else
                                    {{ $new->category->name }}
                                @endif
                            </strong>
                        </a>
                        <span class="text-muted m-l-sm">{{ $new->created_at->format('M j, H:i') }}</span>
                        <span class="text-muted m-l-sm">
                            <i class="fa fa-comment"></i>{{ $new->comments_count() }}
                        </span>
                    </p>
                    <h4 class="news-with-author-avatar-title">
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
    @endforeach
    @if($news->hasMorePages())
        <div class="pagination" style="clear: both; display: flex;">
            <a class="btn btn-default center-block" href="{{ $news->nextPageUrl() }}">Load more...</a>
        </div>
    @endif
@else
    <h5>Өңделген жаңалықтар жоқ.</h5>
@endif