<?php
declare (strict_types=1);

namespace Hw\Sign;

class SignGenerate
{
    use \Hw\Traits\Charge;

    private $url = 'https://iam.cn-east-2.myhuaweicloud.com';

    /**
     * 获取token
     * @date: 2020/11/20 13:27
     * @param string $iamUser IMA用户名
     * @param string $iamUserPwd IMA用户密码
     * @param string $iamAccount IMA账号名
     * @param string $iamAccountId IMA账号ID
     * @param string $projectId IMA项目ID
     * @param string $projectName IMA项目名
     * @return string|\Yurun\Util\YurunHttp\Http\Response
     * @throws \Exception
     */
    public function getToken(string $iamUser, string $iamUserPwd, string $iamAccount, string $iamAccountId, string $projectId, string $projectName)
    {
        $uri = '/v3/auth/tokens';

        $auth = [
            'auth' => [
                'identity' => [
                    'methods' => ['password'],
                    'password' => [
                        'user' => [
                            'domain' => [
                                'name' => $iamAccount
                            ],
                            'name' => $iamUser,
                            'password' => $iamUserPwd
                        ]
                    ]
                ],
                'scope' => [
                    'domain' => [
                        'id' => $iamAccountId,
                        'name' => $iamAccount
                    ],
                    'project' => [
                        'name' => $projectName
                    ]
                ],
            ]
        ];

        //如果项目ID为空，则获取的token作用范围是整个账号
        if (!empty($projectId)) {
            $authp['auth']['scope']['project']['id'] = $projectId;
        }

        $res = $this->charge($this->url . $uri, [], json_encode($auth), 'POST');

        $data = json_decode($res->getBody()->getContents(), true);

        if (array_key_exists('error', $data)) {
            return $data['error'];
        }
        return is_array($res->getHeader('X-Subject-Token')) ? $res->getHeader('X-Subject-Token')[0] : '';
    }
}