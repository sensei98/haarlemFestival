<?php
require APPROOT . '/views/includes/head.php';
?>
<div class="tenPwrapper">
    <!-- <?php
    require APPROOT . '/views/includes/navigation.php';
    ?> -->
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
            <a type="button" class="btn sideBarButton sideBarButtonSelected" href="<?php echo URLROOT; ?>pages/cms">
                Jazz
            </a>
            <a type="button" class="btn sideBarButton" href="<?php echo URLROOT; ?>pages/userManagement">
                User Management
            </a>
            <a type="button" class="btn sideBarButton" href="<?php echo URLROOT; ?>pages/ticketManagement">
                Ticket Data
            </a>
        </div>
        <div class="col-md-11">
            <div>
                <?php /*var_dump($data);*//*var_dump(array_column($data['events'], null, 'artistname')[$data['selectedEvent']])*/?>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="dateForm" method="POST">
                                <input name="datePick" type="date" id="datePick"
                                    value="<?php echo $data['shownDate'] ?>" min="2020-01-01" max="2021-12-31">
                            </form>
                        </div>
                        <!--<div class="col-md-6">
                            <div style="color: #fff;">Off <i id="toggleSwitch" class="fas fa-toggle-on fa-lg"></i> ON
                            </div>
                        </div>-->
                    </div>
                    <form id="dropDownForm" method="POST">
                        <div class="dropdown">
                            <select name="events" id="events">
                                <?php foreach ($data["events"] as $event) : ?>
                                <option value="<?= $event->artistname?>"
                                    <?php echo ($event->artistname ==  $data['selectedEvent']) ? 'selected="selected"' : '';?>>
                                    <?= $event->artistname?></option>
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
                        <button class="btn btn-secondary" type="button" onclick="location.href = '<?php echo URLROOT; ?>pages/addJazz/'">
                            <i class="fas fa-plus"></i> Add New Article
                        </button>
                        <button class="btn btn-danger" type="button" onclick="location.href = '<?php echo URLROOT; ?>pages/deleteJazz/'">
                            <i class="fas fa-trash-alt"></i> Delete Current Article
                        </button>
                    </div>
                    </br>
                    <div class="btn-group" role="group">
                        <!--<button class="btn btn-secondary" type="button">
                            <i class="fas fa-plus-square"></i> Add Image
                        </button>-->
                        <button <?php echo($data['selectedEventObj'] ? '' : 'hidden'); ?> class="btn btn-warning" type="button" onclick="$('#saveForm').submit()">
                            <i class="fas fa-save"></i> Save Current Changes
                        </button>
                        <button <?php echo($data['selectedEventObj'] ? '' : 'hidden'); ?> class="btn btn-warning" type="button" onclick="console.log('open edit details page')">
                            <i class="fas fa-save"></i> Edit Details
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
                    <form id="saveForm" method="POST">
                        <input type="hidden" name="saveForm" value="isTrue"/>
                        <input name="ticketHead" type="text" class="form-control" id="MainTitleArea"
                            placeholder="Article Title here"
                            value="<?php echo($data['selectedEvent'] ?? ($data['events'][0]->artistname ?? ''))?>">
                        <textarea name="ticketBody" class="form-control" id="MainTextArea" rows="20"
                            placeholder="Article Text here"><?php echo((count($data['events']) > 0) ? (array_column($data['events'], null, 'artistname')[$data['selectedEvent'] ?? $data['events'][0]->artistname]->about ?? '') : '')?></textarea>
                    </form>
                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    $('#datePick').change(function () {
        console.log('Submitting form');
        $('#dateForm').submit();
    });

    $('#events').change(function () {
        console.log('Submitting form');
        $('#dropDownForm').submit();
    });
</script>

</html>