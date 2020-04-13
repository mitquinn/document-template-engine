<?php

namespace Tests\Documents;

use Exception;
use PHPUnit\Framework\TestCase;
use Kapitus\DocumentTemplateEngine\DataPools\GenericDataPool;
use Kapitus\DocumentTemplateEngine\Documents\GenericDocumentV1;
use Kapitus\DocumentTemplateEngine\Interfaces\DocumentInterface;

/**
 * Class GenericDocumentTest
 * @package Tests\Documents
 */
class GenericDocumentTest extends TestCase
{
    /** @var GenericDocumentV1 $document */
    protected $document;

    /**
     * @throws Exception
     */
    protected function setUp()
    {
        $dataPool = new GenericDataPool([
            'firstName' => 'Micheal',
            'lastName' => 'Scott',
            'age' =>  49
        ]);
        $document = new GenericDocumentV1($dataPool);
        $this->setDocument($document);
    }

    public function testInitialization()
    {
        $document = $this->getDocument();
        static::assertInstanceOf(GenericDocumentV1::class, $document);
        static::assertInstanceOf(DocumentInterface::class, $document);
    }

    public function testGetRequiredFields()
    {
        $requiredFields = $this->getDocument()->getRequiredFields();
        static::assertTrue(is_array($requiredFields));
        static::assertContains('firstName', $requiredFields);
        static::assertContains('lastName', $requiredFields);
        static::assertContains('age', $requiredFields);
    }

    public function testGetFirstName()
    {
        $firstName = $this->getDocument()->getFirstName();
        static::assertEquals('Micheal', $firstName);
        static::assertTrue(is_string($firstName));
    }

    /**
     * @throws Exception
     */
    public function testInitializeWithMissingDataPoolFields()
    {
        static::expectException(Exception::class);
        static::expectExceptionMessage('Kapitus\DocumentTemplateEngine\Abstracts\AbstractDocument - Passed dataPool does not have required fields available.');
        static::expectExceptionCode(500);
        $dataPool = new GenericDataPool();
        $document = new GenericDocumentV1($dataPool);
    }

    /**
     * @return GenericDocumentV1
     */
    public function getDocument()
    {
        $document = $this->document;
        static::assertInstanceOf(GenericDocumentV1::class, $document);
        static::assertInstanceOf(DocumentInterface::class, $document);
        return $this->document;
    }

    /**
     * @param GenericDocumentV1 $document
     * @return GenericDocumentTest
     */
    public function setDocument(GenericDocumentV1 $document)
    {
        static::assertInstanceOf(DocumentInterface::class, $document);
        static::assertInstanceOf(GenericDocumentV1::class, $document);
        $this->document = $document;
        return $this;
    }

}
