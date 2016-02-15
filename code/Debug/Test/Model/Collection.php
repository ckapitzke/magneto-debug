<?php

/**
 * Class Sheep_Debug_Model_Test_Collection
 *
 * @category Sheep
 * @package  Sheep_Debug
 * @license  Copyright: Pirate Sheep, 2016, All Rights reserved.
 * @link     https://piratesheep.com
 *
 * @covers Sheep_Debug_Model_Collection
 * @codeCoverageIgnore
 */
class Sheep_Debug_Model_Test_Collection extends EcomDev_PHPUnit_Test_Case
{

    public function testConstruct()
    {
        $collection = $this->getMock('Varien_Data_Collection_Db', array('getSelectSql'));
        $collection->expects($this->once())->method('getSelectSql')->with(true)->willReturn('sql query');

        $model = Mage::getModel('sheep_debug/collection', $collection);
        $this->assertNotFalse($model);
        $this->assertInstanceOf('Sheep_Debug_Model_Collection', $model);
        $this->assertContains('Varien_Data_Collection_Db', $model->getClass());
        $this->assertEquals('flat', $model->getType());
        $this->assertEquals('sql query', $model->getQuery());
        $this->assertEquals(0, $model->getCount());
    }


    public function testIncrementCount()
    {
        $collection = $this->getResourceModelMock('catalog/product_collection', array('getSelectSql'));
        $collection->expects($this->once())->method('getSelectSql')->with(true)->willReturn('sql query');

        $model = Mage::getModel('sheep_debug/collection', $collection);
        $this->assertContains('Mage_Catalog_Model_Resource_Product_Collection', $model->getClass());
        $this->assertEquals('eav', $model->getType());
        $this->assertEquals('sql query', $model->getQuery());
        $this->assertEquals(0, $model->getCount());

        $model->incrementCount();
        $this->assertEquals(1, $model->getCount());

        $model->incrementCount();
        $this->assertEquals(2, $model->getCount());
    }

}