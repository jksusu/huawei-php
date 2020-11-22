huawei-php
===============

> php>7.0 兼容 swoole
## 主要功能

* 人脸检测
* 人脸对比
* 人脸搜索
* 活体检测(动态 静态)
## 安装

~~~
composer require jksusu/huawei-php
~~~

## 使用
```php
<?php
require 'vendor/autoload.php';

//获取token token 有效期24小时，建议获取一次缓存。
$request = new \Hw\Sign\SignGenerate();
$token = $request->getToken('用户名','密码','账号','账号ID','项目ID','项目名');

//使用人脸服务类
$face = new \Hw\FaceRecognition\FaceRecognition('项目ID', $token);
//人脸对比，支持多种格式
$res = $face->faceCompare([
         'image1_url' => 'https://csdnimg.cn/feed/20200817/23f9fef9eeb10a423a3e72bc60861ff9.jpg',
         'image2_url' => 'https://csdnimg.cn/feed/20200817/23f9fef9eeb10a423a3e72bc60861ff9.jpg',
]);
var_dump($res);

//人脸检测
$res = $face->faceDetect([
        'image_url' => 'https://csdnimg.cn/feed/20200817/23f9fef9eeb10a423a3e72bc60861ff9.jpg',
]);
var_dump($res);

//静态活体检测
$res = $face->liveDetectFace([
        'image_url' => 'https://csdnimg.cn/feed/20200817/23f9fef9eeb10a423a3e72bc60861ff9.jpg',
]);
var_dump($res);



```
## 版权信息
MIT