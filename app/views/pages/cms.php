<?php
require APPROOT . '/views/includes/head.php';
?>
<div class="tenPwrapper">
    <!-- <?php
    require APPROOT . '/views/includes/navigation.php';
    ?> -->
</div>
<script>
    $(document).ready(function () {
        $('#toggleSwitch').click(function () {
            $(this).toggleClass('fa-toggle-on');
            $(this).toggleClass('fa-toggle-off');
        });
    });
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
            <button type="button" class="btn sideBarButton sideBarButtonSelected" href="cms">
                Jazz
            </button>
            <a type="button" class="btn sideBarButton" href="userManagement">
                User Management
            </a>
            <button type="button" class="btn sideBarButton" href="ticketManagement">
                Ticket Data
            </button>
            <button type="button" class="btn sideBarButton" href="logOut">
                Log Out
            </button>
        </div>
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post">
                                <input type="date" id="datePick" value="<?php echo $data['shownDate'] ?>" min="2020-01-01"
                                    max="2021-12-31">
                            </form>
                        </div>
                        <!--<div class="col-md-6">
                            <div style="color: #fff;">Off <i id="toggleSwitch" class="fas fa-toggle-on fa-lg"></i> ON
                            </div>
                        </div>-->
                    </div>
                    <form action="POST">
                        <div class="dropdown">
                            <select name="events" id="events">
                                <?php foreach ($data["events"] as $event) : ?>
                                <option value="<?= $event->artistname ?>"><?= $event->artistname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <div class="btn-group" role="group">
                        <button class="btn btn-secondary" type="button">
                            <i class="fas fa-plus"></i> Add New Article
                        </button>
                        <button class="btn btn-danger" type="button">
                            <i class="fas fa-trash-alt"></i> Delete Current Article
                        </button>
                    </div>
                    </br>
                    <div class="btn-group" role="group">
                        <!--<button class="btn btn-secondary" type="button">
                            <i class="fas fa-plus-square"></i> Add Image
                        </button>-->
                        <button class="btn btn-warning" type="button">
                            <i class="fas fa-save"></i> Save Current Changes
                        </button>
                    </div>
                    </br>
                    <!--
                    <button type="button" class="btn btn-success btn-sm">
                        <i class="fas fa-edit"></i> Edit Current Article
                    </button>
                            -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <input type="text" class="form-control" id="MainTitleArea" placeholder="Article Title here"
                        value="<?php echo($data['events'][0]->artistname)?>">
                    <textarea class="form-control" id="MainTextArea" rows="20"
                        placeholder="Article Text here"><?php echo($data['events'][0]->about)?></textarea>
                </div>
                <div class="col-md-3">
                    <div>

                        <?php /*var_dump($data)*/?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>