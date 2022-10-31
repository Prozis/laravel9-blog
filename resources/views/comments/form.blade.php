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
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', $newComment->name, ['class' => 'form-control']) }}<br>
</div>
<div class="form-group">
    {{ Form::label('text', 'Text') }}
    {{ Form::textarea('text', $newComment->text, ['class' => 'form-control']) }}<br>
    {{ Form::hidden('post_id', $post->id )}}
</div>
