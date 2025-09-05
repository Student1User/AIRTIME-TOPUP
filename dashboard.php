<?php
// DB Connection
$conn = new mysqli("localhost", "root", "", "airtime_db");

// Fetch stats
$total = $conn->query("SELECT COUNT(*) as c FROM transactions")->fetch_assoc()['c'];
$success = $conn->query("SELECT COUNT(*) as c FROM transactions WHERE result_code=0")->fetch_assoc()['c'];
$failed = $conn->query("SELECT COUNT(*) as c FROM transactions WHERE result_code!=0")->fetch_assoc()['c'];
$revenue = $conn->query("SELECT SUM(amount) as s FROM transactions WHERE result_code=0")->fetch_assoc()['s'];

// Fetch latest 10 transactions
$transactions = $conn->query("SELECT * FROM transactions ORDER BY created_at DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { background: #f4f6f9; }
    .sidebar {
      height: 100vh;
      background: #343a40;
      color: white;
      padding: 20px;
    }
    .sidebar a { color: white; text-decoration: none; display: block; padding: 10px; }
    .sidebar a:hover { background: #495057; border-radius: 8px; }
    .card { border-radius: 15px; }
    .table-hover tbody tr:hover { background: #e3f2fd; transition: 0.3s; }
  </style>
</head>
<body>
<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar">
    <h2 class="mb-4"><i class="fas fa-chart-line"></i> Dashboard</h2>
    <a href="#"><i class="fas fa-tachometer-alt"></i> Overview</a>
    <a href="transactions.php"><i class="fas fa-history"></i> Transactions</a>
    <a href="#"><i class="fas fa-users"></i> Users</a>
    <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
  </div>

  <!-- Main Content -->
  <div class="container-fluid p-4">
    <div class="row mb-4">
      <!-- Stats Cards -->
      <div class="col-md-3">
        <div class="card shadow p-3 text-center">
          <h5>Total Transactions</h5>
          <h2><?= $total ?></h2>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow p-3 text-center text-success">
          <h5>Successful</h5>
          <h2><?= $success ?></h2>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow p-3 text-center text-danger">
          <h5>Failed</h5>
          <h2><?= $failed ?></h2>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow p-3 text-center text-primary">
          <h5>Total Revenue</h5>
          <h2>KES <?= number_format($revenue,2) ?></h2>
        </div>
      </div>
    </div>

    <!-- Chart -->
    <div class="row mb-4">
      <div class="col-md-8">
        <div class="card shadow p-3">
          <h5>Transaction Overview</h5>
          <canvas id="transactionsChart"></canvas>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow p-3">
          <h5>Success Rate</h5>
          <canvas id="pieChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="card shadow p-3">
      <h5>Recent Transactions</h5>
      <table class="table table-hover">
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
        <?php while($row = $transactions->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['phone_number'] ?></td>
            <td>KES <?= $row['amount'] ?></td>
            <td><?= $row['mpesa_receipt_number'] ?></td>
            <td class="<?= $row['result_code']==0 ? 'text-success' : 'text-danger' ?>">
              <?= $row['result_code']==0 ? 'Success ✅' : 'Failed ❌' ?>
            </td>
            <td><?= $row['created_at'] ?></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  // Bar chart
  new Chart(document.getElementById('transactionsChart'), {
    type: 'bar',
    data: {
      labels: ['Total', 'Success', 'Failed'],
      datasets: [{
        label: 'Transactions',
        data: [<?= $total ?>, <?= $success ?>, <?= $failed ?>],
        backgroundColor: ['#0d6efd','#198754','#dc3545']
      }]
    }
  });

  // Pie chart
  new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
      labels: ['Success','Failed'],
      datasets: [{
        data: [<?= $success ?>, <?= $failed ?>],
        backgroundColor: ['#198754','#dc3545']
      }]
    }
  });
</script>
</body>
</html>
