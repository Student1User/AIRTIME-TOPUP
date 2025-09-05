<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airtime Top-up</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
            width: 350px;
            animation: fadeIn 1s ease-in-out;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"], input[type="number"] {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }
        input:focus {
            border-color: #2575fc;
            box-shadow: 0 0 8px rgba(37,117,252,0.5);
        }
        button {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📲 Airtime Top-up</h2>
       <form method="POST" action="stkpush.php" onsubmit="showLoader()">
    <input type="text" name="phone" placeholder="2547XXXXXXXX" required><br>
    <input type="number" name="amount" min="10" placeholder="Amount" required><br>
    <button type="submit">Pay with M-Pesa</button>
</form>

<div id="loader" style="display:none; margin-top:20px;">
    <div class="spinner"></div>
    <p>Please wait... Sending STK Push 📲</p>
</div>

<style>
.spinner {
    border: 6px solid #f3f3f3;
    border-top: 6px solid #2575fc;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin: auto;
}
@keyframes spin {
    0% { transform: rotate(0deg);}
    100% { transform: rotate(360deg);}
}
</style>

<script>
function showLoader() {
    document.getElementById("loader").style.display = "block";
}
</script>

    </div>
</body>
</html>
