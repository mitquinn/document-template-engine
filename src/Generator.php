<?php

namespace Kapitus\DocumentTemplateEngine;

use Exception;
use Mpdf\Mpdf;
use Throwable;
use Ramsey\Uuid\Uuid;
use Mpdf\MpdfException;
use League\Plates\Engine;
use Mpdf\Output\Destination;
use League\Plates\Template\Template;
use Kapitus\DocumentTemplateEngine\Documents\GenericDocumentV1;
use Kapitus\DocumentTemplateEngine\Interfaces\DocumentInterface;
use Kapitus\DocumentTemplateEngine\Interfaces\GeneratorInterface;

/**
 * Class Generator
 * @package Kapitus\DocumentTemplateEngine
 */
class Generator implements GeneratorInterface
{
    /** @var array $documentList */
    protected $registeredDocuments = [
        GenericDocumentV1::class
    ];

    /** @var Engine $engine */
    protected $engine;

    /** @var string  */
    protected $saveLocation = __DIR__.'/Output/';

    /**
     * Generator constructor.
     * @param string $saveLocation
     * @throws Exception
     */
    public function __construct($saveLocation = null)
    {
        //If the saveLocation is not set we just default to the class default.
        if (!is_null($saveLocation)) {
            $this->setSaveLocation($saveLocation);
        }

        //This loads the available templates into the Plate Engine.
        $this->setEngine(new Engine(__DIR__.'/Templates', 'plate'));
    }

    /**
     * @inheritDoc
     * @throws MpdfException
     * @throws Throwable
     */
    public function generatePdf(DocumentInterface $document, $filename = null)
    {
        //If there is no filename passed we will generate a random uuid to the filename.
        if (is_null($filename)) {
            //Generate a uuid as filename.
            $filename = Uuid::uuid4()->toString();
        }

        //Filename must be set.
        if (empty($filename)) {
            throw new Exception(self::class . ' - generatePdf - filename must be set.', 500);
        }

        //Filename must be a string.
        if (!is_string($filename)) {
            throw new Exception(self::class .' - generatePdf - filename must be a string.', 500);
        }

        //Initialize the Template.
        $template = new Template($this->getEngine(), $document->getTemplate());

        //Renders the html template with the data from the passed document.
        $render = $template->render($document->getDataPool()->getAvailableFields());

        /**
         * @var Mpdf $mpdf
         * @see https://mpdf.github.io/
         */
        $mpdf = new Mpdf();

        //Write the html to pdf.
        $mpdf->WriteHTML($render);

        //This is the location where the file will save.
        $file = $this->getSaveLocation(). "$filename.pdf";

        //Saving file to location.
        $mpdf->Output($file, Destination::FILE);

        //This is the path and filename of the recently generated file.
        return $file;
    }


    /**
     * @inheritDoc
     * @return array
     */
    public function getDocumentList()
    {
        $documentList = [];
        /** @var DocumentInterface $document */
        foreach ($this->getRegisteredDocuments() as $document) {
            $documentList[$document::getName()] = [
                'class' => $document,
                'version' => $document::getVersion()
            ];
        }
        return $documentList;
    }

    /**
     * @inheritDoc
     * @return DocumentInterface[]
     */
    public function getRegisteredDocuments()
    {
        return $this->registeredDocuments;
    }

    /**
     * @return Engine
     */
    protected function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param Engine $engine
     * @return Generator
     */
    protected function setEngine($engine)
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaveLocation()
    {
        return $this->saveLocation;
    }

    /**
     * @param string $saveLocation
     * @return Generator
     * @throws Exception
     */
    public function setSaveLocation($saveLocation)
    {
        if (empty($saveLocation)) {
            throw new Exception(self::class . ' - saveLocation must be set.', 500);
        }

        if (!is_string($saveLocation)) {
            throw new Exception(self::class . ' - saveLocation must be a string.', 500);
        }

        $this->saveLocation = $saveLocation;
        return $this;
    }

}
