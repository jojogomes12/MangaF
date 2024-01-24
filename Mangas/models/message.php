<?php

Class Message{
    private $url;

    function __construct($url){
        $this->url = $url;

    }


function getmessage(){
    if(!empty($_SESSION["msg"])){
            return [

             "msg"=>$_SESSION['msg'],
             "type"=>$_SESSION['type']

            ];
    }else{

            return false;
    }

}

function setmessage($msg,$type,$redirect){
        $_SESSION['msg'] = $msg;
        $_SESSION['type'] = $type;
        if($redirect!="back"){
            header("Location:".$redirect);
        }else{
            header("Location:".$_SERVER["HTTP_REFERER"]);


        }

}

function clearmessage(){
        $_SESSION['msg'] = "";
        $_SESSION['type']="";
}

}

?>