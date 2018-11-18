<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/11/9
 * Time: 3:39 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SystemsController extends BackendController
{
	public function department()
    {
        $departments = DB::table('departments')
        	-> select('name')
        	-> whereNull('deleted_at')
        	-> orderBy('id')
        	-> get();
        if ($departments -> isEmpty()) {
            return redirect(route('backend.index')) -> with('error', '当前没有部门');
        }
        return view('backend.systems.group', ['departments'=>$departments]);

    }

    public function user()
    {
        $users = DB::table('users')
            -> select('users.id','users.username','users.name','departments.name as department')
            -> leftJoin('departments', 'departments.id', '=', 'users.dep_id')
            -> whereNull('users.deleted_at')
            -> whereNull('departments.deleted_at')
            -> where('users.id', '>', 1)
            -> orderBy('departments.id')
            -> get();
        // if ($users -> isEmpty()) {
        //     return view('backend.systems.user') -> with('error','当前没有用户');
        // }
        return view('backend.systems.user', ['users'=>$users]);

    }

    public function userForm(Request $request)
    {
        $departments = DB::table('departments')
                -> select('id','name')
                -> whereNull('deleted_at')
                -> orderBy('id')
                -> get();
        if ($departments -> isEmpty()) {
            return redirect(route('backend.index')) -> with('error', '用户操作出错');
        }
        $user = null;
        if ($request -> has('id')) {
            $user = DB::table('users')
                -> select('users.id', 'users.username', 'users.name', 'users.password', 'users.dep_id')
                -> leftJoin('departments', 'departments.id', '=', 'users.dep_id')
                -> whereNull('departments.deleted_at')
                -> whereNull('users.deleted_at')
                -> where('users.id', $request -> id)
                -> first();
            if (!$user) {
                return redirect(route('backend.systems.user')) -> with('error', '用户操作出错');
            }
        }
        return view('backend.systems.userform',
            ['user' => $user, 'departments' => $departments]);
    }

    public function userStore(Request $request)
    {
        $rules = [
            'username' => 'required|max:20|min:2',
            'name' => 'required|max:10|min:2',
            'password' => 'required|max:16|min:3',
        ];
        $messages = [
            'username.required' => '请输入用户名',
            'username.max' => '用户名长度不要超过:max',
            'username.min' => '用户名长度不要少于:min',
            'name.required' => '请输入姓名',
            'name.max' => '姓名长度不要超过:max',
            'name.min' => '姓名长度不要少于:min',
            'password.required' => '请输入密码',
            'password.max' => '密码长度不要超过:max',
            'password.min' => '密码长度不要少于:min',
        ];

        $this -> validate($request, $rules, $messages);

        $data = [
            'username' => $request -> username,
            'name' => $request -> name,
            'password' => Hash::make($request -> password),
            'dep_id' => $request -> dep_id,
        ];

        try {
            if ($request -> has('id')) {
                DB::table('users')
                    -> where('id', $request -> id)
                    -> update($data);
            } else {
                DB::table('users') -> insert($data);
            }
            return redirect(route('backend.systems.user')) -> with('success', '保存成功！');
        } catch (\Exception $e) {
            return redirect(route('backend.systems.user'))
                -> with('error', sprintf('保存失败，请联系管理员。【%s】', $e -> getMessage()));
        }
    }

    public function userDel()
    {
        $departments = DB::table('users')
            -> sw('deleted_at')
            -> orderBy('id')
            -> get();
        return view('backend.systems.user', []);

    }

    public function menu()
    {
        
        return view('backend.systems.menu', []);

    }
}