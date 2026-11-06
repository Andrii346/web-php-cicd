@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Довідник компонентів ЗП (M:M)</h5>
        <a href="{{ route('components.create') }}" class="btn btn-primary btn-sm">Додати компонент</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Код</th>
                    <th>Назва</th>
                    <th>Тип</th>
                    <th>Застосовано разів</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @forelse($components as $comp)
                    <tr>
                        <td><code>{{ $comp->code }}</code></td>
                        <td><strong>{{ $comp->name }}</strong></td>
                        <td>
                            @if($comp->type === 'allowance')
                                <span class="badge bg-success">Нарахування (+)</span>
                            @else
                                <span class="badge bg-warning text-dark">Утримання (-)</span>
                            @endif
                        </td>
                        <td>{{ $comp->payrolls_count }}</td>
                        <td>
                            <form action="{{ route('components.destroy', $comp->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-3">Компонентів немає.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection