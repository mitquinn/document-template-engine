# Document Template Engine #

Welcome to Kapitus Document Template Engine Composer Package.

If you have any questions or concerns please contact:

Mitchell Quinn

mquinn@kapitus.com

### What is this repository for? ###

* This repository is for the Templating and PDF Generation of documents.
* 1.0.0

### How do I get set up? ###

* To get started all you need to do is clone the repo and run **composer install**
* You will need to have at least PHP5.6 installs and composer installed.

### Contribution guidelines ###

* Please store all of your tests in the /tests directory.
* Please add Mitchell Quinn as a reviewer for your pull requests. If your build is failing I will not review your code.
* Please have 100% Code Coverage.

### Who do I talk to? ###

* Mitchell Quinn - mquinn@kapitus.com

### Adding a new Document/Template ###

I suggest starting by reviewing the GenericDocumentV1 class. It has a good example of what you need to do to get rolling.

You will need to create two different files: a Document class and a Template Plate.

##### Document File #####

* The Document class should be located in the src/Documents/ directory.
* The Document class must extend the AbstractDocument class.
* The Document class must be registered in the Generator - $registeredDocuments property. This will make the new Document class available.
* The Document class should have the version appended to the end of the class name. Example: NewDocument**V1**.
* The Document class must set the: $name, $version, $template, and $requiredFields properties.
* The $name property should be the display name of the class.
* The $version should be the version of the document. If this is the first file just use 1.
* The $template should be the template to be used with the document. This must match the name of the Template Plate.
* The $requiredFields is an array of fields that are required to generate the document.

##### Template File #####

Start by taking a look at src/Templates/GenericDocumentV1

* The Template file must be located in the src/Templates/ directory.
* The Template file must end in .plate .
* The Template file must be HTML.
* The Template file may only use supported Mpdf HTML/CSS tags.
* To learn more about MPDF see: https://mpdf.github.io/
* To learn more about Plates see: https://platesphp.com/

### Updating a new Document/Template ###

If you have to update a Document/Template you may extend the previous Document/Template.

An example would be if you were going to update GenericDocumentV1. You would create a new class called GenericDocumentV2. You can then updated any fields desired.

Do **NOT** change existing Templates/Document for updates (fixes are allowed). We want to be able to generate old versions of these Documents/Templates if we choose.