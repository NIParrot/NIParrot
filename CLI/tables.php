<?php
/**
 *spase after column is impostant for CLI Functions
 * like column1 type NOT NULL , <= (^_^) good
 * like column1 type NOT NULL, <= [*_*] error
 */
return $tables = [
    'Users' => '
        column1 type NOT NULL ,
        column2 type NOT NULL ,
    ',
    'Profils' => '
        column1 type NOT NULL ,
        column2 type NOT NULL ,
    '
];
