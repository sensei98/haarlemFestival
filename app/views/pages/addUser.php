<?php
require APPROOT . '/views/includes/head.php';
?>
<div class="tenPwrapper">
    <!-- <?php
    require APPROOT . '/views/includes/navigation.php';
    ?> -->
</div>

<div class="container-fluid">
    <form method="POST">
        <div class="row">
            <div class="col-md-1">
                <a type="button" class="btn sideBarButton sideBarButtonSelected" href="<?php echo URLROOT; ?>pages/cms">
                    Jazz
                </a>
                <a type="button" class="btn sideBarButton" href="<?php echo URLROOT; ?>pages/userManagement">
                    User Management
                </a>
                <!--<a type="button" class="btn sideBarButton" href="<?php echo URLROOT; ?>pages/ticketManagement">
                    Ticket Data
                </a>-->
            </div>
            <div class="col-md-11">
                
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group" role="group">
                            
                        </div>
                        </br>
                        <div class="btn-group" role="group">
                            <input type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i>
                            </input>
                        </div>
                        </br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <input type="hidden" name="addForm" value="isTrue" />
                        <input name="name" type="text" class="form-control" placeholder="Name" value="">
                        <input name="username" type="text" class="form-control" placeholder="Username" value="">
                        <input name="email" type="text" class="form-control" placeholder="email" value="">
                        <input name="newpassword" type="text" class="form-control" placeholder="Password" value="">
                        <input name="typeID" type="text" class="form-control" placeholder="Type" value="">
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>

</html>