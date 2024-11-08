<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบลงทะเบียนและกิจกรรม</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS เหมือนที่ให้มาก่อนหน้า */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="date"]:focus, input[type="number"]:focus, select:focus {
            border-color: #28a745;
            outline: none;
        }
        input[type="submit"] {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
        .event-list {
            margin-top: 20px;
        }
        .event-item {
            padding: 15px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            border-radius: 5px;
            background: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Section ลงทะเบียนผู้ใช้ -->
    <div id="registration-section">
        <h2><i class="fas fa-user-plus"></i> ลงทะเบียนผู้ใช้</h2>
        <form action="register.php" method="POST">
            <label for="username"><i class="fas fa-user"></i> ชื่อผู้ใช้:</label>
            <input type="text" id="username" name="username" required>

            <label for="password"><i class="fas fa-lock"></i> รหัสผ่าน:</label>
            <input type="password" id="password" name="password" required>

            <label for="email"><i class="fas fa-envelope"></i> อีเมล:</label>
            <input type="email" id="email" name="email" required>

            <input type="submit" value="ลงทะเบียน">
        </form>
    </div>

    <!-- Section สร้างกิจกรรม -->
    <div id="events-section" class="hidden">
        <h2><i class="fas fa-calendar-plus"></i> สร้างกิจกรรม</h2>
        <form action="create_event.php" method="POST">
            <label for="event-name"><i class="fas fa-calendar-alt"></i> ชื่อกิจกรรม:</label>
            <input type="text" id="event-name" name="event-name" required>

            <label for="event-date"><i class="fas fa-calendar-day"></i> วันที่จัดกิจกรรม:</label>
            <input type="date" id="event-date" name="event-date" required>

            <label for="max-participants"><i class="fas fa-users"></i> จำนวนที่รับสมัคร:</label>
            <input type="number" id="max-participants" name="max-participants" required>

            <label for="registration-start"><i class="fas fa-clock"></i> ช่วงเวลารับสมัคร (เริ่ม):</label>
            <input type="date" id="registration-start" name="registration-start" required>

            <label for="registration-end"><i class="fas fa-clock"></i> ช่วงเวลารับสมัคร (สิ้นสุด):</label>
            <input type="date" id="registration-end" name="registration-end" required>

            <label for="organizing-body"><i class="fas fa-building"></i> หน่วยงานที่จัด:</label>
            <input type="text" id="organizing-body" name="organizing-body" required>

            <label for="draft-published"><i class="fas fa-file"></i> สถานะกิจกรรม:</label>
            <select id="draft-published" name="draft-published" required>
                <option value="draft">แบบร่าง</option>
                <option value="published">เผยแพร่สาธารณะ</option>
            </select>

            <label for="approval-type"><i class="fas fa-check-circle"></i> การอนุมัติ:</label>
            <select id="approval-type" name="approval-type" required>
                <option value="immediate">อนุมัติทันที</option>
                <option value="manual">เลือกอนุมัติ</option>
            </select>

            <input type="submit" value="สร้างกิจกรรม">
        </form>

        <!-- แสดงรายการกิจกรรมที่สร้างขึ้น -->
        <div class="event-list">
            <h2><i class="fas fa-list"></i> กิจกรรมที่สร้างขึ้น</h2>
            <div id="event-container">
                <?php
                include 'config.php';
                $sql = "SELECT * FROM events";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='event-item'>";
                        echo "<strong>ชื่อกิจกรรม:</strong> " . $row['event_name'] . "<br>";
                        echo "<strong>วันที่จัด:</strong> " . $row['event_date'] . "<br>";
                        echo "<strong>หน่วยงานที่จัด:</strong> " . $row['organizing_body'] . "<br>";
                        echo "<strong>จำนวนที่รับสมัคร:</strong> " . $row['max_participants'] . " คน<br>";
                        echo "</div>";
                    }
                } else {
                    echo "ไม่มีข้อมูลกิจกรรม";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    // ซ่อน form สร้างกิจกรรมจนกว่าจะลงทะเบียนสำเร็จ
    document.querySelector('#registration-section form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        fetch('register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            document.getElementById('registration-section').classList.add('hidden');
            document.getElementById('events-section').classList.remove('hidden');
        });
    });
</script>

</body>
</html>
