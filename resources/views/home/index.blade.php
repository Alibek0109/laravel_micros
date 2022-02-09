@extends('layouts.app')

@section('page_description') Бухгалтерия @endsection

@section('forms')
    <form action="{{ route('home.search') }}" method="get" class="mb-5">
        <div class="form-group">
            <label for="search">Поиск по категориям</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="Поиск по категориям">
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
