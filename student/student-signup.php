<?php
session_start();
include '../db.php';

function sanitize_input($data)
{
  return htmlspecialchars(stripslashes(trim($data)));
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $firstname = isset($_POST['fName']) ? sanitize_input($_POST['fName']) : '';
  $middlename = isset($_POST['mName']) ? sanitize_input($_POST['mName']) : '';
  $lastname = isset($_POST['lName']) ? sanitize_input($_POST['lName']) : '';
  $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
  $studNumber = isset($_POST['studNumber']) ? sanitize_input($_POST['studNumber']) : '';
  $DoB = isset($_POST['DoB']) ? sanitize_input($_POST['DoB']) : '';
  $section = isset($_POST['section']) ? sanitize_input($_POST['section']) : '';
  $course = isset($_POST['course']) ? sanitize_input($_POST['course']) : '';
  $role = isset($_POST['role']) ? sanitize_input($_POST['role']) : '';
  $password = isset($_POST['pw']) ? $_POST['pw'] : '';

  if (!preg_match("/^[a-zA-Z']+$/", $firstname)) {
    $errors[] = "Invalid first name";
  }
  if (!empty($middlename) && !preg_match("/^[a-zA-Z'-]+$/", $middlename)) {
    $errors[] = "Invalid middle name";
  }
  if (!preg_match("/^[a-zA-Z']+$/", $lastname)) {
    $errors[] = "Invalid last name";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  }
  if (!preg_match("/^[a-zA-Z0-9\-]+$/", $studNumber)) {
    $errors[] = "Invalid student number";
  }
  if (!preg_match("/^[a-zA-Z0-9 ]+$/", $course)) {
    $errors[] = "Invalid course";
  }
  if (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters long";
  }


  if (empty($errors)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $conn->begin_transaction();
    try {

      $stmt = $conn->prepare("INSERT INTO user (firstName, middleName, lastName, EmailAddress, userRole, password) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssss", $firstname, $middlename, $lastname, $email, $role, $hashed_password);

      if ($stmt->execute()) {
        $user_id = $stmt->insert_id;


        $stmt_student = $conn->prepare("INSERT INTO student (userId, studentNo, dob, section, course) VALUES (?, ?, ?, ?, ?)");
        $stmt_student->bind_param("issss", $user_id, $studNumber, $DoB, $section, $course);

        if ($stmt_student->execute()) {
          $conn->commit();
          echo "Registration successful!";
          header("Location:login.php");
        } else {
          $conn->rollback();
          echo "Error: " . $stmt_student->error;
        }

        $stmt_student->close();
      } else {
        $conn->rollback();
        echo "Error: " . $stmt->error;
      }

      $stmt->close();
    } catch (Exception $e) {
      $conn->rollback();
      echo "Error: " . $e->getMessage();
    }

    $conn->close();
  } else {
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
  }
}
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
            input: "#D0C7C7",
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
      transform: translateX(100%);
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

    .custom-border {
      border: 1px solid #d0c7c7;
      border-radius: 4px;
    }

    .mini-card {
      width: 130px;
      height: 80px;
      background-color: white;
      border-radius: 6px;
    }

    .custom-shadow {
      box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.75);
      -webkit-box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.75);
      -moz-box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.75);
    }
  </style>

  <title>InterLink</title>

<body class="max-w-[1920px] font-sans">
  <nav class="flex flex-row w-full lg:px-10 lg:py-4 px-4 py-4 justify-between mx-auto items-center">
    <div>
      <h1 class="font-semibold text-xl lg:text-2xl">InterLink</h1>
    </div>
    <div class="lg:hidden">
      <svg onclick="toggleMenu()" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="lucide lucide-menu">
        <line x1="4" x2="20" y1="12" y2="12" />
        <line x1="4" x2="20" y1="6" y2="6" />
        <line x1="4" x2="20" y1="18" y2="18" />
      </svg>
    </div>
    <div class="hidden lg:block">
      <ul class="flex flex-row gap-10 font-medium">
        <li>About</li>
        <li>Students</li>
        <li>Employer</li>
      </ul>
    </div>
  </nav>
  <div id="sidebar"
    class="sidebar fixed top-0 right-0 w-64 h-full bg-white shadow-xl z-50 transition-transform duration-300 ease-in-out lg:hidden">
    <div class="p-4 flex justify-between items-center">
      <button class="text-black items-start" onclick="toggleMenu()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
          <line x1="18" x2="6" y1="6" y2="18" />
          <line x1="6" x2="18" y1="6" y2="18" />
        </svg>
      </button>
    </div>
    <ul class="flex flex-col p-4 space-y-4">
      <li>About</li>
      <li>Students</li>
      <li>Employer</li>
    </ul>
  </div>
  <main class="w-full flex flex-col mx-auto gap-2">
    <div class="w-[90%] mx-auto flex flex-col justify-center items-center">
      <h1 class="text-[1.2rem] font-bold lg:text-4xl">CREATE AN ACCOUNT</h1>
      <p class="text-[.5rem] text-center lg:text-sm">
        Register now and discover the perfect OJT opportunity tailored to
        your skills.
      </p>
    </div>

    <form action="" method="post" class="flex flex-col items-center w-[90%] mx-auto">
      <div class="flex flex-col gap-4 mt-2 items-center">
        <div class="flex flex-row w-full gap-6">
          <div class="w-[160px] h-[30px] flex flex-col lg:w-[220px]">
            <label for="fName" class="text-sm font-medium">First name</label>
            <input type="text" name="fName" class="custom-border w-full h-full" pattern="[a-zA-Z']+"
              title="First name should contain only letters, hyphens, and apostrophes." />
          </div>
          <div class="w-[160px] h-[30px] flex flex-col lg:w-[220px]">
            <label for="mName" class="text-sm font-medium">Middle name</label>
            <input type="text" name="mName" class="custom-border w-full h-full" pattern="[a-zA-Z'-]+"
              title="Middle name should contain only letters, hyphens, and apostrophes." />
          </div>
        </div>
        <div class="flex flex-row w-full gap-6">
          <div class="w-[160px] h-[30px] flex flex-col lg:w-[220px]">
            <label for="lName" class="text-sm font-medium">Last name</label>
            <input type="text" name="lName" class="custom-border w-full h-full" pattern="[a-zA-Z']+"
              title="Last name should contain only letters, hyphens, and apostrophes." />
          </div>
          <div class="w-[160px] h-[30px] flex flex-col lg:w-[220px]">
            <label for="studNumber" class="text-sm font-medium">Student number</label>
            <input type="text" name="studNumber" class="custom-border w-full h-full" pattern="[a-zA-Z0-9\-]+"
              title="Student number should contain only letters, numbers, and hyphens." />
          </div>
        </div>
        <div class="flex flex-row w-full gap-6">
          <div class="w-[160px] h-[45px] flex flex-col lg:w-[220px]">
            <label for="DoB" class="text-sm font-medium">Date of Birth</label>
            <input type="date" name="DoB" class="custom-border w-full h-full" />
          </div>
          <div class="w-[160px] h-[40px] flex flex-col lg:w-[220px]">
            <label for="section" class="text-sm font-medium">Section</label>
            <select name="section" class="custom-border w-full h-full">
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
              <option value="E">E</option>
              <option value="F">F</option>
              <option value="G">G</option>
              <option value="H">H</option>
              <option value="I">I</option>
              <option value="J">J</option>
              <option value="K">K</option>
              <option value="L">L</option>
              <option value="M">M</option>
              <option value="N">N</option>
            </select>
          </div>
        </div>
      </div>
      <div class="flex flex-col gap-4 mt-2 w-full items-center">
        <div class="w-[335px] h-[40px] flex flex-col lg:w-[465px]">
          <label for="course" class="text-sm font-medium">Course</label>
          <select name="course" id="course" class="w-full custom-border">
            <option value="Bachelor Of Science in Information Technology">Bachelor Of Science in Information Technology
            </option>
            <option value="Bachelor of Science in Architecture">Bachelor of Science in Architecture</option>
            <option value="Bachelor of Science in Criminology">Bachelor of Science in Criminology</option>
            <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
            <option value="Bachelor of Physical Education">Bachelor of Physical Education</option>
            <option value="Bachelor of Secondary Education">Bachelor of Secondary Education</option>
            <option value="Bachelor of Technology and Livelihood Education">Bachelor of Technology and Livelihood
              Education</option>
            <option value="Bachelor of Science in Industrial Education">Bachelor of Science in Industrial Education
            </option>
            <option value="Bachelor of Science in Physical Education">Bachelor of Science in Physical Education</option>
            <option value="Bachelor of Science in Civil Engineering">Bachelor of Science in Civil Engineering</option>
            <option value="Bachelor of Science in Electrical Engineering">Bachelor of Science in Electrical Engineering
            </option>
            <option value="Bachelor of Science in Mechanical Engineering">Bachelor of Science in Mechanical Engineering
            </option>
            <option value="Bachelor of Science in Business Administration">Bachelor of Science in Business
              Administration</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship</option>
            <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management
            </option>
            <option value="Bachelor of Science in Tourism Management">Bachelor of Science in Tourism Management</option>
            <option value="Bachelor of Science in Hotel And Restaurant Management">Bachelor of Science in Hotel And
              Restaurant Management</option>
            <option value="Bachelor of Public Administration">Bachelor of Public Administration</option>
          </select>

        </div>
        <div class="w-[335px] h-[40px] flex flex-col lg:w-[465px]">
          <label for="" class="text-sm font-medium">Role</label>
          <select name="role" id="role" class="w-full custom-border  ">

            <option value="student" class="text-[.5rem] lg:text-sm">Student</option>
            <option value="employer" class="text-[.5rem]  lg:text-sm">Employer</option>
          </select>
        </div>
        <div class="w-[335px] h-[40px] flex flex-col lg:w-[465px]">
          <label for="email" class="text-sm font-medium">Email Address</label>
          <input type="email" name="email" id="email" class="custom-border" />
        </div>
        <div class="w-[335px] h-[40px] flex flex-col lg:w-[465px]">
          <label for="pw" class="text-sm font-medium">Password</label>
          <input type="password" name="pw" id="pw" class="custom-border" />
        </div>

        <button type="submit"
          class="font-semibold bg-fontColor w-[150px] lg:w-[190px] text-white py-2 rounded-md hover:bg-gray-700 transition duration-200 ease-in-out">Sign
          Up</button>
      </div>
      <div class="mt-4 flex flex-col items-center gap-2">
        <span class="text-[12px]">Or sign up using</span>
        <svg width="30" height="30" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg"
          class="lg:w-[40px] lg:h-[40px]">
          <rect x="1" y="0.5" width="51" height="51" rx="4.5" fill="#FF0000" stroke="black" />
          <g clip-path="url(#clip0_58_347)">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M21.5 25V27.4H25.47C25.31 28.429 24.27 30.42 21.5 30.42C19.11 30.42 17.16 28.441 17.16 26C17.16 23.56 19.11 21.58 21.5 21.58C22.86 21.58 23.77 22.16 24.29 22.66L26.19 20.83C24.97 19.69 23.39 19 21.5 19C17.63 19 14.5 22.13 14.5 26C14.5 29.87 17.63 33 21.5 33C25.54 33 28.221 30.16 28.221 26.16C28.221 25.7 28.17 25.35 28.11 25H21.5ZM38.5 27H35.5V30H33.5V27H30.5V25H33.5V22H35.5V25H38.5V27Z"
              fill="white" />
          </g>
          <defs>
            <clipPath id="clip0_58_347">
              <rect width="24" height="24" fill="white" transform="translate(14.5 14)" />
            </clipPath>
          </defs>
        </svg>
        <span class="text-[12px]">Already have an account? <a href=""><b>Log In</b></a></span>
      </div>
    </form>

  </main>

  <script src="../js/burgermenu.js"></script>
</body>
</head>

</html>