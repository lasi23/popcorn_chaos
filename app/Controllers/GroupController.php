<?php
    class GroupController extends BaseModel{

        public function create() {
            if(isset($_POST['create_group'])){
                if(!empty($_POST['nameGroup']) && isset($_SESSION['id'])){
                    $newGroup = new GroupModel($this->bdd);
                    $groupEntities = new GroupEntities;
                    Hydrator::hydrate($groupEntities, $_POST);
                    $groupEntities->setIdCreator($_SESSION['id']);
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
            if(isset($_SESSION['id'])) {
                $userEntities = new UserEntities();
                $userEntities->setIdUser($_SESSION['id']);
                
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
    }
?>