<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0F0564; /* Header color */
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 8px 8px 0 0;

        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .greeting {
            text-align: center;
            margin: 20px 0;
            color: #333;
            font-weight: 600;
            font-size: 22px;
        }
        .greeting h2 {
            font-style: italic; /* Italicized name */
        }
        p {
            color: #000000; /* Updated text color */
            line-height: 1.6;
            margin: 10px 0;
            font-size: 16px; /* Increased font size */
        }
        .verification-code {
            background-color: white; /* Light green background */
            border: 1px solid black;
            padding: 15px;
            font-size: 20px;
            color: black;
            margin: 20px 0;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
        }
        .border {
            border-right: 1px solid #212529;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
            </div>
            <h1>Forgot Password</h1>
        </div>
        <div class="greeting">
            <h2>Greetings <span style="font-style: italic; color:#0F0564">{{client_name}}</span> !</h2>
        </div>
        <p>You requested to reset your password. Please use the temporary password below to log in to your account in our website at <a href="https://booking.jfmanalili.com/login">JFManalili Booking System</a>.</p>
        <div class="verification-code">
            <strong>Temporary Password: </strong>{{temp_pass}}<br>
        </div>
        <p>
            <strong>Important: </strong>Once you log in using this password, you will be required to create a new password before continuing. This is to help keep your account secure.
            <br>
            If you didn’t request this password reset, please contact our support team immediately.
        </p>
    </div>
</body>
</html>
