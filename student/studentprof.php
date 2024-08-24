<?php
include '../db.php';
session_start();
$userId = $_SESSION['user_id'];
$studentId = $_SESSION['StudentId'];

$sql = "SELECT * FROM user WHERE UserId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$sql = "SELECT * FROM documents WHERE UserId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$documents = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$sql = "SELECT * FROM student WHERE UserId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user['UserId']);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch skills from the database
$sql = "SELECT skillId FROM skillset WHERE UserId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user['UserId']);
$stmt->execute();
$skillIds = $stmt->get_result();
$skillIds = $skillIds->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$skills = [];
if (count($skillIds) > 0) {
  foreach ($skillIds as $skillId) {
    $sql = "SELECT skillName FROM skills WHERE skillId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $skillId['skillId']);
    $stmt->execute();
    $result = $stmt->get_result();
    $skill = $result->fetch_assoc();

    $skills[] = $skill;
    $stmt->close();
  }

}

$sql = "SELECT * FROM location WHERE UserId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$location = $result->fetch_assoc();


$firstname = isset($user['firstName']) ? htmlspecialchars($user['firstName']) : '';
$middlename = isset($user['MiddleName']) ? htmlspecialchars($user['MiddleName']) : '';
$lastname = isset($user['LastName']) ? htmlspecialchars($user['LastName']) : '';
$fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);

$photo = isset($student['photo']) ? 'uploads/' . htmlspecialchars($student['photo']) : '';
$photoPath = 'uploads/' . $photo;

$street = isset($location['Street']) ? htmlspecialchars($location['Street']) : '';
$barangay = isset($location['Barangay']) ? htmlspecialchars($location['Barangay']) : '';
$city = isset($location['City']) ? htmlspecialchars($location['City']) : '';
$province = isset($location['Province']) ? htmlspecialchars($location['Province']) : '';
$location = trim($street . ',' . $barangay . ', ' . $city . ', ' . $province);

$course = isset($student['course']) ? htmlspecialchars($student['course']) : '';
$section = isset($student['section']) ? htmlspecialchars($student['section']) : '';
$studentNo = isset($student['StudentNo']) ? htmlspecialchars($student['StudentNo']) : '';
$dob = isset($student['DoB']) ? htmlspecialchars($student['DoB']) : '';
$phoneNo = isset($student['phoneNo']) ? htmlspecialchars($student['phoneNo']) : '';
$experience = isset($student['Experience']) ? htmlspecialchars($student['Experience']) : '';
$aboutMe = isset($student['AboutMe']) ? htmlspecialchars($student['AboutMe']) : '';

$emailAddress = isset($user['EmailAddress']) ? htmlspecialchars($user['EmailAddress']) : '';
$coursec = trim($course . ' - 4' . $section);


$documentLabels = [
  'resume' => 'Resume',
  'cor' => 'Certificate of Registration',
  'pdos' => 'Certificate of Participation (PDOS)',
  'asit' => 'Application for Supervised Industrial Training',
  'ojtpi' => 'On - the - Job Training Program and Information Sheet',
  'wpf' => 'Waiver and Permission Form (Notarized)',
  'suc' => 'Student/University Contract (Notarized)',
  'per' => 'Physiological Evaluation Result',
  'mr' => 'Medical Result'
];
$isProfileIncomplete = empty($user['firstName']) || empty($user['LastName']) || empty($student['course']) || empty($student['section']) || empty($student['StudentNo']) || empty($student['DoB']) || empty($student['phoneNo']) || empty($student['Experience']) || empty($student['AboutMe']) || empty($location['Street']) || empty($location['Barangay']) || empty($location['City']) || empty($location['Province']) || empty($skill['skillId']) || empty($document['fileName']);

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="./css/footer.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <link rel="icon" href="./img/Group 236.svg" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            fontColor: "#1E1E1E",
            card1: "#FBC0C0",
            card2: "#F4E87A",
            card3: "#AEA8F8",
            card4: "#F4E884",
            button: "#3E3C3C",
            profcard: "#F1EFEF",
            nav: "#808185",
          },
          fontFamily: {
            sans: ["IBM Plex Sans", "sans-serif"],
          },
        },
      },
    };
  </script>
  <style>
    .sidebar {
      transform: translateX(-100%);
      transition: transform 0.3s ease-in-out;
    }

    .sidebar.show {
      transform: translateX(0);
    }

    .custom-card {
      border-radius: 10px;
      padding: 10px;
      margin: 10px;
      width: 260px;
      height: 150px;
      border: 1px solid black;
    }

    .mini-card {
      width: 130px;
      height: 80px;
      background-color: white;
      border-radius: 6px;
    }

    .custom-sideborder {
      box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
        rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    }

    .text-nav.active {
      background-color: #1e1e1e;
      color: white;
      border-radius: 6px;
    }

    .text-nav.active svg {
      stroke: white;
    }

    .custom-hidden {
      display: none;
    }

    .custom-block {
      display: block;
    }

    .custom-absolute {
      position: absolute;
    }

    .custom-rounded-md {
      border-radius: 0.375rem;
    }

    .custom-shadow-lg {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(5px);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 50;
    }

    .overlay-content {
      background: white;
      padding: 2rem;
      border-radius: 0.5rem;
      text-align: center;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      z-index: 999;
    }
  </style>

  <title>InterLink</title>
</head>

<body>




  <nav class="z-100 w-full border-b flex flex-row justify-between px-4 py-4">
    <div>
      <svg id="sidebarToggle" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="lucide lucide-gantt-chart">
        <path d="M8 6h10" />
        <path d="M6 12h9" />
        <path d="M11 18h7" />
      </svg>
    </div>
    <div class="flex flex-row gap-5">
      <div class="relative">
        <svg id="notificationIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-bell cursor-pointer">
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
          <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
        </svg>
        <div id="notificationDropdown"
          class="hidden absolute top-8 right-0 mt-2 w-48 bg-white border rounded-md shadow-lg">
          <a href="#" class="block py-2 text-gray-700 hover:bg-gray-100">
            <div class="border p-1 w-full flex flex-col">
              <h1>Title</h1>
              <p>description</p>
              <p>time</p>
            </div>
          </a>
        </div>
      </div>
      <div class="relative custom-profile flex flex-row items-center cursor-pointer">
        <div class="w-[25px] h-[24px] rounded-full">
          <img src="<?php echo $photo; ?>" alt="Profile" class="w-full h-full object-cover" />
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-chevron-down">
          <path d="m6 9 6 6 6-6" />
        </svg>
        <div id="custom-dropdownMenu"
          class="custom-hidden custom-absolute z-10 top-8 right-0 mt-2 w-48 bg-white border custom-rounded-md custom-shadow-lg">
          <a href="studentprof.php" class="custom-block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
          <a href="edit-prof.php" class="custom-block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit Profile</a>
          <a href="#" class="custom-block px-4 py-2 text-gray-700 hover:bg-gray-100">About Us</a>
          <a href="#" class="custom-block px-4 py-2 text-gray-700 hover:bg-gray-100">Contact Us</a>
          <a href="logout.php" class="custom-block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <aside id="default-sidebar"
    class="custom-sideborder sidebar fixed top-0 left-0 z-40 w-52 h-screen transition-transform -translate-x-full md:translate-x-0 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white flex flex-col justify-between">
      <ul class="space-y-2 font-medium">
        <svg width="150" height="40" viewBox="0 0 150 59" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M25.2 35V32.096H27.36V21.152H25.2V18.248H33.168V21.152H31.008V32.096H33.168V35H25.2ZM36.2554 35V22.4H39.8074V24.536H39.9514C40.1754 23.88 40.5674 23.312 41.1274 22.832C41.6874 22.352 42.4634 22.112 43.4554 22.112C44.7514 22.112 45.7274 22.544 46.3834 23.408C47.0554 24.272 47.3914 25.504 47.3914 27.104V35H43.8394V27.392C43.8394 26.576 43.7114 25.976 43.4554 25.592C43.1994 25.192 42.7434 24.992 42.0874 24.992C41.7994 24.992 41.5194 25.032 41.2474 25.112C40.9754 25.176 40.7274 25.288 40.5034 25.448C40.2954 25.608 40.1274 25.808 39.9994 26.048C39.8714 26.272 39.8074 26.536 39.8074 26.84V35H36.2554ZM55.2083 35C53.9762 35 53.0402 34.688 52.4002 34.064C51.7762 33.44 51.4642 32.528 51.4642 31.328V25.16H49.6882V22.4H50.5762C51.0562 22.4 51.3842 22.288 51.5602 22.064C51.7362 21.824 51.8242 21.488 51.8242 21.056V18.992H55.0162V22.4H57.5122V25.16H55.0162V32.24H57.3203V35H55.2083ZM65.382 35.288C64.422 35.288 63.566 35.136 62.814 34.832C62.062 34.512 61.422 34.072 60.894 33.512C60.382 32.936 59.99 32.24 59.718 31.424C59.462 30.608 59.334 29.696 59.334 28.688C59.334 27.696 59.462 26.8 59.718 26C59.974 25.184 60.35 24.488 60.846 23.912C61.358 23.336 61.982 22.896 62.718 22.592C63.454 22.272 64.294 22.112 65.238 22.112C66.278 22.112 67.166 22.288 67.902 22.64C68.654 22.992 69.262 23.464 69.726 24.056C70.206 24.648 70.55 25.336 70.758 26.12C70.982 26.888 71.094 27.696 71.094 28.544V29.6H63.006V29.792C63.006 30.624 63.23 31.288 63.678 31.784C64.126 32.264 64.83 32.504 65.79 32.504C66.526 32.504 67.126 32.36 67.59 32.072C68.054 31.768 68.486 31.408 68.886 30.992L70.662 33.2C70.102 33.856 69.366 34.368 68.454 34.736C67.558 35.104 66.534 35.288 65.382 35.288ZM65.31 24.728C64.59 24.728 64.022 24.968 63.606 25.448C63.206 25.912 63.006 26.536 63.006 27.32V27.512H67.422V27.296C67.422 26.528 67.246 25.912 66.894 25.448C66.558 24.968 66.03 24.728 65.31 24.728ZM73.8426 35V22.4H77.3946V25.136H77.5146C77.5786 24.784 77.6906 24.448 77.8506 24.128C78.0106 23.792 78.2186 23.496 78.4746 23.24C78.7466 22.984 79.0666 22.784 79.4346 22.64C79.8026 22.48 80.2346 22.4 80.7306 22.4H81.3546V25.712H80.4666C79.4266 25.712 78.6506 25.848 78.1386 26.12C77.6426 26.392 77.3946 26.896 77.3946 27.632V35H73.8426ZM87.3137 35C86.0977 35 85.2017 34.704 84.6257 34.112C84.0657 33.52 83.7857 32.664 83.7857 31.544V17.24H87.3377V32.24H88.9217V35H87.3137ZM93.0673 21.056C92.3473 21.056 91.8193 20.896 91.4833 20.576C91.1633 20.24 91.0033 19.816 91.0033 19.304V18.776C91.0033 18.264 91.1633 17.848 91.4833 17.528C91.8193 17.192 92.3473 17.024 93.0673 17.024C93.7873 17.024 94.3073 17.192 94.6273 17.528C94.9633 17.848 95.1313 18.264 95.1313 18.776V19.304C95.1313 19.816 94.9633 20.24 94.6273 20.576C94.3073 20.896 93.7873 21.056 93.0673 21.056ZM91.2913 22.4H94.8433V35H91.2913V22.4ZM98.3985 35V22.4H101.951V24.536H102.095C102.319 23.88 102.711 23.312 103.271 22.832C103.831 22.352 104.607 22.112 105.599 22.112C106.895 22.112 107.871 22.544 108.527 23.408C109.199 24.272 109.535 25.504 109.535 27.104V35H105.983V27.392C105.983 26.576 105.855 25.976 105.599 25.592C105.343 25.192 104.887 24.992 104.231 24.992C103.943 24.992 103.663 25.032 103.391 25.112C103.119 25.176 102.871 25.288 102.647 25.448C102.439 25.608 102.271 25.808 102.143 26.048C102.015 26.272 101.951 26.536 101.951 26.84V35H98.3985ZM112.935 17.24H116.487V27.728H116.631L118.191 25.4L120.711 22.4H124.647L120.447 27.224L125.127 35H120.903L118.071 29.672L116.487 31.448V35H112.935V17.24Z"
            fill="black" />
          <path d="M75 18C46.5179 5.92602 -7.65914 -10.9775 3.48921 18" stroke="black" stroke-width="3" />
          <path d="M75.2452 40C103.539 52.5091 157.451 70.241 146.748 41.096" stroke="black" , stroke-width="3" />
        </svg>

        <li>
          <a href="studentjobs.php" class="flex items-center p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-briefcase-business">
              <path d="M12 12h.01" />
              <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
              <path d="M22 13a18.15 18.15 0 0 1-20 0" />
              <rect width="20" height="14" x="2" y="6" rx="2" />
            </svg>
            <span class="ms-3">Jobs</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-app-window">
              <rect x="2" y="4" width="20" height="16" rx="2" />
              <path d="M10 4v4" />
              <path d="M2 8h20" />
              <path d="M6 4v4" />
            </svg>
            <span class="ms-3">Documents</span>
          </a>
        </li>
      </ul>
      <div>
        <a href="#" class="flex items-center p-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-log-out">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" x2="9" y1="12" y2="12" />
          </svg>
          <span class="ms-3 font-medium">Log out</span>
        </a>
      </div>
    </div>
  </aside>

  <div id="overlay" class="overlay"></div>

  <main
    class="max-w-[1920px] lg:ml-52 mt-10 md:ml-52 flex flex-col px-3 gap-10 lg:grid lg:grid-cols-3 lg:gap-4 mx-auto">
    <div
      class="lg:col-span-3 custom-shadow lg:row-span-1 flex flex-row mx-auto rounded-md w-[350px] min-h-20 lg:w-full lg:min-h-40 bg-profcard shadow-black lg:items-center">
      <div class="w-[20%] flex items-center justify-center">
        <img name="photo" id="photo" src="<?php echo $photo; ?>" alt="Profile Photo"
          class="w-[53px] h-[50px] lg:w-[135px] lg:h-[130px] object-cover" />
      </div>
      <div class="flex flex-col w-[50%] gap-2">
        <div>
          <h1 class="font-semibold lg:text-3xl"><?php echo $fullname; ?></h1>
          <p class="text-xs lg:text-xl"><?php echo $coursec; ?></p>

        </div>
        <div class="">
          <p class="text-[10px] font-light lg:text-xl">Address</p>
          <p class="text-[8px] font-medium lg:text-xl">
            <?php echo $location; ?>
          </p>
        </div>
      </div>
      <div class="flex flex-col justify-center gap-2 w-[30%]">
        <div class="flex flex-col">
          <p class="text-[10px] font-light lg:text-xl">Phone</p>
          <p class="text-[8px] font-medium lg:text-xl"><?php echo $phoneNo; ?></p>
        </div>
        <div class="flex flex-col">
          <p class="text-[10px] font-light lg:text-xl">Email Address</p>
          <p class="text-[8px] font-medium lg:text-xl"><?php echo $emailAddress; ?></p>
        </div>
      </div>
    </div>

    <div
      class="custom-shadow lg:col-span-2 lg:row-span-1 rounded-md w-[350px] lg:w-full mx-auto min-h-24 bg-profcard shadow-black p-2">
      <h3 class="text-[0.75rem] font-semibold lg:text-2xl">About me</h3>
      <p class="text-[0.625rem] lg:text-xl">
        <?php echo $aboutMe; ?>
      </p>
    </div>

    <div
      class="custom-shadow lg:col-span-1 lg:row-span-1 rounded-md w-[350px] lg:w-full mx-auto min-h-24 bg-profcard shadow-black p-2">
      <h3 class="text-[0.75rem] font-semibold lg:text-2xl">Skills</h3>
      <div class="flex flex-wrap w-full gap-2">

        <?php if (isset($skills) && !empty($skills)): ?>
          <?php foreach ($skills as $skill): ?>
            <?php $skillName = htmlspecialchars($skill['skillName']); ?>
            <div class="bg-button h-6 lg:h-8 rounded flex items-center justify-center px-2">
              <p class="text-center text-white text-xs lg:text-xl"><?php echo $skillName; ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No skills available.</p>
        <?php endif; ?>
      </div>


    </div>
    </div>

    <div
      class="custom-shadow lg:col-span-1 lg:row-span-1 rounded-md w-[350px] lg:w-full mx-auto min-h-24 bg-profcard shadow-black p-2">
      <h3 class="text-[0.75rem] font-semibold lg:text-2xl">Experience</h3>
      <div class="flex flex-row gap-2 lg:text-xl">
        <p><?php echo $experience; ?> </p>
      </div>
    </div>

    <div
      class="custom-shadow lg:col-span-2 lg:row-span-1 rounded-md w-[350px] lg:w-full mx-auto min-h-24 bg-profcard shadow-black p-2">
      <h3 class="text-[0.75rem] font-semibold lg:text-2xl">Documents</h3>
      <div class="flex flex-col gap-2">
        <div class="flex flex-col gap-2">
          <?php if (isset($documents) && !empty($documents)): ?>
            <?php
            // Track displayed documents to avoid duplication
            $displayedTypes = [];
            foreach ($documents as $document):
              $filename = isset($document['fileName']) ? htmlspecialchars($document['fileName']) : '';
              $type = pathinfo($filename, PATHINFO_FILENAME); // Use filename without extension for type
          
              // Skip if no filename or type
              if (!$filename || !$type)
                continue;

              // Ensure the type matches one of the document labels
              if (isset($documentLabels[$type]) && !in_array($type, $displayedTypes)):
                $displayedTypes[] = $type; // Track displayed document types
                $label = $documentLabels[$type];
                ?>
                <div class="flex flex-row gap-2">
                  <label for="<?php echo htmlspecialchars($type); ?>" class="text-[10px] lg:text-xl">
                    <?php echo $label; ?>:
                  </label>
                  <a href="./uploads/documents/<?php echo $filename; ?>" download
                    class="inline-block px-6 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-button border border-transparent rounded-lg hover:bg-button-dark focus:outline-none focus:shadow-outline">Download</a>
                </div>
                <?php
              endif;
            endforeach;
            ?>
          <?php else: ?>
            <p>No documents available.</p>
          <?php endif; ?>
        </div>


      </div>
    </div>
  </main>
  <?php if ($isProfileIncomplete): ?>
    <div class="overlay">
      <div class="overlay-content">
        <h2 class="text-2xl font-bold mb-4">Profile Incomplete</h2>
        <p class="mb-4">Please complete your profile to access all features.</p>
        <a href="edit-prof.php" class="px-4 py-2 bg-blue-500 text-white rounded">Set Up Profile</a>
      </div>
    </div>
  <?php endif; ?>
  <script>
    const sidebar = document.getElementById("default-sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const overlay = document.getElementById("overlay");

    sidebarToggle.addEventListener("click", () => {
      sidebar.classList.toggle("show");
      overlay.classList.toggle("show");
    });

    overlay.addEventListener("click", () => {
      sidebar.classList.remove("show");
      overlay.classList.remove("show");
    });

    document.addEventListener("click", (event) => {
      if (
        !sidebar.contains(event.target) &&
        !sidebarToggle.contains(event.target) &&
        sidebar.classList.contains("show")
      ) {
        sidebar.classList.remove("show");
        overlay.classList.remove("show");
      }
    });

    document
      .querySelector(".custom-profile")
      .addEventListener("click", function () {
        const dropdownMenu = document.getElementById("custom-dropdownMenu");
        dropdownMenu.classList.toggle("custom-hidden");
      });
  </script>
  <script src="../js/notif.js"></script>
</body>

</html>