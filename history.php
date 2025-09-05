<?php
// Connect DB
$conn = new mysqli("localhost", "root", "", "airtime_db");
$result = $conn->query("SELECT * FROM transactions ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Transaction History</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fa; }
    .table-hover tbody tr:hover { background: #e3f2fd; transition: 0.3s; }
    .success { color: green; font-weight: bold; }
    .failed { color: red; font-weight: bold; }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">📜 Transaction History</h2>
    <table class="table table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Phone</th>
          <th>Amount</th>
          <th>Receipt</th>
          <th>Status</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['phone_number'] ?></td>
            <td><?= $row['amount'] ?></td>
            <td><?= $row['mpesa_receipt_number'] ?></td>
            <td class="<?= $row['result_code']==0 ? 'success' : 'failed' ?>">
              <?= $row['result_code']==0 ? 'Success ✅' : 'Failed ❌' ?>
            </td>
            <td><?= $row['created_at'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
