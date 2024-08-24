<?php
session_start();
include 'db.php';


function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validate_password($password) {
    return !empty($password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['pw']);

    $errors = [];

    if (!validate_email($email)) {
        $errors[] = "Invalid email format";
    }

    if (!validate_password($password)) {
        $errors[] = "Password cannot be empty";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT u.UserId, u.firstName, u.emailAddress, u.password, 
                                       s.StudentId, c.CompanyId, co.CoordinatorId
                                FROM user u
                                LEFT JOIN student s ON s.UserId = u.UserId
                                LEFT JOIN company c ON c.UserId = u.UserId
                                LEFT JOIN coordinator co ON co.UserId = u.UserId
                                WHERE u.emailAddress = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $firstname, $email, $hashed_password, $studentId, $companyId, $coordinatorId);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['email'] = $email;

                if ($studentId) {
                    $_SESSION['StudentId'] = $studentId;
                    $_SESSION['user_type'] = 'student';
                    header("Location: studentprof.php");
                } elseif ($companyId) {
                    $_SESSION['CompanyId'] = $companyId;
                    $_SESSION['user_type'] = 'company';
                    header("Location: ./company/jobposting.php");
                } elseif ($coordinatorId) {
                    $_SESSION['CoordinatorId'] = $coordinatorId;
                    $_SESSION['user_type'] = 'coordinator';
                    header("Location: ./coordinator/job.php");
                } else {
                    $errors[] = "User role not found";
                }
            } else {
                $errors[] = "Invalid email or password";
            }
        } else {
            $errors[] = "Invalid email or password";
        }
        $stmt->close();
    }
    $conn->close();

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: studentprof.php");
        exit();
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
      rel="stylesheet"
    />
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
  </head>
  <body class="font-sans max-w-[1920px]">
    <nav
      class="flex flex-row w-full lg:px-10 lg:py-4 px-4 py-4 justify-between mx-auto items-center"
    >
      <div><h1 class="font-semibold text-xl lg:text-2xl">InterLink</h1></div>
      <div class="lg:hidden">
        <svg
          onclick="toggleMenu()"
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="lucide lucide-menu"
        >
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
    <div
      id="sidebar"
      class="sidebar fixed top-0 right-0 w-64 h-full bg-white shadow-xl z-50 transition-transform duration-300 ease-in-out lg:hidden"
    >
      <div class="p-4 flex justify-between items-center">
        <button class="text-black items-start" onclick="toggleMenu()">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-x"
          >
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
      <div
        class="w-full flex flex-row items-center justify-center py-2 px-8 gap-40"
      >
        <div class="hidden lg:block lg:w-[564.85px] h-[653.01px]">
          <img src="./img/Group 233.png" alt="" class="w-full h-full" />
        </div>
        <form action="" method="post" class="flex flex-col items-center lg:w-[30%] gap-4">
          <h1 class="text-2xl font-bold lg:text-4xl">Welcome Back!</h1>
   <?php if (isset($_SESSION['errors'])): ?>
                <div class="text-red-500">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>


<div class="w-[200px] h-[40px] flex flex-col lg:w-full lg:h-[55px] relative">
  <label for="email" class="text-sm font-medium">Email address</label>
  <input
    type="email"
    name="email"
    id="email"
    class="custom-border w-full h-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
  />
  <span id="emailError" class="text-red-500 text-xs mt-1 hidden">Invalid email address</span>
</div>

<div class="w-[200px] h-[40px] flex flex-col lg:w-full lg:h-[55px] relative">
  <label for="password" class="text-sm font-medium">Password</label>
  <input
    type="password"
    name="pw"
    id="password"
    class="custom-border w-full h-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
  />
  <span id="togglePassword" class="absolute inset-y-0 right-3 top-5 flex items-center cursor-pointer">
    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
  </span>
  <span id="passwordError" class="text-red-500 text-xs mt-1 hidden">Invalid password</span>
</div>

<button type="submit" class="font-semibold bg-fontColor w-[150px] lg:w-[300px] text-white py-2 rounded-md hover:bg-gray-700 transition duration-200 ease-in-out">Log In</button>


            <span class="text-[12px]">Or sign in using</span>

            <svg
              width="30"
              height="30"
              viewBox="0 0 53 52"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              class="lg:w-[40px] lg:h-[40px]"
            >
              <rect
                x="1"
                y="0.5"
                width="51"
                height="51"
                rx="4.5"
                fill="#FF0000"
                stroke="black"
              />
              <g clip-path="url(#clip0_58_347)">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M21.5 25V27.4H25.47C25.31 28.429 24.27 30.42 21.5 30.42C19.11 30.42 17.16 28.441 17.16 26C17.16 23.56 19.11 21.58 21.5 21.58C22.86 21.58 23.77 22.16 24.29 22.66L26.19 20.83C24.97 19.69 23.39 19 21.5 19C17.63 19 14.5 22.13 14.5 26C14.5 29.87 17.63 33 21.5 33C25.54 33 28.221 30.16 28.221 26.16C28.221 25.7 28.17 25.35 28.11 25H21.5ZM38.5 27H35.5V30H33.5V27H30.5V25H33.5V22H35.5V25H38.5V27Z"
                  fill="white"
                />
              </g>
              <defs>
                <clipPath id="clip0_58_347">
                  <rect
                    width="24"
                    height="24"
                    fill="white"
                    transform="translate(14.5 14)"
                  />
                </clipPath>
              </defs>
            </svg>
            <span class="text-[12px] lg:text-sm">
              Don’t have an account? <a href="student-signup.php" class="text-black font-bold">
               Register now!</a></span
            >
          </div>
        </form>
      </div>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const togglePassword = document.getElementById('togglePassword');
    const submitButton = document.querySelector('button[type="submit"]');

    let passwordVisible = false;

    // Toggle password visibility
    togglePassword.addEventListener('click', function () {
        passwordVisible = !passwordVisible;
        if (passwordVisible) {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2.062 12.348a10.75 10.75 0 0 1 19.876 0"/><path d="M12 12a3 3 0 0 0 3 3"/></svg>`;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>`;
        }
    });

    function validateForm() {
        let valid = true;

        if (emailInput.value.trim() === "") {
            emailError.textContent = "Email cannot be empty";
            emailError.classList.remove('hidden');
            valid = false;
        } else {
            emailError.classList.add('hidden');
        }

        if (passwordInput.value.trim() === "") {
            passwordError.textContent = "Password cannot be empty";
            passwordError.classList.remove('hidden');
            valid = false;
        } else {
            passwordError.classList.add('hidden');
        }

        return valid;
    }

    submitButton.addEventListener('click', function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
});
</script>
  </body>
</html>
