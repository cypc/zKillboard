<?php

class User
{
    public static function setLogin($username, $password, $autoLogin)
    {
        return true;
    }

    public static function checkLogin($username, $password)
    {
        return false;
    }

    public static function checkLoginHashed($userID)
    {
	return null;
    }

    public static function autoLogin()
    {
        return false;
    }

    public static function isLoggedIn()
    {
	
	return (int) @$_SESSION['characterID'] != null;
    }

    /**
     * @return array|null
     */
    public static function getUserInfo()
    {
	global $redis, $mdb;
	$id = self::getUserID();
        $info = $redis->hGetAll("user:$id");
	$info['username'] = $mdb->findField('information', 'name', ['type' => 'characterID', 'id' => (int) $id, 'cacheTime' => 300]);
	return $info;
    }

    /**
     * @return int
     */
    public static function getUserID()
    {
         return (int) @$_SESSION['characterID'];
    }

    /**
     * @return bool
     */
    public static function isModerator()
    {
	global $redis;
	$id = self::getUserID();
	return $redis->hGet("user:$id", "moderator") == 'true';
    }

    /**
     * @return bool
     */
    public static function isAdmin()
    {
	return false;
    }

    /**
     * @param int $userID
     *
     * @return string
     */
    public static function getUsername($userID)
    {
        return null;
    }

    /**
     * @param int $userID
     *
     * @return array|null
     */
    public static function getSessions($userID)
    {
        return null; 
    }

    public static function getBalance($userID)
    {
	return 0;
    }

    public static function getPaymentHistory($userID)
    {
        return [];
    }

    public static function getUserTrackerData()
    {
	return [];
    }
}
