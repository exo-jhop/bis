<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Clearance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .header-text {
            text-align: center;
            flex-grow: 1;
        }

        .header-text p,
        .header-text h1 {
            margin: 0;
        }

        .header-text h1 {
            font-size: 2.5em;
            font-weight: bold;
        }

        .body-text {
            margin-top: 40px;
            line-height: 1.8;
        }

        .body-text p {
            text-align: justify;
        }

        .signature {
            margin-top: 60px;
            text-align: center;
            font-weight: bold;
        }

        .footer {
            margin-top: 80px;
            text-align: center;
        }

        .footer p {
            margin: 0;
        }

        .footer .doc-details {
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Header Section -->
        <div class="header">
            <!-- Barangay Logo -->
            @if ($barangayLogo)
                <div>
                    <img src="{{ storage_path('app/public/' . $barangayLogo) }}" alt="Barangay Logo"
                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; box-shadow: 2px 2px 6px rgba(0,0,0,0.2);">
                </div>
            @else
            @endif








            <!-- Header Text -->
            <div class="header-text">
                <p>Republic of the Philippines</p>
                <p>Negros Occidental</p>
                <p>Barangay {{ $barangayName }}</p>
                <h1>Barangay Clearance</h1>
                <p>Office of the Barangay Captain</p>
            </div>

            <!-- Logo / Barangay Seal -->
        </div>

        <!-- Body Section -->
        <div class="body-text">
            <p>This is to certify that <strong>{{ $resident->full_name }}</strong>
                a resident of {{ $barangayName }}, is known to be of good moral character and a law-abiding citizen
                in our barangay as of this date.</p>
            <p>To certify further, that he/she has no derogatory or criminal records filed in this barangay.</p>
            <p>Issued this {{ now()->format('F d, Y') }}, at {{ $barangayName }}, upon request of the interested party
                for whatever legal purpose it may serve.</p>
        </div>

        <!-- Signature Section -->
        <br>
        <div class="signature">
            <p>_____________________________</p>
            <p>Barangay Captain</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <div class="doc-details">
                <p>O.R No. ____________</p>
                <p>Date Issued: {{ now()->format('F d, Y') }}</p>
                <p>Doc. Stamp: </p>
            </div>
        </div>

    </div>
</body>

</html>
