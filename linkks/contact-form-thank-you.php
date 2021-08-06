<head>
    <link rel="icon" href="image_uploads/link.png" type="png" sizes="16x16">
</head>
<div class="container">
    <?php
    include('includes/header.php');
    ?>


<body>
<div class="content">
<h2>Thank you!</h2>
I will contact you soon!

<p>Web page redirects after 5 seconds</p>
</div>
<script>    
 setTimeout(function(){
            window.location.href = 'index.php';
         }, 5000);</script>
