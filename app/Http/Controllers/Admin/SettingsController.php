<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Http\Controllers\Admin\CommonController;

class SettingsController extends Controller
{
    protected $msg;

    public function __construct()
    {
        $this->msg = new CommonController;

    }

    /**
     * 更新网站信息
     *
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
            if ( $res['status'] == 1 and $config ) {
                return back()->with(['success' => $res['msg']]);
            }
            return back()->with(['error' => $res['msg']]);

        }

        $data = Config::pluck('value', 'name')->all();
        return view('admin.main.settings.index', compact('data'));

    }



    /**
     * 更新邮件配置信息
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function email(Request $request)
    {
        //更新邮件配置信息
        $config = $this->webUpdate( $request->all() );

        $res    = $this->webConfig();

        if ( $res['status'] == 1 and $config ) {
            return back()->with(['success' => $res['msg']]);
        }
        return back()->with(['error' => $res['msg']]);

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

        if ( $res['status'] == 1 and $config ) {
            return back()->with(['success' => $res['msg']]);
        }
        return back()->with(['error' => $res['msg']]);
    }

    /**
     * 添加自定义配置信息
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function custom(Request $request)
    {
        //添加自定义配置信息

        $config = new Config();
        $data   = $request->all();

        unset($data['_token']);

        $config->name  = $data['name'];
        $config->value = $data['value'];
        $save = $config->save();

        $res  = $this->webConfig();

        if ( $res['status'] == 1 and $save ) {
            return back()->with(['success' => $res['msg']]);
        }
        return back()->with(['error' => $res['msg']]);
    }

    public function logo(Request $request)
    {
        if ( $request->isMethod('post') ) {

            //判断是否有图片上传
            if ( $request->hasFile('file') ) {

                $file =  $request  ->   file('file');
                //获取图片原始名称
                $clientName = $file-> getClientOriginalName();
                //获取临时文件夹中的文件名称
                $tmpName    = $file-> getFileName();
                //上传文件原始路径
                $realPath   = $file-> getRealPath();
                //上传文件后缀
                $entension  = $file-> getClientOriginalExtension();
                //文件类型
                $fileType   = $file-> getMimeType();
                //定义新文件名称
                $newName    = date('Ymdhis').rand(00000,99999).'.'.$entension;
                //移动文件
                $path = $file -> move('Uploads/logo/'.date('Ymd'), $newName);

                if ( Config::where('name', '=', 'logo')->update(['value' => $path]) ) {

                    $webConfig = $this->webConfig();

                    if ( $webConfig['status'] == 1 ) {

                        $res = $this->msg->msg(1, '上传成功！');
                        $res['url'] = "".url($path)."";

                        return json_encode($res);
                    }

                    $res = $this->msg->msg(0, '上传成功！,配置文件写入失败！');
                    $res['url'] = "".url($path)."";

                    return json_encode($res);

                }

                $res = $this->msg->msg(0, '上传失败！');
                return json_encode($res);
            }

            $res = $this->msg->msg(0, '没有文件上传！');
            return json_encode($res);

        }


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

            return $this->msg->msg(0, '保存成功，配置文件写入失败!');
        }

       return $this->msg->msg(1, '保存成功!');

    }

    /**
     * 更新网站配置信息公共函数
     *
     * @param  $data
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
