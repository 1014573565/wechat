<?php

namespace App;


class ConstCode
{
    const SESSION_ID_NOT_EXISTS = 1; //session id 不存在
    const SESSION_ID_EXPIRED = 2; //session id 已过期
    const CODE_NOT_NULL = 3;    //code不能为空
    const AUTHENTICATION_FAILED = 4;    //认证失败
    const MOBILE_NOT_EXISTS = 5;    //手机号不存在
    const INCORRECT_PASSWORD = 6;   //密码不正确
    const MOBILE_EXISTS = 7;   //手机号已被注册
    const TWO_PASSWORDS_ARE_DIFFERENT = 8;   //两次密码不一样
    const REGISTER_FAIL = 9;   //注册失败



}
