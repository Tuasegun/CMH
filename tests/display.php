<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>

<body>
<br />
<div class="container" style="width:500px;">
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Patients</th>
        </tr>
        <?php
        $allPatients = scandir("appointments/");
        
        $patients = file_get_contents("appointments/" . $email . ".json");
        $data = json_decode($appointmentObject);
        print_r($data);
        ?>
    </table>

</div>

</div>
</body>

</html>