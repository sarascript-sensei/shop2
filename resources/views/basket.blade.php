@extends('layouts.master')

@section('title', __('basket.cart'))

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <h1>@lang('basket.cart')</h1>
    <p>@lang('basket.ordering')</p>
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('basket.name')</th>
                <th>@lang('basket.count')</th>
                <th>Автор</th>
                <th>Дата возврата</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->skus as $sku)
                <tr>
                    <td>
                        <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
                            <img height="56px" src="{{($sku->product->image) }}">
                            {{ $sku->product->__('name') }}
                        </a>
                    </td>
                    <td><span class="badge">{{ $sku->countInOrder }}</span>
                        <div class="btn-group form-inline">
                            <form action="{{ route('basket-remove', $sku) }}" method="POST">
                                <button type="submit" class="btn btn-danger" href=""><span
                                        class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                                @csrf
                            </form>
                            <form action="{{ route('basket-add', $sku) }}" method="POST">
                                <button type="submit" class="btn btn-success"
                                        href=""><span
                                        class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                @csrf
                            </form>
                        </div>
                    </td>
                    <td>{{ $sku->propertyOptions->map->name->implode(', ') }}</td>
                    <td>{{ $date = date("Y-m-d G:i:s", mktime(date("G"), date("i"), date("s"), date("m"), date("d")+14, date("Y")))}}</td>
                </tr>
            @endforeach
{{--            <tr>
                <td colspan="3">@lang('basket.full_cost'):</td>
                @if($order->hasCoupon())
                    <td><strike>{{ $order->getFullSum(false) }}</strike>
                        <b>{{ $order->getFullSum() }}</b> {{ $currencySymbol }}</td>
                @else
                    <td>{{ $order->getFullSum() }} {{ $currencySymbol }}</td>
                @endif
            </tr>--}}
            </tbody>
        </table>
{{--        @if(!$order->hasCoupon())
            <div class="row">
                <div class="form-inline pull-right">
                    <form method="POST" action="{{ route('set-coupon') }}">
                        @csrf
                        <label for="coupon">@lang('basket.coupon.add_coupon'):</label>
                        <input class="form-control" type="text" name="coupon">
                        <button type="submit" class="btn btn-success">@lang('basket.coupon.apply')</button>
                    </form>
                </div>
            </div>
            @error('coupon')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        @else
            <div>@lang('basket.coupon.your_coupon') {{ $order->coupon->code }}</div>
        @endif--}}
        <br>
        <div class="row">
            <br>
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success"
                   href="{{ route('basket-place') }}">@lang('basket.place_order')</a>
            </div>
        </div>
@endsection
