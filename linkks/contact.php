<head>
    <link rel="icon" href="image_uploads/favicon.png" type="png" sizes="16x16">
    <script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>
    <script language="JavaScript" src="scripts/current_date.js" type="text/javascript"></script>
</head>



<div class="container">
    <?php
    include('includes/header.php');
    ?>
    <div class="content">
        <h2>Contact us</h2>
        <form method="POST" name="contactform" action="contact-form-handler.php">
            <p>
                <label for='name'>Your Name:</label> <br>
                <input type="text" name="name" required>
            </p>
            <p>
                <label for='dob'>Date of Birth:</label> <br>
                <input id="datefield" type="date" name="dob" min="1950-01-01" required /> <br>
            </p>
            <p>
                <label for='email'>Email Address:</label> <br>
                <input type="text" name="email" required> <br>
            </p>
            <p>
                <label for='message'>Message:</label> <br>
                <textarea name="message" required></textarea>
            </p>
            <input type="submit" id="buy_button" value="Submit"><br>
        </form>
    </div>