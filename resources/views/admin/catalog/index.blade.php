@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Категории</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.catalog.create') }}" type="button" class="btn btn-sm btn-outline-success">Добавить продукт</a>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Chapter</th>
                <th>Type</th>
                <th>Code</th>
                <th>Price</th>
                <th>Color</th>
                <th>Size</th>
                <th>Description</th>
                <th>Specifications</th>
                <th>Images</th>
                <th>Rating</th>
                <th>Date created</th>
            </tr>
            @foreach($products as $productItem)
                <tr>
                    <td>{{ $productItem->id }}</td>
                    <td>{{ $productItem->name }}</td>
                    <td>{{ $productItem->chapter }}</td>
                    <td>{{ $productItem->type }}</td>
                    <td>{{ $productItem->code }}</td>
                    <td>{{ $productItem->price }}</td>
                    <td>{{ $productItem->color }}</td>
                    <td>{{ $productItem->size }}</td>
                    <td>{{ $productItem->description }}</td>
                    <td>{{ $productItem->specifications }}</td>
                    <td>{{ $productItem->images }}</td>
                    <td>{{ $productItem->rating }}</td>
                    <td>{{ $productItem->created_at }}</td>
                    <td>
                        <div class="admin__btns">
                            <a class="admin__edit" href="{{ route('admin.catalog.edit', ['catalog' => $productItem]) }}"><img src="/img/admin/edit.png" alt="edit"></a>
                            <a class="admin__delete delete" href="javascript:;" rel="{{$productItem->id}}"><img src="/img/admin/delete.png" alt="delete"></a>
                        </div>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
"@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            let items = document.querySelectorAll(".delete")
            items.forEach(function (item, key) {
                item.addEventListener('click', function () {
                    const id = this.getAttribute('rel');
                    if(confirm(`Подтвердить удаление продукта с #ID = ${id}`)) {
                        send(`/admin/catalog/${id}`).then(() => {
                            location.reload();
                        });
                    } else {
                        alert("Отменено");
                    }
                })
            })
        })

        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });


            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
