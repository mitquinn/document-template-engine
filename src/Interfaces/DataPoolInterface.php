<?php

namespace Kapitus\DocumentTemplateEngine\Interfaces;

/**
 * Interface DataPoolInterface
 * @package Kapitus\DocumentTemplateEngine\Interfaces
 */
interface DataPoolInterface
{
    /**
     * Returns array of the Key => Value pairs of the availableFields.
     * @return array
     */
    public function getAvailableFields();

    /**
     * Returns array of keys from the availableFields.
     * @return array
     */
    public function getAvailableFieldsKeys();

    /**
     * @param string $key String used to identify the value.
     * @param mixed $value Value wish to be stored. Can not be array.
     * @return DataPoolInterface
     */
    public function addKeyValueToAvailableFields($key, $value);

    /**
     * @param string $key String used to identify the value.
     * @return mixed
     */
    public function getAvailableFieldsValueByKey($key);

}