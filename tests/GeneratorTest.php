<?php

namespace Tests;

use Exception;
use Kapitus\DocumentTemplateEngine\DataPools\GenericDataPool;
use Kapitus\DocumentTemplateEngine\Documents\GenericDocument;
use Kapitus\DocumentTemplateEngine\Documents\GenericDocumentV1;
use Kapitus\DocumentTemplateEngine\Generator;
use Kapitus\DocumentTemplateEngine\Interfaces\GeneratorInterface;
use Mpdf\MpdfException;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * Class GeneratorTest
 * @package Tests
 */
class GeneratorTest extends TestCase
{
    /** @var Generator $generator */
    protected $generator;

    protected function setUp()
    {
        $generator = new Generator();
        $this->setGenerator($generator);
    }

    /**
     * @throws Exception
     */
    public function testInitializationWithSaveLocation()
    {
        $generator = new Generator('test');
        static::assertInstanceOf(Generator::class, $generator);
    }

    public function testGetDocuments()
    {
        $documents = $this->getGenerator()->getDocumentList();
        static::assertTrue(is_array($documents));
    }

    /**
     * @throws MpdfException
     * @throws Throwable
     */
    public function testGeneratePdf()
    {
        $dataPool = new GenericDataPool([
            'firstName' => 'Micheal',
            'lastName' => 'Scott',
            'age' => 49

        ]);

        $document = new GenericDocumentV1($dataPool);
        $filename = $this->getGenerator()->generatePdf($document);
        static::assertTrue(is_string($filename));
        static::assertFileExists($filename);
    }

    /**
     * @throws MpdfException
     * @throws Throwable
     */
    public function testGeneratePdfFilenameNotSet()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);

        $dataPool = new GenericDataPool([
            'firstName' => 'Micheal',
            'lastName' => 'Scott',
            'age' => 49

        ]);

        $document = new GenericDocumentV1($dataPool);
        $this->getGenerator()->generatePdf($document, '');
    }

    /**
     * @throws MpdfException
     * @throws Throwable
     */
    public function testGeneratePdfFilenameIsNotString()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);

        $dataPool = new GenericDataPool([
            'firstName' => 'Micheal',
            'lastName' => 'Scott',
            'age' => 49

        ]);

        $document = new GenericDocumentV1($dataPool);
        $this->getGenerator()->generatePdf($document, 666);
    }

    public function testSetSaveLocationEmpty()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getGenerator()->setSaveLocation('');
    }

    public function testSetSaveLocationNotString()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getGenerator()->setSaveLocation(666);
    }



    /**
     * @return Generator
     */
    public function getGenerator()
    {
        $generator = $this->generator;
        static::assertInstanceOf(Generator::class, $generator);
        static::assertInstanceOf(GeneratorInterface::class, $generator);
        return $generator;
    }

    /**
     * @param Generator $generator
     * @return GeneratorTest
     */
    public function setGenerator($generator)
    {
        static::assertInstanceOf(Generator::class, $generator);
        static::assertInstanceOf(GeneratorInterface::class, $generator);
        $this->generator = $generator;
        return $this;
    }

}
