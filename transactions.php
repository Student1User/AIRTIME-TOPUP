<?php include 'db.php'; ?>
<?php $result = $conn->query("SELECT * FROM transactions ORDER BY created_at DESC"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Transactions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
  <?php include 'sidebar.php'; ?>
  <div class="container-fluid p-4" style="margin-left:220px;">
    <h2 class="mb-4">📜 All Transactions</h2>
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
</body>
</html>
