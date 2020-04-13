<?php

namespace Kapitus\DocumentTemplateEngine\Abstracts;

use Exception;
use Kapitus\DocumentTemplateEngine\Interfaces\DataPoolInterface;

/**
 * Class AbstractDataPool
 * @package Kapitus\DocumentTemplateEngine\Abstracts
 */
abstract class AbstractDataPool implements DataPoolInterface
{
    /** @var array $availableFields */
    protected $availableFields = [];

    /**
     * BaseDataPool constructor.
     * @param array $data Key => Value array with Keys being strings.
     * @throws Exception
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->addKeyValueToAvailableFields($key, $value);
        }
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function getAvailableFields()
    {
        return $this->availableFields;
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function getAvailableFieldsKeys()
    {
        return array_keys($this->getAvailableFields());
    }


    /**
     * @inheritDoc
     * @return DataPoolInterface
     * @throws Exception
     */
    public function addKeyValueToAvailableFields($key, $value)
    {
        $availableFields = $this->getAvailableFields();

        if (empty($key)) {
            throw new Exception(self::class . ' - key can not be empty.', 500);
        }

        if (!is_string($key)) {
            throw new Exception(self::class . ' - key must be a string.', 500);
        }

        if (is_array($value)) {
            throw new Exception(self::class . '- value passed can not be an array.', 500);
        }

        if (array_key_exists($key, $availableFields)) {
            throw new Exception(self::class . " - key: $key has already been set.", 500);
        }

        $this->availableFields[$key] = $value;
        return $this;
    }

    /**
     * @inheritDoc
     * @return mixed
     * @throws Exception
     */
    public function getAvailableFieldsValueByKey($key)
    {
        $availableFieldsKeys = $this->getAvailableFieldsKeys();

        if (!is_string($key)) {
            throw new Exception(self::class . ' - Key must be a string.', 500);
        }

        if (!in_array($key, $availableFieldsKeys)) {
            throw new Exception(self::class . " - Key: $key is not set in availableFields.", 500);
        }

        $availableFields = $this->getAvailableFields();
        return $availableFields[$key];
    }

}
