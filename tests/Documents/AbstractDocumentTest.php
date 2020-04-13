<?php

namespace Tests\Documents;

use Exception;
use Kapitus\DocumentTemplateEngine\Abstracts\AbstractDocument;
use Kapitus\DocumentTemplateEngine\DataPools\GenericDataPool;
use Kapitus\DocumentTemplateEngine\Documents\GenericDocumentV1;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractDocumentTest
 * @package Tests\Documents
 */
class AbstractDocumentTest extends TestCase
{

    /** @var $mockAbstractDocument */
    protected $mockAbstractDocument;


    protected function setUp()
    {
        /** @var AbstractDocument $mock */
        $mock = $this->getMockBuilder(AbstractDocument::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->setMockAbstractDocument($mock);
    }

    /**
     * @throws Exception
     */
    public function testEnforceName()
    {
        $true = $this->getMockAbstractDocument()->enforceName('test');
        static::assertTrue($true);
    }

    /**
     * @throws Exception
     */
    public function testEnforceNameWithEmpty()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDocument()->enforceName('');
    }

    /**
     * @throws Exception
     */
    public function testEnforceNameWithNoneString()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDocument()->enforceName(666);
    }

    /**
     * @throws Exception
     */
    public function testEnforceVersion()
    {
        $true = $this->getMockAbstractDocument()->enforceVersion('test');
        static::assertTrue($true);
    }

    /**
     * @throws Exception
     */
    public function testEnforceVersionWithEmpty()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDocument()->enforceVersion('');
    }

    /**
     * @throws Exception
     */
    public function testEnforceVersionWithNoneString()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDocument()->enforceVersion(666);
    }

    /**
     * @throws Exception
     */
    public function testEnforceTemplate()
    {
        $true = $this->getMockAbstractDocument()->enforceTemplate('test');
        static::assertTrue($true);
    }

    /**
     * @throws Exception
     */
    public function testEnforceTemplateWithEmpty()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDocument()->enforceTemplate('');
    }

    /**
     * @throws Exception
     */
    public function testEnforceTemplateWithNoneString()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDocument()->enforceTemplate(666);
    }

    /**
     * @throws Exception
     */
    public function testEnforceRequiredFields()
    {
        $true = $this->getMockAbstractDocument()->enforceRequiredFields(['test' => 'true']);
    }

    /**
     * @throws Exception
     */
    public function testEnforceRequiredFieldsWithEmpty()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDocument()->enforceRequiredFields([]);
    }

    /**
     * @throws Exception
     */
    public function testValidateDataPool()
    {
        $true = $this->getMockAbstractDocument()->validateDataPool(['firstName'],['firstName']);
        static::assertTrue($true);
    }

    /**
     * @throws Exception
     */
    public function testValidateDataPoolWithMissingAvailableField()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDocument()->validateDataPool(['firstName', 'lastName'],['firstName']);
    }


    /*** Getters and Setters ***/

    /**
     * @return AbstractDocument
     */
    public function getMockAbstractDocument()
    {
        return $this->mockAbstractDocument;
    }

    /**
     * @param AbstractDocument $mock
     * @return $this
     */
    public function setMockAbstractDocument($mock)
    {
        $this->mockAbstractDocument = $mock;
        return $this;
    }
}
