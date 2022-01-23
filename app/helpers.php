<?php
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    const ADMIN = 'admin';

    /**
     * Check user is admin
     *
     * @return bool
     */
    public static function isAdmin()
    {
        return Auth::user()->permission == self::ADMIN;
    }
}
