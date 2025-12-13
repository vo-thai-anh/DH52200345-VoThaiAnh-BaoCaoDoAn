<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class cartitemController extends Controller
{
    // user->cart->cartitem
    protected function getOrCreateCartId()
    {
        $userId = Auth::id();
        // Tìm Giỏ hàng của user_id này, nếu không có thì tạo mới
        // Đây là cầu nối User -> Cart
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        
        return $cart->cart_id;
    }
    public function add(Request $request)
    {
        // 1. Validate dữ liệu đầu vào
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cartId = $this->getOrCreateCartId();

        $product = Product::where('product_id', $productId)->first();

        if (!$product) {
            return back()->with('error', 'Sản phẩm không tồn tại hoặc đã bị xóa.');
        }


        $cartItem = Cartitem::where('cart_id', $cartId)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
            $message = 'Đã cập nhật số lượng cho sản phẩm **' . $product->name . '** trong giỏ hàng.';
        } else {
            Cartitem::create([
                'cart_id' => $cartId, // **Đã FIX:** Sử dụng cart_id hợp lệ từ bảng Carts
                'name_product' => $product->name,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price, // Lưu trữ giá tại thời điểm thêm vào giỏ
            ]);
            $message = 'Đã thêm sản phẩm **' . $product->name . '** vào giỏ hàng thành công!';
        }
        
        // 5. Chuyển hướng đến trang giỏ hàng (sử dụng route name đã được đặt tên)
        return redirect()->route('cartitems')->with('success', $message);
    }

    public function remove($id)
    {
        $cartId = $this->getOrCreateCartId();
        $cartItem = Cartitem::where('cart_id', $cartId)
                            ->where('id', $id)
                            ->first();
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cartitems')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
        } else {
            return redirect()->route('cartitems')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }
    }
    public function index()
    {
        //$cartitems = session()->get('cartitems', []); khong su dung session o day
        return view('cart.index');
    }
}
