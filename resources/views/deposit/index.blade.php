@extends('layouts.app')

@section('meta.title', 'Пополнение')
@section('meta.robots', 'noindex')

@section('content')
<div class="content content_auth">
    <div class="section__content">
        <form id="deposit-form" method="post" action="{{ url()->current() }}">
            @csrf
            <section class="section">
                <div class="section__header">
                    <label class="section__title section__title_required" for="">Категория</label>
                </div>
                <div class="section__content">
                    <input type="number" name="amount" placeholder="Введите сумму пополнения в рублях..." value="{{ old('amount') }}" class="input" required>
                </div>
            </section>
        </form>
    </div>
</div>
@endsection