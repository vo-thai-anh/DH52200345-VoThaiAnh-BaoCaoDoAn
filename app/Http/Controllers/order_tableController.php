<?php

namespace App\Http\Controllers;

use App\Models\Order_table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Orderdt;
use Illuminate\Support\Facades\DB;
use App\Models\Cartitem;

class order_tableController extends Controller
{
    protected function getOrCreateCartId()
    {
        $userId = Auth::id();
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        return $cart->cart_id;
    }
    public function pt(){
        return view('order_table.phuongthucthanhtoan');
    }

    public function thanhtoan(Request $request){
        DB::beginTransaction();
        try{
            $userid = Auth::id();
            $cart_id=$this->getOrCreateCartId();
            $items = Cartitem::where('cart_id',$cart_id)->get();
            if($items->isEmpty()){
                return back()->with('error','gio hang rong ');
            }

            $order=Order_table::create([
                'user_id'=>$userid,
                'total_amount'=>$request->total_amount,
                'shipping_fee'=>$request->shipping_fee,
                'final_total'=>$request->final_total,
                'status'=>'pending',
                'fullname'=>$request->fullname,
                'phone'=>$request->phone,
                'address'=> $request->address,
                'note'=> $request->note,
                'method_pay'=> $request->method_pay,
            ]);
            foreach($items as $item)
                { Orderdt::create([
                'order_id'=> $order->order_id,
                'product_id'=>$item->product_id,
                'name'=>$item->name_product,
                'quantity'=> $item->quantity,
                'price'=> $item->price,
            ]);
            }
            Cartitem::where('cart_id',$cart_id)->delete();
            DB::commit();
            return redirect()->route('cartitems')->with('success','dat haang thanh cong');
        }
        catch(\Exception $e){
            DB::rollBack();
            return back()->with('error','loi he thong'.$e->getMessage());
        }
    }
    public function formthanhtoan()
    {
        //lấy user id
        $cart_id=$this->getOrCreateCartId();
        // biến giỏ hàng truy vấn bảng cartitems trong databse
        $productsincart= DB::table('cartitems')
        ->join('products','cartitems.product_id','=','products.product_id')
        ->where('cartitems.cart_id',$cart_id)
        ->select('cartitems.*','products.name as name','products.price as price')
        ->get();

    if($productsincart->isEmpty()){
        return redirect()->route('cartitems')->with('error', 'Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
    }
    $subTotalItem = 0;
    $fintal_total =0;
    foreach ($productsincart as $item) {
        $subTotalItem += $item->quantity * $item->price;
    }

    $shippingFee = random_int(0,50)*1000; // Phí vận chuyển cố định
    $fintal_total = $subTotalItem + $shippingFee;
        return view('order_table.checkout',[
            'final_total'=>$fintal_total,
            'productsInCart' => $productsincart,
            'subTotalItem' => $subTotalItem,
            'shippingFee' => $shippingFee,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    
}
