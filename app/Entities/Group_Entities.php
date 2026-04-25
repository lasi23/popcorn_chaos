<?php
    class GroupEntities{

        private $id;
        private $name;
        private $code;
        private $img;
        private $idCreator;

        /**
         * Get the value of id
         */
        public function getId() {
                return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId($id): self {
                $this->id = $id;
                return $this;
        }

        /**
         * Get the value of name
         */
        public function getName() {
                return $this->name;
        }

        /**
         * Set the value of name
         */
        public function setName($name): self {
                $this->name = $name;
                return $this;
        }

        /**
         * Get the value of code
         */
        public function getCode() {
                return $this->code;
        }

        /**
         * Set the value of code
         */
        public function setCode($code): self {
                $this->code = $code;
                return $this;
        }

        /**
         * Get the value of img
         */
        public function getImg() {
                return $this->img;
        }

        /**
         * Set the value of img
         */
        public function setImg($img): self {
                $this->img = $img;
                return $this;
        }

        /**
         * Get the value of idCreator
         */
        public function getIdCreator() {
                return $this->idCreator;
        }

        /**
         * Set the value of idCreator
         */
        public function setIdCreator($idCreator): self {
                $this->idCreator = $idCreator;
                return $this;
        }
    }

?>