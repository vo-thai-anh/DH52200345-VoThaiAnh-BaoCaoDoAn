@extends('admin.dashboard')

@section('admin_content')

<h1 class="text-3xl font-bold mb-6 text-gray-800">Quản lý Đơn Hàng</h1>

<div class="mt-6 bg-white p-6 rounded-lg shadow">
    <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 border-b">
            <tr class="text-left">
                <th class="p-3">Order ID</th>
                <th class="p-3">Khách hàng</th>
                <th class="p-3">Tổng tiền</th>
                <th class="p-3">Trạng thái</th>
                <th class="p-3">Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order as $or)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $or->order_id }}</td>
                    <td class="p-3">
                        {{ $or->fullname}}
                    </td>

                    <td class="p-3 text-pink-600 font-semibold">
                        {{ number_format($or->final_total) }} đ
                    </td>

                    <td class="p-3">
                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-700">
                            {{ $or->status }}
                        </span>
                    </td>

                    <td class="p-3">
                        <a href="{{ route('home', $or->order_id) }}"
                            class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Xem
                        </a>
                        <form action="{{ route('admin.products.delete', $or->order_id) }}"
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
        {{ $order->links() }}
    </div>
</div>

@endsection
