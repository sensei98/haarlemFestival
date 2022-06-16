<?php
class Ticket
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }



    public function getJazzByDay($day)
    {
        $this->db->query('SELECT * from tickets where date_format(date(timefrom),"%Y-%m-%d") like :day');
        $this->db->bind(':day', $day);

        $results = $this->db->resultSet();
        return $results;
    }

    public function saveJazzChanges($event){
        $this->db->query("UPDATE tickets SET artistname = :nm, about = :abt WHERE tickets.ID = :tktid;");
        $this->db->bind(':nm', $event->artistname);
        $this->db->bind(':abt', $event->about);
        $this->db->bind(':tktid', $event->ID);

        /*$_SESSION['COUNT'] = ($_SESSION['COUNT']) ? $_SESSION['COUNT']+1 : 0;
        var_dump($_SESSION['COUNT']);*/
        //var_dump($event);
        
        return $this->db->execute();
    }

    public function addJazzTicket($event){
        $this->db->query("INSERT INTO tickets (artistname, location, hall, price, timefrom, timeto, about) VALUES (:artist, :location, :hall, :price, :timefrom, :timeto, :about)");
        //$this->db->bind(':ID', $event->ID);
        $this->db->bind(':artist', $event->artistname);
        $this->db->bind(':location', $event->location);
        $this->db->bind(':hall', $event->hall);
        $this->db->bind(':price', $event->price);
        $this->db->bind(':timefrom', $event->timefrom);
        $this->db->bind(':timeto', $event->timeto);
        $this->db->bind(':about', $event->about);

        
        return $this->db->execute();
    }

    public function editJazzTicket($event){
        $this->db->query("UPDATE tickets SET artistname = :artist, location = :location, hall = :hall, price = :price, timefrom = :timefrom, timeto = :timeto, about = :about WHERE ID = :ID");
        $this->db->bind(':ID', $event->ID);
        $this->db->bind(':artist', $event->artistname);
        $this->db->bind(':location', $event->location);
        $this->db->bind(':hall', $event->hall);
        $this->db->bind(':price', $event->price);
        $this->db->bind(':timefrom', $event->timefrom);
        $this->db->bind(':timeto', $event->timeto);
        $this->db->bind(':about', $event->about);

        
        return $this->db->execute();
    }

    public function deleteJazzTicket($event){
        $this->db->query("DELETE FROM tickets WHERE ID=:ID;");
        //$this->db->bind(':ID', $event->ID);
        $this->db->bind(':ID', $event->ID);

        
        return $this->db->execute();
    }

    /*public function getAllEvents(){
        $this->db->query('SELECT  e.eventID, e.eventLocation, e.eventDateTime, h.hostName, e.maxCapacity, e.eventPrice
                            FROM Event as e join Host as h ON e.eventHost = h.HostID');

        $results = $this->db->resultSet();

        return $results;
    }*/

    public function getRestaurantByInfo($data)
    {
        $date = '%' . $data['date'] . '%';


        $this->db->query('SELECT * FROM Event WHERE eventLocation = :restaurant AND eventDateTime LIKE :date');
        $this->db->bind(':restaurant', $data['restaurant']);
        $this->db->bind(':date', $date);

        //        $this->db->query('SELECT * FROM Event');
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}
