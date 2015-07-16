<?php
return array(
    array(
        'ssh_host' => '10.0.0.254',   //SSH主机
        'ssh_user' => 'root',         //用户名
        'ssh_pass' => '123456',       //密码
        'ssh_port' => '22',           //SSH端口
        'ssh_path' => '/web/',        //远程目录(必须以"/"结尾)
        'dl_path'  => 'X:/backup1/',  //本地目录(Windows或Linux目录,必须以"/"结尾)
    ),
    array(
        'ssh_host' => '172.16.0.254',
        'ssh_user' => 'root',
        'ssh_pass' => '123456',
        'ssh_port' => '2222',
        'ssh_path' => '/web/',
        'dl_path'  => 'X:/backup2/',
    ),
);