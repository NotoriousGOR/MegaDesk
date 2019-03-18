<!DOCTYPE html>
<html>
    <head>
        <title>Ticket Creation Results</title>
</head>
<body>
    <h1>MegaDesk ticket creation results</h1>
    <?php
        //create variable names
        $assignedTo = $_POST['assignedTo'];
        $customer = $_POST['customer'];
        $campus = $_POST['campus'];
        $room = $_POST['room'];
        $extension = $_POST['extension'];
        $description = $_POST['description'];
        $ticketStatus = $_POST['ticketStatus'];

        $db = new mysqli('localhost', 'darrell.cheney@cvisd.org', 'password', 'megadesk2');
        if (mysqli_connect_errno())
        {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }
        $techID = 0;
        switch ($assignedTo) {
            case "Ivan":
                $techID = 1;
                break;
            case "Max":
                $techID = 2;
                break;
            case "Johnny":
                $techID = 3;
                break;
            case "Kimberly":
                $techID = 4;
                break;
        }

        $campusID = 0;
        switch ($campus) {
            case "CHS":
                $campusID = 1;
                break;
            case "KOL":
                $campusID = 2;
                break;
            case "AJO":
                $campusID = 3;
                break;
            case "AAG":
                $campusID = 4;
                break;
            case "JFC":
                $campusID = 5;
                break;
        }

        $ext = intval($extension);

        $query = "INSERT INTO Tickets VALUES (NULL,'2018-12-10',?,?,?,?,?,?,NULL,NULL,NULL,?,NULL,NULL,NULL,NULL)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('isisiss',$techID,$customer,$campusID,$room,$ext,$description,$ticketStatus);
        $stmt->execute();

        if ($stmt->affected_rows > 0)
        {
            echo "<p>Ticket has been entered</p>";
        } else {
            echo "<p>An error occurred</p>";
        }

        $db->close();
        ?>
</body>
</html>
