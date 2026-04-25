<?php

    class FilmEntities {
        private $idFilm;
        private $nameFilm;
        private $resumFilm;
        private $drownHat;
        private $idGroup;
        


        /**
         * Get the value of idFilm
         */
        public function getIdFilm() {
                return $this->idFilm;
        }

        /**
         * Set the value of idFilm
         */
        public function setIdFilm($idFilm): self {
                $this->idFilm = $idFilm;
                return $this;
        }

        /**
         * Get the value of nameFilm
         */
        public function getNameFilm() {
                return $this->nameFilm;
        }

        /**
         * Set the value of nameFilm
         */
        public function setNameFilm($nameFilm): self {
                $this->nameFilm = $nameFilm;
                return $this;
        }

        /**
         * Get the value of resumFilm
         */
        public function getResumFilm() {
                return $this->resumFilm;
        }

        /**
         * Set the value of resumFilm
         */
        public function setResumFilm($resumFilm): self {
                $this->resumFilm = $resumFilm;
                return $this;
        }

        /**
         * Get the value of drownHat
         */
        public function getDrownHat() {
                return $this->drownHat;
        }

        /**
         * Set the value of drownHat
         */
        public function setDrownHat($drownHat): self {
                $this->drownHat = $drownHat;
                return $this;
        }

        /**
         * Get the value of idGroupe
         */
        public function getIdGroup() {
                return $this->idGroup;
        }

        /**
         * Set the value of idGroupe
         */
        public function setIdGroup($idGroup): self {
                $this->idGroup = $idGroup;
                return $this;
        }
    }
    

?>