<?php
    function readDataFile($filePath){
        $rows   = array_map(function($v){return str_getcsv($v, ";");}, file($filePath));
        $header = array_shift($rows);
        $csv    = array();

        foreach($rows as $row) {
            $csv[] = array_combine($header, $row);
        }   

        return $csv;
    }

    function writeDataFile($line, $filePath){
        if($filePath == "")
            return;
        
        $DataArray = readDataFile($filePath);
        if(count($DataArray) == 0)
            file_put_contents($filePath, "fname;lname;birthday;address;weight;height\n", FILE_APPEND | LOCK_EX);

        file_put_contents($filePath, $line, FILE_APPEND | LOCK_EX); 
    }

    function buildTable($filePath, $sortType){
        $DataArray = readDataFile($filePath);

        if($sortType == "ASC"){
            function cmp($a, $b)
            {
                return $b['height'] - $a['height'];
            }
            usort($DataArray, "cmp");
        }
        else if($sortType == "DESC"){
            function cmp($a, $b)
            {
                return $b['height'] + $a['height'];
            }
            usort($DataArray, "cmp");
        }

        if(count($DataArray) > 0){
            $iter = 1;

            foreach ($DataArray as $items) {
                echo "<tr>";
                echo '<th scope="row">'.$iter.'</th>';
                foreach ($items as $item){
                    echo "<td>$item</td>";
                }
                echo "</tr>";
                $iter++;
            }
        }
    }  

    function getAverageWeight(){
        $DataArray = readDataFile("../input.txt");
        
        if(count($DataArray) > 0){

            $Average = 0;

            foreach ($DataArray as $items) {
                $Average += $items['weight'];
            }
            return $Average/count($DataArray);
        }
        
        return 0;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table View</title>

    <?php include_once("../header.html");?>

</head>
<body>
    <?php include_once("../menu.html"); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs"></div>
            <div class="col-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Birth Date</th>
                            <th scope="col">Address</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Height</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(($_POST['fname'] != "") && ($_POST['lname'] != "") && ($_POST['address'] != "") && ($_POST['birthday'] != "")) {
                            $data = $_POST['fname'] . ';' . $_POST['lname'] . ';' . $_POST['birthday'] . ';' . $_POST['address'] .';'. $_POST['weight'] . ';' . $_POST['height'] ."\n";
                            
                            writeDataFile($data, "../input.txt");    
                        }
                    ?>
                    <?php buildTable("../input.txt", "DESC"); ?>
                    <tr>
                        <td colspan="4"></td>
                        <td><b>Average Weight:</b></td>
                        <td><b><u> <?php echo getAverageWeight(); ?> </u></b></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <a type="button" class="btn btn-dark" href="../" data-toggle="tooltip" data-placement="bottom" title="Back to input form">Back</a>
            </div>
            <div class="col-xs"></div>
        </div>
    </div>
</body>
</html>

