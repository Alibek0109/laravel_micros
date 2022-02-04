@extends('layouts.app')

@section('page_description') Страница категорий @endsection

@section('content')

    <form action="{{ route('home.category.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="type_id">Тип</label>
            <select name="type_id" id="type_id" class="form-control">
                <option disabled selected>Выберите тип</option>
                <option value="1">Доход</option>
                <option value="2">Расход</option>
            </select>
        </div>
        <div class="form-group">
            <label for="category_title">Категория</label>
            <input type="text" class="form-control" id="category_title" placeholder="Категория" name="title">
        </div>
        <button class="btn btn-success mt-2">Создать категорию</button>
    </form>

@endsection
