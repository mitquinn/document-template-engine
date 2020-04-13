<?php

namespace Tests\DataPools;

use Exception;
use Kapitus\DocumentTemplateEngine\DataPools\GenericDataPool;
use Kapitus\DocumentTemplateEngine\Interfaces\DataPoolInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class GenericDataPoolTest
 * @package Tests\DataPools
 */
class GenericDataPoolTest extends TestCase
{
    /** @var GenericDataPool $dataPool */
    public $dataPool;

    /**
     * @throws Exception
     */
    protected function setUp()
    {
        $dataPool = new GenericDataPool([
            'firstName' => 'Micheal',
            'lastName' => 'Scott',
            'age' => 49
        ]);
        $this->setDataPool($dataPool);
    }


    /**
     * Testing retrieval of availableFields.
     */
    public function testGetAvailableFields()
    {
        $availableFields = $this->getDataPool()->getAvailableFields();
        static::assertNotEmpty($availableFields);
        static::assertArrayHasKey('firstName', $availableFields);
        static::assertArrayHasKey('lastName', $availableFields);
        static::assertArrayHasKey('age', $availableFields);
    }

    /**
     * Testing retrieval of availableFieldsKeys.
     */
    public function testGetAvailableFieldsKeys()
    {
        $availableFieldsKeys = $this->getDataPool()->getAvailableFieldsKeys();
        static::assertNotEmpty($availableFieldsKeys);
        static::assertContains('firstName', $availableFieldsKeys);
        static::assertContains('lastName', $availableFieldsKeys);
        static::assertContains('age', $availableFieldsKeys);
    }

    /**
     * Testing adding of a Key => Value to availableFields.
     * @throws Exception
     */
    public function testAddKeyValueToAvailableFields()
    {
        $dataPool = $this->getDataPool()->addKeyValueToAvailableFields('eyeColor', 'blue');
        static::assertInstanceOf(GenericDataPool::class, $dataPool);
        static::assertInstanceOf(DataPoolInterface::class, $dataPool);
        $availableFields = $this->getDataPool()->getAvailableFields();
        static::assertArrayHasKey('eyeColor', $availableFields);
        static::assertEquals('blue', $availableFields['eyeColor']);
    }

    /**
     * Testing insertion of empty key to availableFields.
     * @throws Exception
     */
    public function testAddKeyValueToAvailableFieldsKeyCanNotBeEmpty()
    {
        static::expectException(Exception::class);
        static::expectExceptionMessage('Kapitus\DocumentTemplateEngine\Abstracts\AbstractDataPool - key can not be empty.');
        static::expectExceptionCode(500);
        $true = $this->getDataPool()->addKeyValueToAvailableFields('', 'test');
    }

    /**
     * Testing insertion of value as array to availableFields.
     */
    public function testAddKeyValueToAvailableFieldsValueCanNotBeAnArray()
    {
        static::expectException(Exception::class);
        static::expectExceptionMessage('Kapitus\DocumentTemplateEngine\Abstracts\AbstractDataPool- value passed can not be an array.');
        static::expectExceptionCode(500);
        $true = $this->getDataPool()->addKeyValueToAvailableFields('eyeColor', ['test']);
    }

    /**
     * Testing insertion of non-string key to availableFields.
     */
    public function testAddKeyValueToAvailableFieldsKeyMustBeString()
    {
        static::expectException(Exception::class);
        static::expectExceptionMessage('Kapitus\DocumentTemplateEngine\Abstracts\AbstractDataPool - key must be a string.');
        static::expectExceptionCode(500);
        $true = $this->getDataPool()->addKeyValueToAvailableFields(5, 'test');
    }

    /**
     * Testing insertion of key that already is set in availableFields.
     */
    public function testAddKeyValueToAvailableFieldsKeyAlreadyExists()
    {
        static::expectException(Exception::class);
        static::expectExceptionMessage('Kapitus\DocumentTemplateEngine\Abstracts\AbstractDataPool - key: firstName has already been set.');
        static::expectExceptionCode(500);
        $true = $this->getDataPool()->addKeyValueToAvailableFields('firstName', 'Jim');
    }


    public function testGetAvailableFieldsValuesByKeyWhenTheKeyIsNotAString()
    {
        static::expectException(Exception::class);
        static::expectExceptionMessage('Kapitus\DocumentTemplateEngine\Abstracts\AbstractDataPool - Key must be a string.');
        static::expectExceptionCode(500);
        $true = $this->getDataPool()->getAvailableFieldsValueByKey(1);
    }

    public function testGetAvailableFieldsValuesByKeyWhenTheKeyDoesNotExist()
    {
        static::expectException(Exception::class);
        static::expectExceptionMessage('Kapitus\DocumentTemplateEngine\Abstracts\AbstractDataPool - Key: key_does_not_exist is not set in availableFields.');
        static::expectExceptionCode(500);
        $true = $this->getDataPool()->getAvailableFieldsValueByKey('key_does_not_exist');
    }


    /**
     * @return GenericDataPool
     */
    public function getDataPool()
    {
        $dataPool = $this->dataPool;
        static::assertInstanceOf(GenericDataPool::class, $dataPool);
        static::assertInstanceOf(DataPoolInterface::class, $dataPool);
        return  $dataPool;
    }

    /**
     * @param GenericDataPool $dataPool
     * @return GenericDataPoolTest
     */
    public function setDataPool(GenericDataPool $dataPool)
    {
        static::assertInstanceOf(GenericDataPool::class, $dataPool);
        static::assertInstanceOf(DataPoolInterface::class, $dataPool);
        $this->dataPool = $dataPool;
        return $this;
    }

}