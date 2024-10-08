<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel Pesawat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            text-align: center;
            padding-top: 50px;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            padding: 30px;
        }
        h1 {
            font-size: 24px;
            color: #333;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        input {
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .output {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Control Panel Pesawat</h1>

    <form method="post">
        <button type="submit" name="action" value="fly">Lepas Landas</button>
        <button type="submit" name="action" value="land">Mendarat</button><br>

        <input type="text" name="terminal" placeholder="Enter terminal">
        <button type="submit" name="action" value="taxi">Taxi</button><br>

        <button type="submit" name="action" value="checkstate">Cek Status</button>
    </form>

    <div class="output">
    <?php
    session_start();

    class Pesawat {
        public $nama;
        public $model;
        public $manufaktur;
        private $state; 

        public function __construct() {
            if (isset($_SESSION['state'])) {
                $this->state = $_SESSION['state'];
            } else {
                $this->state = 'Mendarat'; 
                $_SESSION['state'] = $this->state; 
            }
        }

        public function fly() {
            if ($this->state == 'Mendarat' || $this->state == 'Taxi') {
                $this->state = 'Mengudara';
                $_SESSION['state'] = $this->state; 
                echo("Pesawat Lepas Landas<br>");
            } else {
                echo("Pesawat tidak dalam posisi untuk lepas landas!<br>");
            }
        }

        public function land() {
            if ($this->state == 'Mengudara') {
                $this->state = 'Mendarat';
                $_SESSION['state'] = $this->state; 
                echo("Pesawat Mendarat<br>");
            } else {
                echo("Pesawat tidak dalam posisi untuk mendarat!<br>");
            }
        }

        public function taxi($terminal) {
            if ($this->state == 'Mendarat' || $this->state == 'Taxi' || $this->state == 'Mengudara') {
                $this->state = 'Taxi';
                $_SESSION['state'] = $this->state; 
                echo("Pesawat telah taxi ke $terminal!<br>");
            } else {
                echo("Pesawat tidak dalam posisi untuk taxi<br>");
            }
        }

        public function checkstate() {
            echo("[STATE CHECK] : State pesawat adalah $this->state!<br>");
        }
    }

    $pesawat1 = new Pesawat();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];

        switch ($action) {
            case 'fly':
                $pesawat1->fly();
                break;
            case 'land':
                $pesawat1->land();
                break;
            case 'taxi':
                $terminal = isset($_POST['terminal']) && !empty($_POST['terminal']) ? $_POST['terminal'] : 'Terminal 01';
                $pesawat1->taxi($terminal);
                break;
            case 'checkstate':
                $pesawat1->checkstate();
                break;
        }
    }
?>
    </div>
</div>

</body>
</html>
