<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AC Control System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button.secondary {
            background-color: #007BFF;
        }

        button.off {
            background-color: #f44336;
        }

        .status {
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>AC Control System</h2>
    <form method="POST" id="acForm">
        <label for="suhu">Suhu (°C):</label>
        <input type="number" id="suhu" name="suhu" min="10" max="50">

        <label for="kl">Kelembaban (%):</label>
        <input type="number" id="kl" name="kl" min="0" max="100">

        <button type="submit" name="action" value="set">Set Temperature & Humidity</button>

        <button type="submit" name="action" value="on" class="secondary">Turn ON AC</button>
        <button type="submit" name="action" value="off" class="off">Turn OFF AC</button>
    </form>

    <div class="status">
        <?php
        if (isset($_POST['suhu']) && isset($_POST['kl']) && isset($_POST['action'])) {
            $Suhu = $_POST['suhu'];
            $Kl = $_POST['kl'];
            $action = $_POST['action'];
            $ACstate = false;
            $ACpower = 0;

            function ACon($ACpow){
                global $ACstate, $ACpower;
                $ACstate = true;
                $ACpower = $ACpow;
                echo "AC is ON with power set to $ACpow%<br>";
            }

            function ACoff(){
                global $ACstate, $ACpower;
                $ACstate = false;
                $ACpower = 0;
                echo "AC is OFF<br>";
            }

            function setACPower($Suhu, $Kl){
                if ($Suhu >= 25 && $Suhu <= 29 && $Kl >= 0 && $Kl <= 50) {
                    ACon(30);
                    echo "AC menyala dengan kekuatan ringan!<br>";
                } elseif ($Suhu >= 30 && $Suhu <= 34 && $Kl >= 0 && $Kl <= 70) {
                    ACon(70);
                    echo "AC menyala dengan kekuatan sedang!<br>";
                } elseif ($Suhu >= 35 && $Kl >= 0 || $Kl >= 71) {
                    ACon(100);
                    echo "AC menyala dengan kekuatan berat!<br>";
                } else {
                    echo "Suhu dan kelembaban di luar ketentuan.<br>";
                    ACoff();
                }
            }

            // input
            if ($action == "set") {
                echo "Suhu set to $Suhu and Kelembaban set to $Kl%<br>";
                setACPower($Suhu, $Kl);
            } elseif ($action == "on") {
                ACon($ACpower);
            } elseif ($action == "off") {
                ACoff();
            }
        }
        ?>
    </div>
</div>

</body>
</html>
