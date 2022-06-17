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
            <a type="button" class="btn sideBarButton" href="<?php echo URLROOT; ?>pages/cms">
                Jazz
            </a>
            <a type="button" class="btn sideBarButton sideBarButtonSelected"
                href="<?php echo URLROOT; ?>pages/userManagement">
                User Management
            </a>
            <!--<a type="button" class="btn sideBarButton" href="<?php echo URLROOT; ?>pages/ticketManagement">
                Ticket Data
            </a>-->
        </div>
        <div class="col-md-8">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
                <?php foreach($data['users'] as $row): ?>
                    <tr>
                        <td><?= $row->ID;?></td>
                        <td><?= $row->username;?></td>
                        <td><?= $row->email;?></td>
                        <td><input type="button" value="EDIT" onclick="location.href='<?php echo URLROOT; ?>pages/editUser?ID=<?php echo $row->ID ?>'"/></td>
                        <!--<td><input <?php echo($_SESSION['loggedInUser']->typeID > 2 ? '' : 'hidden'); ?> type="submit" value="DELETE" /></td>-->
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
        <div class="col-md-3">
            <button <?php echo($_SESSION['loggedInUser']->typeID > 2 ? '' : 'hidden'); ?> class="btn btn-warning" type="button" onclick="location.href='<?php echo URLROOT; ?>pages/addUser'">
                <i class="fas fa-save"></i> Add New User
            </button>
        </div>
    </div>
</div>
</body>

</html>