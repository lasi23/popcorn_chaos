<?php
//Fonction utilitaire de nettoyage
function sanitize($data){
    return strip_tags(trim($data));
}