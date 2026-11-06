@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-white d-flex justify-content-between">
        <h5 class="mb-0">Розрахунковий лист #{{ $payroll->id }} ({{ $payroll->period }})</h5>
        <a href="{{ route('payrolls.index') }}" class="btn btn-sm btn-secondary">Назад</a>
    </div>
    <div class="card-body">
        <p><strong>Співробітник:</strong> {{ $payroll->employee->last_name }} {{ $payroll->employee->first_name }} ({{ $payroll->employee->position }})</p>
        <p><strong>Відпрацьовано днів:</strong> {{ $payroll->worked_days }}</p>
        <p><strong>Нараховано за окладом:</strong> {{ number_format($payroll->base_salary, 2) }} грн</p>
        <p><strong>Премія:</strong> {{ number_format($payroll->bonus, 2) }} грн</p>
        <p><strong>Податки (19.5%):</strong> -{{ number_format($payroll->tax_amount, 2) }} грн</p>
        <hr>
        <h6>Додаткові компоненти (M:M):</h6>
        <ul>
            @forelse($payroll->components as $comp)
                <li>{{ $comp->name }} ({{ $comp->type === 'allowance' ? '+' : '-' }}{{ number_format($comp->pivot->amount, 2) }} грн)</li>
            @empty
                <li class="text-muted">Немає додаткових компонентів</li>
            @endforelse
        </ul>
        <h4 class="text-success mt-3">Сума до виплати (на руки): {{ number_format($payroll->net_salary, 2) }} грн</h4>
    </div>
</div>
@endsection