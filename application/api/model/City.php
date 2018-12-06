<?php 
namespace app\api\model;

use think\Model;
use think\Db;

class City extends Model
{
    public function getCountryName($countryName = '北京')
    {
        $res = Db::name('ins_county')->where('county_name', $countryName)->select();
        return $res;
    }

    public function getWeatherList()
    {
        $res = Db::name('ins_county')->select();
        return $res;
    }
}