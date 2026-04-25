<?php
    class GroupController {

        public function create() {
            if(isset($_POST['createGroup'])){
                if(!empty($_POST['group_name'])&& isset($_SESSION['id'])){
                    $newGroup = new GroupModel;
                    $groupEntities = new GroupEntities;
                    Hydrator::hydrate($groupEntities, $_POST);
                    $groupEntities->setIdCreator($_SESSION['id']);
                    $newGroup->create($groupEntities);
                }
            }
        }
    }
?>