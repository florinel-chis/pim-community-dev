<?php

namespace Pim\Bundle\CatalogBundle\Tests\Unit\Validator\Constraints;

use Pim\Bundle\CatalogBundle\Validator\Constraints\UniqueValue;

/**
 * @author    Gildas Quemener <gildas@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class UniqueValueTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->constraint = new UniqueValue();
    }

    public function testExtendsConstraint()
    {
        $this->assertInstanceOf('Symfony\Component\Validator\Constraint', $this->constraint);
    }

    public function testMessage()
    {
        $this->assertEquals(
            'The value {{ value }} of attribute {{ attribute }} is already set on an other product.',
            $this->constraint->message
        );
    }

    public function testValidatedBy()
    {
        $this->assertEquals('pim_unique_value_validator', $this->constraint->validatedBy());
    }
}
