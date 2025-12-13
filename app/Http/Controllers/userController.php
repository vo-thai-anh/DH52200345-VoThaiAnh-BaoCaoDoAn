<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

// Thay 1 bằng ID của tài khoản đang gặp lỗi

    public function indexUser(){
        $user = DB::table('users')
            ->select('user_id','username','email','role')
            ->orderBy('user_id','desc')
            ->paginate(10);
            return view('admin.indexUser',compact('user'));
    }
    public function register(){
        return view('login-logout.register');
    }
    public function acpregister(request $request){
        $request->validate([
            'username'=>'required|string|max:255|unique:users,username' ,
            'password'=>'required|string|min:1|confirmed',
            'email'=>'required|email|max:255|unique:users,email',
            'fullname'=>'required|string|max:100',
            'phone_number'=> 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'nullable|string|in:user,admin'
        ]);
        try{
            $user=User::create([
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'fullname'=>$request->fullname,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'role'=>$request->role ??'user'
        ]);
                return redirect()->intended('login')
            ->with('success', 'Đăng ký thành công');
        }
        catch(Exception $e){
            return back()->with('error',' đã trùng '.$e->getMessage());
        }
    }
    public function login(){
        return view('login-logout.login');
    }
    public function checklogin(request $request){
        $request->validate([
        'email'=>'required|email',
        'password'=>'required|string|min:1',
    ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
        $user = Auth::user();
        if($user->isadmin()){
            return redirect('admin/dashboard')->with('success','đăng nhập thành công');
        }
        return redirect('/')->with('success','đăng nhập thành công ');
    }
        return back()->withErrors(['email'=>'email hoặc mật khẩu không đúng',])
        ->withInput();
    }
    public function logout(request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success','Đăng xuất thành công');
    }
    // public function checklogin(request $request){
    //     $request->validate([
    //         'username'=>'required|string',
    //         'password'=>'required|string'
    //     ]);
    //     $user=user::where('username',$request->username)->first();
    //     if( !$user || !Hash::check($request->password,$user->password)){
    //         return redirect()
    //         ->route('login')
    //         ->withErrors(['username'=>'Thông tin đăng nhập không hợp lệ'])
    //         ->withInput($request->only('username'));
    //     }
    //     else{
    //         Auth::login($user);
    //         return redirect()->intended('/')->with('success','Đăng nhập thành công');
    //     }
    // }

    
}
