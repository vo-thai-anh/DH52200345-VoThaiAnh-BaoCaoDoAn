
@extends('admin.dashboard')

@section('admin_content')

<h1 class="text-3xl font-bold mb-6 text-gray-800">Quản lý Đơn Hàng</h1>

<div class="mt-6 bg-white p-6 rounded-lg shadow">
    <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 border-b">
            <tr class="text-left">
                <th class="p-3">OrderID</th>
                <th class="p-3">Product ID</th>
                <th class="p-3">USER</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $or )
                <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $or->cart_id }}</td>
                <td class="p-3 font-medium">{{ $p->product_id }}</td>
                <td class="p-3 text-pink-600 font-semibold">{{ number_format($p->price) }} đ</td>
            @endforeach
                <td class="p-3">
                    <a href="{{ route('admin.products.edit', $p->product_id) }}"
                        class="px-3 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        Sửa
                    </a>
                    <form action="{{ route('admin.products.delete', $p->product_id) }}"
                            method="POST" class="inline-block"
                            onsubmit="return confirm('Bạn chắc chắn muốn xóa?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
