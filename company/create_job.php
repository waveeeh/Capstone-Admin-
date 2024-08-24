<?php
include "../db.php";
session_start();
$userId = $_SESSION['user_id'];
$CompanyId = $_SESSION['CompanyId'];

$skills = $_POST['skills'] ?? '';
$jobId = $_POST['jobId'] ?? '';
$position = $_POST['position'] ?? '';
$description = $_POST['Description'] ?? '';
$openings = $_POST['NoOfOpenings'] ?? '';
$allowance = $_POST['allowance'] ?? '';
$startDate = $_POST['startDate'] ?? '';
$endDate = $_POST['endDate'] ?? '';
$street = $_POST['Street'] ?? '';
$barangay = $_POST['Barangay'] ?? '';
$city = $_POST['City'] ?? '';
$province = $_POST['Province'] ?? '';

$stmt = $conn->prepare("SELECT * FROM company WHERE CompanyId = ?");
$stmt->bind_param("i", $CompanyId);
$stmt->execute();
$result = $stmt->get_result();
$company = $result->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("INSERT INTO location (Street, Barangay, City, Province, UserId) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $street, $barangay, $city, $province, $userId);
$stmt->execute();
$locationId = $conn->insert_id;
$stmt->close();

if ($locationId == 0) {
    echo "Failed to retrieve location ID.";
    exit();
}

$stmt = $conn->prepare("INSERT INTO job (Position, Description, NoOfOpenings, CompanyId, monthlyAllowance, startDate, endDate, LocationId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssiisssi", $position, $description, $openings, $CompanyId, $allowance, $startDate, $endDate, $locationId);
$stmt->execute();
$jobId = $stmt->insert_id;
$stmt->close();


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
            $insertSkillQuery = "INSERT INTO skillset (skillId, UserId, JobId) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertSkillQuery);
            $stmt->bind_param('iii', $skillId, $userId, $jobId);
            $stmt->execute();
        }




    }
}

header("Location: jobposting.php");




?>