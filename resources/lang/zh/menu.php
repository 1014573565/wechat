<?php
/**
 * Created by PhpStorm.
 * User: some
 * Date: 2017/6/30
 * Time: 上午11:33
 */

return ["menu" => [
    [
        "header" => "首页",
        "key" => "dashboard_section",
        "class" => "",
        "menu" => [
            [
                "link" => url(''),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "后台统计",
                "key" => "index",
                "submenus" => []
            ]
        ]
    ],
    [
        "header" => "用户管理",
        "key" => "user_section",
        "class" => "",
        "menu" => [
            [
                "link" => url('user/list'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "用户表",
                "key" => "user_list",
                "submenus" => []
            ],
            [
                "link" => url('finance/list'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "资产列表",
                "key" => "assets_list",
                "submenus" => []
            ],
        ],
    ],
    [
        "header" => "币种管理",
        "key" => "coin_section",
        "class" => "",
        "menu" => [
            [
                "link" => url('coin/list'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "币种列表",
                "key" => "coin_list",
                "submenus" => []
            ],
            [
                "link" => url('coin/add'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "添加币种",
                "key" => "coin_add",
                "submenus" => []
            ],
            /*[
                "link" => url('coin/config/list'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "RPC 配置",
                "key" => "coin_wallet_config",
                "submenus" => []
            ]*/
        ]
    ],
    /*[
        "header" => "交易管理",
        "key" => "trust_section",
        "class" => "hidden-md",
        "menu" => [
            [
                "link" => url('deal/trusts'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "委托",
                "key" => "trust",
                "submenus" => []
            ],
            [
                "link" => url('deal/orders'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "成交",
                "key" => "order",
                "submenus" => []
            ],
        ]
    ],*/
    [
        "header" => "财务管理",
        "key" => "finance_section",
        "class" => "hidden-md",
        "menu" => [
            [
                "link" => url('finance/coinin'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "充币记录",
                "key" => "coinin",
                "submenus" => []
            ],
            [
                "link" => url('finance/coinout'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "提币记录",
                "key" => "coinout",
                "submenus" => []
            ],
            [
                "link" => url('otc/list'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "OTC交易列表",
                "key" => "otc_list",
                "submenus" => []
            ],
            [
                "link" => url('exchange/listorder'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "币币兑换列表",
                "key" => "trusts_list",
                "submenus" => []
            ],
            [
                "link" => url('finance/transferLog'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "转账记录",
                "key" => "transferLog",
                "submenus" => []
            ],
            [
                "link" => url('redpacket/index'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "红包列表",
                "key" => "redpacket_index",
                "submenus" => []
            ],
            [
                "link" => url('finance/receivePayment'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "收付款列表",
                "key" => "receivePayment",
                "submenus" => []
            ],
            [
                "link" => url('bet/index'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "竞猜",
                "key" => "bet_index",
                "submenus" => []
            ],

        ]
    ],
    [
        "header" => "新闻管理",
        "key" => "news_section",
        "class" => "",
        "menu" => [
            [
                "link" => url('news/publish'),
                "class" => "",
                "icon" => "glyphicon-home",
                "name" => "发布新闻",
                "key" => "news_publish",
                "submenus" => []
            ],
            [
                "link" => url('news/list'),
                "class" => "",
                "icon" => "glyphicon-home",
                "name" => "新闻列表",
                "key" => "news_list",
                "submenus" => []
            ],
            [
                "link" => url('question/lists'),
                "class" => "",
                "icon" => "glyphicon-home",
                "name" => "常见问题",
                "key" => "common_question",
                "submenus" => []
            ],
        ]
    ],
    [
        "header" => "管理",
        "key" => "managers_section",
        "class" => "",
        "menu" => [
            [
                "link" => url('admin/index'),
                "class" => "",
                "icon" => "glyphicon-home",
                "name" => "管理员",
                "key" => "manager_list",
                "submenus" => []
            ],
            [
                "link" => url('admin/role'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "角色管理",
                "key" => "role_list",
                "submenus" => []
            ],
            [
                "link" => url('admin/permission'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "权限管理",
                "key" => "permission_list",
                "submenus" => []
            ],
        ]
    ],
    /*[
        "header" => "系统设置",
        "key" => "system_settings_section",
        "class" => "",
        "menu" => [

            [
                "link" => url('system/maintance'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "网站维护",
                "key" => "system_maintance",
                "submenus" => []
            ],
        ]
    ],*/

]];