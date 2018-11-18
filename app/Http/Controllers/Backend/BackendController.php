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

use Illuminate\Support\Facades\Auth,Redirect;
// use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    protected $searchConditions = [];

    public function index()
    {
	    return view('backend.index');
    }
}