<?php
    require_once __DIR__ . '/../Models/UserModel.php';
class UserController extends BaseModel {
    
// ------------------------------------------inscription--------------------------------
    public function register() {
        if(isset($_POST['inscription'])){
            if(!empty($_POST['nameUser']) && 
                !empty($_POST['surnameUser']) && 
                !empty($_POST['loginUser']) && 
                !empty($_POST['emailUser']) && 
                !empty($_POST['passwordUser']) && 
                !empty($_POST['confirmPasswordUser'])){
                if(filter_var($_POST['emailUser'], FILTER_VALIDATE_EMAIL)){
                    if($_POST['passwordUser'] === $_POST['confirmPasswordUser']){
                        
                        $userModel = new UserModel($this->bdd);
                        if($userModel->emailExists($_POST['emailUser'])) {
                            return "Identifiant déjà enregistré. Un autre vous existe déjà dans le système.
Cet email est déjà actif. Le clonage est illégal dans 47 systèmes solaires. ";
                        }
                        if($userModel->loginExist($_POST['loginUser'])) {
                            return " Ce login est déjà pris. Quelqu'un porte votre nom. Trouvez-le. »
« Login déjà utilisé. Il vous a volé votre identité avant vous. ";
                        }

                        $userEntities = new UserEntities;
                        Hydrator::hydrate($userEntities, $_POST);
                        $userEntities->setPasswordUser(password_hash($_POST['passwordUser'], PASSWORD_DEFAULT));
                        $userModel->register($userEntities);
                        header('Location: ?page=connection');
                        exit;
                        
                    } else {
                        return "Votre mot de passe de confirmation ne correspond pas. Il a changé tout seul.
Les deux mots de passe ne correspondent pas. Recommencez. Vite.";
                    }
                } else {
                    return "Adresse email non reconnue dans ce secteur de la galaxie. »
« Protocole d'identification échoué. Cette adresse email n'existe dans aucune dimension.";                  
                }
            } else {
                return "Vous avez laissé des champs vides. Les champs, ça se remplit. »
« Remplissez tout. Oui, même ce champ-là. Surtout celui-là. ";
            }
        }
        return null;
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
                        return "C'est pas password123 ? Ah… essayez password1234";
                    }
                } else {
                    return "Personne de ce nom n'est entré ici. Personne n'en est ressorti.";
                }
            }
        }
    }
}
?>