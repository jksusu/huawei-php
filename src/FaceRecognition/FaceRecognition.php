<?php
declare (strict_types=1);

namespace Hw\FaceRecognition;

use Hw\Traits\Charge;

/**
 * 华为云人脸识别服务
 * @date 2020/11/20 15:24
 * Class FaceRecognition
 * @package Hw\FaceRecognition
 */
class FaceRecognition
{
    use Charge;

    private $url = 'https://face.cn-north-4.myhuaweicloud.com';

    protected $projectId;

    protected $token;

    public function __construct(string $projectId, string $token)
    {
        $this->projectId = $projectId;
        $this->token = $token;
    }

    /**
     * 人脸检测
     * @param array $params = [
     *         'image_url | image_file | image_base64' =>'三选一'
     * ]
     * @date 2020/11/20 14:08
     * @return string
     * @throws \Exception
     * @link https://support.huaweicloud.com/api-face/face_02_0085.html
     */
    public function faceDetect(array $params)
    {
        $params['attributes'] = '1,2,21,12,13';//返回人脸属性
        return $this->charge(
            $this->url . '/v2/' . $this->projectId . '/face-detect',
            ['X-Auth-Token' => $this->token, 'Content-Type' => "application/json",],
            json_encode($params),
            'POST'
        )->getBody()->getContents();
    }


    /**
     * 人脸对比
     * @param array $params = [
     *         'image1_url | image1_file | image1_base64' =>'三选一'
     *         'image2_url | image2_file | image2_base64' =>'三选一'
     * ]
     * @date 2020/11/20 14:08
     * @return string
     * @throws \Exception
     * @link https://support.huaweicloud.com/api-face/face_02_0085.html
     */
    public function faceCompare(array $params)
    {
        return $this->charge(
            $this->url . '/v2/' . $this->projectId . '/face-compare',
            ['X-Auth-Token' => $this->token, 'Content-Type' => "application/json"],
            json_encode($params),
            'POST'
        )->getBody()->getContents();
    }

    /**
     * 人脸搜索
     * @param string $faceSetName 人脸库名称
     * @param array $params = [
     *         'image_url | image_file | image_base64 | face_id' =>'必传 四选一'
     *         'top_n' =>'int 返回查询到的最相似的N张人脸，N默认为10。'
     *         'threshold' =>'人脸相似度阈值，低于这个阈值则不返回，取值范围0~1，一般情况下建议取值0.93，默认为0。'
     *         'sort' =>'支持字段排序'
     *         'filter' =>'过滤条件'
     *         'return_fields' =>'指定返回的自定义字段。'
     * ]
     * @date 2020/11/20 14:08
     * @return string
     * @throws \Exception
     * @link https://support.huaweicloud.com/api-face/face_02_0086.html
     */
    public function faceSearch(string $faceSetName, array $params)
    {
        return $this->charge(
            $this->url . '/v2/' . $this->projectId . '/face-sets/' . $faceSetName . 'search',
            ['X-Auth-Token' => $this->token, 'Content-Type' => "application/json"],
            $params,
            'POST'
        )->getBody()->getContents();
    }

    /**
     * 动作活体检测
     * @param array $params = [
     *         'video_url | video_file | video_base64' =>'三选一'
     *         'actions' =>'1：左摇头 2：右摇头 3：点头 4：嘴部动作'
     * ]
     * @date 2020/11/20 14:08
     * @return string
     * @throws \Exception
     * @link https://support.huaweicloud.com/api-face/face_02_0100.html
     */
    public function liveDetect(array $params)
    {
        return $this->charge(
            $this->url . '/v1/' . $this->projectId . '/live-detect',
            ['X-Auth-Token' => $this->token, 'Content-Type' => "application/json"],
            json_encode($params),
            'POST'
        )->getBody()->getContents();
    }

    /**
     * 静默活体检测
     * @param array $params = [
     *         'image_url | image_file | image_base64' =>'三选一'
     * ]
     * @date 2020/11/20 14:08
     * @return string
     * @throws \Exception
     * @link https://support.huaweicloud.com/api-face/face_02_0101.html
     */
    public function liveDetectFace(array $params)
    {
        return $this->charge(
            $this->url . '/v1/' . $this->projectId . '/live-detect-face',
            ['X-Auth-Token' => $this->token, 'Content-Type' => "application/json"],
            json_encode($params),
            'POST'
        )->getBody()->getContents();
    }
}