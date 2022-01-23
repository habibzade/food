<?php
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    const ADMIN = 'admin';
    const USER = 'user';

    /**
     * Check user is admin
     *
     * @return bool
     */
    public static function isAdmin()
    {
        return Auth::user()->permission == self::ADMIN;
    }

    /**
     * Check user is public
     *
     * @return bool
     */
    public static function isPublic()
    {
        return Auth::user()->permission == self::USER;
    }
}
