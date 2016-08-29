@extends('layouts.home')

@section('content')
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
    <div class="col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px; padding: 9px 50px;">
        <div class="header-row">
            <span class="m-l-xs">My Posts</span>
        </div>
    </div>
    <div class="col-lg-12 header-three">
        <div class="row header-row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="hpanel forum-box">
                    <div class="panel-body">
                        <p>
                            <span>* <i class="fa fa-pencil-square-o fa-lg"></i></span> - Жолдама өңделу барысында. <br>
                            <span>* <i class="fa fa-square-o fa-lg"></i></span> - Жолдама өңделмеген. <br>
                            <span>* <i class="fa fa-check-square-o fa-lg"></i></span> - Жолдама өңделіп, расталған. <br>
                            <span>* <i class="fa fa-ban fa-lg"></i></span> - Жолдама өңделіп, расталмаған.
                        </p>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" action="{{url('/myposts/search')}}" method="POST">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-xs-3 col-sm-3 col-md-2 col-lg-2 control-label">Мәтіні:</label>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
                                        <input name="post" class="form-control" type="text" placeholder="Жолдаманы іздеу...">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="col-xs-3 col-sm-3 col-md-4 col-lg-4 control-label">Күйі:</label>
                                    <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                        <select class="form-control" name="status">
                                            <option value="all" selected="selected">Барлығы</option>
                                            <option value="">Өңделмеген</option>
                                            <option value="accepted">Расталған</option>
                                            <option value="baned">Расталмаған</option>
                                            <option value="processing">Өңделуде</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="col-xs-3 col-sm-3 col-md-4 col-lg-4 control-label">Уақыты:</label>
                                    <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                        <input name="datetime" type="datetime-local" class="form-control" placeholder="Уақытын көрсетіңіз">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <button class="btn btn-info pull-right" type="submit">Іздеу</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="hpanel">
                    @if(!count($posts)>0)
                        <div class="panel-body" style="min-height: 300px;">
                            <p class="text-info">Сізде жолданған хабрламаларыңыз жоқ.</p>
                        </div>
                    @endif

                    @foreach($posts as $post)
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <h5>
                                        <span>
                                        @if($post->status == null)
                                            <i class="fa fa-square-o fa-lg"></i>
                                        @elseif($post->status == 'accepted')
                                            <i class="fa fa-check-square-o fa-lg"></i>
                                        @elseif($post->status == 'baned')
                                            <i class="fa fa-ban fa-lg"></i>
                                        @elseif($post->status == 'processing')
                                            <i class="fa fa-pencil-square-o fa-lg"></i>
                                        @endif
                                        </span>
                                        {{ $post->created_at }}
                                    </h5>
                                    <div>
                                        <p>{{ $post->text }}</p>
                                        @if($post->news_id != null)
                                            <a href="{{ url('/newsread/'.$post->news_id) }}">Мақаланы оқу...</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($post->status == 'baned')
                                <div class="row">
                                    <div class="col-sm-12 m-t-md">
                                        <div class="btn-group pull-right">
                                            <form action="{{url('/myposts/' . $post->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-sm btn-default"> Delete </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="hpanel hblue">
                    <div class="panel-heading hbuilt">
                        <h6>Оқуға ұсынамыз</h6>
                    </div>
                    <div class="panel-body hblue">
                        <div class="row row-with-margin">
                            <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
                            @foreach($recommend_news as $index => $recommend_new)
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 news-thumbnail text-justify pull-left @if($index%3==0) clear-left @endif">
                                    <a href="{{ url('/newsread/'.$recommend_new->id) }}">
                                        <img class="img-responsive image-main-news" src="{{ asset($recommend_new->avatar_picture) }}">
                                        <h5 class="{{ $colors[$index%4] }}">{{ $recommend_new->category->name }}</h5>
                                        <h5>{{ $recommend_new->title }}</h5>
                                        <p class="news-datetime">{{ $recommend_new->created_at->format('F j, H:i') }}</p>
                                        <div class="small statistics-style">
                                            <span><i class="fa fa-eye"></i>{{ $recommend_new->views }}</span>
                                            <span><i class="fa fa-comment"></i>{{ $recommend_new->comments_count() }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection