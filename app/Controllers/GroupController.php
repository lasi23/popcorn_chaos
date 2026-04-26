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
                    $groupEntities->setIdGroup($_POST['idGroup']);
                    return $getCode->getCodeGroup($groupEntities);

                }
                return 'Veuilez choisir un group';
            }
            return null;
        }
    }
?>