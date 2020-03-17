<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Input Form</title>

    <?php 
        include_once("header.html");
    ?>
</head>
<body>
    <?php include_once("menu.html"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md"></div>
            <div class="col-sm">
                <div class="input">
                    <form method="POST" action="/table/index.php">
                        <div class="form-group">
                            <label for="fname">First name</label>
                            <input type="text" class="form-control" name="fname" placeholder="John">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last name</label>
                            <input type="text" class="form-control" name="lname" placeholder="Doe">
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birth Date</label>
                            <input type="date" class="form-control" name="birthday">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" aria-describedby="addressHelp" placeholder="Enter city address">
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight</label>
                            <input type="number" class="form-control" name="weight" placeholder="65 kg" min="0" value="0">
                        </div>

                        <div class="form-group">
                            <label for="height">Height</label>
                            <input type="number" class="form-control" name="height" placeholder="165 cm" min="0" value="0">
                        </div>

                        <button type="button submit" name="submit" class="btn btn-success btn-block">Add record</button>
                    </form>
                </div>
            </div>
            <div class="col-md"></div>
        </div>
    </div>
        
</body>
</html>