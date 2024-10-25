<ul class="" style=" display:grid; grid-template-columns: repeat(5,1fr)">

    <a href="{{ route('paste.create') }}" class="btn btn-outline-primary">Главная</a>

    <a href="{{ route('paste.index') }}" class="btn btn-outline-primary">Список паст</a>

    <a href="{{ route('user.auth_page') }}" class="btn btn-outline-primary">Войти</a>

    <a href="" class="btn btn-outline-primary">Primary</a>

    <a href="" class="btn btn-outline-primary">Primary</a>

</ul>

@if ($data['public_pastes']->isNotEmpty())
    <p>Публичные пасты</p>
    <table class="table table-hover w-50 mt-5 ml-5">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Паста</th>
                <th scope="col">Дата создания</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['public_pastes'] as $public_paste)
                <tr>
                    <th scope="row">{{ $public_paste->id }}</th>
                    <td>
                        <pre><code class="{{ $public_paste->language }}">{{ $public_paste->content }}</code></pre>
                    </td>
                    <td>{{ $public_paste->created_at }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <hr>
@endif


@if (!empty($user_pastes))
    @if ($user_pastes->isNotEmpty())
        <p>Мои пасты</p>
        <table class="table table-hover w-50 mt-5 ml-5">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Паста</th>
                    <th scope="col">Дата создания</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user_pastes as $user_paste)
                    <tr>{{ $public_paste->content }}
                        <th scope="row">{{ $user_paste->id }}</th>
                        <td>
                            <pre><code class="{{ $public_paste->language }}">{{ $user_paste->content }}</code></pre>
                        </td>
                        <td>{{ $user_paste->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <hr>
    @endif
@endif
