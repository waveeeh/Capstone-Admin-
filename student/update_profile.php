<?php
session_start();

// Connect to the database
include '../db.php';

// Fetch user data from the form
$userId = $_SESSION['user_id'];
$studentId = $_SESSION['StudentId'];
$firstName = $_POST['firstName'] ?? '';
$middleName = $_POST['middleName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$emailAddress = $_POST['emailAddress'] ?? '';
$studentNo = $_POST['StudentNo'] ?? '';
$section = $_POST['section'] ?? '';
$dob = $_POST['DoB'] ?? '';
$course = $_POST['course'] ?? '';
$phoneNo = $_POST['phoneNo'] ?? '';
$experience = $_POST['Experience'] ?? '';
$aboutMe = $_POST['AboutMe'] ?? '';
$street = $_POST['Street'] ?? '';
$barangay = $_POST['Barangay'] ?? '';
$city = $_POST['City'] ?? '';
$province = $_POST['Province'] ?? '';
$skills = $_POST['skills'] ?? '';
$photo = $_FILES['photo']['name'] ?? '';

// Function to handle file upload
function handleFileUpload($file, $uploadDir)
{
    $subfolder = 'documents/';
    $targetDir = $uploadDir . $subfolder;
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($file["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "Sorry, only PDF, DOC, & DOCX files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return false;
}

// Handle photo upload
if (!empty($_FILES['photo']['name'])) {
    $uploadDir = 'uploads/images/';
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
            $stmt = $conn->prepare("UPDATE student SET photo = ? WHERE userId = ?");
            $stmt->bind_param("si", $uploadedPhotoPath, $userId);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Handle user and student data
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

$studentCheckQuery = "SELECT COUNT(*) as count FROM student WHERE userId = ?";
$stmt = $conn->prepare($studentCheckQuery);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    $insertStudentQuery = "INSERT INTO student (userId, studentNo, section, dob, course, phoneNo, experience, aboutMe, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertStudentQuery);
    $stmt->bind_param('issssssss', $userId, $studentNo, $section, $dob, $course, $phoneNo, $experience, $aboutMe, $photo);
    $stmt->execute();
} else {
    $updateStudentQuery = "UPDATE student SET studentNo = COALESCE(NULLIF(?, ''), studentNo), section = COALESCE(NULLIF(?, ''), section), dob = COALESCE(NULLIF(?, ''), dob), course = COALESCE(NULLIF(?, ''), course), phoneNo = COALESCE(NULLIF(?, ''), phoneNo), experience = COALESCE(NULLIF(?, ''), experience), aboutMe = COALESCE(NULLIF(?, ''), aboutMe), photo = COALESCE(NULLIF(?, ''), photo) WHERE userId = ?";
    $stmt = $conn->prepare($updateStudentQuery);
    $stmt->bind_param('ssssssssi', $studentNo, $section, $dob, $course, $phoneNo, $experience, $aboutMe, $photo, $userId);
    $stmt->execute();
}

// Handle address data
$addressCheckQuery = "SELECT COUNT(*) as count FROM location WHERE userId = ?";
$stmt = $conn->prepare($addressCheckQuery);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    $insertAddressQuery = "INSERT INTO location (userId, Street, Barangay, City, Province) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertAddressQuery);
    $stmt->bind_param('issss', $userId, $street, $barangay, $city, $province);
    $stmt->execute();
} else {
    $updateAddressQuery = "UPDATE location SET Street = COALESCE(NULLIF(?, ''), Street), Barangay = COALESCE(NULLIF(?, ''), Barangay), City = COALESCE(NULLIF(?, ''), City), Province = COALESCE(NULLIF(?, ''), Province) WHERE userId = ?";
    $stmt = $conn->prepare($updateAddressQuery);
    $stmt->bind_param('ssssi', $street, $barangay, $city, $province, $userId);
    $stmt->execute();
}
$deleteSkillsQuery = "DELETE FROM skillset WHERE UserId = ?";
$stmt = $conn->prepare($deleteSkillsQuery);
$stmt->bind_param('i', $user);
$stmt->execute();

if (!empty($skills)) {
    $skillsArray = array_map('trim', explode('-=-', $skills)); // Ensure correct splitting
    foreach ($skillsArray as $skill) {
        $skill = trim($skill);

        // Check if the skill already exists
        $skillQuery = "SELECT skillId FROM skills WHERE skillName = ?";
        $stmt = $conn->prepare($skillQuery);
        $stmt->bind_param('s', $skill);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows === 0) {
            $insertSkillQuery = "INSERT INTO skills (skillName) VALUES (?)";
            $stmt = $conn->prepare($insertSkillQuery);
            $stmt->bind_param('s', $skill);
            $stmt->execute();
            $skillId = $stmt->insert_id;
        } else {
            $row = $result->fetch_assoc();
            $skillId = $row['skillId'];

        }
        $checkSkill = "SELECT COUNT(*) as count FROM skillset WHERE skillId = ? AND UserId = ?";
        $stmt = $conn->prepare($checkSkill);
        $stmt->bind_param('ii', $skillId, $user['UserId']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['count'] == 0) {
            $insertSkillQuery = "INSERT INTO skillset (skillId, UserId) VALUES (?, ?)";
            $stmt = $conn->prepare($insertSkillQuery);
            $stmt->bind_param('ii', $skillId, $userId);
            $stmt->execute();
        }



        // $insertSkillQuery = "INSERT INTO skillset (skillId, StudentId) VALUES (?, ?)";
        // $stmt = $conn->prepare($insertSkillQuery);
        // $stmt->bind_param('ii', $skillId, $studentId);
        // $stmt->execute();
    }
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


// Handle file uploads for other documents
$uploadDir = "uploads/documents/";
$files = ['resume', 'cor', 'pdos', 'ojtpi', 'asit', 'wpf', 'suc', 'per', 'mr'];
$filePaths = [];

foreach ($files as $file) {
    if (isset($_FILES[$file])) {
        $filePath = handleFileUpload($_FILES[$file], $uploadDir);
        if ($filePath) {
            $filePaths[$file] = $filePath;
        }
    }
}

foreach ($filePaths as $type => $path) {
    $docCheckQuery = "SELECT COUNT(*) as count FROM documents WHERE userId = ? AND fileType = ?";
    $stmt = $conn->prepare($docCheckQuery);
    $stmt->bind_param('is', $userId, $type);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        $sql = "INSERT INTO documents (userId, fileType, filename, studentId) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issi', $userId, $type, $path, $studentId);
    } else {
        $sql = "UPDATE documents SET filename = ?, studentId = ? WHERE userId = ? AND fileType = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('siis', $path, $studentId, $userId, $type);
    }
    if ($stmt->execute()) {
        echo "File $type uploaded and saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}

header("Location: studentprof.php");
exit();
?>