<?php

if (!isset($_SESSION)) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <?php require APPROOT . '/views/includes/head.php' ?>
</head>

<body>

    <section class="tickets-overallwrapper">
        <section class="ticketpage-header">
            <h1>Tickets</h1>
        </section>
        <?php
        foreach ($data as $row) :
            for ($i = 0; $i < count($row); $i++) :
        ?>
                <section class="tickets-body">
                    <section class="tickets-heading">
                        <h2><?php if (!empty($row[$i]->location)) {
                                $row[$i]->location;
                            } ?></h2>

                    </section>

                    <ul class="u-list-item">
                        <li class="list-item">
                            <section class="tickets-container">
                                <section class="tickets">
                                    <span class="date-start">
                                        <?php

                                        // CONVERTING DATETIME TO RESPECTIVE month,day,year
                                        $month = $row[$i]->timefrom;
                                        $day = $row[$i]->timefrom;
                                        $year = $row[$i]->timefrom;

                                        $m = date("M", strtotime($month));
                                        $d = date("d", strtotime($day));
                                        $y = date("Y", strtotime($year));
                                        ?>
                                        <section class="date-month"><?php echo $m; ?></section>
                                        <section class="date-date"><?php echo $d; ?></section>
                                        <section class="date-year"><?php echo $y; ?></section>
                                    </span>

                                    <!-- should point to the shopping cart -->
                                    <form method="POST" action="<?php echo URLROOT; ?>/Pages/addTocart/<?php echo $row[$i]->ID ?>">

                                        <section class="flex-column">
                                            <span name="" class="artist-name"><?php echo $row[$i]->artistname; ?></span>
                                            <?php
                                            // CONVERTING DATETIME TO 24hour times
                                            $timefrom = $row[$i]->timefrom;
                                            $tFrm = date("G", strtotime($timefrom));

                                            $timeto = $row[$i]->timeto;
                                            $tto = date("G", strtotime($timeto))
                                            ?>

                                            <span class="artist-time"><?php echo $tFrm; ?>:00 &ndash; <?php echo $tto; ?>:00</span>
                                            <span class="artist-location"><?php echo $row[$i]->hall; ?></span>
                                            <span class="price">&euro;<?php echo $row[$i]->price; ?></span>
                                            <span class="artist-about"><?php echo $row[$i]->about; ?></span>


                                        </section>

                                        <section class="tickets-buttons">
                                            <input type="hidden" name="hidden_name" value="<?php echo $row[$i]->artistname; ?>" />
                                            <input type="hidden" name="hidden_price" value="<?php echo $row[$i]->price ?>" />
                                            <input type="hidden" name="hidden_ID" value="<?php echo $row[$i]->ID ?>" />
                                            <input type="hidden" name="hidden_location" value="<?php echo $row[$i]->hall ?>" />
                                            <input class="button1" name="add" type="submit" value="Add to cart" onclick="location.href='<?php echo URLROOT; ?>/pages/cartpage?=<?php echo $row[$i]->ID ?>'">
                                            <input class="inputfield" type="text" name="quantity" value=1>
                                        </section>
                                    </form>
                                </section>
                            </section>
                </section>
    </section>
    </li>
    </ul>
    </section>
    <script src="../js/button-animation.js"></script>
<?php endfor;
?>
<?php endforeach;
?>

<footer>
    <?php require APPROOT . '/views/includes/footer.php' ?>
</footer>
</body>


</html>