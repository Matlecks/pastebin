@extends('base.index')

@section('info_container')
<form action="{{ route('user.auth') }}" method="POST">
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
        <button type="submit">Войти</button>
    </div>
</form>
<a href="{{route('user.reg_page')}}">Зарегистрироваться</a>
@endsection
