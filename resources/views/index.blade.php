<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>

    <title>Messenger</title>
    <style>
        /* Ensure the body takes full height */
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f0f2f5; /* Light background */
        }

        /* Center the form container */
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Style for the form */
        .form-box {
            background-color: white; /* White background for the form */
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1); /* Add shadow */
            text-align: center; /* Center content */
        }

        /* Style for the WhatsApp logo */
        .whatsapp-logo {
            width: 100px; /* Adjust size as needed */
            height: 100px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

<!-- Form container -->
<div class="center-container">
    <div class="form-box">
        <!-- WhatsApp logo -->
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp Logo" class="whatsapp-logo">

        <form action="/send-message" method="post" style="width: 100%;">
            @csrf
            <!-- Message input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                <label class="form-label" for="form4Example3">متن پیام</label>
            </div>

            <!-- Submit button -->
            <button data-mdb-ripple-init type="submit" class="btn btn-success btn-block mb-4">ارسال پیام</button>
        </form>
    </div>
</div>

</body>
</html>
