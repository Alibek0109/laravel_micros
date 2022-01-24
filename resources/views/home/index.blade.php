@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="text-center mb-5">Бухгалтерия</h2>
                <div class="col-md-3 mb-5">
                    <form action="{{route('home.filter')}}" method="post">
                        @csrf
                        <label for="stat">Статистика</label>
                        <select name="stat" id="stat" class="form-control">
                            <option value="all">За все время</option>
                            <option value="have">Доступные средства</option>
                            <option value="spend">Потраченные стредства</option>
                            <option value="spectime">За указанный период</option>
                        </select>
                        <button type="submit" class="btn btn-dark mt-2">Фильтровать</button>
                    </form>
                </div>


                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
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
                                @foreach ($el->categories as $cat)
                                    <td>{{ $cat->title }}</td>
                                @endforeach

                                <td>{{ $el->date }}</td>
                                <td>{{ number_format($el->sum, 2, '.', ' ') }}</td>
                                <td>{{ number_format($el->result, 2, '.', ' ') }}</td>
                                <td>{{ $el->comment }}</td>
                                <td style="width:235px">
                                    <a href="{{ route('home.edit', ['id' => $el->id]) }}"
                                        class="btn btn-warning mx-auto">Редактировать</a>
                                    <form action="{{ route('home.destroy', ['id' => $el->id]) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $mainModel->links() }}
            </div>
        </div>
    </div>
@endsection
