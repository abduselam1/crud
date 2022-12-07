<?php


    class Todo{

        public $id;
        public $text;
        public $title;
        public $checked;
        public $created_date;
        public $created_time;
        
        public function __construct($title){
            $this->title = $title;
            echo $title;

        }

        public function save(){
            echo "save";
            echo $this.id;
            echo $this.text;
            echo $this.title;
            echo $this.checked;
            echo $this.id;

        }

        // function update(){

        // }

        // function delete(){

        // }

        // function checked(){

        // }



    }

    $todo = new Todo("title");
?>