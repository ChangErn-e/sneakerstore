<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
    <style>
/* Ultra Aesthetic Admin Dashboard */
:root {
  --primary: #6c5ce7;
  --primary-light: #a29bfe;
  --secondary: #00cec9;
  --dark: #2d3436;
  --light: #f5f6fa;
  --accent: #fd79a8;
  --success: #00b894;
  --warning: #fdcb6e;
  --danger: #d63031;
}

body {
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
  background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
  margin: 0;
  padding: 0;
  min-height: 100vh;
  color: var(--dark);
  overflow-x: hidden;
}

/* Glassmorphism Container */
.container {
  max-width: 95%;
  margin: 2rem auto;
  padding: 2rem;
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(12px);
  border-radius: 20px;
  box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.18);
}

h2 {
  color: var(--primary);
  font-size: 2.5rem;
  margin-bottom: 1.5rem;
  font-weight: 600;
  position: relative;
  display: inline-block;
}

h2::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 0;
  width: 60px;
  height: 4px;
  background: linear-gradient(90deg, var(--primary), var(--accent));
  border-radius: 2px;
}

/* Premium Table Design */
table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
  margin-bottom: 2rem;
  position: relative;
}

table::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--primary), var(--secondary));
}

th {
  background-color: white;
  color: var(--primary);
  font-weight: 600;
  text-align: left;
  padding: 1.25rem 1.5rem;
  position: sticky;
  top: 0;
  border-bottom: 2px solid rgba(108, 92, 231, 0.1);
  backdrop-filter: blur(5px);
}

td {
  padding: 1rem 1.5rem;
  border-bottom: 1px solid rgba(0, 0, 0, 0.03);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

tr:hover td {
  background-color: rgba(108, 92, 231, 0.03);
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(108, 92, 231, 0.1);
}

tr:last-child td {
  border-bottom: none;
}

/* Gradient Stripes */
tr:nth-child(even) {
  background-color: rgba(245, 246, 250, 0.5);
}

/* Status Badges */
.status {
  display: inline-block;
  padding: 0.35rem 0.75rem;
  border-radius: 50px;
  font-size: 0.75rem;
  font-weight: 600;
  letter-spacing: 0.5px;
}

.status-paid {
  background: linear-gradient(135deg, var(--success), #55efc4);
  color: white;
}

.status-pending {
  background: linear-gradient(135deg, var(--warning), #ffeaa7);
  color: var(--dark);
}

/* Card Number Styling */
.card-number {
  font-family: 'Space Mono', monospace;
  letter-spacing: 1px;
  color: var(--primary);
  position: relative;
  padding-left: 1.5rem;
}

.card-number::before {
  content: '••••';
  position: absolute;
  left: 0;
  opacity: 0.5;
}

/* Floating Action Button */
.fab {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), var(--primary-light));
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 10px 25px rgba(108, 92, 231, 0.3);
  cursor: pointer;
  transition: all 0.3s;
  border: none;
  z-index: 100;
}

.fab:hover {
  transform: translateY(-5px) scale(1.05);
  box-shadow: 0 15px 35px rgba(108, 92, 231, 0.4);
}

.fab i {
  font-size: 1.5rem;
}

/* Animated Background Elements */
.background-element {
  position: fixed;
  border-radius: 50%;
  filter: blur(60px);
  opacity: 0.15;
  z-index: -1;
}

.el-1 {
  width: 300px;
  height: 300px;
  background: var(--primary);
  top: -100px;
  left: -100px;
}

.el-2 {
  width: 400px;
  height: 400px;
  background: var(--accent);
  bottom: -150px;
  right: -100px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .container {
    padding: 1.5rem;
  }
  
  th, td {
    padding: 0.75rem 1rem;
  }
}

/* Add these to your HTML head for fonts */
/* <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Space+Mono&display=swap" rel="stylesheet"> */
/* <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> */
    </style>
</head>
<body>
    <h2>Payments</h2>
    <table>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Card Number</th>
            <th>Expiry Month</th>
            <th>Expiry Year</th>
            <th>CVV</th>
        </tr>
        <?php
    // Connect to the database
    $servername = "localhost";
    $username = "root"; // Change to your MySQL username
    $password = ""; // Change to your MySQL password
    $dbname = "sneakerstore";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query payments table
    $sql = "SELECT name, phone, address, card_number, expiry_month, expiry_year, cvv FROM payment";
    $result = $conn->query($sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    // Counter for serial numbers
    $serialNumber = 1;

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$serialNumber."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["phone"]."</td>";
            echo "<td>".$row["address"]."</td>";
            echo "<td>".$row["card_number"]."</td>";
            echo "<td>".$row["expiry_month"]."</td>";
            echo "<td>".$row["expiry_year"]."</td>";
            echo "<td>".$row["cvv"]."</td>";
            echo "</tr>";
            $serialNumber++; // Increment serial number for next row
        }
    } else {
        echo "<tr><td colspan='8'>No payments found</td></tr>";
    }
    $conn->close();
?>

    </table>
</body>
</html>