<?php
/**
 * Created by PhpStorm.
 * User: some
 * Date: 2017/6/30
 * Time: 上午11:33
 */
return ["menu" => [
    [
        "header" => "用户管理",
        "key" => "user_section",
        "icon" => "fa fa-columns",
        "menu" => [
            [
                "link" => url('user/list'),
                "name" => "用户表",
                "key" => "user_list",
                "submenus" => []
            ],
            [
                "link" => url('user/list'),
                "name" => "用户资产",
                "key" => "user_list",
                "submenus" => []
            ],
        ]
    ],
    [
        "header" => "币种管理",
        "key" => "coin_section",
        "icon" => "fa fa-copy",
        "menu" => [
            [
                "link" => url('coin/list'),
                "name" => "币种管理",
                "key" => "coin_list",
                "submenus" => []
            ],
            [
                "link" => url('coin/add'),
                "name" => "添加币种",
                "key" => "coin_add",
                "submenus" => []
            ],
        ]
    ],
    [
        "header" => "财务管理",
        "key" => "coin_section",
        "icon" => "fa fa-copy",
        "menu" => [
            [
                "link" => url('coin/list'),
                "name" => "充币",
                "key" => "coin_list",
                "submenus" => []
            ],
            [
                "link" => url('coin/add'),
                "name" => "提币",
                "key" => "coin_add",
                "submenus" => []
            ],
            [
                "link" => url('coin/add'),
                "name" => "OTC",
                "key" => "coin_add",
                "submenus" => [
                    [
                        "link" => url('coin/list'),
                        "name" => "OTC交易列表",
                        "key" => "coin_list",
                        "submenus" => []
                    ],
                    [
                        "link" => url('coin/add'),
                        "name" => "OTC订单列表",
                        "key" => "coin_add",
                        "submenus" => []
                    ],
                ]
            ],
            [
                "link" => url('coin/add'),
                "name" => "区块链竞猜",
                "key" => "coin_add",
                "submenus" => [
                    [
                        "link" => url('coin/list'),
                        "name" => "竞猜设置",
                        "key" => "coin_list",
                        "submenus" => []
                    ],
                    [
                        "link" => url('coin/add'),
                        "name" => "竞猜记录",
                        "key" => "coin_add",
                        "submenus" => []
                    ],
                ]
            ],
            [
                "link" => url('coin/add'),
                "name" => "币币兑换",
                "key" => "coin_add",
                "submenus" => [
                    [
                        "link" => url('coin/list'),
                        "name" => "兑换设置",
                        "key" => "coin_list",
                        "submenus" => []
                    ],
                    [
                        "link" => url('coin/add'),
                        "name" => "兑换记录",
                        "key" => "coin_add",
                        "submenus" => []
                    ],
                ]
            ],
            [
                "link" => url('coin/list'),
                "name" => "转账记录",
                "key" => "coin_list",
                "submenus" => []
            ],
            [
                "link" => url('coin/add'),
                "name" => "红包记录",
                "key" => "coin_add",
                "submenus" => []
            ],
        ]
    ],
    [
        "header" => "新闻管理",
        "key" => "coin_section",
        "icon" => "fa fa-copy",
        "menu" => [
            [
                "link" => url('coin/list'),
                "name" => "新闻列表",
                "key" => "coin_list",
                "submenus" => []
            ],
            [
                "link" => url('coin/add'),
                "name" => "发布新闻",
                "key" => "coin_add",
                "submenus" => []
            ],
        ]
    ],
    [
        "header" => "管理员",
        "key" => "coin_section",
        "icon" => "fa fa-copy",
        "menu" => [
            [
                "link" => url('coin/list'),
                "name" => "管理员列表",
                "key" => "coin_list",
                "submenus" => []
            ],
            [
                "link" => url('coin/add'),
                "name" => "角色管理",
                "key" => "coin_add",
                "submenus" => []
            ],
            [
                "link" => url('coin/add'),
                "name" => "权限管理",
                "key" => "coin_add",
                "submenus" => []
            ],
        ]
    ],
]];