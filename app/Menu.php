<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    public static function GetLeftMenuBar()
    {
        return trans("menu.menu");
    }

    public static function GetPortoMenu()
    {
        return trans("menu_porto.menu");
    }
}
