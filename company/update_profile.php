<?php
session_start();

// Connect to the database
include '../db.php';

// Fetch user data from the form
$userId = $_SESSION['user_id'];
$CompanyId = $_SESSION['CompanyId'];

$firstName = $_POST['firstName'] ?? '';
$middleName = $_POST['middleName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$emailAddress = $_POST['emailAddress'] ?? '';
$companyLogo = $_POST['companyLogo'] ?? '';
$companyName = $_POST['companyName'] ?? '';
$website = $_POST['website'] ?? '';
$photo = $_POST['photo'] ?? '';






if (!empty($_FILES['photo']['name'])) {
    $uploadDir = '../uploads/images/';
    $targetDir = $uploadDir;
    $targetFile = $targetDir . basename($_FILES['photo']['name']);
    $uploadOk = 1;

    // Check if file is an image
    $check = getimagesize($_FILES['photo']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        echo "File is not an image.";
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $uploadOk = 0;
        echo "Sorry, file already exists.";
    }

    // Check file size (5MB max)
    if ($_FILES['photo']['size'] > 5000000) {
        $uploadOk = 0;
        echo "Sorry, your file is too large.";
    }

    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES['photo']['name'])) . " has been uploaded.";

            // Update database
            $uploadedPhotoPath = $targetFile;
            $stmt = $conn->prepare("UPDATE company SET photo = ? WHERE userId = ?");
            $stmt->bind_param("si", $uploadedPhotoPath, $userId);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
if (!empty($_FILES['CompanyLogo']['name'])) {
    $uploadDir = '../uploads/images/';
    $targetDir = $uploadDir;
    $targetFile = $targetDir . basename($_FILES['CompanyLogo']['name']);
    $uploadOk = 1;

    // Check if file is an image
    $check = getimagesize($_FILES['CompanyLogo']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        echo "File is not an image.";
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $uploadOk = 0;
        echo "Sorry, file already exists.";
    }

    // Check file size (5MB max)
    if ($_FILES['CompanyLogo']['size'] > 5000000) {
        $uploadOk = 0;
        echo "Sorry, your file is too large.";
    }

    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['CompanyLogo']['tmp_name'], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES['CompanyLogo']['name'])) . " has been uploaded.";

            // Update database
            $uploadedPhotoPath = $targetFile;
            $stmt = $conn->prepare("UPDATE company SET CompanyLogo = ? WHERE userId = ?");
            $stmt->bind_param("si", $uploadedPhotoPath, $userId);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}



$userCheckQuery = "SELECT COUNT(*) as count FROM user WHERE userId = ?";
$stmt = $conn->prepare($userCheckQuery);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    $insertUserQuery = "INSERT INTO user (userId, firstName, middleName, lastName, emailAddress) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertUserQuery);
    $stmt->bind_param('issss', $userId, $firstName, $middleName, $lastName, $emailAddress);
    $stmt->execute();
} else {
    $updateUserQuery = "UPDATE user SET firstName = COALESCE(NULLIF(?, ''), firstName), middleName = COALESCE(NULLIF(?, ''), middleName), lastName = COALESCE(NULLIF(?, ''), lastName), emailAddress = COALESCE(NULLIF(?, ''), emailAddress) WHERE userId = ?";
    $stmt = $conn->prepare($updateUserQuery);
    $stmt->bind_param('ssssi', $firstName, $middleName, $lastName, $emailAddress, $userId);
    $stmt->execute();
}

$companyCheckQuery = "SELECT COUNT(*) as count FROM company WHERE userId = ?";
$stmt = $conn->prepare($companyCheckQuery);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    $insertCompanyQuery = "INSERT INTO company (userId, CompanyName, Website, CompanyLogo, photo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertCompanyQuery);
    $stmt->bind_param('issss', $userId, $companyName, $website, $companyLogo, $photo);
    $stmt->execute();
} else {
    $updateCompanyQuery = "UPDATE company SET CompanyName = COALESCE(NULLIF(?, ''), CompanyName), Website = COALESCE(NULLIF(?, ''), Website), CompanyLogo = COALESCE(NULLIF(?, ''), CompanyLogo), photo = COALESCE(NULLIF(?, ''), photo) WHERE userId = ?";
    $stmt = $conn->prepare($updateCompanyQuery);
    $stmt->bind_param('ssssi', $companyName, $website, $companyLogo, $photo, $userId);
    $stmt->execute();
}

$newPassword = $_POST['newPassword'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';

if (!empty($newPassword) && !empty($confirmPassword)) {
    if ($newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePasswordQuery = "UPDATE user SET password = ? WHERE userId = ?";
        $stmt = $conn->prepare($updatePasswordQuery);
        $stmt->bind_param('si', $hashedPassword, $userId);
        $stmt->execute();
    } else {
        echo "Passwords do not match.";
    }
}
// header("Location: studentprof.php");
exit();
?>