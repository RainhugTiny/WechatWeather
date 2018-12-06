<?php 
namespace app\api\model;

use think\Model;
use think\Db;

class Weather extends Model
{
    public function getWeather($cityCode = 101010100)
    {
        $res = Db::name('ins_county')->where('weather_code', $cityCode)->select();
        return $res;
    }

    public function getWeatherList()
    {
        $res = Db::name('ins_county')->select();
        return $res;
    }
}