<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Config::truncate();
        //创建相应的权限
        $config = [
            [
                'name'=>'title',
                'value'=>'我的博客',
            ],

            [
                'name'=>'keyword',
                'value'=>'博客,个人博客',
            ],

            [
                'name'=>'desc',
                'value'=>'这是一个充满情怀的博客！',
            ],

            [
                'name'=>'copyright',
                'value'=>'我的博客版权所有',
            ],
            [
                'name'=>'text',
                'value'=>'当你能力不能满足你的野心的时候,你就该沉下心来学习',
            ],
            [
                'name'=>'number',
                'value'=>'京ICP证030173号',
            ],
            [
                'name'=>'countcode',
                'value'=>'https://www.baidu.com',
            ],
            [
                'name'=>'send_mode',
                'value'=>'smtp',
            ],

            [
                'name'=>'smtp_server',
                'value'=>'smtp.163.com',
            ],

            [
                'name'=>'smtp_port',
                'value'=>'25',
            ],

            [
                'name'=>'smtp_user',
                'value'=>'blog@163.com',
            ],
            [
                'name'=>'smtp_pwd',
                'value'=>'123456',
            ],
            [
                'name'=>'recipient_email',
                'value'=>'test@163.com',
            ],
            [
                'name'=>'webswitch',
                'value'=>'OFF',
            ],
            [
                'name'=>'logo',
                'value'=>'https://odu38kv7q.qnssl.com/nice.png',
            ],
            [
                'name'=>'github',
                'value'=>'https://odu38kv7q.qnssl.com/nice.png',
            ],
            [
                'name'=>'sina-weibo',
                'value'=>'https://odu38kv7q.qnssl.com/nice.png',
            ],
            [
                'name'=>'cooperation',
                'value'=>'php-garlic | Carl-cys——协同开发',
            ],

        ];

        foreach ($config as $value){
            \App\Models\Config::create($value);
        }
    }
}
