<?php

namespace League\Url\Components;

class Port extends AbstractStringComponent implements ComponentInterface
{
    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        return $this->validatePort($data);
    }
}