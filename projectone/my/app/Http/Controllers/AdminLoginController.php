<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class AdminLoginController extends Controller
{
    //显示后台登陆页面
    public function getLogin()
    {
        return view('admins.login');
    }
    public function postDologin(Request $request)
    {
        //获取数据
        //var_dump($request->all());die;
        $res = $request->except('_token');
/*        echo '<pre>';
       var_dump($res);//数组

*/
        $data = DB::table('user')->where('username',$res['username'])->first();
        //var_dump($data);die();

         if(!$data){
            return back()->with('info','用户名或密码有误');
        }
        //密码
        if(!Hash::check($request->input('password'),$data->password)){
            return back()->with('info','密码误');
        }
            //存session
            session(['uid'=>$data->id]);
            return redirect('/admin')->with('info','登陆成功');
    }
//   public function getTest()
 //   {
 //       echo session('uid');
 //   }
 //   //处理退出
    public function getLogout()
    {
        session(['uid'=>null]);
        return redirect('/admin/login/login');
    }
}
