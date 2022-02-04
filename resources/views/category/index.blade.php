@extends('layouts.app')


@section('page_description') Все категории @endsection

@section('content')

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Номер</th>
                <th scope="col">Тип</th>
                <th scope="col">Категория</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($categoryModel as $el)
                <tr>
                    <th>{{ $i++ }}</th>
                    @if ($el->type_id == 1)
                        <td>Доход</td>
                    @elseif ($el->type_id == 2)
                        <td>Расход</td>
                    @endif
                    <td>{{ $el->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$categoryModel->WithQueryString()->links()}}
@endsection
