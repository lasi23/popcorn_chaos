<?php
    class GroupController extends BaseModel{

        public function create() {
            if(isset($_POST['create_group'])){
                if(!empty($_POST['name'])&& isset($_SESSION['id'])){
                    $newGroup = new GroupModel($this->bdd);
                    $groupEntities = new GroupEntities;
                    Hydrator::hydrate($groupEntities, $_POST);
                    $groupEntities->setIdCreator($_SESSION['id']);
                    $newGroup->create($groupEntities);
                    header('Location: ?page=profil');
                    exit;
                }else{
                    return 'We are group : trouver le vôtre';
                }
            }
        }
    }
?>