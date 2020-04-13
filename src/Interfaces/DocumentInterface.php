<?php

namespace Kapitus\DocumentTemplateEngine\Interfaces;

/**
 * Class DocumentTemplateInterface
 * @package Kapitus\DocumentTemplateEngine\Interfaces
 */
interface DocumentInterface
{
    /**
     * @return string
     */
    public static function getName();

    /**
     * @return string
     */
    public static function getVersion();

    /**
     * @return string
     */
    public static function getTemplate();

    /**
     * @return array
     */
    public static function getRequiredFields();

    /**
     * @return DataPoolInterface
     */
    public function getDataPool();

}
