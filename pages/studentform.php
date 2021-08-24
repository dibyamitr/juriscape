<?php
if(isset($_REQUEST['studentid']) and !empty($_REQUEST['studentid']))
{
    $studentid=$_REQUEST['studentid'];
    $studentid=base64_decode(urldecode($studentid));
    $studentdata=$fnc->getStudentData($studentid);
}
?>
<div class="row">
    <div class="col-12">
        <h3 class="d-inline-block text-left fieldtext"><?php echo (isset($studentid) and !empty($studentid))?'Edit':'Add'; ?> Student</h3>
        <a class="d-inline-block text-right" href="<?php echo $fnc->authurl('student-list'); ?>">
            <div class="menulink">
                <i class="fas fa-list"></i>
            </div>
        </a>
        <div class="form-wrapper">
            <form action="<?php echo $fnc->authurl('security/form-student'); ?>">
                <div class="row">
                    <div class="col-4">
                        <input type="text" class="form-control fieldval" name="name" placeholder="Student Name" value="<?php echo $studentdata->name??''; ?>" />
                    </div>
                    <div class="col-4">
                        <select class="form-control fieldval" name="standard">
                            <option value="">Student Standard</option>
                            <?php
                            for($i=1;$i<=12;$i++)
                            {
                                ?>
                                <option value="<?php echo $i; ?>" <?php if(isset($studentdata->standard) and $studentdata->standard==$i) { ?> selected <?php } ?>><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-control fieldval subject" name="subjectid[]" multiple>
                            <?php
                            if(isset($studentdata->subjectid) and !empty($studentdata->subjectid))
                            {
                                $selected=explode(',',$studentdata->subjectid);
                            }
                            else
                            {
                                $selected=array();
                            }
                            echo $fnc->dynamicDropdownOpt('subjects','id','name',$selected);
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <input type="hidden" readonly name="studentid" value="<?php echo $studentdata->id??''; ?>" />
                        <button type="button" class="btn btn-primary ajaxsubmit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>