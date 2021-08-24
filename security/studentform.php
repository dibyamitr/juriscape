<?php
$post=$_POST;
$studentid=$post['studentid'];
unset($post['studentid']);
$subjectid=$post['subjectid'];
unset($post['subjectid']);
if(isset($studentid) and !empty($studentid))
{
    /**
     * Code checking for already exist student
     */
    $chk=$fnc->checkAlready('name','students',$post['name'],'id',$studentid,'update');
    if(isset($chk) and !empty($chk))
    {
        $fnc->sendAjaxResponse('error','This student already exists');
    }
    else
    {
        /**
         * Code for update
         */
        $condition=array('id'=>$studentid);
        $fnc->userQuery($post,'students',$condition,'u');
    }
}
else
{
    /**
     * Code checking for already exist student
     */
    $chk=$fnc->checkAlready('name','students',$post['name'],'id',NULL,'insert');
    if(isset($chk) and !empty($chk))
    {
        $fnc->sendAjaxResponse('error','This student already exists');
    }
    else
    {
        /**
         * Code for insert
         */
        $studentid=$fnc->userQuery($post,'students',NULL,'i');
    }
}
if(isset($subjectid) and !empty($subjectid))
{
    foreach($subjectid as $subjectidval)
    {
        $condition=array('studentid'=>$studentid,'subjectid'=>$subjectidval);
        $fnc->userQuery(NULL,'students_subjects',$condition,'d');

        $insarr=array('studentid'=>$studentid,'subjectid'=>$subjectidval);
        $fnc->userQuery($insarr,'students_subjects',NULL,'i');
    }
}
$redirect=$fnc->authurl('student-list');
$fnc->sendAjaxResponse('success','Data properly modified',$redirect);