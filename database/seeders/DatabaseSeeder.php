<?php

namespace Database\Seeders;

use App\Models\cart;
use App\Models\cartitem;
use App\Models\category;
use App\Models\user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\product;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $product = product::first();
        $cart = cart::first();
        $category= category::first();
        // User::factory(10)->create();
        // $user = new User();
        // $user->username = 'usser';
        // $user->password = bcrypt('user123'); // Mã hóa mật khẩu
        // $user->email = 'vothaianh46@gmail.com';
        // $user->fullname = 'Võ Thái Anh';
        // $user->phone_number = '0123456789';
        // $user->address = '123 Đường ABC, Quận XYZ, TP.HCM';
        // $user->role = 'user'; // Đặt vai trò là 'user'
        // $user->save();

        // $cart = new cart();
        // $cart->cart_id = 3;
        // $cart->user_id = 6;
        // $cart->created_at = now();
        // $cart->updated_at = now();
        // $cart->save();

        // $cartitem = new cartitem();
        // $cartitem->cart_id = 3;
        // $cartitem->product_id = 1; // Giả sử sản phẩm với ID
        // $cartitem->name_product = $product->name; // Tên sản phẩm
        // $cartitem->quantity = 3;
        // $cartitem->price = $product->price;
        // $cartitem->save();
        $products = new product();
        $products->category_id =$category->cate_id;
        $products->price = 200000;
        $products->name = 'Hoa Lam Linh';
        $products->description = 'Hoa lam linh dep';
        $products->save();
        $products = new product();
        $products->category_id =$category->cate_id;
        $products->price = 400000;
        $products->name = 'Hoa thạch thảo';
        $products->description = 'Hoa thạch thảo cao nguyên ';
        $products->save();

    }
}
