<?php
namespace app\api\controller;

use think\Controller;

class Weather extends Controller
{
    public function read()
    {
        $cityCode = input('citycode');
        $model = model('Weather');
        $data = $model->getWeather($cityCode);
        return $data[0]['weather_info'];
    }
}