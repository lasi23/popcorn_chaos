<?php
    require_once __DIR__ . '/../Models/UserModel.php';
class UserController {
    private $bdd;
    
    public function __construct($bdd) {
        $this->bdd = $bdd;
    }
// ------------------------------------------inscription--------------------------------
    public function register() {
        if(isset($_POST['inscription'])){
            if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])){
                if(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)){
                    if($_POST['password'] === $_POST['confirmPassword']){
                        
                        $userModel = new UserModel($this->bdd);
                        if ($userModel->emailExists($_POST['email'])) {
                            return "Cet email est déjà utilisé.";
                        }
                        if($userModel->loginExist($_POST['login'])) {
                            return "Ce login est déjà utilisé";
                        }

                        $userEntities = new UserEntities;
                        Hydrator::hydrate($userEntities, $_POST);
                        $userEntities->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
                        $userModel->register($userEntities);
                        
                    } else {
                        return "Les mots de passe ne correspondent pas.";
                    }
                } else {
                    return "L'adresse email n'est pas valide.";                  
                }
            } else {
                return "Veuillez remplire tous les champs";
            }
        }
    }
// -----------------------------------------Connection-------------------
    public function connection() {
        if(isset($_POST['']))
    }
}
?>