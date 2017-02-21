<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";
    require_once "src/Date.php";

    $server = 'mysql:host=localhost:8889;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
            Date::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            //Creates Category object
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            //Creates Date object
            $date = "2017-12-31";
            $date_id = null;
            $test_date = new Date($date, $date_id);
            $test_date->save();

            //Creates Task Object
            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 1;
            $test_task = new Task($description, $category_id, $importance, $date_id, $id);
            $test_task->save();

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCategoryId()
        {
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            //Creates Date object
            $date = "2017-12-31";
            $date_id = null;
            $test_date = new Date($date, $date_id);
            $test_date->save();

            //Creates Task Object
            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 1;
            $test_task = new Task($description, $category_id, $importance, $date_id, $id);
            $test_task->save();

            //Act
            $result = $test_task->getCategoryId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getDateId()
        {
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            //Creates Date object
            $date = "2017-12-31";
            $date_id = null;
            $test_date = new Date($date, $date_id);
            $test_date->save();

            //Creates Task Object
            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 1;
            $test_task = new Task($description, $category_id, $importance, $date_id, $id);
            $test_task->save();

            //Act
            $result = $test_task->getDateId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            //Creates Category object
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            //Creates Date object
            $date = "2017-12-31";
            $date_id = null;
            $test_date = new Date($date, $date_id);
            $test_date->save();

            //Creates Task Object
            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 1;
            $test_task = new Task($description, $category_id, $importance, $date_id, $id);

            //Act
            $test_task->save();

            //Assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            //Creates Category object
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            //Creates Date object
            $date = "2017-12-31";
            $date_id = null;
            $test_date = new Date($date, $date_id);
            $test_date->save();

            //Creates Task Object
            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 1;
            $test_task = new Task($description, $category_id, $importance, $date_id, $id);
            $test_task->save();

            $description2 = "Wash the car";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 2;
            $test_task2 = new Task($description, $category_id, $importance, $date_id, $id);
            $test_task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            //Creates Category object
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            //Creates Date object
            $date = "2017-12-31";
            $date_id = null;
            $test_date = new Date($date, $date_id);
            $test_date->save();

            //Creates Task Object
            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 1;
            $test_task = new Task($description, $category_id, $importance, $date_id, $id);
            $test_task->save();

            $description2 = "Wash the car";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 2;
            $test_task2 = new Task($description, $category_id, $importance, $date_id, $id);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            //Creates Category object
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            //Creates Date object
            $date = "2017-12-31";
            $date_id = null;
            $test_date = new Date($date, $date_id);
            $test_date->save();

            //Creates Task Object
            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 1;
            $test_task = new Task($description, $category_id, $importance, $date_id, $id);
            $test_task->save();

            $description2 = "Wash the car";
            $category_id = $test_category->getId();
            $date_id = $test_date->getId();
            $importance = 2;
            $test_task2 = new Task($description, $category_id, $importance, $date_id, $id);
            $test_task2->save();

            //Act
            $result = Task::find($test_task->getId());

            //Assert
            $this->assertEquals($test_task, $result);
        }
      }
?>
