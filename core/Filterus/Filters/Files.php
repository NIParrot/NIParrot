<?php

namespace Filterus\Filters;

use NI_files;

class Files extends \Filterus\Filter
{

    protected $defaultOptions = array(
        'allowd' => null,
        'max' => null,
        'key' => null,
    );

    public function filter($var)
    {
        $ArrayOfAllowd = ($this->options['allowd']) ? explode(';', $this->options['allowd']) : null;
        $maxSize = $this->options['max'];
        $fileInput = $this->options['key'];
        if (empty($_FILES) || empty($_FILES[$fileInput])) {
            return false;
        } else {
            return NI_files::upload($fileInput, $maxSize, $ArrayOfAllowd);
        }
    }
}
