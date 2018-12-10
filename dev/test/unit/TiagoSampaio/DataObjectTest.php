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
}
