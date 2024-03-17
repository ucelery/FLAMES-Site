<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F.L.A.M.E.S.</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="wrapper">
        <div class="video-bg">
            <div class="vid-filter"></div>
            <div class="video-foreground" style="height: 100%;">
                <video autoplay muted loop>
                    <source src="./assets/bg.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

        <div class="form-wrapper">
            <div class="content">
                <div class="form-content">
                    <form id="flamesForm" action="flames.php" method="post">
                        <div class="flames-text-container">
                            <div class="flames-text">
                                <div class="letter" id="friends">
                                    <div>F</div>
                                    <div class="meaning">riends</div>
                                </div>
                                <div class="letter" id="lovers">
                                    <div>L</div>
                                    <div class="meaning">overs</div>
                                </div>
                                <div class="letter" id="anger">
                                    <div>A</div>
                                    <div class="meaning">nger</div>
                                </div>
                                <div class="letter" id="married">
                                    <div>M</div>
                                    <div class="meaning">arried</div>
                                </div>
                                <div class="letter" id="engaged">
                                    <div>E</div>
                                    <div class="meaning">ngaged</div>
                                </div>
                                <div class="letter" id="soulmates">
                                    <div>S</div>
                                    <div class="meaning">oulmates</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="my_name" name="myName" placeholder="Your Name">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="their_name" name="theirName" placeholder="Their Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="date" class="form-control" id="my_birth" name="myBirthday" placeholder="Your Birthday">
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" id="their_birth" name="theirBirthday" placeholder="Their Birthday">
                            </div>
                        </div>

                        <div class="submit-container">
                            <button type="submit" id="submit-btn" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- FONT AWESOME -->
<script src="https://kit.fontawesome.com/400350ec23.js" crossorigin="anonymous"></script>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- AJAX HANDLER -->
<script src="js/functions.js"></script>

</html>