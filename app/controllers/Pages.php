<?php

require_once __DIR__ . '/../../mollie-api-php/vendor/autoload.php';
require __DIR__ . '/../../phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../phpmailer/src/SMTP.php';
require __DIR__ . '/../../phpmailer/src/Exception.php';
require_once __DIR__ . '/../libraries/fpdf/fpdf.php';
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/chillerlan/php-qrcode/src/QRCode.php';

use chillerlan\QRCode\QRCode;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Pages extends Controller
{
    public function __construct()
    {
        //$this->userModel = $this->model('User');
        $this->restaurantModel = $this->model('Restaurant');
        $this->ticketsModel = $this->model('RestaurantTickets');
        $this->ticketModel = $this->model('Ticket');
        $this->userModel = $this->model('User');
        $this->JazzModel = $this->model('JazzModel');
        $this->AllAccessPass = $this->model('AllAccessPass');
    }

    public function index()
    {
        $accessPassTickets = $this->AllAccessPass->getAccessPasses();
        $data = array($accessPassTickets);
        $this->view('pages/homepage', $data);


        /*$data = [
            'title' => 'Home page'
        ];

        $this->view('index', $data);*/
    }

    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];

        $this->view('pages/about', $data);
    }


    public function cms()
    {
        $data = [
            'title' => 'CMS',
            'events' => ($this->ticketModel->getJazzByDay("2021-07-29"/*$_POST['date']*/))
        ];

        $this->view('pages/cms', $data);
    }


    public function orders()
    {
        $target_dir = "/upload";

        $uploadOk = 1;


        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            print_r($imageFileType);
            if ($target_file == "upload/") {
                $msg = "cannot be empty";
                $uploadOk = 0;
            } // Check if file already exists
            else if (file_exists($target_file)) {
                $msg = "Sorry, file already exists.";
                $uploadOk = 0;
            } // Check file size
            else if ($_FILES["fileToUpload"]["size"] > 5000000) {
                $msg = "Sorry, your file is too large.";
                $uploadOk = 0;
            } // Check if $uploadOk is set to 0 by an error
            else if ($uploadOk == 0) {
                $msg = "Sorry, your file was not uploaded.";

                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $msg = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                }
            }
        }
        $this->view('orders');
    }
    // public function pdf_qrCode()
    // {
    //     if (isset($_POST['Generate'])) {

    //         $name = $_POST['email'];
    //         $address = $_POST['Address'];
    //         $city = $_POST['city'];
    //         $zip = $_POST['zip'];

    //         $pdf = new FPDF();
    //         $pdf->AddPage();
    //         $pdf->SetFont('Arial', 'B', 14);

    //         $pdf->Cell(50, 10, "Firstname: ", 1, 0);
    //         $pdf->Cell(140, 10, $name, 1, 1);

    //         $pdf->Cell(50, 10, "Address: ", 1, 0);
    //         $pdf->Cell(140, 10, $address, 1, 1);

    //         $pdf->Cell(50, 10, "City: ", 1, 0);
    //         $pdf->Cell(140, 10, $city, 1, 1);

    //         $pdf->Cell(50, 10, "Zip Code: ", 1, 0);
    //         $pdf->Cell(140, 10, $zip, 1, 1);

    //         $pdf->Output();
    //     }
    //     $this->view('pdf_qrCode');
    // }

    //function for jazzhomepage exclusively
    public function jazzhomepage()
    {
        $topArtists = $this->JazzModel->getTopArtists();
        $data = array($topArtists);
        $this->view('pages/jazzhomepage', $data);
    }

    //function with redirect to jazz tickets page
    public function jazztickets()
    {
        $jazzTickets = $this->JazzModel->getAllJazzTickets();
        $data = array($jazzTickets);
        $this->view('pages/jazztickets', $data);
    }

    /**
     * function getting jazz artists
     * @param id - getting artists by id
     * @return data - returns array of jazz tickets
     */
    public function getJazzArtistsByID($id)
    {
        $ticket = $this->JazzModel->getJazzArtistsByID($id);
        $data = array($ticket);
        return $data;
    }

    //function for generating orderNo
    public function orderNumberGen()
    {
        //format   //HF + year + month + date + random No
        $randomNo = rand(0, 200); //randomNo between 0 and 200
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $stringFormat = "HF" . $year . $month . $day . ($randomNo);
        return $stringFormat;
    }
    #initializing shopping cart
    public function initShoppingCart($id)
    {
        try {
            if (isset($_SESSION['shopping_cart'])) {
                //using the ticketID to get ticket info in cart
                $item_array_ID = array_column($_SESSION['shopping_cart'], "ticketID");
                if (!in_array($id, $item_array_ID)) {
                    $count = count($_SESSION['shopping_cart']);
                    $data = $this->getAllTicketsToCart($id);
                    $_SESSION['shopping_cart'][$count] = $data;

                    $lastIndex = array_key_last($data); //getting the last index
                    if ($count >= 6) {
                        echo '<script>alert("No more items can be added")</script>';
                        unset($_SESSION['shopping_cart'][$lastIndex]); //removing lastitem
                    }
                } else {
                    echo '<script>alert("Item has already been added")</script>';
                }
            } else {
                $data = $this->getAllTicketsToCart($id);
                $_SESSION['shopping_cart'][0] = $data;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    #getting jazz tickets by id to be added to cart

    public function getAllTicketsToCart($id)
    {
        $price = $this->ValidateData($_POST['hidden_price']);
        $name = $this->ValidateData($_POST['hidden_name']);
        $location = $this->ValidateData($_POST['hidden_location']);
        $data = array("ticketID" => $id, "item_name" => $name, "item_price" => $price, "item_quantity" => $_POST['quantity'], "item_location" => $location);
        return $data;
    }

    #function for add to cart
    public function addTocart()
    {
        try {
            if (isset($_POST['add'])) {
                $data = $this->initShoppingCart($this->ValidateData($_POST['hidden_ID']));
            }
            $this->view('pages/cartpage', $data);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    #function for removing cart
    public function RemoveFromCart()
    {
        try {
            if (isset($_POST['delete'])) {
                foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                    if ($values["ticketID"] == $_POST['delete']) {
                        unset($_SESSION['shopping_cart'][$keys]); //array with index   
                        echo '<script>alert("Item has been deleted")</script>';
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->view('pages/cartpage');
    }
    //redirect to contact page
    public function contactPage()
    {
        $this->view("pages/contactPage");
    }
    //redirect to confirmation page
    public function confirmation()
    {
        $this->view("pages/confirmation");
    }
    /**
     * function for data validation
     * @param data - post request objects
     * @return data - can be passed in every function for validation
     */
    public function ValidateData($data)
    {
        $data = trim($data); //removing whitespace and other predefined characters
        $data = stripslashes($data); //removes backlashes 
        $data = htmlspecialchars($data); //encoding user input to prevent the insert of html codes to the site 
        return $data;
    }

    //mollie payment function
    public function payment()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $mollie = new \Mollie\Api\MollieApiClient();
                $mollie->setApiKey(MOLLIE_API); //api key in config.php
                $amount = sprintf("%.2f", $_SESSION['totalprice']);
                $description = $_POST['firstname'] . ' payment';
                $payment = $mollie->payments->create([
                    "amount" => [
                        "currency" => "EUR",
                        "value" => "$amount"
                    ],
                    "description" => "$description",
                    "redirectUrl" => "http://localhost:8080/php/SchoolStuff/HaarlemFestival-Group2-Merging/pages/emailCustomer",
                    "webhookUrl" => "",
                    // "metadata" => $id
                ]);
                //getting payment token
                $_SESSION['payment_id'] = $payment->id;
                //getting payment date created
                $_SESSION['date_created'] = $payment->createdAt;
                //getting payment expiry daae
                $_SESSION['due_date'] = $payment->expiresAt;

                $payments = $mollie->payments->get($_SESSION['payment_id']);
                $this->generateInvoice();
                if ($payments->isPaid()) {
                    //generateInvoice
                    $this->generateInvoice();
                } else {
                    echo "payment error";
                }
                redirectPayment($payment->getCheckoutUrl(), true, 303);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    //function for PDF creation
    public function generateInvoice()
    {
        try {
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 10);

            //path to Logo
            $pathToLogo = URLROOT . "/public/img/icons/logo.png";
            $pdf->Image($pathToLogo, 150, 10, 20, 0, 'PNG'); //placing image into pdf


            //orderId
            $orderId = $this->orderNumberGen();
            //toralprice
            $totalprice = $_SESSION['totalprice'];
            //formatted date
            $getFormattedDate = $this->convertDateGmtToString();
            //invoice date
            $invoiceDate = $getFormattedDate[1];
            //payment due date
            $paymentDueDate = $getFormattedDate[0];
            //email address
            $_SESSION["email_address"] = $this->ValidateData($_POST["email"]);
            $firstname = $this->ValidateData($_POST["first_name"]);
            $lastname = $this->ValidateData($_POST["last_name"]);
            $email =  $_SESSION["email_address"];
            $day = $this->ValidateData($_POST["day"]);
            $month = $this->ValidateData($_POST["month"]);
            $year = $this->ValidateData($_POST["year"]);
            $address = $this->ValidateData($_POST["address"]);
            $postcode = $this->ValidateData($_POST["postcode"]);
            $phonenumber = $this->ValidateData($_POST["phonenumber"]);
            $priceWithVAT = $this->calculateVat();


            //order number
            $pdf->Cell(100, 10, "Order number: " . $orderId, 1, 0, 'C');
            $pdf->Ln();
            //customer name
            $pdf->Cell(100, 10, "First name: " . $firstname . " " . $lastname, 1, 0, 'C');
            $pdf->Ln();
            //customer email
            $pdf->Cell(100, 10, "Email: " . $email, 1, 0, 'C');
            $pdf->Ln();

            //dob
            $pdf->Cell(100, 10, "Date of birth: " . $day . "/" . $month . "/" . $year, 1, 0, 'C');
            $pdf->Ln();
            //address of client
            $pdf->Cell(100, 10, "Address: " . $address . ", " . $postcode, 1, 0, 'C'); //address
            $pdf->Ln();
            //phone number
            $pdf->Cell(100, 10, "Phone number: " . $phonenumber, 1, 0, 'C');
            $pdf->Ln();

            //invoice date
            $pdf->Cell(100, 10, "Invoice Date: "  . $invoiceDate, 1, 0, 'C');
            $pdf->Ln();
            //payment due date
            $pdf->Cell(100, 10, "Payment Due Date: "  . $paymentDueDate, 1, 0, 'C');
            $pdf->Ln();

            foreach ($_SESSION["shopping_cart"] as $item) {
                //cart item name
                $pdf->Cell(100, 10, "ARTIST: " . $item["item_name"], 1, 0, 'C');
                $pdf->Ln();
                //cart item price
                $pdf->Cell(100, 10, "PRICE PER PERSON: " . EURO .  $item["item_price"], 1, 0, 'C');
                $pdf->Ln();
            }

            //total amount
            $pdf->Cell(100, 10, "Total: " . EURO . $totalprice, 1, 0, 'C');
            $pdf->Ln();
            //value added tax
            $pdf->Cell(100, 10, "Total price with VAT(21%): " . EURO . $priceWithVAT, 1, 0, 'C');
            $pdf->Ln();

            $this->generateTicket();
            $filename = "haarlem_festival_invoice.pdf";
            $pdf->Output('F', '../' . $filename, true);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function generateTicket()
    {
        try {
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 10);

            //path to Logo
            $pathToLogo = URLROOT . "/public/img/icons/logo.png";
            $pdf->Image($pathToLogo, 150, 10, 20, 0, 'PNG'); //placing image into pdf

            //qr code
            $qr = new QRCode();
            $filename = APPROOT . '/../public/img/qrCode/qr.png';
            $url = sprintf('http://localhost:8080/php/SchoolStuff/HaarlemFestival-Group2-Merging/pages'); //link to website
            $qr->render($url, $filename);
            $pdf->Image($filename, 150, 40);

            //ticketId
            $ticketID = $this->orderNumberGen();
            //ticket number
            $pdf->Cell(100, 10, "Ticket number: " . $ticketID, 1, 0, 'C');
            $pdf->Ln();

            foreach ($_SESSION["shopping_cart"] as $item) {
                //cart item name
                $pdf->Cell(100, 10, "ARTIST: " . $item["item_name"], 1, 0, 'C');
                $pdf->Ln();
                //cart item location
                $pdf->Cell(100, 10, "EVENT LOCATION: " . $item["item_location"], 1, 0, 'C');
                $pdf->Ln();
            }

            $filename = "ticket.pdf";
            $pdf->Output('F', '../' . $filename, true);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //function for emailing
    public function emailCustomer()
    {
        try {
            $mail = new PHPMailer(true);
            //$mail->SMTPDebug = 3; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com';  //Set the SMTP server to send through
            //$mail->Host = 'mail.641496.infhaarlem.nl';  //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'haarlemfestivalgroup2@gmail.com'; //SMTP username
            //$mail->Username = 's641496'; //SMTP username
            //$mail->Password = 'haarlemfestival'; //password
            $mail->Password = 'fvofcvpmwexqubaz'; //password
            //$mail->Password = 'j6mouYyw'; //password
            $mail->SMTPSecure = "tls";
            $mail->Port = 587; //googlemail port

            $email =  $_SESSION["email_address"];
            $mail->setFrom('haarlemfestivalgroup2@gmail.com', "Haarlem Festival");
            //$mail->setFrom('mail.641496.infhaarlem.nl', "Haarlem Festival");
            $mail->addAddress($email); //recipient email

            $filename = 'haarlem_festival_invoice.pdf';
            $ticket = 'ticket.pdf';
            $mail->addAttachment('../' . $filename);
            $mail->addAttachment('../' . $ticket);

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Haarlem Festival!';
            $mail->Body = '<b>Welcome to the haarlem Festival!</b>  ';
            $mail->Body .= 'Your ticket and invoice is in the attachment below! <b>Enjoy!</b>';


            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $this->view("pages/confirmation");
    }

    //function for VAT calculation
    public function calculateVat()
    {
        $vat = 0.21; //VAT 21%
        $totalVAT = $vat * $_SESSION["totalprice"];
        $priceWithVAT = $_SESSION["totalprice"] + $totalVAT;
        return $priceWithVAT;
    }

    /**
     * function for date conversion
     * @return dates - payment date created and payment due date
     */

    public function convertDateGmtToString()
    {
        $due_date = $_SESSION['due_date'];
        $date_Created = $_SESSION['date_created'];
        $dueDate = date("d-m-Y", strtotime($due_date)); //format dd-mm-yyyy
        $dateCreated = date("d-m-Y", strtotime($date_Created));
        return array($dueDate, $dateCreated);
    }
}
