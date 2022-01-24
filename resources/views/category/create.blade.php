@extends('layouts.app')


@section('content')
    <div class="container_fluid mt-5">
        <div class="row">
            @include('inc.inc_manage')
            <div class="col-md-8">
                <div class="container">
                    <h2 class="text-center mb-3">Создать категорию</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{route('home.category.store')}}" method="post">
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
                            <input type="text" class="form-control" id="category_title" placeholder="Категория"
                                 name="title">
                        </div>
                        <button class="btn btn-success mt-2">Создать категорию</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
