@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('status'))
	{{ Session::get('status') }}
@endif

<div class="form-group">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', $post->title, ['class' => 'form-control']) }}<br>
</div>
<div class="form-group">
    {{ Form::label('descr', 'Text') }}
    {{ Form::textarea('descr', $post->descr, ['class' => 'form-control']) }}<br>
</div>
