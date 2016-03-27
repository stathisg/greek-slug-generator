<?php
header("Content-type: text/plain");
require __DIR__ . '/../vendor/autoload.php';

use \StathisG\GreekSlugGenerator\GreekSlugGenerator;

// produces: the-class-can-be-used-for-english-only-titles-as-well
echo GreekSlugGenerator::getSlug('The class can be used for ENGLISH-ONLY titles as well') . PHP_EOL;

// produces: it-ignores-multiple-spaces-between-the-words
echo GreekSlugGenerator::getSlug('It   ignores   multiple   spaces   between   the   words') . PHP_EOL;

// produces: as-well-as-brackets-quotes-commas-and-full-stops
echo GreekSlugGenerator::getSlug('As well as brackets {[()]}, quotes `\'", commas, and full stops.') . PHP_EOL;

//produces: some-others-are-converted-in-dashes-but-if-at-any-point-multiple-sequential-dashes-are-produced-only-one-appears-
echo GreekSlugGenerator::getSlug('Some others are converted in dashes, but if at any point multiple sequential dashes are produced, only one appears: \/_-') . PHP_EOL;

// produces: greek-example-1-ekthesh-fwtografias-to-rethymno-kai-h-thalassa-hmeres-rethymnoy-2013
echo GreekSlugGenerator::getSlug('Greek example #1: Έκθεση Φωτογραφίας «Το Ρέθυμνο και η Θάλασσα» - "Ημέρες Ρεθύμνου" 2013') . PHP_EOL;

// produces: greek-example-2-h-ekthesh-ksekinaei-thn-tetarth-08-05-2013-kai-wra-20-45-h-diarkeia-ths-ektheshs-tha-einai-apo-08-05-ews-07-06
echo GreekSlugGenerator::getSlug('Greek example #2: Η έκθεση ξεκινάει την Τετάρτη 08/05/2013 και ώρα 20:45. Η διάρκεια της έκθεσης θα είναι από 08/05 έως 07/06') . PHP_EOL;
