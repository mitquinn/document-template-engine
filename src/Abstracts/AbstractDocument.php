<?php

namespace Kapitus\DocumentTemplateEngine\Abstracts;

use Exception;
use Kapitus\DocumentTemplateEngine\Interfaces\DataPoolInterface;
use Kapitus\DocumentTemplateEngine\Interfaces\DocumentInterface;

/**
 * Class BaseDocument
 * @package Kapitus\DocumentTemplateEngine\Templates
 */
abstract class AbstractDocument implements DocumentInterface
{
    /** @var string $name */
    protected static $name = '';

    /** @var string $version */
    protected static $version = '';

    /** @var string $template */
    protected static $template = '';

    /** @var array $requiredFields */
    protected static $requiredFields = [];

    /** @var DataPoolInterface $dataPool */
    protected $dataPool;

    /**
     * BaseDocument constructor.
     * @param DataPoolInterface $dataPool
     * @throws Exception
     */
    public function __construct(DataPoolInterface $dataPool)
    {
        //The name must be set by the child class.
        $this->enforceName(static::getName());

        //The version must be set by the class.
        $this->enforceVersion(static::getVersion());

        //The template must be set by the child class.
        $this->enforceTemplate(static::getTemplate());

        //The requiredFields must be set by the child class.
        $this->enforceRequiredFields(static::getRequiredFields());

        $this->setDataPool($dataPool);
    }

    /**
     * @param string $name
     * @return bool
     * @throws Exception
     */
    public function enforceName($name)
    {
        if (empty($name)) {
            throw new Exception(static::class. ' - name must be set.', 500);
        }

        if (!is_string($name)) {
            throw new Exception(static::class. ' - name must be a string.', 500);
        }
        return true;
    }


    /**
     * @param string $version
     * @return bool
     * @throws Exception
     */
    public function enforceVersion($version)
    {
        if (empty($version)) {
            throw new Exception(static::class. ' - version must be set.', 500);
        }

        if (!is_string($version)) {
            throw new Exception(static::class. ' - version must be a string.', 500);
        }
        return true;
    }

    /**
     * @param string $template
     * @return bool
     * @throws Exception
     */
    public function enforceTemplate($template)
    {
        if (empty($template)) {
            throw new Exception(static::class. ' - template must be set.', 500);
        }

        if (!is_string($template)) {
            throw new Exception(static::class. ' - template must be a string.', 500);
        }

        return true;
    }


    /**
     * This is the array of required fields that are needed to generate the template. Each of these fields will be
     * looped through and validated to make sure they exist and have a value in the dataPool.
     * @param array $requiredFields
     * @return bool
     * @throws Exception
     */
    public function enforceRequiredFields(array $requiredFields)
    {
        if (empty($requiredFields)) {
            throw new Exception(self::class.' - Does not have requiredFields property set.', 500);
        }
        return true;
    }

    /**
     * @param array $requiredFields
     * @param array $availableFieldsKeys
     * @return bool
     * @throws Exception
     */
    public function validateDataPool(array $requiredFields, array $availableFieldsKeys)
    {
        foreach ($requiredFields as $requiredField) {
            if (!in_array($requiredField, $availableFieldsKeys)) {
                throw new Exception(self::class.' - Passed dataPool does not have required fields available.', 500);
            }
        }
        return true;
    }

    /*** Getters and Setters ***/

    /**
     * @return DataPoolInterface
     */
    public function getDataPool()
    {
        return $this->dataPool;
    }

    /**
     * @param DataPoolInterface $dataPool
     * @return AbstractDocument
     * @throws Exception
     */
    public function setDataPool(DataPoolInterface $dataPool)
    {
        $this->validateDataPool(static::getRequiredFields(), $dataPool->getAvailableFieldsKeys());
        $this->dataPool = $dataPool;
        return $this;
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return static::$name;
    }

    /**
     * @return string
     */
    public static function getVersion()
    {
        return static::$version;
    }

    /**
     * @return string
     */
    public static function getTemplate()
    {
        return static::$template;
    }

    /**
     * @return array
     */
    public static function getRequiredFields()
    {
        return static::$requiredFields;
    }

}
