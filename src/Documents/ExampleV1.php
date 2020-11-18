<?php


namespace Kapitus\DocumentTemplateEngine\Documents;


use Kapitus\DocumentTemplateEngine\Abstracts\AbstractDocument;
use Kapitus\DocumentTemplateEngine\Interfaces\DataPoolInterface;

class ExampleV1 extends AbstractDocument
{
    protected static $name = 'ExampleV1';

    protected static $version = '1';

    protected static $template = 'ExampleV1';

    protected static $requiredFields = [
        'firstName',
        'lastName',
        'age'
    ];


    public function __construct(DataPoolInterface $dataPool)
    {
        parent::__construct($dataPool);
    }

}

