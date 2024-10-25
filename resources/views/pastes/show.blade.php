@extends('base.index')

@section('info_container')
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Название</label>
        <input name="name" class="form-control" id="exampleFormControlInput1" placeholder="Название"
            value="{{ $data['paste']->name }}">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Паста</label>
        <textarea class="form-control {{ $data['paste']->language }}" id="exampleFormControlTextarea1" rows="3"
            name="content">
            <pre><code class="{{ $data['paste']->content }}">{{ $data['paste']->content }}</code></pre>
        </textarea>
    </div>
@endsection
