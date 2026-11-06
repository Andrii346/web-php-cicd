@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Відомість нарахувань заробітної плати</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Період</th>
                            <th>Співробітник</th>
                            <th>Базова (грн)</th>
                            <th>До виплати</th>
                            <th>Файл</th>
                            <th>Статус</th>
                            <th>Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payrolls as $payroll)
                            <tr>
                                <td><strong>{{ $payroll->period }}</strong></td>
                                <td>{{ $payroll->employee->last_name }} {{ $payroll->employee->first_name }}</td>
                                <td>{{ number_format($payroll->base_salary, 2) }}</td>
                                <td class="text-success fw-bold">{{ number_format($payroll->net_salary, 2) }}</td>
                                <td>
                                    @if ($payroll->attachment_path)
                                        <a href="{{ asset('storage/' . $payroll->attachment_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-info">
                                            Переглянути
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-info text-dark">{{ $payroll->status }}</span></td>
                                <td>
                                    <form action="{{ route('payrolls.destroy', $payroll) }}" method="POST"
                                        onsubmit="return confirm('Ви впевнені, що хочете видалити цей запис?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Видалити</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Записів немає.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{ $payrolls->links() }}
    </div>
@endsection
