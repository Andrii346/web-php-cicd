@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-white"><h5 class="mb-0">Новий компонент ЗП</h5></div>
    <div class="card-body">
        <form action="{{ route('components.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Назва (напр. Премія за KPI)</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Системний код (напр. KPI_BONUS)</label>
                <input type="text" name="code" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Тип</label>
                <select name="type" class="form-select">
                    <option value="allowance">Нарахування (+)</option>
                    <option value="deduction">Утримання (-)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Створити</button>
        </form>
    </div>
</div>
@endsection