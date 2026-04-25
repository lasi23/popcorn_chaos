<?php
    require_once __DIR__ . '/../Models/UserModel.php';
class UserController extends BaseModel {
    
// ------------------------------------------inscription--------------------------------
    public function register() {
        if(isset($_POST['inscription'])){
            if(!empty($_POST['nameUser']) && !empty($_POST['surnameUser']) && !empty($_POST['loginUser']) && !empty($_POST['passwordUser']) && !empty($_POST['confirmPassword'])){
                if(filter_var($_POST['emailUser'], FILTER_VALIDATE_EMAIL)){
                    if($_POST['passwordUser'] === $_POST['confirmPassword']){
                        
                        $userModel = new UserModel($this->bdd);
                        if($userModel->emailExists($_POST['emailUser'])) {
                            return "Cet email est déjà utilisé.";
                        }
                        if($userModel->loginExist($_POST['loginUser'])) {
                            return "Ce login est déjà utilisé";
                        }

                        $userEntities = new UserEntities;
                        Hydrator::hydrate($userEntities, $_POST);
                        $userEntities->setPasswordUser(password_hash($_POST['passwordUser'], PASSWORD_DEFAULT));
                        $userModel->register($userEntities);
                        header('Location: ?page=connection');
                        exit;
                        
                    } else {
                        return "Les mots de passe ne correspondent pas.";
                    }
                } else {
                    return "L'adresse email n'est pas valide.";                  
                }
            } else {
                return "Veuillez remplir tous les champs";
            }
        }
    }
// -----------------------------------------Connection-------------------
    public function connection() {
        if(isset($_POST['connection'])){
            if(!empty($_POST['login']) && !empty($_POST['password'])){
                $login = sanitize($_POST['login']);
                $password = $_POST['password'];
                $userModel = new UserModel($this->bdd);
                $data = $userModel->connect($login);
                if ($data) {
                    if (password_verify($password, $data->getPasswordUser())) {
                        $_SESSION['idUser'] = $data->getIdUser();
                        $_SESSION['loginUser'] = htmlspecialchars($data->getLoginUser());
                        $_SESSION['nameUser'] = htmlspecialchars($data->getNameUser());
                        $_SESSION['surnameUser'] = htmlspecialchars($data->getSurnameUser());
                        $_SESSION['emailUser'] = htmlspecialchars($data->getEmailUser());
                        $_SESSION['userUser'] = "connecté";
                        header('Location: profil');
                        exit;
                    } else {
                        return "Mot de passe incorrect.";
                    }
                } else {
                    return "Login introuvable.";
                }
            }
        }
    }
}
?>