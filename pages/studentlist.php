<div class="row">
    <div class="col-12">
        <h3 class="d-inline-block text-left fieldtext">Student List</h3>
        <a class="d-inline-block text-right" href="<?php echo $fnc->authurl('add-student'); ?>">
            <div class="menulink">
                <i class="fas fa-plus"></i>
            </div>
        </a>
        <div class="table-responsive table-wrapper">
            <?php
            echo $fnc->studentList();
            ?>
        </div>
    </div>
</div>