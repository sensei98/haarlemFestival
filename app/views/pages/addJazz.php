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
                        <input name="artistname" type="text" class="form-control" id="MainTitleArea" placeholder="Article Title here" value="">
                        <input name="ticketLocation" type="text" class="form-control" placeholder="Article Location here" value="">
                        <input name="ticketHall" type="text" class="form-control" placeholder="Article hall here" value="">
                        <input name="ticketPrice" type="text" class="form-control" placeholder="Article price here" value="">
                        <input name="startDateTime" type="datetime-local" min="2020-01-01" max="2021-12-31">
                        <input name="endDateTime" type="datetime-local" min="2020-01-01" max="2021-12-31">
                        <textarea name="about" class="form-control" id="MainTextArea" rows="20" placeholder="Article Text here"></textarea>
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