<?php

class path {

    private static $absolutePath = null;
    const CLASSES = 'class/';
    const CONTROLLERS = 'controllers/';
    const VIEWS = 'views/';
    const MODELS = 'models/';
    const USERIMAGES = 'assets/IMG/userImage/';
    public static function getAbsolutePath() {
        if (is_null(self::$absolutePath)) {
            self::$absolutePath = explode(self::CLASSES, __FILE__)[0];
        }
        return self::$absolutePath;
    }

    public static function getClassesPath() {
        return self::getAbsolutePath() . self::CLASSES;
    }

    public static function getControllersPath() {
        return self::getAbsolutePath() . self::CONTROLLERS;
    }  
     public static function getViewsPath() {
        return self::getAbsolutePath() . self::VIEWS;
    }
    
    public static function getModelsPath() {
        return self::getAbsolutePath() . self::MODELS;
    }
        
    public static function getUserImage() {
        return self::getAbsolutePath() . self::USERIMAGES;
    }
    public static function getRootPath(){
        return self::getAbsolutePath();
    }
}