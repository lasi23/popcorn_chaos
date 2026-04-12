<?php
class UserController {
    private $bdd;
    
    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function register() {
        if(isset($_POST['connection'])){
            if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])){
                if(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)){
                    if($_POST['password'] === $_POST['confirmPassword']){
                        $userEntities = new UserEntities;
                        Hydrator::hydrate($userEntities, $_POST);
                        $userEntities->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
                        $userModel = new UserModel($this->bdd);
                        $success = $userModel->register($userEntities);
                    } else {
                        echo "Les mots de passe ne correspondent pas.";
                    }
                } else {
                    echo "L'adresse email n'est pas valide.";
                    
                }
            }
        }
    }
}
?>