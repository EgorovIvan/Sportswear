@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать категорию</h1>

    </div>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif

    <form method="post"
          action="{{ route('admin.catalog.update', ['catalog' => $product]) }}"
          enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Наименование</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}"/>
            @error('name') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="chapter">Вид</label>
            <input type="text" name="chapter" id="chapter" class="form-control" value="{{ $product->chapter }}"/>
            @error('chapter') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="type">Тип</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $product->type }}"/>
            @error('type') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="code">Код</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $product->code }}"/>
            @error('code') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="price">Стоимость</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}"/>
            @error('title') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="color">Цвет</label>
            <input type="text" name="color" id="color" class="form-control" value="{{ $product->color }}"/>
            @error('price') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="size">Размер</label>
            <input type="text" name="size" id="size" class="form-control" value="{{ $product->size }}"/>
            @error('size') <strong style="color:red" type="danger" >{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" name="description" id="description">{!! $product->description !!}</textarea>
        </div>
        <div class="form-group">
            <label for="specifications">Характеристики</label>
            <textarea class="form-control" name="specifications" id="specifications">{!! $product->specifications !!}</textarea>
            @error('specifications') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="images">Картинки</label>
            <textarea class="form-control" name="images" id="images">{!! $product->images !!}</textarea>
            @error('images') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="rating">Рейтинг</label>
            <input type="text" name="rating" id="rating" class="form-control" value="{{ $product->rating }}"/>
            @error('rating') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>

        <br />
        <button type="submit" class="btn btn-success">Cохранить</button>
    </form>

@endsection
