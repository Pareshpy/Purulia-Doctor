<?php
require 'vendor/autoload.php';
require 'config.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

use Slim\App;
use Slim\Http\Response;
use Slim\Http\Request;
use Ramsey\Uuid\Uuid;
use PHPMailer\PHPMailer\PHPMailer;


$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = $_ENV['MAIL_HOSTNAME'];
$mail->SMTPAuth = true;
$mail->Username = $_ENV['MAIL_USERNAME'];
$mail->Password = $_ENV['MAIL_PASSWORD'];
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

// Recipients
$mail->setFrom('no-reply@stringocean.com', 'Purulia Doctors');

$app = new App($appConfig);

$container = $app->getContainer();
$container['db'] = function ($container) use ($appConfig) {
    $settings = $appConfig['settings']['db'];
    $dsn = "{$settings['driver']}:host={$settings['host']};dbname={$settings['database']};charset={$settings['charset']}";
    try {
        return new PDO($dsn, $settings['username'], $settings['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
};


$app->get('/getEmails', function (Request $req, Response $res) {
    $db = $this->get('db');

    try {
        $query = "SELECT * FROM users";
        $stmt = $db->query($query);
        $emails = $stmt->fetchAll();

    } catch (PDOException $e) {
        return $res->withJson(['error' => 'Database query failed: ' . $e->getMessage()], 500);
    }

    return $res->withJson($emails);
});

$app->get('/getDoctors', function (Request $req, Response $res) {
    $db = $this->get('db');
    try {
        $query = "SELECT * FROM doctors";
        $stmt = $db->query($query);
        $doctors = $stmt->fetchAll();
    } catch (PDOException $e) {
        return $res->withJson(['error' => 'Database query failed: ' . $e->getMessage()], 500);
    }

    return $res->withJson($doctors);

});

$app->post('/checkEmail', function (Request $req, Response $res, array $args) {
    $db = $this->get('db');
    $data = (object) $req->getParsedBody();
    try {
        $email = $data->email;
        $query = "SELECT vid FROM users WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $emails = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as an associative array

        if ($emails) {
            $vid = $emails[0]['vid'] ?? null; // Get the first row's VID
            if ($vid !== null) {
                return $res->withJson(['status' => 'error', 'message' => 'Email already exists', 'vid' => $vid]);
            }
            return $res->withJson(['status' => 'error', 'message' => 'Email already exists']);
        } else {
            return $res->withJson(['status' => 'success', 'message' => 'Email available','email' => $email]);
        }
    } catch (PDOException $e) {
        return $res->withJson(['error' => 'Database query failed: ' . $e->getMessage()], 500);
    }
});

$app->post('/signup', function (Request $req, Response $res, array $args) {
    global $mail;
    $db = $this->get('db');
    $data = (object) $req->getParsedBody();
    try {
        $fName = $data->fName;
        $lName = $data->lName;
        $mNumber = $data->mNumber;
        $password = $data->password;
        $cPassword = $data->cPassword;
        $offers = $data->offers;
        $email = $data->email;

        $vid = Uuid::uuid4();
        $otp = rand(111111, 999999);


        if ($password == $cPassword) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (first_name, last_name, email, phone, password, profile_image, vid, otp) VALUES ('$fName', '$lName', '$email','$mNumber', '$hashed', '','$vid','$otp')";
            $stmt = $db->query($query);

            if ($stmt) {
                $mail->addAddress($email, $fName . ' ' . $lName);

                $mail->isHTML(true);
                $mail->Subject = 'Verify your email!';
                $mail->Body = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f6f6f6;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        background-color: #ffffff;
                        max-width: 600px;
                        margin: 20px auto;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        padding: 20px 0;
                        border-bottom: 1px solid #eeeeee;
                    }
                    .header h1 {
                        margin: 0;
                        color: #333333;
                    }
                    .content {
                        padding: 20px;
                        text-align: center;
                    }
                    .content p {
                        color: #555555;
                        line-height: 1.5;
                    }
                    .otp {
                        display: inline-block;
                        padding: 10px 20px;
                        margin: 20px 0;
                        font-size: 24px;
                        color: #ffffff;
                        background-color: #007bff;
                        border-radius: 4px;
                        text-decoration: none;
                    }
                    .verify-link {
                        display: inline-block;
                        padding: 10px 20px;
                        margin-top: 20px;
                        font-size: 18px;
                        background-color: #28a745;
                        color: #ffffff;
                        border-radius: 5px;
                        text-decoration: none;
                    }
                    .footer {
                        text-align: center;
                        padding: 10px 0;
                        border-top: 1px solid #eeeeee;
                        color: #999999;
                        font-size: 12px;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h1>OTP Verification</h1>
                    </div>
                    <div class='content'>
                        <p>Dear $fName,</p>
                        <p>Thank you for using our service. Please use the following OTP to complete your verification process:</p>
                        <a class='otp'>$otp</a>
                        <p>Or click the button below to verify your email:</p>
                        <a class='verify-link' href='https://puruliadoctors.in/verify2.php?vid=$vid'>Verify Now</a>
                        <p>If you did not request this OTP, please ignore this email.</p>
                    </div>
                    <div class='footer'>
                        <p>&copy; " . date('Y') . " Purulia Doctors. All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>
          ";

                $mail->send();

                return $res->withJson(['status' => 'success', 'message' => 'Verification email has been sent', 'vid' => $vid]);
            } else {
                return $res->withJson(['status' => 'error', 'message' => 'Unable to process']);

            }
        } else {
            return $res->withJson(['status' => 'error', 'message' => 'Passwords do not match']);

        }
    } catch (PDOException $e) {
        return $res->withJson(['error' => 'Database query failed: ' . $e->getMessage()], 500);
    }

});

$app->post('/verify', function (Request $req, Response $res, array $args) {
    $db = $this->get('db');
    $data = (object) $req->getParsedBody();

    $vid = $data->vid ?? null;
    $userOtp = $data->otp ?? null;

    if (!$vid || !$userOtp) {
        return $res->withJson(['status' => 'error', 'message' => 'VID and OTP are required'], 400);
    }

    try {
        // Fetch stored OTP
        $query = "SELECT otp FROM users WHERE vid = :vid";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':vid', $vid);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $storedOtp = $user['otp'];

            // Compare OTP
            if ($storedOtp == $userOtp) {
                // OTP is correct, update verification status and clear vid & otp
                $updateQuery = "UPDATE users SET vid = NULL, otp = NULL, status = 1 WHERE vid = :vid";
                $updateStmt = $db->prepare($updateQuery);
                $updateStmt->bindParam(':vid', $vid);
                $updateStmt->execute();

                return $res->withJson(['status' => 'success', 'message' => 'verified successfully']);
            } else {
                return $res->withJson(['status' => 'error', 'message' => 'Invalid OTP']);
            }
        } else {
            return $res->withJson(['status' => 'error', 'message' => 'User not found']);
        }
    } catch (PDOException $e) {
        return $res->withJson(['error' => 'Database query failed: ' . $e->getMessage()], 500);
    }
});

$app->post('/searchClinics', function (Request $req, Response $res, array $args) use ($app) {
    $db = $app->getContainer()->get('db');  // Get database connection
    $data = (object) $req->getParsedBody();

    if (!isset($data->input) || empty(trim($data->input))) {
        return $res->withJson(['error' => 'Search input is required'], 400);
    }

    $input = "%{$data->input}%";  // Add wildcards for partial match

    try {
        $stmt = $db->prepare("SELECT * FROM clinics WHERE clinic_name LIKE ? OR clinic_address LIKE ?");
        $stmt->execute([$input, $input]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res->withJson($results);
    } catch (PDOException $e) {
        return $res->withJson(['error' => 'Database query failed: ' . $e->getMessage()], 500);
    }
});


$app->run();