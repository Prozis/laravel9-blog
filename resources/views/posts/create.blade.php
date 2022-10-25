@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h3>New post</h3>
                {{ Form::model($post, ['url' => route('post.store')]) }}
                @include('posts.form')
                {{ Form::submit('Add post', ['class'=>'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
