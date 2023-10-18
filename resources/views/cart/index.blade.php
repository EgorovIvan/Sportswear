@extends('layouts.cart')
@section('title')
    Корзина @parent
@stop
@section('content')
    <div class="cart">
        @if ($errors->any())
            @foreach($errors->all() as $error)
                <x-alert type="danger" :message="$error"></x-alert>
            @endforeach
        @endif
        <section class="cart__header">

        </section>

        <section class="cart__products">
            <div class="products-cart">
                <ul class="products-cart__list">
                    @foreach($resource as $product)
                        <li class="products-cart__item">
                            <img src="{{json_decode($product->images)->a}}" alt="{{$product->name}}">
                            <div class="products-cart__item-info">
                                <p class="products-cart__item-name">{{ $product->name }}</p>
                                <p class="products-cart__item-description">{{ $product->description }}</p>
                            </div>

                            <div class="products-cart__item-total">
                                <p class="products-cart__item-price" >{{ $product->price * $product->quantity }} ₽</p>
                                <hr class="products-cart__hr-shelf">
                                <form method="post">
                                    @csrf
                                    @method('put')
                                    <div class="products-cart__item-count"
                                         >
                                        <input type="hidden" name="quantity" value="{{ $product->quantity }}" />

                                        <button class="products-cart__item-btn" name="product_id"
                                                formaction="{{ route('cart.reduceQuantity', ['id' => $product->id]) }}"
                                                value="{{ $product->id }}">
                                            <img src="/img/cart/minus.png" alt="">
                                        </button>

                                        <p class="products-cart__item-number">{{ $product->quantity }}</p>

                                        <button class="products-cart__item-btn" name="product_id"
                                                formaction="{{ route('cart.addQuantity', ['id' => $product->id]) }}"
                                                value="{{ $product->id }}">
                                            <img src="/img/cart/plus.png" alt="">
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="products-cart__buy">

                    <p class="products-cart__buy-title">ИТОГО</p>

                    <div class="products-cart__buy-total">
                        <p class="products-cart__buy-count">{{ $singular }}</p>
                        <p class="products-cart__buy-price">{{ $total }} ₽</p>
                    </div>

                    <button class="products-cart__buy-btn">Перейти к оформлению</button>
                </div>
            </div>
        </section>

    </div>

@endsection

