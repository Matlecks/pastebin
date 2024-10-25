@extends('base.index')

@section('info_container')
    <form action="{{ route('user.registrate') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">Пароль</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <button type="submit">Зарегистрироваться</button>
        </div>
    </form>
@endsection
