<?php
// customers.php

$host = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP MySQL
$database = "bus_ticket";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $conn->query("DELETE FROM customers WHERE id=$id");
    }
}

// Fetch customers
$customers = $conn->query("SELECT * FROM customers");

$conn->close();
?>

<div class="customers">
  <h2>Customers</h2>
  <table>
    <thead>
      <tr>
        <th>Serial Number</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($customer = $customers->fetch_assoc()) : ?>
        <tr data-id="<?php echo $customer['id']; ?>">
          <td><?php echo $customer['id']; ?></td>
          <td><?php echo $customer['name']; ?></td>
          <td><?php echo $customer['email']; ?></td>
          <td>
            <button class="deleteCustomer">Delete</button>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function () {
    $(".deleteCustomer").click(function () {
      const id = $(this).closest("tr").data("id");
      $.post("customers.php", { action: "delete", id }, function (data) {
        location.reload();
      });
    });
  });
</script>
