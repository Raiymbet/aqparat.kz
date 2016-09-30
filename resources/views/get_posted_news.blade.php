@if(count($news)>0)
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
    @if($screen == 'lg')
        <?php $divider = 3; ?>
    @elseif($screen == 'sm')
        <?php $divider = 2; ?>
    @else
        <?php $divider = 1;?>
    @endif
    @foreach($news as $index => $last_post)
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 news-thumbnail pull-left @if($index%$divider==0) clear-left @endif">
            <div class="media p-t-sm" style="border-top: 1px dashed;">
                <div class="media-left">
                    <a href="{{ url('/newsread/'.$last_post->news->id) }}">
                        <img alt="64x64" class="media-object"
                             src="{{ asset($last_post->news->author->avatar) }}"
                             data-holder-rendered="true" width="80" height="80">
                    </a>
                </div>
                <div class="media-body">
                    <p class="" style="margin-top: 3px;">
                        <a href="{{ url('/categorynews/'.$last_post->news->category->id) }}"
                           class="{{ $colors[$index%4] }} text-uppercase"
                           style="border: 1px solid; padding: 0 5px;">
                            <strong>
                                @if ($last_post->news->category->type=='point')
                                    Round Table
                                @elseif ($last_post->news->category->type=='focus')
                                    Focus
                                @else
                                    {{ $last_post->news->category->name }}
                                @endif
                            </strong>
                        </a>
                        <span class="text-muted m-l-sm">{{ $last_post->news->created_at->format('M j, H:i') }}</span>
                                                        <span class="text-muted m-l-sm"><i
                                                                    class="fa fa-comment"></i>{{ $last_post->news->comments_count() }}</span>
                    </p>
                    <h4 class="news-with-author-avatar-title">
                        <a href="{{ url('/newsread/'.$last_post->news->id) }}">
                            <strong>{{ $last_post->news->title }}</strong>
                        </a>
                    </h4>
                    <p>
                        <a href="{{ url('/columnist/'.$last_post->news->author->id) }}">
                            <strong class="text-uppercase"><u>{{ $last_post->news->author->name }}</u></strong>
                        </a>
                        <span>{{ $last_post->news->short_description }}</span>
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
    <h5>Өңделген жолдамалар жоқ.</h5>
@endif