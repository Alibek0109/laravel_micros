@extends('layouts.app')

@section('page_description') Бухгалтерия @endsection

@section('forms')
    <h3 class="mb-2 mt-5 text-center">Статистика</h3>
    <form action="{{route('home.stat')}}" method="post" class="mb-5 mt-2">
        @csrf
        <div class="query-form d-flex justify-content-between mb-2">
            <div class="form-group col-md-3">
                <label for="type_id">Тип</label>
                <select name="type_id" id="type_id" class="form-control">
                    <option value="0">Все</option>
                    <option value="1">Доход</option>
                    <option value="2">Расход</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="date_start">Начало отсчета</label>
                <input type="date" class="form-control" name="date_start" id="date_start">
            </div>
            <div class="form-group col-md-3">
                <label for="date_end">Конец отсчета</label>
                <input type="date" class="form-control" name="date_end" id="date_end">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Отправить</button>
    </form>

    @if (session('stat'))
        <div class="alert alert-info">
            {{session('stat')}}
        </div>
    @endif

    <h3 class="mb-2 text-center">Поиск по категориям</h3>
    <form action="{{ route('home.search') }}" method="get" class="mb-5">
        <div class="form-group">
            <label for="search">Поиск</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="Поиск">
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-2">Искать</button>
    </form>
@endsection

@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">ТИП</th>
                <th scope="col">КАТЕГОРИЯ</th>
                <th scope="col">ДАТА</th>
                <th scope="col">СУММА</th>
                <th scope="col">ИТОГО</th>
                <th scope="col">КОММЕНТАРИЙ</th>
                <th scope="col">ДЕЙСТВИЯ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mainModel as $el)
                <tr>
                    @if ($el->type_id == 1)
                        <th>Доход</th>
                    @elseif($el->type_id == 2)
                        <th>Расход</th>
                    @endif

                    <td>{{ $el->categories->title }}</td>

                    <td>{{ $el->date }}</td>
                    <td>{{ number_format($el->sum, 2, '.', ' ') }}</td>
                    <td>{{ number_format($el->result, 2, '.', ' ') }}</td>
                    <td>{{ $el->comment }}</td>
                    <td style="width:235px">
                        <a href="{{ route('home.edit', ['id' => $el->id]) }}"
                            class="btn btn-warning mx-auto">Редактировать</a>
                        <form action="{{ route('home.destroy', ['id' => $el->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $mainModel->WithQueryString()->links() }}

@endsection


@section('jquery')

@endsection
