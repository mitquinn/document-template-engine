<?php

namespace Kapitus\DocumentTemplateEngine\Documents;

use Exception;
use Kapitus\DocumentTemplateEngine\Abstracts\AbstractDocument;
use Kapitus\DocumentTemplateEngine\Interfaces\DataPoolInterface;

/**
 * Class GenericDocument
 * @package Kapitus\DocumentTemplateEngine\Documents\V1
 *
 * So this is a generic document class. Its to give an example of how to setup a document.
 * Dont modify this one. Make your own and extend the BaseDocument.
 */
class GenericDocumentV1 extends AbstractDocument
{

    protected static $name = 'GenericDocumentV1';

    protected static $version = '1';

    protected static $template = 'GenericDocumentV1';

    protected static $requiredFields = [
        'firstName',
        'lastName',
        'age'
    ];

    /** @var string $firstName */
    protected $firstName;

    /** @var string $lastName */
    protected $lastName;

    /** @var int $age */
    protected $age;


    /**
     * GenericDocument constructor.
     * @param DataPoolInterface $dataPool
     * @throws Exception
     */
    public function __construct(DataPoolInterface $dataPool)
    {
        parent::__construct($dataPool);

        //If desired you can use getters and setters. I prefer them but its up to you.
        $this->setFirstName($dataPool->getAvailableFieldsValueByKey('firstName'));
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return GenericDocumentV1
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

}
