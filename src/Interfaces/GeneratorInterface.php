<?php

namespace Kapitus\DocumentTemplateEngine\Interfaces;

/**
 * Interface GeneratorInterface
 * @package Kapitus\DocumentTemplateEngine\Interfaces
 */
interface GeneratorInterface
{
    /**
     * Returns an array of registered DocumentInterface classes along with associated information.
     * @return array
     */
    public function getDocumentList();

    /**
     * Generates a pdf and return the location of the file.
     * @param DocumentInterface $document The document to be converted to pdf.
     * @param string $filename This will not affect the save location. Only the filename.
     * @return string
     */
    public function generatePdf(DocumentInterface $document, $filename = null);

    /**
     * Returns an array of registered DocumentInterface classes.
     * @return DocumentInterface[]
     */
    public function getRegisteredDocuments();


}