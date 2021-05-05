<?php

/**
 * spase after column is impostant for CLI Functions
 * like column1 type NOT NULL , <= (^_^) good
 * like column1 type NOT NULL, <= [*_*] error
 */

return $tables = [
    'Kindergartens' => '
        name VARCHAR( 255 ) NULL ,
    ',
    'Worktimes' => '
        start_time TIME NOT NULL ,
        end_time TIME NOT NULL ,
    ',
    'Managers' => '
        username VARCHAR( 255 ) NULL ,
        password VARCHAR( 255 ) NULL ,
    ',
    'Kindergarten_Teacher' => '
        kindergartens_id INT (11) NOT NULL ,
        teachers_id INT (11) NOT NULL ,
    ',
    'Kindergarten_Kid' => '
        kindergartens_id INT (11) NOT NULL ,
        kids_id INT (11) NOT NULL ,
    ',
    'kid_Teacher' => '
        kids_id INT (11) NOT NULL ,
        teachers_id INT (11) NOT NULL ,
    ',
    'Teachers' => '
        name VARCHAR( 255 ) NULL ,
        password VARCHAR( 255 ) NULL ,
        phone  VARCHAR( 255 ) NULL UNIQUE ,
        salary INT (11) NOT NULL,
        Worktimes_id INT (11) NOT NULL ,
        active INT (11) DEFAULT 0 ,
        fcm_token  VARCHAR( 255 ) NULL ,
    ',
    'Fathers' => '
        name VARCHAR( 255 ) NULL ,
        password VARCHAR( 255 ) NULL ,
        phone VARCHAR( 255 ) NULL ,
        fcm_token  VARCHAR( 255 ) NULL ,
    ',
    'Kids' => '
        name VARCHAR( 255 ) NULL ,
        fathers_id INT (11) NOT NULL ,
    ',
    'Vacations' => '
        teachers_id INT (11) NOT NULL ,
        day DATE NOT NULL ,
    ',
    'Payments' => '
        kids_id INT (11) NOT NULL ,
    ',
    'Notifications' => '
        msg VARCHAR( 255 ) NULL ,
        kids_id INT (11) NOT NULL ,
    ',
    'Fcm_notifications' => '
        title VARCHAR( 255 ) NULL ,
        body VARCHAR( 255 ) NULL ,
    '

];