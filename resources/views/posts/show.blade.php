@extends('layouts.app')

@section('title', 'Show')

@section('content')
    <div class="container">
        <div class="card-header text-center mb-3"><h4>{{ $post->title }}</h4></div>
        <div class="card-body">
            <div class="card-image mb-3"
                 style="background-image: url({{ $post->img ?? asset('img/default.png') }})"></div>
            <div class="card-descr">{{ $post->descr }}</div>

        </div>
        <div class="card-footer mt-3 mb-3">
            <div class="author-name">
                {{ $post->name }}
            </div>
            <div class="created-at">
                {{ $post->created_at->format('d-m-Y H:i') }}
            </div>
        </div>

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
              integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
              crossorigin="anonymous">
        {{-- comments block --}}
        <div class="container">
            <div class="row">
                @foreach($comments as $comment)
                    <div class="col-md-8">
                        <div class="media g-mb-30 media-comment">
                            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"
                                 src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                <div class="g-mb-15">
                                    <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->name }}</h5>
                                    <span
                                        class="g-color-gray-dark-v4 g-font-size-12">{{ $comment->created_at->format('d-m-Y H:i') }}</span>
                                </div>

                                <p>{{ $comment->text }}</p>

                                <ul class="list-inline d-sm-flex my-0">
                                    <li class="list-inline-item g-mr-20">
                                        <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                            <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
                                            178
                                        </a>
                                    </li>
                                    <li class="list-inline-item g-mr-20">
                                        <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                            <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
                                            34
                                        </a>
                                    </li>
                                    <li class="list-inline-item ml-auto">
                                        <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                            <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                                            Reply
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-md-8">

                                <h3>Add comment</h3>
                                {{ Form::model($newComment, ['url' => route('comment.store')]) }}
                                @include('comments.form')
                                {{ Form::submit('Add comment', ['class'=>'btn btn-primary']) }}
                                {{ Form::close() }}

                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $comments->links() }}
            </div>
        </div>
        {{--        end comments block --}}
    </div>
@endsection


