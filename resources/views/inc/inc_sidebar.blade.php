<div class="col-md-4">
    <nav class="navbar navbar-dark bg-dark vh-100 align-items-md-start">
        <div class="container-fluid mt-5">
            <ul class="navbar-nav me-auto mb-2">
                <div class="navbar-brand">Бухгалтерия</div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}">Главная</a>
                </li>
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
