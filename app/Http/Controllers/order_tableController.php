<?php

namespace App\Http\Controllers;

use App\Models\Order_table;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Orderdt;
use Illuminate\Support\Facades\DB;
use App\Models\Cartitem;
use App\Models\Payment;

class order_tableController extends Controller
{
        public function indexOrder(){
            $order=DB::table('orderdts')
            ->leftJoin('order_tables','order_tables.order_id','=','Orderdts.order_id')
            ->leftJoin('payments','payments.order_id','=','order_tables.order_id')
            ->select('orderdts.order_id','order_tables.fullname','order_tables.final_total','payments.status')
            ->orderBy('order_tables.order_id','desc')
            ->paginate(10);
            return view('admin.indexOrder',compact('order'));
        }
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
            foreach($items as $item){
                $stock = Stock::where('product_id', $item->product_id)->lockForUpdate()->first();
                if (!$stock || $stock->quantity < $item->quantity) {
                DB::rollBack();
                return back()->with('error',
                    'Sản phẩm "' . $item->name_product . '" không đủ hàng'
                );
            }
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
            Stock::where('product_id', $item->product_id)
            ->decrement('quantity', $item->quantity);
            }
                Payment::create([
                    'order_id'=> $order->order_id,
                    'user_id'=>$userid,
                    'amount'=>$request->total_amount,
                    'payment_method'=>$request->method_pay,
                    'status'=>$request->method_pay == 'Bank Transfer'?'da thanh toan ': 'chua thanh toan',
                ]);
            
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
