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
            <a type="button" class="btn sideBarButton" href="<?php echo URLROOT; ?>pages/ticketManagement">
                Ticket Data
            </a>
        </div>
        <div class="col-md-11">
            <table>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
                <?php foreach($data['users'] as $row): ?>
                <form action="<?php echo URLROOT; ?>pages/editUser">
                    <tr>
                        <td><?= $row->username;?></td>
                        <td><?= $row->email;?></td>
                        <td><input type="submit" value="EDIT" /></td>
                        <!--<td><input <?php echo($_SESSION['loggedInUser']->typeID > 2 ? '' : 'hidden'); ?> type="submit" value="DELETE" /></td>-->
                    </tr>
                </form>

                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</body>

</html>