@extends('base.index')

@section('info_container')
    <form action="{{ route('paste.store') }}" method="POST" style="border:1px solid #ccc  " class="w-50 mt-5 ms-5 p-3">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Название</label>
            <input name="name" class="form-control" id="exampleFormControlInput1" placeholder="Название">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Паста</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
        </div>

        <select class="form-select" aria-label="Default select example" name="access_level">
            <option selected>Доступ</option>
            <option value="public">public</option>
            <option value="private">private</option>
            <option value="unlisted">unlisted</option>
        </select>

        <select class="form-select mt-4" aria-label="Default select example" name="expires_at">
            <option selected>выберите срок сохранения</option>
            <option value="1">10мин</option>
            <option value="2">1час</option>
            <option value="3">3часа</option>
            <option value="4">1день</option>
            <option value="5">1неделя</option>
            <option value="6">1месяц</option>
            <option value="7">навсегда</option>
        </select>

        <select class="form-select mt-4" aria-label="Default select example" name="language">
            <option selected>Язык</option>
            <option value="php">php</option>
            <option value="js">js</option>
        </select>

        <button type="submit" class="btn btn-success mt-4">Сохранить</button>
    </form>
@endsection
