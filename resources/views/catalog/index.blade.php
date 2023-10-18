@extends('layouts.catalog')
@section('title')
    Каталог @parent
@stop
@section('content')
    <div class="catalog">

        @if ($errors->any())
            @foreach($errors->all() as $error)
                <x-alert type="danger" :message="$error"></x-alert>
            @endforeach
        @endif
        <section class="catalog__search">
            <form class="search" method="get" action="{{ route('catalog.search') }}">
                <div class="search__border">
                    <input id="search" name="search" class="search__input" type="search"
                           value="{{ isset($search) ? $search : '' }}">
                </div>

                <button class="search__btn" type="submit">Найти</button>
            </form>
        </section>

        <section class="catalog__field">

            <form class="filter" method="get" action="{{ route('catalog.filter') }}">
                @csrf
                <div class="filter__title">Категории</div>
                <label class="filter__item">
                    <input id="checked-men" class="filter__item-checkbox" type="checkbox" name="men"
                           value="100" @checked(isset($checked['men']) ? 100 : '')/>
                    <span class="filter__item-text">Мужская одежда</span>
                    <span class="filter__item-text"></span>
                </label>
                <label class="filter__item">
                    <input class="filter__item-checkbox" type="checkbox" name="women"
                           value="101" @checked(isset($checked['women']) ? 101 : '')/>
                    <span class="filter__item-text">Женская одежда</span>
                </label>
                <label class="filter__item">
                    <input class="filter__item-checkbox" type="checkbox" name="kids"
                           value="102" @checked(isset($checked['kids']) ? 102 : '')/>
                    <span class="filter__item-text">Детская одежда</span>
                </label>
                <label class="filter__item">
                    <input class="filter__item-checkbox" type="checkbox" name="accessories"
                           value="103" @checked(isset($checked['accessories']) ? 103 : '')/>
                    <span class="filter__item-text">Аксессуары</span>
                </label>
                <button class="filter__button" type="submit" id="filter_btn">Применить</button>
            </form>

            <div class="products">
                <ul class="products__list">
                    @foreach($products as $product)

                        @if($productsCart->contains('product_id', $product->id))
                            <li class="products__item">
                                <img src="{{ json_decode($product->images)->a }}" alt="{{ $product->name }}">
                                <p class="products__item-price">{{ $product->price }} ₽</p>
                                <p class="products__item-name">{{ $product->name }}</p>
                                <div class="products__item-btn">
                                    <button class="products__add-basket">Товар в корзине</button>
                                    <form method="POST" id="data" action="{{ route('cart.destroy', ['id' => $product->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="products__delete" >
                                            <img src="/img/delete.png" alt="delete">
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="products__item">
                                <img src="{{ json_decode($product->images)->a }}" alt="{{$product->name}}">
                                <p class="products__item-price">{{$product->price}} ₽</p>
                                <p class="products__item-name">{{$product->name}}</p>
                                <form action="{{ route('cart.add', ['id' => $product->id]) }}" method="post">
                                    @csrf
                                    <button class="products__add-basket" type="submit" name="product_id" id="test"
                                            value={{$product->id}}>Добавить в корзину</button>
                                </form>

                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>

    </div>

@endsection
@push('js')
{{--    <script type="text/javascript">--}}
{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            let items = document.querySelectorAll(".products__delete")--}}
{{--            items.forEach(function (item, key) {--}}
{{--                item.addEventListener('click', function () {--}}
{{--                    const id = this.getAttribute('rel');--}}
{{--                    if(confirm(`Подтвердить удаление источника с #ID = ${id}`)) {--}}

{{--                        send(`/cart/${id}`).then(() => {--}}
{{--                            location.reload();--}}
{{--                            console.log(id);--}}
{{--                        });--}}
{{--                    } else {--}}
{{--                        alert("Отменено");--}}
{{--                    }--}}
{{--                })--}}
{{--            })--}}
{{--        })--}}

{{--        async function send(url) {--}}
{{--            let response = await fetch(url, {--}}
{{--                method: 'DELETE',--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')--}}
{{--                }--}}
{{--            });--}}


{{--            let result = await response.json();--}}
{{--            return result.ok;--}}
{{--        }--}}
{{--    </script>--}}
@endpush

