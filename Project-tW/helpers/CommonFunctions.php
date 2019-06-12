<?php
class CommonFunctions {
    public static function generateCode() {
        $model = new EventsModel(App::getDatabase());
        while(true) {
            $code = strtoupper(substr(md5(mt_rand()), 0, 10));
            if(!$model->codeAlreadyExist($code))
                return $code;
        }
        return strtoupper(substr(md5(mt_rand()), 0, 10));
    }
}