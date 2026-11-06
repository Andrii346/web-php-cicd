@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-white"><h5 class="mb-0">Новий співробітник</h5></div>
    <div class="card-body">
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Прізвище</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ім'я</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">РНОКПП (10 цифр)</label>
                <input type="text" name="tax_number" maxlength="10" class="form-control" value="{{ old('tax_number') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Посада</label>
                <input type="text" name="position" class="form-control" value="{{ old('position') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Посадовий оклад (грн)</label>
                <input type="number" step="0.01" name="base_salary" class="form-control" value="{{ old('base_salary', 25000) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </form>
    </div>
</div>
@endsection