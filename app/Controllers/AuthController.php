<?php

class AuthController
{
    public function logout()
    {
        session_start();

        $_SESSION = [];
        session_destroy();

        header('Location: ?page=connection');
        exit;
    }
}