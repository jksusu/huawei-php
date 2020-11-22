<?php
declare (strict_types=1);

namespace Hw\Traits;

use Yurun\Util\YurunHttp\Http\Request;
use Yurun\Util\YurunHttp\Http\Response;
use Yurun\Util\YurunHttp;

trait Charge
{
    /**
     * 发起http请求
     * @param string $url               请求地址
     * @param array $headers            header头
     * @param $body                     body
     * @param string $method            请求方法
     * @param string $version           设置http版本
     * @return YurunHttp\Http\Response
     * @throws \Exception
     */
    public function charge(string $url, array $headers = [], $body, string $method = 'GET', string $version = '1.1'): Response
    {
        try {
            $request = new Request($url, $headers, $body, $method, $version);
            return YurunHttp::send($request);
        } catch (\Exception $e) {
            throw new \Exception();
        }
    }
}