<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Hash;

class AdminUserController extends Controller
{
    public function getIndex(Request $request)
    {
       $res = DB::table('user')->
            where('username','like','%'.$request->input('search').'%')->
            paginate($request->input('num',10));
         return view('admins.user.index',['res'=>$res,'request'=>$request]);

    }
    //后台用户添加页面
    public function getAdd()
    {
        return view('admins.user.add');
    }
    //后台用户添加数据
    
    public function postInsert(Request $request)
    {
        

        $this->validate($request, [
            'username' => 'required|regex:/^\S{8,16}$/|unique:user',
            'password' => 'required|regex:/^\w{6,12}$/',
            'repassword'=>'required|same:password',
            'email'=> 'required|email',
            'phone'=> 'required|regex:/^1[34578]\d{9}$/',

        ],[
            'username.required' => '用户名不能为空',
            'username.regex'=>'用户名格式不正确',
            'username.unique'=>'用户名已存在',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码格式不正确',
            'repassword.required'=>'确认密码不能为空',
            'repassword.same'=>'两次密码不一致',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'phone.required'=>'手机号码不能为空',
            'phone.regex'=>'手机号码格式不正确'
        ]);

        $res = $request->except('_token','profile','repassword');

        //判断文件上传
        if($request->hasFile('profile')) {
            //自定义上传文件的名字
            $names = rand(1111,9999).time();
            //获取上传文件的后缀
            $suffix = $request->file('profile')->getClientOriginalExtension();

            $request->file('profile')->move('./upload/',$names.'.'.$suffix);
        }
        //把上传的图片存储到数据库中
        $res['profile'] = '/upload/'.$names.'.'.$suffix;
        //哈希加密密码
        $res['password'] = Hash::make($request->input('password'));
        //用户的状态
        $res['status'] = '0';
        //数据的添加
        $pro = DB::table('user')->insert($res);
        //判断结果
        if($pro) {

            return redirect('/admin/user/index')->with('info','添加成功');
        } else {

            return back()->with('info','添加失败');
        }
    } 


    public function getEdit($id)
    {
        $res = DB::table('user')->where('id',$id)->first();
        return view('admins.user.edit',['res'=>$res]);
    } 

     public function postUpdate(Request $request)
    {
         $res = $request->except('_token','id');
        //var_dump($res);die();

        //判断文件上传
        if($request->hasFile('profile')) {
            //自定义上传文件的名字
            $names = rand(1111,9999).time();
            //获取上传文件的后缀
            $suffix = $request->file('profile')->getClientOriginalExtension();

            $request->file('profile')->move('./upload/',$names.'.'.$suffix);
        }
        if(isset($names)){
            //把上传的图片存储到数据库中
            $res['profile'] = '/upload/'.$names.'.'.$suffix;
        }
        

        $id = $request->input('id');
        $pro = DB::table('user')->where('id',$id)->update($res);

        if($pro){
            return redirect('/admin/user/index')->with('info','修改成功'); 
        }else{
             return back()->with('info','修改失败');
        }               
    }
    public function getDelete($id)
    { 
        $into = DB::table('user')->where('id',$id)->first();
        if(unlink('.'.$into->profile)){
            $res = DB::table('user')->where('id',$id)->delete();
        
            if($res){
            
                return redirect('/admin/user/index')->with('info','删除成功'); 
            }
        }
    }
    //修改密码页面
    public function getPassword($id)
    {
        $res = DB::table('user')->where('id',$id)->first();
        return view('admins.user.password',['res'=>$res]);
    }
    //修改密码的方法
    public function postPassword(Request $request)
    {
    //表单验证
        $this->validate($request, [
            'username' => 'required|regex:/^\S{8,16}$/',
            'old' => 'required|regex:/^\w{6,12}$/',
            'password' => 'required|regex:/^\w{6,12}$/',
            're'=>'required|same:password',

        ],[
            'username.required' => '用户名不能为空',
            'username.regex'=>'用户名格式不正确',
            'old.required'=>'旧密码不能为空',
            'old.regex'=>'旧密码格式不正确',
            'password.required'=>'新密码不能为空',
            'password.regex'=>'密码格式不正确',
            're.required'=>'确认密码不能为空',
            're.same'=>'两次密码不一致',
         ]);
        $data = DB::table('user')->where('id',$request->input('id'))->first();
        //var_dump($data);die();
        //密码
        if(!Hash::check($request->input('old'),$data->password)){
            return back()->with('info','原密码有误');
        }

        $res = $request->except('_token','old','re');
        $res['password'] = Hash::make($request->input('password'));
        

        $pro = DB::table('user')->where('id',$res['id'])->update($res);
        //var_dump($pro);die();
        if($pro>0)
        {
            return redirect('/admin/user/index')->with('info','修改密码成功');
        }else{
            return back()->with('info','修改失败');
        }
}
    

}