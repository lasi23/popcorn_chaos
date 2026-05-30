<?php
    class GroupController extends BaseModel{

        public function create() {
            if(isset($_POST['create_group'])){
                if(!empty($_POST['nameGroup']) && isset($_SESSION['idUser'])){
                    $newGroup = new GroupModel($this->bdd);
                    $groupEntities = new GroupEntities;
                    Hydrator::hydrate($groupEntities, $_POST);
                    $groupEntities->setIdCreator($_SESSION['idUser']);
                    $result = $newGroup->create($groupEntities);
                    if(!$result) {
                        return 'Ce nom de groupe existe déjà !';
                    }
                    header('Location: profil');
                    exit;
                }else{
                    return 'We are group : trouver le vôtre';
                }
            }
        }
        public function getGroups() {
            if(isset($_SESSION['idUser'])) {
                $userEntities = new UserEntities();
                $userEntities->setIdUser($_SESSION['idUser']);
                
                $getGroup = new GroupModel($this->bdd);
                $groupsData = $getGroup->getGroups($userEntities->getIdUser());
                
                $groups = [];
                foreach($groupsData as $groupData) {
                    $groupEntities = new GroupEntities();
                    Hydrator::hydrate($groupEntities, $groupData);
                    $groups[] = $groupEntities;
                }
                return $groups;
            }
            return [];
        }
        public function getCodeGroup(){
            if(isset($_POST['getCode'])){
                if(!empty($_POST['idGroup'])){
                    $getCode = new GroupModel($this->bdd);
                    $groupEntities = new GroupEntities();
                    $groupEntities->setIdGroup(intval($_POST['idGroup']));
                    return $getCode->getCodeGroup($groupEntities);

                }
                return 'Veuilez choisir un groupe';
            }
            return null;
        }

        public function joinGroup(){
            if(isset($_POST['submitSendCode'])){       
                if(!empty($_POST['code'])){          
                    $joinGroup = new GroupModel($this->bdd);
                    $groupEntities = new GroupEntities();
                    $groupEntities->setCodeGroup(sanitize($_POST['code']));
                    $userEntities = new UserEntities();
                    $userEntities->setIdUser(sanitize($_SESSION['idUser']));
                    return $joinGroup->joinGroup($groupEntities->getCodeGroup(), $userEntities->getIdUser());
                }
            }
            return 'Veuillez mettre un code valide';
        }

        public function takeHat(){
            $film = [];
            if(isset($_POST['submitTakeAHate'])){
                if(!empty($_POST['idGroup']) && intval($_POST['idGroup']) > 0){
                    $takeHat = new GroupModel($this->bdd);
                    $film = $takeHat->takeHat(intval($_POST['idGroup']));
                    return $film;
                }
                return 'Veuillez choisir un groupe';
            }
        }
    }
?>