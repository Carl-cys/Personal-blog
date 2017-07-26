<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;

class SettingsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        if( $request->isMethod('post') ){
            //更新网站信息
            $config = $this->webUpdate( $request->all() );
            //写入网站配置信息
            $res    = $this->webConfig();
            if ( $res and $config ) {
                return back()->with(['success' => $res]);
            }
            return back()->with(['error' => $res]);

        }

        $data = Config::pluck('value', 'name')->all();
        return view('admin.main.settings.index', compact('data'));

    }



    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function email(Request $request)
    {
        //更新邮件配置信息
        $config = $this->webUpdate( $request->all() );

        $res    = $this->webConfig();

        if ( $res and $config ) {
            return back()->with(['success' => $res]);
        }
        return back()->with(['error' => $res]);

    }

    /**
     * 网站开关
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function webSwitch(Request $request)
    {
        //更新网站开关配置信息
        $config = $this->webUpdate( $request->all() );

        $res    = $this->webConfig();

        if ( $res and $config ) {
            return back()->with(['success' => $res]);
        }
        return back()->with(['error' => $res]);
    }

    public function custom(Request $request)
    {
        //添加自定义配置信息

        $config = new Config();
        $data   = $request->all();

        unset($data['_token']);

        $config->name  = $data['name'];
        $config->value = $data['value'];
        $save = $config->save();

        $res    = $this->webConfig();

        if ( $res and $save ) {
            return back()->with(['success' => $res]);
        }
        return back()->with(['error' => $res]);
    }

    /**
     * 写入网站配置文件
     *
     * @return string
     */
    public function webConfig()
    {
        //获取网站信息
        $configs = Config::pluck('value', 'name')->all();

        $str     = "<?php \n\r return".'  '.var_export($configs, true).';';

        //配置文件路径
        $path    = config_path('config.inc.php');

        //写入网站信息
        if ( !file_put_contents($path, $str) ) {

            return '保存成功，配置文件写入失败!';
        }

        return '修改成功';

    }

    /**
     * @param $data
     * @return string
     */
    public function webUpdate($data)
    {
        $res = '';
        foreach ($data as $name=>$value) {
            $res = Config::where('name', '=', $name)->update( ['value' => $value] );

        }

        return $res;
    }

}
