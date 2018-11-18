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


use Illuminate\Support\Facades\DB;

class SettingsController extends BackendController
{
    public function link()
    {
        $links = DB::table('links')
            -> select('id', 'name')
            -> whereNull('deleted_at')
            -> where('parent_id', 0)
            -> orderBy('weight')
            -> get();
        return view('backend.settings.link', [
            'links' => $links
        ]);

    }

    public function set()
    {
    	$sets = DB::table('sets')
            -> select('title','foot')
            -> whereNull('deleted_at')
            -> orderBy('id')
            -> get();
        return view('backend.settings.set', [
            'sets' => $sets
        ]);
    }
}