<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

/**
 * ThinkPHP CLI模式定义
 */

use think\Console;

\think\Response::tramsform(function () {
});

return [
    // 配置文件
    'config' => array_merge(include THINK_PATH . 'convention' . EXT, [
        'default_return_type' => ''
    ]),

    'commands' => [],
    'run'      => function () {
        $console = new Console('Think Console', '0.1');


        $commands = \think\Config::get('commands');

        if (is_array($commands)) {
            foreach ($commands as $command) {
                if (class_exists($command) && $command instanceof \think\console\command\Command) {
                    $console->add(new $command());
                }
            }
        }

        $console->run();
    }

];
