@extends('base.index')

@section('info_container')
    <table class="table table-hover w-50 mt-5 ml-5">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Паста</th>
                <th scope="col">Язык</th>
                <th scope="col">Доступ</th>
                <th scope="col">Дата создания</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['pastes'] as $paste)
                <tr>
                    <th scope="row">{{ $paste->id }}</th>
                    <td>
                        <pre><code class="{{ $paste->language }}">{{ $paste->content }}</code></pre>
                    </td>
                    <td>{{ $paste->language }}</td>
                    <td>{{ $paste->access_level }}</td>
                    <td>{{ $paste->created_at }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $data['pastes']->links() }}
@endsection
