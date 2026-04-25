<?php
    abstract class BaseModel {
        protected $bdd;

        public function __construct($bdd) {
            $this->bdd = $bdd;
    }
}
?>