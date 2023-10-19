@extends('layouts.payments')

@section('title')
    Пополнение @parent
@stop

@section('content')
{{--    <h5>Текущий баланс</h5>--}}
{{--    <br>--}}

{{--    <div>@if(cache()->has('balance')) {{ cache()->get('balance') }} @else 0 @endif</div>--}}
    <br>

    <h2>Данные по оплате</h2>
    <br>

    <form method="post" action="{{route('payments.create')}}">
        @csrf

        <div class="form-group">
            <label for="size">Сумма платежа</label>
            <input class="form-control" type="number" name="amount" id="website" placeholder="Сумма"
                   value="{{ $total }}" aria-label="Disabled input example" disabled>
        </div>
        <div class="form-group">
            <label for="description">Описание платежа</label>
            <textarea class="form-control" name="description" id="about"></textarea>
        </div>
        <br>

        <button type="submit" class="btn btn-success">Произвести оплату</button>
        <br>

        <h2>Список транзакций</h2>

            <table class="table table-cell">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Сумма</th>
                    <th>Описание</th>
                    <th>Статус</th>
                    <th>Дата</th>
                </tr>
                </thead>

                <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>{{ $transaction->updated_at }}</td>

                    </tr>
                @empty
                    Транзакций нет
                @endforelse
                </tbody>

            </table>
    </form>
@stop

