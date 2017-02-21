<?php
class Task
    {
        private $description;
        private $category_id;
        private $id;
        private $importance;
        private $date_id;

        function __construct($description, $id = null, $category_id, $importance, $date_id)
        {
            $this->description = $description;
            $this->id = $id;
            $this->category_id = $category_id;
            $this->importance = $importance;
            $this->date_id = $date_id;
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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO tasks (description, category_id, importance, date_id) VALUES ('{$this->getDescription()}', {$this->getCategoryId()}), {$this->getImportance()}), {$this->getDateId()})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
            $tasks = array();
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $id = $task['id'];
                $category_id = $task['category_id'];
                $importance = $task['importance'];
                $date_id = $task['date_id'];
                $new_task = new Task($description, $id, $category_id, $importance, $date_id);
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
