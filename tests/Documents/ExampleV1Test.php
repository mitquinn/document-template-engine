<?php

namespace Tests\Documents;

use Kapitus\DocumentTemplateEngine\DataPools\GenericDataPool;
use Kapitus\DocumentTemplateEngine\Documents\ExampleV1;
use Kapitus\DocumentTemplateEngine\Generator;
use PHPUnit\Framework\TestCase;

/**
 * Class ExampleV1Test
 * @package Tests\Documents
 */
class ExampleV1Test extends TestCase
{

    public function testInitialization()
    {
        $dataPool = new GenericDataPool([
            'firstName' => 'Todd',
            'lastName' => 'Packer',
        ]);
        $example = new ExampleV1($dataPool);

        $generator = new Generator();
        $filename = $generator->generatePdf($example);
        var_dump($filename);
    }

}