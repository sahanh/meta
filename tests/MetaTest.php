<?php
use SahanH\Meta\MetaManager;

class MetaTest extends PHPUnit_Framework_TestCase
{
    protected $m;

    public function setUp()
    {
        $this->m = new MetaManager;
        $this->m->registerNamespace('Test', __DIR__);
    }

    /**
     * @expectedException SahanH\Meta\Exception\InvalidMetaGroupException
     */
    public function testGetInvalidInstance()
    {
        $this->m->getInstance('Dummy');
    }

    public function testMeta()
    {
        $m = $this->m;

        $this->assertSame('John', $m->getMeta('Test', 'meta.name'));
        $this->assertSame('Developer', $m->transform('Test', 'meta.type', 1));
        $this->assertFalse($m->transform('Test', 'meta.type', 3));
    }
}