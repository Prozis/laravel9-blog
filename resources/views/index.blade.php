@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($_GET['search']))
            @if(count($posts))
                <h4>Found <?= count($posts) ?> posts</h4>
            @else
                <h4>Nothing found</h4>
                <a href="/" class="btn btn-outline-primary mt-3">Main page</a>
            @endif
        @endif
        <div class="row">
            @foreach($posts as $post)

                <div class="col-lg-6">
                    <div class="card mb-3">
                        <div class="card-header"><h4>{{ $post->short_title }}</h4></div>
                        <div class="card-body">
                            <div class="card-image mb-3" style="background-image: url({{ $post->img ?? asset('img/default.png') }})"></div>
                            <div class="card-short-descr mb-3">{{ $post->descr }}</div>

                            <a href="{{ route('post.show', $post) }}" class="btn btn-outline-primary">Show post</a>
                            @auth
                            <a href="{{ route('post.edit', $post) }}" class="btn btn-outline-secondary">Edit</a>
                            <form style=" display:inline!important;" action="{{ route('post.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" title="Delete">Delete</button>
                            </form>
                            @endauth
                        </div>
                        <div class="card-footer">
                            <div class="author-name">
                                {{ $post->name }}
                            </div>
                            <div class="created-at">
                                {{ $post->created_at->format('d-m-Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection


