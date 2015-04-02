<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SpartaPark  | SJSU Parking Guidance System</title>
        <meta name="description" content="A Parking Guidance System">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Kosta Rashev">
    </head>
    <body>
        <?php
            // Get the email data
            $firstName = Input::get('first_name');
            $lastName  = Input::get('last_name');
            $email     = Input::get('email');
            $subject   = Input::get('subject');
            $message   = Input::get('message');
            $datetime  = date('F j, Y, g:i a');
            $ipAddress = Request::getClientIp();
        ?>

        <h1>New Email!</h1>

        <p>
            First Name: <?php echo $firstName; ?>
            <br />
            Last Name: <?php echo $lastName; ?>
            <br />
            Email: <?php echo $email; ?>
        </p>
        <p>
            Subject: <?php echo $subject; ?>
            <br />
            Message: <br />
            <?php echo $message; ?>
            <br />
        </p>
        <p>
            Date: <?php echo $datetime; ?>
            <br />
            IP Address: <?php echo $ipAddress; ?>
            <br />
        </p>
    </body>
</html>