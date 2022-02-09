@extends('layouts.app')

@section('page_description') Редактирование категорий @endsection

@section('content')

    <form action="{{ route('home.category.update', ['id' => $category->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Имя категории</label>
            <input type="text" class="form-control" id="title" placeholder="Категория" name="title" value="{{$category->title}}">
        </div>
        <button class="btn btn-success mt-2">Редактировать</button>
    </form>

@endsection
