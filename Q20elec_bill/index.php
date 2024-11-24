<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Electricity Bill Calculator</h2>
        <form id="billForm" method="POST" class="mt-4">
            <div class="form-group">
                <label for="units">Enter the number of units:</label>
                <input type="number" id="units" name="units" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Calculate Bill</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $units = $_POST['units'];
            $bill = 0;

            if ($units <= 50) {
                $bill = $units * 3.50;
            } elseif ($units <= 150) {
                $bill = (50 * 3.50) + (($units - 50) * 4.00);
            } elseif ($units <= 250) {
                $bill = (50 * 3.50) + (100 * 4.00) + (($units - 150) * 5.20);
            } else {
                $bill = (50 * 3.50) + (100 * 4.00) + (100 * 5.20) + (($units - 250) * 6.50);
            }

            echo "<div class='result alert alert-success text-center'>Total Bill: ₹" . number_format($bill, 2) . "</div>";
        }
        ?>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#billForm").on("submit", function(e) {
                const units = $("#units").val();
                if (units <= 0) {
                    e.preventDefault();
                    alert("Please enter a valid number of units!");
                }
            });
        });
    </script>
</body>
</html>
