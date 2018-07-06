<?php
/**
 * Created by PhpStorm.
 * User: some
 * Date: 2017/6/30
 * Time: 上午11:33
 */
return ["menu" => [
    [
        "header" => "系统管理",
        "key" => "user_section",
        "icon" => "fa fa-user-circle-o",
        "menu" => [
            [
                "link" => url('/jobs'),
                "name" => "工作管理",
                "key" => "user_list",
                "submenus" => []
            ],
            [
                "link" => url('/proto/admin'),
                "name" => "管理员列表",
                "key" => "manager_list",
                "submenus" => []
            ],
            [
                "link" => url('/proto/driver'),
                "name" => "司机列表",
                "key" => "manager_list",
                "submenus" => []
            ],
            [
                "link" => url('/proto/guide'),
                "name" => "导游列表",
                "key" => "manager_list",
                "submenus" => []
            ],
        ]
    ],

]];