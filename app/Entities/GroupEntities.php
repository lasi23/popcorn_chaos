<?php
    class GroupEntities{

        private $idGroup;
        private $nameGroup;
        private $codeGroup;
        private $imgGroup;
        private $idCreator;

       
        

        /**
         * Get the value of idGroup
         */
        public function getIdGroup() {
                return $this->idGroup;
        }

        /**
         * Set the value of idGroup
         */
        public function setIdGroup($idGroup): self {
                $this->idGroup = $idGroup;
                return $this;
        }

        /**
         * Get the value of nameGroup
         */
        public function getNameGroup() {
                return $this->nameGroup;
        }

        /**
         * Set the value of nameGroup
         */
        public function setNameGroup($nameGroup): self {
                $this->nameGroup = $nameGroup;
                return $this;
        }

        /**
         * Get the value of codeGroup
         */
        public function getCodeGroup() {
                return $this->codeGroup;
        }

        /**
         * Set the value of codeGroup
         */
        public function setCodeGroup($codeGroup): self {
                $this->codeGroup = $codeGroup;
                return $this;
        }

        /**
         * Get the value of imgGroup
         */
        public function getImgGroup() {
                return $this->imgGroup;
        }

        /**
         * Set the value of imgGroup
         */
        public function setImgGroup($imgGroup): self {
                $this->imgGroup = $imgGroup;
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