<?php
   require APPROOT . '/views/includes/head.php';
?>
<div id="section-landing">
    <!-- <?php
       require APPROOT . '/views/includes/navigation.php';
    ?> -->
<div class="scrolldiv">
<table>
<div class="wrapper-landing">
        <h1>Log view</h1>
        <h2>Only own logs and of users with lower permissions are visible</h2>
    </div>
        <tr>
            <td>Log ID</td>
            <td>Username</td>
            <td>Event type</td>
            <td>Event time</td>
            <td>Log</td>
        </tr>
        <?php
            foreach ($data as $row)
            {
                $class = ($i == 0) ? "" : "alt";
                echo "<tr class=\"".$class."\">";
                echo "<td>".$row->log_id."</td>";
                echo "<td>".$row->username."</td>";
                echo "<td>".$row->name."</td>";
                echo "<td>".$row->time."</td>";
                echo "<td>".$row->event_log."</td>";
                echo "</tr>";
                $i = ($i==0) ? 1:0;
            }
        ?>
    </table>
    </div>
</div>
