<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/11/9
 * Time: 3:40 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends BackendController
{
    public function footnav(Request $request)
    {
        $footnavs = DB::table('footnavs')
            -> select('id', 'name', 'code', 'weight','created_at')
            -> whereNull('deleted_at')
            -> get();
        return view('backend.settings.footnav', [
            'footnavs' => $footnavs
        ]);
    }

    public function footnavForm(Request $request)
    {
        if ($request -> has('id')) {
            $footnav = DB::table('footnavs')
                -> select('*')
                -> where('id', $request -> id)
                -> whereNull('deleted_at')
                -> first();
            if (is_null($footnav)) {
                return redirect(route('backend.settings.footnav')) -> with('error', '未查询到该板块，请重试！');
            } else {
                return view('backend.settings.footnavform', ['footnav' => $footnav]);
            }
        } else {
            return view('backend.settings.footnavform');
        }
    }

    public function footnavStore(Request $request)
    {
        $rules = [
            'name' => 'required|max:10|min:4|unique:footnavs,name,'
                . ($request -> has('id') ? $request -> id : 'NULL') . ',id,deleted_at,NULL',
            'code' => 'required|max:10|min:4|unique:footnavs,code,'
                . ($request -> has('id') ? $request -> id : 'NULL') . ',id,deleted_at,NULL',
            'weight' => 'required|numeric|max:1000|min:0'
        ];
        $messages = [
            'name.required' => '请输入导航名称',
            'name.max' => '导航名称长度不要超过:max',
            'name.min' => '导航名称长度不要少于:min',
            'name.unique' => '该导航名称已存在',
            'code.required' => '请输入导航代码',
            'code.max' => '导航代码长度不要超过:max',
            'code.min' => '导航代码长度不要少于:min',
            'code.unique' => '导航代码已存在',
            'desc.required' => '请输入描述信息',
            'desc.max' => '导航描述不要超过:max',
            'desc.min' => '导航描述不要少于:min',
            'weight.required' => '请输入导航权重',
            'weight.max' => '导航权重不要大于:max',
            'weight.min' => '导航权重不要小于:min',
        ];
        $this -> validate($request, $rules, $messages);

        $data = [
            'name' => $request -> name,
            'code' => $request -> code,
            'weight' => $request -> weight
        ];
        try {
            if ($request -> has('id')) {
                DB::table('footnavs')
                    -> where('id', $request -> id)
                    -> update($data);
            } else {
                DB::table('footnavs') -> insert($data);
            }
            return redirect(route('backend.settings.footnav')) -> with('success', '保存成功！');
        } catch (\Exception $e) {
            return redirect(route('backend.settings.footnav'))
                -> with('error', sprintf('保存失败，请联系管理员。【%s】', $e -> getMessage()));
        }
    }

    public function footnavDel(Request $request)
    {
        if ($request -> has('id')) {
            DB::table('footnavs')
                -> where('id', $request -> id) -> update(['deleted_at' => date('Y-m-d H:i:s')]);
            return redirect(route('backend.settings.footnav')) -> with('success', '删除成功！');
        } else {
            return redirect(route('backend.settings.footnav')) -> with('error', '删除失败，请提供所要删除的导航板块ID！');
        }
    }

    public function link(Request $request)
    {
        $links = DB::table('links')
            -> select('links.id', 'links.name', 'links.link', 'links.weight', 'links.created_at','footnavs.name as nav')
            -> leftJoin('footnavs', 'footnavs.id','=','links.parent_id')
            -> whereNull('links.deleted_at')
            -> whereNull('links.deleted_at')
            -> get();
        return view('backend.settings.link', [
            'links' => $links
        ]);

    }

    public function linkForm(Request $request)
    {
        $footnavs = DB::table('footnavs')
            -> select('id', 'name')
            -> whereNull('deleted_at')
            -> get();
        $link = null;
        if ($request -> has('id')) {
            $link = DB::table('links')
                -> select('*')
                -> where('id', $request -> id)
                -> whereNull('deleted_at')
                -> first();
            if (is_null($link)) {
                return redirect(route('backend.settings.link')) -> with('error', '未查询到该板块，请重试！');
            }
            // return view('backend.settings.linkform',['footnavs' => $footnavs,'link' => $link]);
        }
        return view('backend.settings.linkform',['footnavs' => $footnavs,'link' => $link]);

    }

    public function linkStore(Request $request)
    {
        $rules = [
            'name' => 'required|max:10|min:2|unique:links,name,'
                . ($request -> has('id') ? $request -> id : 'NULL') . ',id,deleted_at,NULL',
            'link' => 'required|max:50|min:17|unique:links,link,'
                . ($request -> has('id') ? $request -> id : 'NULL') . ',id,deleted_at,NULL',
            'weight' => 'required|numeric|max:1000|min:0'
        ];
        $messages = [
            'name.required' => '请输入链接名称',
            'name.max' => '链接名称长度不要超过:max',
            'name.min' => '链接名称长度不要少于:min',
            'name.unique' => '该链接名称已存在',
            'link.required' => '请输入链接代码',
            'link.max' => '链接代码长度不要超过:max',
            'link.min' => '链接代码长度不要少于:min',
            'link.unique' => '链接代码已存在',
            'desc.required' => '请输入描述信息',
            'desc.max' => '链接描述不要超过:max',
            'desc.min' => '链接描述不要少于:min',
            'weight.required' => '请输入链接权重',
            'weight.max' => '链接权重不要大于:max',
            'weight.min' => '链接权重不要小于:min',
        ];
        $this -> validate($request, $rules, $messages);

        $data = [
            'name' => $request -> name,
            'link' => $request -> link,
            'weight' => $request -> weight,
            'parent_id' => $request -> parent_id
        ];
        try {
            if ($request -> has('id')) {
                DB::table('links')
                    -> where('id', $request -> id)
                    -> update($data);
            } else {
                DB::table('links') -> insert($data);
            }
            return redirect(route('backend.settings.link')) -> with('success', '保存成功！');
        } catch (\Exception $e) {
            return redirect(route('backend.settings.link'))
                -> with('error', sprintf('保存失败，请联系管理员。【%s】', $e -> getMessage()));
        }
    }

    public function linkDel(Request $request)
    {
        if ($request -> has('id')) {
            DB::table('links')
                -> where('id', $request -> id) -> update(['deleted_at' => date('Y-m-d H:i:s')]);
            return redirect(route('backend.settings.link')) -> with('success', '删除成功！');
        } else {
            return redirect(route('backend.settings.link')) -> with('error', '删除失败，请提供所要删除的导航板块ID！');
        }

    }

    public function set(Request $request)
    {
        $sets = DB::table('sets')
            -> select('key','value')
            -> whereNull('deleted_at')
            -> get();
        return view('backend.settings.set', [
            'sets' => $sets
        ]);
    }

    public function setForm(Request $request)
    {
        if ($request -> has('id')) {
            $data = $request;
            try{
                DB::table('sets') -> where('id','=',1) -> update($data);
                return redirect(route('backend.settings.set')) -> with('success', '保存成功！');
            } catch (\Exception $e) {
                return redirect(route('backend.settings.set'))
                    -> with('error', sprintf('保存失败，请联系管理员。【%s】', $e -> getMessage()));
            }
        }
    }
}