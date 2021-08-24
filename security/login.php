<?php
$post=$_POST;
if($post['email']=='demo@juriscape.com' and $post['password']=='Jur!$(@9e')
{
    session_regenerate_id();
    $post['session']=session_id();
    $fnc->setSession('session',session_id());
    $fnc->setSession('userdetails',json_encode($post));
    $url=$fnc->authurl('student-list');
    $fnc->sendAjaxResponse('success','Successfully Logged in',$url);
}
else
{
    $fnc->sendAjaxResponse('error','Wrong Credentials');
}