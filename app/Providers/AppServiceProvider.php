<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if ($request -> method() == 'GET') {
            $uri = $request -> getPathInfo();
            $uriArray = explode('/', $uri);
            if(isset($uriArray[1]) && $uriArray[1] == 'admin') {
                # 管理后台
            } else {
                # 前端
                $this -> frontendCommonGenerate();
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function frontendCommonGenerate()
    {
        $navs = DB::table('navigation')
            -> select('modules.name', 'modules.code')
            -> leftJoin('modules', 'modules.id', '=', 'navigation.m_id')
            -> whereNull('navigation.deleted_at')
            -> orderBy('navigation.weight', 'ASC')
            -> get();
        view() -> composer('frontend.default.layouts.navs', function ($view) use ($navs) {
            $view -> with('navs', $navs);
        });

        // title
        $title = DB::table('sets')
            -> select('title')
            -> first();
        view() -> composer('frontend.default.layouts.common', function ($view) use ($title) {
            $view -> with('title', $title -> title);
        });

        //foot
        $foot = DB::table('sets')
            -> select('foot')
            -> first();
        view() -> composer('frontend.default.layouts.footer', function ($view) use ($foot) {
            $view -> with('foot', $foot -> foot);
        });
    }

}
