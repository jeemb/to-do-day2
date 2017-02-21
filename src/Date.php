<?php
    class Date
    {
        private $date;
        private $id;

        function __construct($date, $id = null)
        {
            $this->date = $date;
            $this->id = $id;
        }

        function setDate($new_date)
        {
            $this->date = (string) $new_date;
        }

        function getDate()
        {
            return $this->date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO dates (date) VALUES ('{$this->getDate()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_dates = $GLOBALS['DB']->query("SELECT * FROM dates;");
            $dates = array();
            foreach($returned_dates as $date) {
                $date = $date['date'];
                $id = $date['id'];
                $new_date = new Date($date, $id);
                array_push($dates, $new_date);
            }
            return $dates;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM dates;");
        }

        static function find($search_id)
        {
            $found_date = null;
            $dates = Date::getAll();
            foreach($dates as $date) {
                $date_id = $date->getId();
                if ($date_id == $search_id) {
                  $found_date = $date;
                }
            }
            return $found_date;
        }

        function getTasks()
        {
            $tasks = Array();
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks WHERE date_id = {$this->getId()};");
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
    }
?>
