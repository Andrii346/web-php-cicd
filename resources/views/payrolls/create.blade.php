@extends('layouts.app')

@section('content')
    <div class="card shadow-sm col-md-8 mx-auto">
        <div class="card-header bg-white">
            <h5 class="mb-0">Створення розрахунку заробітної плати</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('payrolls.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Співробітник</label>
                    <select name="employee_id" class="form-select" required>
                        <option value="">Оберіть працівника</option>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}" {{ old('employee_id') == $emp->id ? 'selected' : '' }}>
                                {{ $emp->last_name }} {{ $emp->first_name }} (Оклад: {{ $emp->base_salary }} грн)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Період (YYYY-MM)</label>
                        <input type="month" name="period" class="form-control" value="{{ old('period', date('Y-m')) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Відпрацьовано днів</label>
                        <input type="number" name="worked_days" class="form-control" min="1" max="31"
                            value="{{ old('worked_days', 22) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Премія (грн)</label>
                    <input type="number" step="0.01" name="bonus" class="form-control"
                        value="{{ old('bonus', '0.00') }}">
                </div>

                <h6 class="mt-4 mb-2">Додаткові нарахування / утримання (зв'язок M:M):</h6>
                @foreach ($components as $index => $comp)
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ $comp->name }} ({{ $comp->type }})</span>
                        <input type="hidden" name="components[{{ $index }}][id]" value="{{ $comp->id }}">
                        <input type="number" step="0.01" name="components[{{ $index }}][amount]"
                            class="form-control" placeholder="Сума (0.00)" value="0.00">
                    </div>
                @endforeach

                <div class="mb-3">
                    <label class="form-label">Прикріпити документ/наказ (PDF, JPG, PNG)</label>
                    <input type="file" name="attachment" class="form-control">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Розрахувати та зберегти</button>
                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Скасувати</a>
                </div>
            </form>
        </div>
    </div>
@endsection
