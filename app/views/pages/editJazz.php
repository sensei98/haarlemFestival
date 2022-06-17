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
                        <input type="hidden" name="editForm" value="isTrue" />
                        <input name="artistname" type="text" class="form-control" id="MainTitleArea" placeholder="Article Title here" value="<?php echo($_SESSION['selectedEventObj']->artistname);?>">
                        <input name="ticketLocation" type="text" class="form-control" placeholder="Article Location here" value="<?php echo($_SESSION['selectedEventObj']->location);?>">
                        <input name="ticketHall" type="text" class="form-control" placeholder="Article hall here" value="<?php echo($_SESSION['selectedEventObj']->hall);?>">
                        <input name="ticketPrice" type="text" class="form-control" placeholder="Article price here" value="<?php echo($_SESSION['selectedEventObj']->price);?>">
                        <input name="startDateTime" type="datetime-local" min="2020-01-01" max="2021-12-31" value="<?php echo date('Y-m-d\TH:i:s', strtotime($_SESSION['selectedEventObj']->timefrom));?>">
                        <input name="endDateTime" type="datetime-local" min="2020-01-01" max="2021-12-31" value="<?php echo date('Y-m-d\TH:i:s', strtotime($_SESSION['selectedEventObj']->timeto));?>">
                        <textarea name="about" class="form-control" id="MainTextArea" rows="20" placeholder="Article Text here"><?php echo($_SESSION['selectedEventObj']->about);?></textarea>
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