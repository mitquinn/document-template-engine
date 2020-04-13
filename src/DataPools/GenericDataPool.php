<?php

namespace Kapitus\DocumentTemplateEngine\DataPools;

use Exception;
use Kapitus\DocumentTemplateEngine\Abstracts\AbstractDataPool;

/**
 * Class GenericDataPool
 * @package Kapitus\DocumentTemplateEngine\DataPools
 *
 * This is a super basic example class. You should probably make your own DataPool class for your specific use case.
 * I would suggest to create your own and add some getters and setters to it along with some default fields maybe.
 */
class GenericDataPool extends AbstractDataPool
{
    /**
     * GenericDataPool constructor.
     * @param array $data
     * @throws Exception
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

}