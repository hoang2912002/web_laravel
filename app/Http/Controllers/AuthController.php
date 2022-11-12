<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {   
        try {
            $user = User::query()
                ->where('email' , $request->get('email'))
                ->where('password' , $request->get('password'))
                ->firstOrFail();
            //method firstOrFail() nó sẽ bắn về exception nếu mà k tìm thấy thằng nào


            session()->put('id', $user->id);
            session()->put('name', $user->name);
            session()->put('avatar', $user->avatar);
            session()->put('level', $user->level);
            //put là đặt vào giả sử trong DB đã có gtri đó r thì nó sẽ ghi đè lên
            //còn push là đẩy vào   thì nếu nhưng trong DB đã có gtri r thì nó sẽ báo lỗi
            return redirect()->route('courses.index');

        } catch (Throwable $th) {
            return redirect()->route('login')->with('error', 'Đăng nhập không thành công');
        };
        //try là mình sẽ thử 1 cái j đó 
        //catch ở đây là bắt các trường hợp và Throwable là bắt mọi trường hợp kể cả lõi logic và lỗi cú pháp 1 cách tương đối
       

    }

    public function logout()
    {
        session()->flush();
        //flush là xóa hết toàn bộ trong session

        return redirect()->route('login');
    }
}
