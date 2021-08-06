<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Phone Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="icon" href="image_uploads/link.png" type="png" sizes="16x16">
</head>
<!-- the body section -->
<body>
    <header><h1>Phone Shop</h1></header>

    <main>
        <h2 class="top">Error</h2>
        <p><?php echo $error; ?></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Phone Shop, Richard Collins</p>
    </footer>
    <script>    
 setTimeout(function(){
            window.location.href = 'index.php';
         }, 5000);</script>
</body>
</html>