@extends('admin.dashboard')

@section('admin_content')

<h1 class="text-3xl font-bold mb-6 text-gray-800">Sửa thông tin hoa</h1>

<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl">

    <form action="{{ route('admin.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <label class="block mb-2 font-semibold">Tên hoa</label>
        <input type="text" name="name" value="{{ $product->name }}"
                class="w-full p-3 border rounded-lg mb-4">

        <label class="block mb-2 font-semibold">Mô tả</label>
        <textarea name="description" class="w-full p-3 border rounded-lg mb-4">{{ $product->description }}</textarea>

        <label class="block mb-2 font-semibold">Giá</label>
        <input type="number" name="price" value="{{ $product->price }}"
                class="w-full p-3 border rounded-lg mb-4">

        <label class="block mb-2 font-semibold">Tồn kho</label>
        <input type="number" name="stock_quantity"
                value="{{ $product->stock->quantity }}"
                class="w-full p-3 border rounded-lg mb-4">

        <label class="block mb-2 font-semibold">Danh mục</label>
        <select name="category_id" class="w-full p-3 border rounded-lg mb-4">
            @foreach($categories as $c)
                <option value="{{ $c->category_id }}" @selected($c->category_id == $product->category_id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-gray-700">Ảnh Chính (Chọn file)</label>
            <input type="file" name="main_image"
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-pink-500 focus:border-pink-500 transition duration-150">
        </div>
        <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Cập nhật
        </button>
    </form>

</div>

@endsection
