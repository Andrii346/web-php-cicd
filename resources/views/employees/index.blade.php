@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Реєстр співробітників</h5>
        <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">Додати співробітника</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>ПІБ</th>
                    <th>РНОКПП (ІПН)</th>
                    <th>Посада</th>
                    <th>Базовий оклад</th>
                    <th>Нарахувань</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $emp)
                    <tr>
                        <td>{{ $emp->id }}</td>
                        <td><strong>{{ $emp->last_name }} {{ $emp->first_name }}</strong><br><small class="text-muted">{{ $emp->email }}</small></td>
                        <td><code>{{ $emp->tax_number }}</code></td>
                        <td>{{ $emp->position }}</td>
                        <td>{{ number_format($emp->base_salary, 2) }} грн</td>
                        <td><span class="badge bg-secondary">{{ $emp->payrolls_count }}</span></td>
                        <td>
                            <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" onsubmit="return confirm('Архівувати співробітника?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-3">Співробітників ще немає.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection