<?php
// buses.php

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
    // Handle Add/Edit/Delete
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $company = $_POST['company'];
            $number = $_POST['number'];
            $type = $_POST['type'];
            $conn->query("INSERT INTO buses (company, number, type) VALUES ('$company', '$number', '$type')");
        } elseif ($_POST['action'] == 'edit') {
            $id = $_POST['id'];
            $company = $_POST['company'];
            $number = $_POST['number'];
            $type = $_POST['type'];
            $conn->query("UPDATE buses SET company='$company', number='$number', type='$type' WHERE id=$id");
        } elseif ($_POST['action'] == 'delete') {
            $id = $_POST['id'];
            $conn->query("DELETE FROM buses WHERE id=$id");
        }
    }
}

// Fetch buses
$buses = $conn->query("SELECT * FROM buses");

$conn->close();
?>

<div class="buses">
  <h2>Buses</h2>
  <form id="busForm">
    <input type="hidden" name="id" id="busId" />
    <label for="company">Company:</label>
    <input type="text" name="company" id="busCompany" required />
    <label for="number">Number:</label>
    <input type="text" name="number" id="busNumber" required />
    <label for="type">Type:</label>
    <select name="type" id="busType">
      <option value="AC">AC</option>
      <option value="Non-AC">Non-AC</option>
    </select>
    <button type="submit" id="busSubmit">Add Bus</button>
  </form>
  <table>
    <thead>
      <tr>
        <th>Company</th>
        <th>Number</th>
        <th>Type</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($bus = $buses->fetch_assoc()) : ?>
        <tr data-id="<?php echo $bus['id']; ?>">
          <td><?php echo $bus['company']; ?></td>
          <td><?php echo $bus['number']; ?></td>
          <td><?php echo $bus['type']; ?></td>
          <td>
            <button class="editBus">Edit</button>
            <button class="deleteBus">Delete</button>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function () {
    // Handle form submission
    $("#busForm").submit(function (event) {
      event.preventDefault();
      const action = $("#busId").val() ? "edit" : "add";
      const id = $("#busId").val();
      const company = $("#busCompany").val();
      const number = $("#busNumber").val();
      const type = $("#busType").val();

      $.post("buses.php", { action, id, company, number, type }, function (data) {
        location.reload();
      });
    });

    // Handle edit button
    $(".editBus").click(function () {
      const row = $(this).closest("tr");
      const id = row.data("id");
      const company = row.find("td:eq(0)").text();
      const number = row.find("td:eq(1)").text();
      const type = row.find("td:eq(2)").text();

      $("#busId").val(id);
      $("#busCompany").val(company);
      $("#busNumber").val(number);
      $("#busType").val(type);
      $("#busSubmit").text("Edit Bus");
    });

    // Handle delete button
    $(".deleteBus").click(function () {
      const id = $(this).closest("tr").data("id");
      $.post("buses.php", { action: "delete", id }, function (data) {
        location.reload();
      });
    });
  });
</script>
