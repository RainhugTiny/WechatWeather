<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx70f37b51d8ae9378", "3428a09919656402e16114be01f37e40");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <!-- 引入 WeUI -->
    <link rel="stylesheet" href="http://res.wx.qq.com/open/libs/weui/0.4.3/weui.min.css"/>
  <script  type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
  <script  type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=zGWtqgDpHg3pBAptknTaPbNQB5k7c7In"></script>
    <title></title>
</head>
<body ontouchstart>
<a href="javascript:;" onclick="openLocation()" class="weui_btn weui_btn_primary">调用地图</a>
<a href="javascript:;" onclick="scanQRCode()" class="weui_btn weui_btn_primary">微信扫一扫</a>
<a href="javascript:;" onclick="getWeather()" class="weui_btn weui_btn_primary">天气预报</a>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    /*
     * 注意：
     * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
     * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
     * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
     *
     * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
     * 邮箱地址：weixin-open@qq.com
     * 邮件主题：【微信JS-SDK反馈】具体问题
     * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
     */

  	var latitude = 0.0;
    var longitude = 0.0;
    wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'getLocation',
            'openLocation',
      		'scanQRCode',
        ]
    });
    wx.ready(function () {
        // 在这里调用 API
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度
                alert("latitude:" + latitude + "longitude:" + longitude);
            }
        });
    });

    function openLocation() {
        wx.ready(function () {
            wx.openLocation({
                latitude: latitude, // 纬度，浮点数，范围为90 ~ -90
                longitude: longitude, // 经度，浮点数，范围为180 ~ -180。
                name: '', // 位置名
                address: '', // 地址详情说明
                scale: 15, // 地图缩放级别,整形值,范围从1~28。默认为最大
                infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
            });
        });
    }
      
      
      function scanQRCode() {
        wx.ready(function () {
            wx.scanQRCode({
              needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
              scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
              success: function (res) {
                  var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
              }
            });
        });
    }
      function getWeather() {
        var geoc = new BMap.Geocoder();
        var lng = longitude;
        var lat = latitude;
        var pointArr = [];
        var gpsPoint = new BMap.Point(lng,lat);
        var bdPoint = new BMap.Point(0,0);
        //回调函数，返回百度坐标位置
        
        translateCallback = function (point1){
          bdPoint = point1.points[0];
          geoc.getLocation(bdPoint,function (rs){
            alert(rs.address);
            //var addComp = rs.addressComponents;
            //alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
        });
        }
        //将GPS坐标转化为百度坐标
        setTimeout(function(){
          var convertor = new BMap.Convertor();
          pointArr.push(gpsPoint);
          convertor.translate(pointArr,1,5,translateCallback);     //真实经纬度转成百度坐标
        }, 1000);
        
    }

</script>
</html>

