<?php

namespace TiagoSampaioTest;

use TiagoSampaio\DataObject;

/**
 * Class DataObjectTest
 * @package TelegramTest\Telegram\Framework\Data
 */
class DataObjectTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     */
    public function dataSetterAndGetter()
    {
        $key    = 'first_name';
        $value  = 'John Doe';
    
        $object = new DataObject();
        $this->assertInstanceOf(DataObject::class, $object->setData($key, $value));
        $this->assertEquals($value, $object->getData($key));
    }

    /**
     * @test
     */
    public function setData()
    {
        $key    = 'first_name';
        $value  = 'John Doe';
        
        $data = [
            $key => $value
        ];
    
        $object = new DataObject();
        $this->assertInstanceOf(DataObject::class, $object->setData($data));
        $this->assertEquals($value, $object->getData($key));
    }

    /**
     * @test
     */
    public function addData()
    {
        $object = new DataObject();
        
        $this->assertInstanceOf(DataObject::class, $object->setData(['first_name' => 'John']));
        $this->assertEquals('John', $object->getData('first_name'));
    
        $this->assertInstanceOf(DataObject::class, $object->addData(['last_name' => 'Doe']));
        $this->assertEquals('Doe', $object->getData('last_name'));

        $this->assertInstanceOf(DataObject::class, $object->addData(['middle_name' => null]));
        $this->assertEquals(null, $object->getData('middle_name'));
    }

    /**
     * @test
     */
    public function hasData()
    {
        $data = [
            'one' => 'Value One',
            'two' => 'Value Two',
        ];

        $object = new DataObject($data);

        $this->assertEquals(true, $object->hasData('one'));
        $this->assertEquals(true, $object->hasData('two'));
        $this->assertEquals(false, $object->hasData('three'));
    }

    /**
     * @test
     */
    public function resetData()
    {
        $data = [
            'one' => 'Value One',
            'two' => 'Value Two',
        ];

        $object = new DataObject($data);

        $this->assertEquals($data, $object->getData());
        $this->assertInstanceOf(DataObject::class, $object->resetData());
        $this->assertEquals([], $object->getData());
    }

    /**
     * @test
     */
    public function getData()
    {
        $data = [
            'one' => 'Value One',
            'two' => 'Value Two',
        ];

        $object = new DataObject($data);

        $this->assertEquals($data, $object->getData());
        $this->assertEquals($data, $object->getData([]));
        $this->assertEquals(null, $object->getData('not_found'));
    }

    /**
     * @test
     */
    public function unsetData()
    {
        $data = [
            'one' => 'Value One',
            'two' => 'Value Two',
        ];

        $object = new DataObject($data);

        $this->assertEquals($data, $object->getData());

        $this->assertInstanceOf(DataObject::class, $object->unsetData('one'));
        $this->assertEquals(['two' => 'Value Two'], $object->getData());

        $object->setData($data);
        $object->unsetData();
        $this->assertEquals([], $object->getData());

        $object->setData($data);
        $object->unsetData(['one']);
        $this->assertEquals(['two' => 'Value Two'], $object->getData());
    }

    /**
     * @test
     */
    public function export()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];
        
        $object = new DataObject();
        $object->setData($data);
        
        $this->assertEquals($data, $object->export());
        $this->assertEquals(['first_name' => 'John'], $object->export(['first_name']));
    }

    /**
     * @test
     */
    public function debug()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        $object = new DataObject();
        $object->setData($data);

        $this->assertEquals($data, $object->debug());
    }

    /**
     * @test
     */
    public function offset()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        $object = new DataObject($data);

        $object->offsetSet('middle_name', 'Genius');
        $this->assertEquals('Genius', $object->offsetGet('middle_name'));
        $this->assertEquals(true, $object->offsetExists('middle_name'));
        $object->offsetUnset('middle_name');
        $this->assertEquals(false, $object->offsetExists('middle_name'));
    }
}
