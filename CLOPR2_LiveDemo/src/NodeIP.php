<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LiveDemo EKS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
    <link rel="stylesheet" href="assets/css/Social-Icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
</head>

<body>
    <!-- Start: Highlight Clean -->
    <section class="highlight-clean">
        <div class="container">
            <!-- Start: Intro -->
            <div class="intro">
                <h1 class="text-center">My IP address on each node is :</h1>
                <h1>
                    <?php echo 'HTTP host: '.$_SERVER['HTTP_HOST'].'<br>'; ?>
                </h1>

            </div>
            <!-- End: Intro -->
            <!-- Start: Buttons -->
            <div class="buttons"><a class="btn btn-primary" role="button" href="NodeIP.php">Refresh</a><a class="btn btn-light" role="button" href="index.html">return home</a></div>
            <!-- End: Buttons -->
        </div>
    </section>
    <!-- End: Highlight Clean -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>