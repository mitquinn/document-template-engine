<?php

namespace Tests\DataPools;

use Exception;
use Kapitus\DocumentTemplateEngine\Abstracts\AbstractDataPool;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractDataPoolTest
 * @package Tests\DataPools
 */
class AbstractDataPoolTest extends TestCase
{
    /** @var AbstractDataPool $mockAbstractDataPool */
    protected $mockAbstractDataPool;

    protected function setUp()
    {
        /** @var AbstractDataPool $mock */
        $mock = $this->getMockBuilder(AbstractDataPool::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->setMockAbstractDataPool($mock);
    }

    /**
     * @throws Exception
     */
    public function testAddKeyValueToAvailableFields()
    {
        $mock = $this->getMockAbstractDataPool()->addKeyValueToAvailableFields('firstName', 'Micheal');
        static::assertGreaterThan(1, strpos(get_class($mock), 'AbstractDataPool'));
    }

    /**
     * @throws Exception
     */
    public function testAddKeyValueToAvailableFieldsEmptyKey()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDataPool()->addKeyValueToAvailableFields('', 'Micheal');
    }

    /**
     * @throws Exception
     */
    public function testAddKeyValueToAvailableFieldsKeyIsNotString()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDataPool()->addKeyValueToAvailableFields(5, 'Micheal');
    }

    /**
     * @throws Exception
     */
    public function testAddKeyValueToAvailableFieldsValueIsNotArray()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDataPool()->addKeyValueToAvailableFields('firstName', []);
    }

    /**
     * @throws Exception
     */
    public function testAddKeyValueToAvailableFieldsDuplicateKey()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDataPool()->addKeyValueToAvailableFields('firstName', 'Micheal');
        $this->getMockAbstractDataPool()->addKeyValueToAvailableFields('firstName', 'Micheal');
    }

    /**
     * @throws Exception
     */
    public function testGetAvailableFieldsValueByKey()
    {
        $value = $this->getMockAbstractDataPool()
            ->addKeyValueToAvailableFields('firstName', 'Micheal')
            ->getAvailableFieldsValueByKey('firstName');
        static::assertEquals('Micheal', $value);
    }

    /**
     * @throws Exception
     */
    public function testGetAvailableFieldsValueByKeyKeyIsNotString()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDataPool()
            ->addKeyValueToAvailableFields('firstName', 'Micheal')
            ->getAvailableFieldsValueByKey(5);
    }

    public function testGetAvailableFieldsValueByKeyKeyIsNotAvailable()
    {
        static::expectException(Exception::class);
        static::expectExceptionCode(500);
        $this->getMockAbstractDataPool()
            ->addKeyValueToAvailableFields('firstName', 'Micheal')
            ->getAvailableFieldsValueByKey('lastName');
    }

    public function testGetAvailableFieldsKeys()
    {
        $array = $this->getMockAbstractDataPool()
            ->addKeyValueToAvailableFields('firstName', 'Micheal')
            ->getAvailableFieldsKeys();
        static::assertTrue(is_array($array));
        static::assertContains('firstName', $array);
    }

    /**
     * @throws Exception
     */
    public function testGetAvailableFields()
    {
        $array = $this->getMockAbstractDataPool()
            ->addKeyValueToAvailableFields('firstName', 'Micheal')
            ->getAvailableFields();
        static::assertTrue(is_array($array));
        static::assertArrayHasKey('firstName', $array);
        static::assertEquals('Micheal', $array['firstName']);
    }

    /**
     * @return AbstractDataPool
     */
    public function getMockAbstractDataPool()
    {
        return $this->mockAbstractDataPool;
    }

    /**
     * @param AbstractDataPool $mockAbstractDataPool
     * @return AbstractDataPoolTest
     */
    public function setMockAbstractDataPool($mockAbstractDataPool)
    {
        $this->mockAbstractDataPool = $mockAbstractDataPool;
        return $this;
    }

}
