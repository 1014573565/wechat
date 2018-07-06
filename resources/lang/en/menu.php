<?php
/**
 * Created by PhpStorm.
 * User: some
 * Date: 2017/6/30
 * Time: 上午11:33
 */
return ["menu" => [
    [
        "header" => "BackGround",
        "key" => "dashboard_section",
        "class" => "",
        "menu" => [
            [
                "link" => url(''),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "Detail",
                "key" => "bg_detail",
                "submenus" => []
            ]
        ]
    ],
    [
        "header" => "Users Management",
        "key" => "user_section",
        "class" => "",
        "menu" => [
            [
                "link" => url('user/list'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "UserList",
                "key" => "user_list",
                "submenus" => []
            ]
        ]
    ],
    [
        "header" => "Coin ManageMent",
        "key" => "coin_section",
        "class" => "",
        "menu" => [
            [
                "link" => url('coin/list'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "Coin List",
                "key" => "coin_list",
                "submenus" => []
            ],
            [
                "link" => url('coin/add'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "Add Coin",
                "key" => "coin_add",
                "submenus" => []
            ],
            [
                "link" => url('coin/config/list'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "RPC Configure",
                "key" => "coin_wallet_config",
                "submenus" => []
            ]
        ]
    ],
    [
        "header" => "Transaction Management",
        "key" => "trust_section",
        "class" => "hidden-md",
        "menu" => [
            [
                "link" => url('deal/trusts'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "Trust",
                "key" => "trust",
                "submenus" => []
            ],
            [
                "link" => url('deal/orders'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "Deal",
                "key" => "order",
                "submenus" => []
            ],
        ]
    ],
    [
        "header" => "Financial Management",
        "key" => "finance_section",
        "class" => "hidden-md",
        "menu" => [
            [
                "link" => url('finance/coinin'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "CoinIn",
                "key" => "coinin",
                "submenus" => []
            ],
            [
                "link" => url('finance/coinout'),
                "class" => "",
                "icon" => "glyphicon-align-justify",
                "name" => "CoinOut",
                "key" => "coinout",
                "submenus" => []
            ]
        ]
    ],
    [
        "header" => "News Management",
        "key" => "news_section",
        "class" => "",
        "menu" => [
            [
                "link" => url('news/publish'),
                "class" => "",
                "icon" => "glyphicon-home",
                "name" => "Publish News",
                "key" => "news_publish",
                "submenus" => []
            ],
            [
                "link" => url('news/list'),
                "class" => "",
                "icon" => "glyphicon-home",
                "name" => "NewsList",
                "key" => "news_list",
                "submenus" => []
            ],
        ]
    ],
    [
        "header" => "Managers",
        "key" => "managers_section",
        "class" => "",
        "menu" => [
            [
                "link" => url('admin/index'),
                "class" => "",
                "icon" => "glyphicon-home",
                "name" => "Manager Management",
                "key" => "manager_list",
                "submenus" => []
            ],
            [
                "link" => url('admin/role'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "Roles Management",
                "key" => "role_list",
                "submenus" => []
            ],
            [
                "link" => url('admin/permission'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "Permission Management",
                "key" => "permission_list",
                "submenus" => []
            ],
        ]
    ],
    [
        "header" => "System Settings",
        "key" => "system_settings_section",
        "class" => "",
        "menu" => [

            [
                "link" => url('system/maintance'),
                "class" => "",
                "icon" => "glyphicon-eye-open",
                "name" => "Website Maintenance",
                "key" => "system_maintance",
                "submenus" => []
            ],
        ]
    ]
]];