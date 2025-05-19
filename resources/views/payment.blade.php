<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        #response {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
            background-color: #e8f5e9;
            color: #2e7d32;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Stripe Payment</h1>
        <div class="form-group">
            <label for="amount">Amount (in cents):</label>
            <input type="number" id="amount" name="amount" min="1" value="1000">
        </div>
        <button id="payButton">Pay Now</button>
        <div id="response"></div>
    </div>

    <script>
        document.getElementById('payButton').addEventListener('click', async () => {
            const amount = document.getElementById('amount').value;
            const responseDiv = document.getElementById('response');
            responseDiv.style.display = 'none';
            try {
                const response = await fetch('/api/create-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ amount: parseInt(amount) }),
                });
                const data = await response.json();
                responseDiv.textContent = JSON.stringify(data, null, 2);
                responseDiv.style.display = 'block';
            } catch (error) {
                responseDiv.textContent = 'Error: ' + error.message;
                responseDiv.style.display = 'block';
            }
        });
    </script>
</body>
</html> 