@extends('layouts.app')


@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            @include('inc.inc_manage')
            <div class="col-8">
                <div class="container">
                    <h2 class="text-center mb-5">Все категории</h2>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

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
                </div>
            </div>
        </div>
    </div>
@endsection
