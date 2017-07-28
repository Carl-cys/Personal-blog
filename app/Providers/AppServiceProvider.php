<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Links;
use App\Models\Navigation;
use App\Models\Users;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // 使用闭包型态的视图组件...
        view()->composer('*', function ($view) {
        //右边导航
        $navigation = $this->navigation();
        //友情链接
        $links = $this->links();

        $user = Users::select(['nickname','email','pic','password','id'])->first();
        //获取公共的分类
        $cates = $this->cate();
        //获取推荐文章
        $recommend = $this->recommend();
        //随便看看
        $casual = $this->casual();

        View::share( 'navigation', $navigation );
        View::share( 'links', $links );
        View::share( 'user', $user );
        View::share( 'cates', $cates );
        View::share( 'recommend', $recommend );
        View::share( 'casual', $casual );

        });
    }

    /**
     * 随便看看
     * @return mixed
     */
    public function casual()
    {
        $casual = Article::select('title','id')->orderBy('created_at','desc')->take(10)->get();
        return $casual;
    }
    /**
     * 获取推荐文章
     */
    public function recommend()
    {
        $recommend = Article::where('read_ecommend', '1')->select('title','id')->take(10)->get();
        return $recommend;
    }
    /**
     * 友情链接
     * @return mixed
     */
    public function links()
    {
        $links = Links::select(['name','order','link'])
            ->orderBy('order', 'desc')
            ->get();
        return $links;
    }
    /**
     * 获取右边导航
     * @return mixed
     */
    public function navigation()
    {
        $navigation = Navigation::select(['title','url','order',])
            ->orderBy('order','desc')
            ->get();
        return $navigation;
    }

    /**
     * 获取分类
     * @return mixed
     */
    public function cate()
    {
        $cate = Category::where('path', '0')->take(6)->get();
        return $cate;
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
}
