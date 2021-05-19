<?php

/**
 * spase after column is impostant for CLI Functions
 * like column1 type NOT NULL , <= (^_^) good
 * like column1 type NOT NULL, <= [*_*] error
 */

return $tables = [
    'Table' => '
        col VARCHAR( 255 ) NULL ,
    '
];
