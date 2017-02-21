<?php
class Task
    {
        private $description;
        private $category_id;
        private $category;
        private $importance;
        private $date_id;
        private $date;
        private $id;

        function __construct($description, $category_id, $importance, $date_id, $id = null)
        {
            $this->description = $description;
            $this->category_id = $category_id;
            $this->importance = $importance;
            $this->date_id = $date_id;
            $this->id = $id;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getId()
        {
            return $this->id;
        }

        function getCategory()
        {
            return $this->category;
        }

        function getDate()
        {
            return $this->date;
        }

        function getCategoryId()
        {
            return $this->category_id;
        }

        function getImportance()
        {
            return $this->importance;
        }

        function getDateId()
        {
            return $this->date_id;
        }

        function setCategory($category)
        {
            $this->category = $category;
        }

        function setDate($date)
        {
            $this->date = $date;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO tasks (description, category_id, importance, date_id) VALUES ('{$this->getDescription()}', {$this->getCategoryId()}, {$this->getImportance()}, {$this->getDateId()})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks JOIN categories ON tasks.category_id = categories.id JOIN dates on tasks.date_id = dates.id;");
            $tasks = array();
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $id = $task['id'];
                $category_id = $task['category_id'];
                $importance = intval($task['importance']);
                $date_id = $task['date_id'];
                $date = $task['date'];
                $category = $task['name'];
                $new_task = new Task($description, $category_id, $importance, $date_id, $id);
                $new_task->setDate($date);
                $new_task->setCategory($category);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM tasks;");
        }

        static function find($search_id)
        {
            $found_task = null;
            $tasks = Task::getAll();
            foreach($tasks as $task) {
                $task_id = $task->getId();
                if ($task_id == $search_id) {
                  $found_task = $task;
                }
            }
            return $found_task;
        }
    }
?>
