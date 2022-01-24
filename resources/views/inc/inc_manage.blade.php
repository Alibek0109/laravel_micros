<div class="col-md-4">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2">
                <div class="navbar-brand">Действия</div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.create') }}">Создание данных</a>
                </li>
                <div class="navbar-brand">Категории</div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.category.index') }}">Все категории</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.category.create') }}">Создать категорию</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
