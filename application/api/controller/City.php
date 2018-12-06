<?php
namespace app\api\controller;

use think\Controller;

class City extends Controller
{
    public function read()
    {
        $countryName = input('countryname');
        $model = model('City');
        $data = $model->getCountryName($countryName);
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data[0]['weather_code']
        ];
        return json($data);
    }
}