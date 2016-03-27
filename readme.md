# (Greek) Slug Generator

```GreekSlugGenerator``` is a [slug][1] (pretty URL) generator, which supports Greek UTF-8 encoded characters, and generates a slug based on strings which are typically titles of pages or articles.

**The class can be used for English-only titles as well.**

If a Greek character is found, it is converted to its English equivalent.

Spaces as well as some punctuation marks are converted to dashes, but if at any point multiple sequential dashes are produced, only one appears in the final slug.

## Installation

It can be installed either by requiring the ```GreekSlugGenerator.php``` file under ```src```, or via Composer by using the [Packagist archive][2].

## How to use & examples

```php
require_once('src/GreekSlugGenerator.php');
$slug_generator = new \StathisG\GreekSlugGenerator\GreekSlugGenerator();

/* produces: the-class-can-be-used-for-english-only-titles-as-well */
echo $slug_generator->get_slug('The class can be used for ENGLISH-ONLY titles as well');

/* produces: it-ignores-multiple-spaces-between-the-words */
echo $slug_generator->get_slug('It   ignores   multiple   spaces   between   the   words');

/* produces: as-well-as-brackets-quotes-commas-and-full-stops */
echo $slug_generator->get_slug('As well as brackets {[()]}, quotes `\'", commas, and full stops.');

/* produces: some-others-are-converted-in-dashes-but-if-at-any-point-multiple-sequential-dashes-are-produced-only-one-appears- */
echo $slug_generator->get_slug('Some others are converted in dashes, but if at any point multiple sequential dashes are produced, only one appears: \/_-');

/* produces: greek-example-1-ekthesh-fwtografias-to-rethymno-kai-h-thalassa-hmeres-rethymnoy-2013 */
echo $slug_generator->get_slug('Greek example #1: Έκθεση Φωτογραφίας «Το Ρέθυμνο και η Θάλασσα» - "Ημέρες Ρεθύμνου" 2013');

/* produces: greek-example-2-h-ekthesh-ksekinaei-thn-tetarth-08-05-2013-kai-wra-20-45-h-diarkeia-ths-ektheshs-tha-einai-apo-08-05-ews-07-06 */
echo $slug_generator->get_slug('Greek example #2: Η έκθεση ξεκινάει την Τετάρτη 08/05/2013 και ώρα 20:45. Η διάρκεια της έκθεσης θα είναι από 08/05 έως 07/06');
```

[1]: http://en.wikipedia.org/wiki/Slug_(web_publishing\)#Slug
[2]: https://packagist.org/packages/stathisg/greek-slug-generator
