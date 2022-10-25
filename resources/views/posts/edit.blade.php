@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h3>Edit post</h3>

                {{ Form::model($post, ['url' => route('post.update', $post), 'method' => 'PATCH']) }}
                @include('posts.form')
                {{ Form::submit('Update post', ['class'=>'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
