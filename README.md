FontAwesome Picker Bundle
=========================

Implementation of [FontAwesome Picker](https://github.com/itsjavi/fontawesome-iconpicker) Form Type for Symfony 2+


## Installation

Donwload the bundle with composer.

```
composer require redking/fontawesome-picker-bundle
```

Register the bundle in the kernel.


``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Redking\FontAwesomePickerBundle\RedkingFontAwesomePickerBundle(),

    );
}
```


Add the following js and css to your layout assets : 

* `/bundles/redkingfontawesomepicker/js/fontawesome-iconpicker.min.js`
* `/bundles/redkingfontawesomepicker/css/fontawesome-iconpicker.min.css`


## Usage

Use the form type as usual : 

```php

use Redking\FontAwesomePickerBundle\Form\Type\FontAwesomeType

// ...
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('icon', FontAwesomeType::class, array(
            'picker_options' => [], // You can pass here the options of the widget
        ));
    }
```
