<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.09.2017
 * Time: 22:29
 */

namespace common\models;
use frontend\models\usersmetadata;
use frontend\models\usersgroups;

class Usr extends Usersmetadata
{
    public static function getKoeff($user_id)
    {
        $user = self::findone($user_id);
        return UsersGroups::findOne($user->GroupID);
    }
}