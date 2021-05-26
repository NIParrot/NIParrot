<?php

/**
 * spase after column is impostant for CLI Functions
 * like column1 type NOT NULL , <= (^_^) good
 * like column1 type NOT NULL, <= [*_*] error
 */

return $tables = [
    'Roles' => '
        name VARCHAR(50) NOT NULL ,
    ',
    'Permissions' => '
        name VARCHAR(50) NOT NULL ,
    ',
    'Role_Permission' => '
        roles_id INT (11) NOT NULL ,
        permissions_id INT (11) NOT NULL ,
    ',
    'Userole' => '
        roles_id INT (11) NOT NULL ,
        user_id INT (11) NOT NULL ,
        modeltype VARCHAR(50) NOT NULL ,
    ',
];
