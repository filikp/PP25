<?php

class Operater
{
    public static function autoriziraj($email, $lozinka)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select * from operater where email=:email;
        
        ');
        $izraz->execute([
            'email'=>$email
        ]);
        $operater = $izraz->fetch();
        if($operater == null){
            return null;
        }
        if(!password_verify($lozinka, $operater->lozinka)){
            return null;
        }
        unset($operater->lozinka);
        return $operater;
    }
}