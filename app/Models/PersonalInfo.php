<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected  $table = 'personal_info';
    /**
     * 博主信息
     * @return mixed
     */
    public static function personalInfo()
    {
        $info = PersonalInfo::select(['name', 'profile', 'address', 'img'])->first();
        return $info;
    }
}
