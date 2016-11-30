<?php
class ContainerTest extends DbTestCase {

   public function testGetSearchOptions() {
      $container = new PluginFieldsContainer();
      $options = $container->getSearchOptions();

      $this->assertEquals(8, count($options));
   }

   public function testNewContainer() {
      $container = new PluginFieldsContainer();

      $data = [
         'label'     => '_container_label1',
         'type'      => 'tab',
         'is_active' => '1',
         'itemtypes' => ["Computer", "User"]
     ];

     $newid = $container->add($data);
     $this->assertGreaterThan(0, $newid);

     $this->assertTrue(class_exists('PluginFieldsComputercontainerlabel1'));
   }
}
