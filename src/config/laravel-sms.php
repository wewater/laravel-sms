<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 路由组中间件
    |--------------------------------------------------------------------------
    |
    | 可在此配置内置路由组'sms'的中间件,
    | 如果是web应用建议为'web',
    | 如果是api应用(无session),建议为'api'。
    |
    */
    'middleware' => 'web',

    /*
    |--------------------------------------------------------------------------
    | 是否数据库记录发送日志
    |--------------------------------------------------------------------------
    |
    | 若需开启此功能,需要先生成一个内置的'laravel_sms'表,
    | 运行'php artisan migrate'命令可以自动生成。
    |
    */
    'dbLogs' => false,

    /*
    |--------------------------------------------------------------------------
    | 数据验证管理
    |--------------------------------------------------------------------------
    |
    | 设置从客户端传来的需要验证的数据字段(本库将其称为field),
    | 并管理其启用状态(enable),默认静态验证规则(default)以及所有可用静态验证规则(staticRules)。
    |
    */
    'validation' => [
        'mobile' => [
            'enable'      => true,
            'default'     => 'mobile_required',
            'staticRules' => [
                'mobile_required'     => 'required|zh_mobile',
                'check_mobile_unique' => 'required|zh_mobile|unique:users,mobile',
                'check_mobile_exists' => 'required|zh_mobile|exists:users',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 验证码模块提示信息
    |--------------------------------------------------------------------------
    |
    */
    'notifies' => [
        // 频繁请求无效的提示
        'request_invalid' => '请求无效，请在%s秒后重试',

        // 验证码短信发送失败的提示
        'sms_sent_failure' => '短信验证码发送失败，请稍后重试',

        // 语音验证码发送发送成功的提示
        'voice_sent_failure' => '语音验证码请求失败，请稍后重试',

        // 验证码短信发送成功的提示
        'sms_sent_success' => '短信验证码发送成功，请注意查收',

        // 语音验证码发送发送成功的提示
        'voice_sent_success' => '语音验证码发送成功，请注意接听',
    ],

    /*
    |--------------------------------------------------------------------------
    | 验证码短信相关配置
    |--------------------------------------------------------------------------
    |
    | verifySmsContent:
    | 验证码短信通用内容
    |
    | codeLength:
    | 验证码长度
    |
    | codeValidMinutes:
    | 验证码有效时间长度，单位为分钟(minutes)
    |
    */
    'verifySmsContent' => '【your app signature】亲爱的用户，您的验证码是%s。有效期为%s分钟，请尽快验证',
    'codeLength'       => 5,
    'codeValidMinutes' => 5,

    /*
    |--------------------------------------------------------------------------
    | 存储系统配置
    |--------------------------------------------------------------------------
    |
    | prefix:
    | 存储key的prefix
    |
    | storage:
    | 存储方式,是一个实现了'Toplan\Sms\Storage'接口的类的类名,
    | 内置可选的值有'Toplan\Sms\SessionStorage'和'Toplan\Sms\CacheStorage',
    | 如果不填写storage,那么系统会自动根据'sms'路由组中间件(middleware)的配置值选择存储器,
    | 如果中间件含有'web',会选择使用'Toplan\Sms\SessionStorage',
    | 如果中间件含有'api',会选择使用'Toplan\Sms\CacheStorage'。
    |
    | 内置storage的个性化配置:
    | 在'config/session.php'文件中可以对'Toplan\Sms\SessionStorage'进行更多个性化设置
    | 在'config/cache.php'文件中可以对'Toplan\Sms\CacheStorage'进行更多个性化设置
    */
    'prefix'  => 'laravel_sms',
    'storage' => '',

    /*
    |--------------------------------------------------------------------------
    | 队列任务
    |--------------------------------------------------------------------------
    |
    */
    'queueJob' => 'Toplan\Sms\SendReminderSms',
];
