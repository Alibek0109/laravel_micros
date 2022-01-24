@extends('layouts.app')


@section('content')
    <div class="container_fluid mt-5">
        <div class="row">
            @include('inc.inc_manage')
            <div class="col-md-8">
                <div class="container">
                    <h2 class="text-center mb-3">Создание данных</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('home.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="type_id">Тип</label>
                            <select class="form-control" id="type_id" name="type_id">
                                <option disabled selected>Выберите тип</option>
                                <option value="1">Доход</option>
                                <option value="2">Расход</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option disabled selected>Выберите категорию</option>
                                @foreach ($categories1 as $category)
                                    <option value="{{ $category->id }}" title="cat1">{{ $category->title }}</option>
                                @endforeach
                                @foreach ($categories2 as $category)
                                    <option value="{{ $category->id }}" title="cat2">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Дата</label>
                            <input type="date" class="form-control" id="date" placeholder="Дата"
                                value="{{ $date_now }}" name="date">
                        </div>
                        <div class="form-group">
                            <label for="sum">Сумма</label>
                            <input type="text" class="form-control" id="sum" placeholder="Сумма" name="sum">
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <textarea class="form-control" id="comment" rows="3" name="comment"
                                placeholder="Комментарий"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success mt-2">Добавить данные</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('jquery')
    $(document).ready(function() {
        $("type_id").click(function() {

        });
    });
@endsection
