<?php

namespace Redking\FontAwesomePickerBundle\Tests\Form\Type;

use Redking\FontAwesomePickerBundle\Form\Type\FontAwesomeType;
use Symfony\Component\Form\Test\TypeTestCase;

class FontAwesomeTypeTest extends TypeTestCase
{
    public function testOptions()
    {
        $form = $this->factory->create(FontAwesomeType::class);
        
        $options = $form->getConfig()->getOptions();
        $this->assertTrue(isset($options['picker_options']), 'Check if picker_options is in form options');
        $this->assertEquals([], $options['picker_options'], 'Check if picker_options is an empty array');
    }
}
