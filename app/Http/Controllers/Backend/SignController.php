<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/11/9
 * Time: 3:38 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class SignController extends BackendController
{
    public function in()
    {
        return view('backend.sign.in');
    }

    public function doIn(Request $request)
    {
        // dd(Auth::user() -> id);

        $rules = [
            'username' => 'required|min:5|max:20',
            'password' => 'required|min:3|max:32'
        ];
        $messages = [
            'username.required' => '请输入用户名',
            'username.min' => '用户名长度不要少于:min',
            'username.max' => '用户名长度不要长于:max',
            'password.required' => '请输入密码',
            'password.min' => '密码长度不要少于:min',
            'password.max' => '密码长度不要长于:max',
        ];
        $this -> validate($request, $rules, $messages);


        if (Auth::attempt([$this -> username() => $request -> username, 'password' => $request -> password, 'deleted_at' => null])) {
            return redirect(route('backend.index'));
        } else {
            return $this -> sendFailedLoginResponse($request);
        }
    }

    public function doOut ()
    {
        Auth::logout();
        return redirect(route('backend.sign.in'));
    }

    public function doResetPwd (Request $request)
    {
        if (strlen($request -> newpwd) < 6) {
            return '密码至少6位';
        }
        if ($request -> newpwd != $request -> newpwd_confirm) {
            return '两次密码不一致';
        }
        // dd(bcrypt($request -> pwd));
        if (Auth::attempt([$this->username() => Auth::user()->username,'password'=>$request -> pwd,'deleted_at'=>null])) {
            try {
                DB::table('users')
                    -> where('id',Auth::id())
                    -> update(['password' => bcrypt($request -> pwd)]);
                return '修改成功';
            } catch (\Exception $e) {
                return '修改失败：'.$e -> getMessage();
            }
        } else {
            return '修改失败：原密码不正确！';
        }
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->pwd() => [trans('auth.failed')],
        ]);
    }

    private function username()
    {
        return 'username';
    }

    private function getPrivilege($uid = 0)
    {

    }
}