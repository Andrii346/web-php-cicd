<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Робоче місце бухгалтера ЗП</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('payrolls.index') }}">Бухгалтерія ЗП</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link {{ request()->routeIs('payrolls.*') ? 'active' : '' }}" href="{{ route('payrolls.index') }}">Відомості ЗП</a>
            <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">Співробітники (1:M)</a>
            <a class="nav-link {{ request()->routeIs('components.*') ? 'active' : '' }}" href="{{ route('components.index') }}">Компоненти ЗП (M:M)</a>
            <a class="nav-link text-info" href="{{ route('payrolls.report.summary') }}" target="_blank">JSON-Звіт</a>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('employees.create') }}" class="btn btn-outline-light btn-sm">+ Співробітник</a>
            <a href="{{ route('components.create') }}" class="btn btn-outline-warning btn-sm">+ Компонент</a>
            <a href="{{ route('payrolls.create') }}" class="btn btn-success btn-sm">+ Нарахувати ЗП</a>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>
</body>
</html>