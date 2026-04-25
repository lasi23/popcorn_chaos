<?php
    class GroupeController {

        public function create() {
            if(isset($_POST['createGroup'])){
                if(!empty($_POST['group_name'])){
                    $newGroup = new GroupModel;
                    $groupEntities = new GroupEntities;
                    Hydrator::hydrate($groupEntities, $_POST);
                    $newGroup->create($groupEntities);
                }
            }
        }
    }
?>