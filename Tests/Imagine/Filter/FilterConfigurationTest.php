<?php

namespace Liip\ImagineBundle\Tests\Filter;

use Liip\ImagineBundle\Imagine\Filter\FilterConfiguration;
use Liip\ImagineBundle\Tests\AbstractTest;

/**
 * @covers Liip\ImagineBundle\Imagine\Filter\FilterConfiguration
 */
class FilterConfigurationTest extends AbstractTest
{
    public function testSetAndGetFilter()
    {
        $config = array(
            'filters' => array(
                'thumbnail' => array(
                    'size' => array(180, 180),
                    'mode' => 'outbound',
                ),
            ),
            'cache' => 'web_path',
        );

        $filterConfiguration = new FilterConfiguration();
        $filterConfiguration->set('profile_photo', $config);

        $this->assertEquals($config, $filterConfiguration->get('profile_photo'));
    }

    public function testReturnAllFilters()
    {
        $filterConfiguration = new FilterConfiguration();
        $filterConfiguration->set('foo', array('fooConfig'));
        $filterConfiguration->set('bar', array('barConfig'));

        $filters = $filterConfiguration->all();

        $this->assertInternalType('array', $filters);

        $this->assertArrayHasKey('foo', $filters);
        $this->assertEquals(array('fooConfig'), $filters['foo']);

        $this->assertArrayHasKey('bar', $filters);
        $this->assertEquals(array('barConfig'), $filters['bar']);
    }

    public function testGetUndefinedFilter()
    {
        $filterConfiguration = new FilterConfiguration();

        $this->setExpectedException('RuntimeException', 'Filter not defined: thumbnail');
        $filterConfiguration->get('thumbnail');
    }
}
