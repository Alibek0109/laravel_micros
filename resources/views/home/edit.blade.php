@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-3">Форма редактирования данных</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('home.update', ['id' => $data->id]) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="type_id">Тип</label>
                        <select class="form-control" id="type_id" name="type_id">
                            @if ($data->type_id == 1)
                                <option value="1" selected>Доход</option>
                                <option value="2">Расход</option>
                            @elseif($data->type_id == 2)
                                <option value="1">Доход</option>
                                <option value="2" selected>Расход</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Категория</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach ($categoryModel as $el)
                                @if($el->id == $data->category_id)
                                    <option value="{{$el->id}}" selected>{{$el->title}}</option>
                                @else
                                    <option value="{{$el->id}}">{{$el->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Дата</label>
                        <input type="date" class="form-control" id="date" placeholder="Дата" value="{{ $date_now }}"
                            name="date">
                    </div>
                    <div class="form-group">
                        <label for="sum">Сумма</label>
                        <input type="text" class="form-control" id="sum" value="{{ $data->sum }}" placeholder="Сумма"
                            name="sum">
                    </div>
                    <div class="form-group">
                        <label for="comment">Комментарий</label>
                        <textarea class="form-control" id="comment" rows="3" name="comment"
                            placeholder="Комментарий">{{ $data->comment }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success mt-2">Изменить данные</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('jquery')

@endsection
