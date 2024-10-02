<!DOCTYPE html>
    <html>
        <head>
            <title>Student Data Form</title>
            <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 600px;
            text-align: left;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        .student-info {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 15px;
            border-left: 4px solid #4CAF50;
            border-radius: 5px;
        }

        .student-info.pass {
            border-color: #4CAF50;
            background-color: #e8f5e9;
        }

        .student-info.fail {
            border-color: #F44336;
            background-color: #ffebee;
        }

        .student-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .student-details {
            font-size: 14px;
            color: #666;
        }

        .summary {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #333;
        }

        .summary p {
            margin: 5px 0;
        }


            </style>
        </head>
        <body>
        <div class="container">
            <h1>Student Data</h1>

            <?php
                $siswa = [
                    ["nama" => "Andi", "matematika" => 85, "bahasa_inggris" => 70, "ipa" => 80],
                    ["nama" => "Budi", "matematika" => 60, "bahasa_inggris" => 50, "ipa" => 65],
                    ["nama" => "Cici", "matematika" => 75, "bahasa_inggris" => 80, "ipa" => 70],
                    ["nama" => "Dodi", "matematika" => 95, "bahasa_inggris" => 85, "ipa" => 90],                
                    ["nama" => "Eka", "matematika" => 50, "bahasa_inggris" => 60, "ipa" => 55],
                ];
                $lulus=0;
                $t_lulus=0;
                $status = array();
                $status = $siswa;
                $lowest_sub;
                foreach ($siswa as $data){
                    // average
                    $avg = ($data["matematika"] + $data["bahasa_inggris"] + $data["ipa"])/3;

                    $grades = [
                        'Matematika' => $data['matematika'],
                        'Bahasa Inggris' => $data['bahasa_inggris'],
                        'IPA' => $data['ipa']
                    ];
                    
                    // Nilai terendah + subjek
                    $lowest_sub = array_search(min($grades), $grades);
                    $lowest_grade = $grades[$lowest_sub];

                    if ($avg >= 75) {
                        $status = ["avg" => $avg, "kelulusan" => 'lulus', "lowest" => $lowest_grade];
                        $lulus++;
                        echo "<div class='student-info pass'>";
                        echo "<span class='student-name'>Nama: " . $data["nama"] . "</span><br>";
                        echo "<span class='student-details'>Rata-rata: " . round($avg, 2) . "</span><br>";
                        echo "<span class='student-details'>Kelulusan: Lulus</span><br>";
                    }
                    else {
                        $status = [ "avg" => $avg, "kelulusan" => 'tidak lulus', "lowest" => $lowest_grade];
                        $t_lulus++;
                        echo "<div class='student-info fail'>";
                        echo "<span class='student-name'>Nama: " . $data["nama"] . "</span><br>";
                        echo "<span class='student-details'>Rata-rata: " . round($avg, 2) . "</span><br>";
                        echo "<span class='student-details'>Kelulusan: Tidak Lulus</span><br>";
                        echo "<span class='student-details'>Diperbaiki: " . $lowest_sub . " (" . $lowest_grade . ")</span><br>";
                    }

                    echo "</div>";          
                }
                    // Summary
                    echo "<div class='summary'>";
                    echo "<p>Jumlah Siswa Lulus: " . $lulus . "</p>";
                    echo "<p>Jumlah Siswa Tidak Lulus: " . $t_lulus . "</p>";
                    echo "</div>";   
            
            ?>
        </div>
    </body>
</html>
