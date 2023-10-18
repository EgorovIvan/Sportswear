@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить продукт</h1>

    </div>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif

    <form method="post" action="{{ route('admin.catalog.store', ['query' => 'test']) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Наименование</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"/>
            @error('name') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="chapter">Вид</label>
            <input type="text" name="chapter" id="chapter" class="form-control" value="{{ old('chapter') }}"/>
            @error('chapter') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="type">Тип</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}"/>
            @error('type') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="code">Код</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}"/>
            @error('code') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="price">Стоимость</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}"/>
            @error('title') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="color">Цвет</label>
            <input type="text" name="color" id="color" class="form-control" value="{{ old('color') }}"/>
            @error('price') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="size">Размер</label>
            <input type="text" name="size" id="size" class="form-control" value="{{ old('size') }}"/>
            @error('size') <strong style="color:red" type="danger" >{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="specifications">Категории</label>--}}
{{--            <select class="form-control" multiple name="specifications[]" id="specifications">--}}
{{--                    <option value="example1">test1</option>--}}
{{--                    <option value="example2">test2</option>--}}
{{--            </select>--}}
{{--        </div>--}}

        <div class="form-group">
            <label for="specifications">Характеристики</label>
            <textarea class="form-control" name="specifications" id="specifications">{!! old('specifications') !!}</textarea>
        </div>
        <div class="form-group">
            <label for="images">Картинки</label>
            <textarea class="form-control" name="images" id="images">{!! old('images') !!}</textarea>
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="images">Картинки</label>--}}
{{--            <select class="form-control" multiple name="images[]" id="images">--}}
{{--                <option value="example1">test1</option>--}}
{{--                <option value="example2">test2</option>--}}
{{--            </select>--}}
{{--        </div>--}}
        <div class="form-group">
            <label for="rating">Рейтинг</label>
            <input type="text" name="rating" id="rating" class="form-control" value="{{ old('rating') }}"/>
            @error('rating') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>


        <br />
        <button type="submit" class="btn btn-success">Cохранить</button>
    </form>

@endsection
