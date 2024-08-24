<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="icon" href="./img/Group 236.svg" type="image/x-icon" />
    <link
      href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
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
      <div>
        <svg
          width="150"
          height="59"
          viewBox="0 0 150 59"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M25.2 35V32.096H27.36V21.152H25.2V18.248H33.168V21.152H31.008V32.096H33.168V35H25.2ZM36.2554 35V22.4H39.8074V24.536H39.9514C40.1754 23.88 40.5674 23.312 41.1274 22.832C41.6874 22.352 42.4634 22.112 43.4554 22.112C44.7514 22.112 45.7274 22.544 46.3834 23.408C47.0554 24.272 47.3914 25.504 47.3914 27.104V35H43.8394V27.392C43.8394 26.576 43.7114 25.976 43.4554 25.592C43.1994 25.192 42.7434 24.992 42.0874 24.992C41.7994 24.992 41.5194 25.032 41.2474 25.112C40.9754 25.176 40.7274 25.288 40.5034 25.448C40.2954 25.608 40.1274 25.808 39.9994 26.048C39.8714 26.272 39.8074 26.536 39.8074 26.84V35H36.2554ZM55.2083 35C53.9762 35 53.0402 34.688 52.4002 34.064C51.7762 33.44 51.4642 32.528 51.4642 31.328V25.16H49.6882V22.4H50.5762C51.0562 22.4 51.3842 22.288 51.5602 22.064C51.7362 21.824 51.8242 21.488 51.8242 21.056V18.992H55.0162V22.4H57.5122V25.16H55.0162V32.24H57.3203V35H55.2083ZM65.382 35.288C64.422 35.288 63.566 35.136 62.814 34.832C62.062 34.512 61.422 34.072 60.894 33.512C60.382 32.936 59.99 32.24 59.718 31.424C59.462 30.608 59.334 29.696 59.334 28.688C59.334 27.696 59.462 26.8 59.718 26C59.974 25.184 60.35 24.488 60.846 23.912C61.358 23.336 61.982 22.896 62.718 22.592C63.454 22.272 64.294 22.112 65.238 22.112C66.278 22.112 67.166 22.288 67.902 22.64C68.654 22.992 69.262 23.464 69.726 24.056C70.206 24.648 70.55 25.336 70.758 26.12C70.982 26.888 71.094 27.696 71.094 28.544V29.6H63.006V29.792C63.006 30.624 63.23 31.288 63.678 31.784C64.126 32.264 64.83 32.504 65.79 32.504C66.526 32.504 67.126 32.36 67.59 32.072C68.054 31.768 68.486 31.408 68.886 30.992L70.662 33.2C70.102 33.856 69.366 34.368 68.454 34.736C67.558 35.104 66.534 35.288 65.382 35.288ZM65.31 24.728C64.59 24.728 64.022 24.968 63.606 25.448C63.206 25.912 63.006 26.536 63.006 27.32V27.512H67.422V27.296C67.422 26.528 67.246 25.912 66.894 25.448C66.558 24.968 66.03 24.728 65.31 24.728ZM73.8426 35V22.4H77.3946V25.136H77.5146C77.5786 24.784 77.6906 24.448 77.8506 24.128C78.0106 23.792 78.2186 23.496 78.4746 23.24C78.7466 22.984 79.0666 22.784 79.4346 22.64C79.8026 22.48 80.2346 22.4 80.7306 22.4H81.3546V25.712H80.4666C79.4266 25.712 78.6506 25.848 78.1386 26.12C77.6426 26.392 77.3946 26.896 77.3946 27.632V35H73.8426ZM87.3137 35C86.0977 35 85.2017 34.704 84.6257 34.112C84.0657 33.52 83.7857 32.664 83.7857 31.544V17.24H87.3377V32.24H88.9217V35H87.3137ZM93.0673 21.056C92.3473 21.056 91.8193 20.896 91.4833 20.576C91.1633 20.24 91.0033 19.816 91.0033 19.304V18.776C91.0033 18.264 91.1633 17.848 91.4833 17.528C91.8193 17.192 92.3473 17.024 93.0673 17.024C93.7873 17.024 94.3073 17.192 94.6273 17.528C94.9633 17.848 95.1313 18.264 95.1313 18.776V19.304C95.1313 19.816 94.9633 20.24 94.6273 20.576C94.3073 20.896 93.7873 21.056 93.0673 21.056ZM91.2913 22.4H94.8433V35H91.2913V22.4ZM98.3985 35V22.4H101.951V24.536H102.095C102.319 23.88 102.711 23.312 103.271 22.832C103.831 22.352 104.607 22.112 105.599 22.112C106.895 22.112 107.871 22.544 108.527 23.408C109.199 24.272 109.535 25.504 109.535 27.104V35H105.983V27.392C105.983 26.576 105.855 25.976 105.599 25.592C105.343 25.192 104.887 24.992 104.231 24.992C103.943 24.992 103.663 25.032 103.391 25.112C103.119 25.176 102.871 25.288 102.647 25.448C102.439 25.608 102.271 25.808 102.143 26.048C102.015 26.272 101.951 26.536 101.951 26.84V35H98.3985ZM112.935 17.24H116.487V27.728H116.631L118.191 25.4L120.711 22.4H124.647L120.447 27.224L125.127 35H120.903L118.071 29.672L116.487 31.448V35H112.935V17.24Z"
            fill="black"
          />
          <path
            d="M75 18C46.5179 5.92602 -7.65914 -10.9775 3.48921 18"
            stroke="black"
            stroke-width="3"
          />
          <path
            d="M75.2452 40C103.539 52.5091 157.451 70.241 146.748 41.096"
            stroke="black"
            stroke-width="3"
          />
        </svg>
      </div>
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
    <main>
      <div
        class="w-full mx-auto flex flex-col lg:flex-row items-center justify-center gap-10 p-6 lg:px-10"
      >
        <div
          class="flex flex-col items-center lg:items-start lg:gap-8 justify-center gap-16 lg:w-[50%] m-14"
        >
          <h1
            class="font-bold text-center text-5xl lg:text-start lg:w-[65%] lg:leading-tight"
          >
            Charting Journeys, Igniting Passions, and Sculpting Futures.
          </h1>
          <button
            class="bg-fontColor text-white py-1.5 px-4 rounded-md font-medium text-sm lg:text-lg lg:py-3 lg:px-10"
          >
            Learn More
          </button>
        </div>
        <div
          class="w-[272.67px] h-[278px] mx-auto mt-10 lg:w-[500px] lg:h-[500px]"
        >
          <img src="./img/bnew.png" alt="" class="w-full h-full" />
        </div>
      </div>
      <div
        class="w-full mx-auto flex flex-col lg:flex-row items-center justify-center mt-10 p-6 lg:mt-20 lg:justify-evenly"
      >
        <div class="custom-card bg-card1 shadow-2xl lg:w-[350px] lg:h-[200px]">
          <div>
            <img
              src="./img/jp.png"
              alt=""
              class="w-[50px] h-[50px] lg:w-[60px] lg:h-[60px]"
            />
          </div>
          <div class="mt-3.5">
            <h3 class="font-semibold text-base lg:text-xl">Job Placement</h3>
            <p class="font-normal text-[12px] leading-3 lg:text-base">
              We will help you get placed in the best companies in the industry.
            </p>
          </div>
        </div>
        <div class="custom-card bg-card2 shadow-2xl lg:w-[350px] lg:h-[200px]">
          <div>
            <img
              src="./img/cc.png"
              alt=""
              class="w-[50px] h-[50px] lg:w-[60px] lg:h-[60px]"
            />
          </div>
          <div class="mt-3.5">
            <h3 class="font-semibold text-base lg:text-xl">
              Career Counselling
            </h3>
            <p class="font-normal text-[12px] leading-3 lg:text-base">
              Our experts will help you choose the right career path for you.
            </p>
          </div>
        </div>
        <div class="custom-card bg-card3 shadow-2xl lg:w-[350px] lg:h-[200px]">
          <div>
            <img
              src="./img/sd.png"
              alt=""
              class="w-[50px] h-[50px] lg:w-[60px] lg:h-[60px]"
            />
          </div>
          <div class="mt-3.5">
            <h3 class="font-semibold text-base lg:text-xl">
              Skill Development
            </h3>
            <p class="font-normal text-[12px] leading-3 lg:text-base">
              We provide you with the best On-The-Job Training position to
              develop your skills.
            </p>
          </div>
        </div>
      </div>
      <div
        class="flex flex-col items-center justify-center p-6 lg:flex-row-reverse"
      >
        <div class="mt-10 lg:w-[50%]">
          <h3 class="font-semibold text-xl lg:text-2xl">
            Skill-Based Matching
          </h3>
          <p class="font-medium text-sm lg:text-lg">
            "Our coordinators are committed to using our skill-based matching
            features to help individuals find the perfect fit for their talents.
            Whether you're a student seeking an OJT opportunity or an employer
            looking for the ideal candidate, we ensure the match goes beyond
            qualifications, considering skills, experiences, and preferences of
            both parties."
          </p>
        </div>
        <div><img src="./img/sbm2.png" alt="" /></div>
      </div>
      <div
        class="bg-card4 w-full p-6 lg:py-6 lg:px-1 mt-10 flex flex-col items-center lg:flex-row justify-center gap-10"
      >
        <div class="lg:w-[45%]">
          <h3 class="lg:text-3xl">
            "Discover your ideal OJT opportunity that matches your skills
            perfectly with our assistance."
          </h3>
        </div>
        <div class="grid grid-cols-2 grid-rows-2 gap-4 p-4 lg:gap-8">
          <div
            class="mini-card py-1 px-2 flex flex-col gap-2 lg:gap-4 custom-shadow lg:w-[200px] lg:h-[120px]"
          >
            <div class="">
              <svg
                width="30"
                height="30"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="lg:w-[50px] lg:h-[50px]"
              >
                <path
                  opacity="0.5"
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M9.01417 18.6298H12.3475C15.4902 18.6298 17.0616 18.6298 18.0378 17.6535C19.0142 16.6772 19.0142 15.1058 19.0142 11.9631V11.5989C19.0142 10.8716 19.0142 10.3251 18.9787 9.87988H15.6808H15.6018C14.6875 9.87997 13.8796 9.88005 13.2283 9.79247C12.5223 9.69755 11.8165 9.47963 11.2405 8.90355C10.6644 8.32752 10.4465 7.6217 10.3516 6.91577C10.264 6.2645 10.2641 5.45653 10.2642 4.54228L10.2718 2.18028C10.2721 2.11158 10.278 2.04363 10.2892 1.97702C9.94867 1.96313 9.544 1.96313 9.039 1.96313C5.87975 1.96313 4.30013 1.96313 3.32381 2.93944C2.3475 3.91576 2.3475 5.4871 2.3475 8.6298V11.9631C2.3475 15.1058 2.3475 16.6772 3.32381 17.6535C4.30013 18.6298 5.87147 18.6298 9.01417 18.6298Z"
                  fill="#1C274C"
                />
                <path
                  d="M9.59935 12.1827C9.7206 11.8595 9.55685 11.4993 9.2336 11.3781C8.91043 11.2569 8.55017 11.4206 8.42897 11.7439L7.17897 15.0772C7.05777 15.4004 7.22153 15.7606 7.54473 15.8818C7.86793 16.003 8.22819 15.8393 8.34939 15.516L9.59935 12.1827Z"
                  fill="#1C274C"
                />
                <path
                  d="M6.95612 12.405C7.2002 12.1609 7.2002 11.7653 6.95612 11.5212C6.71205 11.2771 6.31631 11.2771 6.07224 11.5212L5.2389 12.3545C4.99483 12.5986 4.99483 12.9943 5.2389 13.2384L6.07224 14.0717C6.31631 14.3158 6.71205 14.3158 6.95612 14.0717C7.2002 13.8276 7.2002 13.4319 6.95612 13.1879L6.56473 12.7964L6.95612 12.405Z"
                  fill="#1C274C"
                />
                <path
                  d="M10.7061 13.1879C10.462 12.9439 10.0663 12.9439 9.82225 13.1879C9.57817 13.432 9.57817 13.8277 9.82225 14.0718L10.2136 14.4632L9.82225 14.8546C9.57817 15.0987 9.57817 15.4944 9.82225 15.7384C10.0663 15.9825 10.462 15.9825 10.7061 15.7384L11.5394 14.9051C11.7835 14.661 11.7835 14.2654 11.5394 14.0213L10.7061 13.1879Z"
                  fill="#1C274C"
                />
                <path
                  d="M10.2718 2.17988L10.2642 4.54188C10.2641 5.45613 10.264 6.26411 10.3516 6.91538C10.4465 7.62131 10.6644 8.32713 11.2405 8.90322C11.8166 9.47922 12.5223 9.69713 13.2283 9.79205C13.8796 9.87963 14.6875 9.87955 15.6017 9.87947H18.9787C18.989 10.0091 18.9963 10.1473 19.0015 10.2961H19.0142C19.0142 10.0731 19.0142 9.96172 19.0059 9.83047C18.9587 9.08505 18.6489 8.23084 18.2071 7.62857C18.1293 7.52255 18.0761 7.45891 17.9697 7.33162C17.3093 6.54112 16.44 5.55641 15.6808 4.87941C15.0052 4.27684 14.0797 3.6176 13.2726 3.07855C12.5792 2.61543 12.2325 2.38386 11.7571 2.21175C11.6311 2.16613 11.4648 2.11573 11.3347 2.08368C11.0147 2.00491 10.7032 1.97751 10.2642 1.96802L10.2718 2.17988Z"
                  fill="#1C274C"
                />
              </svg>
            </div>
            <div class="flex flex-row items-center gap-2 lg:px-1 lg:gap-4">
              <h3 class="font-semibold text-xs lg:text-base">DEVELOPER</h3>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-move-right lg:w-[24px] lg:h-[24px]"
              >
                <path d="M18 8L22 12L18 16" />
                <path d="M2 12H22" />
              </svg>
            </div>
          </div>
          <div
            class="mini-card mini-card py-1 px-2 flex flex-col gap-2 lg:gap-4 custom-shadow lg:w-[200px] lg:h-[120px]"
          >
            <div>
              <svg
                width="30"
                height="30"
                viewBox="0 0 50 51"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="lg:w-[50px] lg:h-[50px]"
              >
                <path
                  opacity="0.5"
                  d="M25 46.228C36.506 46.228 45.8334 36.9006 45.8334 25.3947C45.8334 13.8887 36.506 4.56134 25 4.56134C13.4941 4.56134 4.16669 13.8887 4.16669 25.3947C4.16669 36.9006 13.4941 46.228 25 46.228Z"
                  fill="#1C274C"
                />
                <path
                  d="M29.0127 30.1901C29.5231 29.7919 29.986 29.329 30.9119 28.4032L42.4542 16.8608C42.7333 16.5817 42.6056 16.1011 42.2327 15.9717C40.8704 15.4991 39.0979 14.6116 37.4402 12.9537C35.7823 11.2958 34.8948 9.52353 34.4221 8.16108C34.2927 7.78824 33.8121 7.66051 33.5331 7.93958L21.9906 19.482C21.0648 20.4079 20.6018 20.8708 20.2037 21.3813C19.7341 21.9834 19.3314 22.6349 19.0029 23.3242C18.7244 23.9086 18.5174 24.5297 18.1033 25.7717L17.5683 27.3769L16.7176 29.929L15.9199 32.3222C15.7161 32.9334 15.8752 33.6074 16.3308 34.063C16.7865 34.5186 17.4604 34.6778 18.0717 34.474L20.4648 33.6763L23.0169 32.8255L24.6221 32.2905C25.8642 31.8765 26.4852 31.6694 27.0696 31.3909C27.759 31.0624 28.4104 30.6599 29.0127 30.1901Z"
                  fill="#1C274C"
                />
                <path
                  d="M46.0681 13.2468C48.5317 10.7833 48.5317 6.78913 46.0681 4.32561C43.6046 1.86208 39.6104 1.86208 37.1471 4.32561L36.7758 4.6967C36.4179 5.05478 36.2556 5.55494 36.345 6.05338C36.4012 6.36692 36.5056 6.82534 36.6954 7.37234C37.075 8.46628 37.7917 9.9023 39.1417 11.2522C40.4914 12.6022 41.9275 13.3189 43.0214 13.6984C43.5685 13.8882 44.0269 13.9925 44.3404 14.0488C44.8389 14.1382 45.3389 13.976 45.6971 13.6179L46.0681 13.2468Z"
                  fill="#1C274C"
                />
              </svg>
            </div>
            <div class="flex flex-row items-center gap-2 lg:px-1 lg:gap-4">
              <h3 class="font-semibold text-xs lg:text-base">DESIGNER</h3>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-move-right lg:w-[24px] lg:h-[24px]"
              >
                <path d="M18 8L22 12L18 16" />
                <path d="M2 12H22" />
              </svg>
            </div>
          </div>
          <div
            class="mini-card mini-card py-1 px-2 flex flex-col gap-2 lg:gap-4 custom-shadow lg:w-[200px] lg:h-[120px]"
          >
            <div>
              <svg
                width="30"
                height="30"
                viewBox="0 0 50 50"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="lg:w-[50px] lg:h-[50px]"
              >
                <path
                  d="M25 21.228C34.2048 21.228 41.6666 17.497 41.6666 12.8947C41.6666 8.2923 34.2048 4.56134 25 4.56134C15.7952 4.56134 8.33331 8.2923 8.33331 12.8947C8.33331 17.497 15.7952 21.228 25 21.228Z"
                  fill="#1C274C"
                />
                <path
                  opacity="0.5"
                  d="M8.33331 25.3947V37.8947C8.33331 42.4969 15.7952 46.228 25 46.228C34.2048 46.228 41.6666 42.4969 41.6666 37.8947V25.3947C41.6666 29.9969 34.2048 33.728 25 33.728C15.7952 33.728 8.33331 29.9969 8.33331 25.3947Z"
                  fill="#1C274C"
                />
                <path
                  opacity="0.7"
                  d="M8.33331 12.8947V25.3947C8.33331 29.9969 15.7952 33.728 25 33.728C34.2048 33.728 41.6666 29.9969 41.6666 25.3947V12.8947C41.6666 17.497 34.2048 21.228 25 21.228C15.7952 21.228 8.33331 17.497 8.33331 12.8947Z"
                  fill="#1C274C"
                />
              </svg>
            </div>
            <div class="flex flex-row items-center gap-2 lg:gap-4 lg:px-1">
              <h3 class="font-semibold text-xs lg:text-base">DATA ANALYST</h3>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-move-right lg:w-[24px] lg:h-[24px]"
              >
                <path d="M18 8L22 12L18 16" />
                <path d="M2 12H22" />
              </svg>
            </div>
          </div>
          <div
            class="mini-card mini-card py-1 px-2 flex flex-col gap-2 custom-shadow lg:w-[200px] lg:h-[120px]"
          >
            <div>
              <svg
                width="30"
                height="30"
                viewBox="0 0 50 50"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="lg:w-[50px] lg:h-[50px]"
              >
                <g opacity="0.5">
                  <path
                    d="M12.5 27.0833H37.5C41.4284 27.0833 43.3925 27.0833 44.6129 28.3037C45.8334 29.5241 45.8334 31.4883 45.8334 35.4166C45.8334 39.345 45.8334 41.3091 44.6129 42.5296C43.3925 43.75 41.4284 43.75 37.5 43.75H12.5C8.57165 43.75 6.60746 43.75 5.38708 42.5296C4.16669 41.3091 4.16669 39.345 4.16669 35.4166C4.16669 31.4883 4.16669 29.5241 5.38708 28.3037C6.60746 27.0833 8.57165 27.0833 12.5 27.0833Z"
                    fill="#1C274C"
                  />
                  <path
                    d="M12.5 6.25H37.5C41.4284 6.25 43.3925 6.25 44.6129 7.4704C45.8334 8.69077 45.8334 10.655 45.8334 14.5833C45.8334 18.5117 45.8334 20.4759 44.6129 21.6962C43.3925 22.9167 41.4284 22.9167 37.5 22.9167H12.5C8.57165 22.9167 6.60746 22.9167 5.38708 21.6962C4.16669 20.4759 4.16669 18.5117 4.16669 14.5833C4.16669 10.655 4.16669 8.69077 5.38708 7.4704C6.60746 6.25 8.57165 6.25 12.5 6.25Z"
                    fill="#1C274C"
                  />
                </g>
                <path
                  d="M26.5625 14.5833C26.5625 13.7204 27.2621 13.0208 28.125 13.0208H37.5C38.3629 13.0208 39.0625 13.7204 39.0625 14.5833C39.0625 15.4463 38.3629 16.1458 37.5 16.1458H28.125C27.2621 16.1458 26.5625 15.4463 26.5625 14.5833Z"
                  fill="#1C274C"
                />
                <path
                  d="M12.5 18.2292C11.6371 18.2292 10.9375 17.5296 10.9375 16.6667V12.5C10.9375 11.6371 11.6371 10.9375 12.5 10.9375C13.3629 10.9375 14.0625 11.6371 14.0625 12.5V16.6667C14.0625 17.5296 13.3629 18.2292 12.5 18.2292Z"
                  fill="#1C274C"
                />
                <path
                  d="M18.75 18.2292C17.8871 18.2292 17.1875 17.5296 17.1875 16.6667V12.5C17.1875 11.6371 17.8871 10.9375 18.75 10.9375C19.6129 10.9375 20.3125 11.6371 20.3125 12.5V16.6667C20.3125 17.5296 19.6129 18.2292 18.75 18.2292Z"
                  fill="#1C274C"
                />
                <path
                  d="M26.5625 35.4167C26.5625 34.5538 27.2621 33.8542 28.125 33.8542H37.5C38.3629 33.8542 39.0625 34.5538 39.0625 35.4167C39.0625 36.2796 38.3629 36.9792 37.5 36.9792H28.125C27.2621 36.9792 26.5625 36.2796 26.5625 35.4167Z"
                  fill="#1C274C"
                />
                <path
                  d="M12.5 39.0625C11.6371 39.0625 10.9375 38.3629 10.9375 37.5V33.3333C10.9375 32.4704 11.6371 31.7708 12.5 31.7708C13.3629 31.7708 14.0625 32.4704 14.0625 33.3333V37.5C14.0625 38.3629 13.3629 39.0625 12.5 39.0625Z"
                  fill="#1C274C"
                />
                <path
                  d="M18.75 39.0625C17.8871 39.0625 17.1875 38.3629 17.1875 37.5V33.3333C17.1875 32.4704 17.8871 31.7708 18.75 31.7708C19.6129 31.7708 20.3125 32.4704 20.3125 33.3333V37.5C20.3125 38.3629 19.6129 39.0625 18.75 39.0625Z"
                  fill="#1C274C"
                />
              </svg>
            </div>
            <div class="flex flex-row items-center gap-2 lg:gap-4 lg:px-1">
              <h3 class="font-semibold text-xs lg:text-base">NETWORK ENG</h3>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-move-right lg:w-[24px] lg:h-[24px]"
              >
                <path d="M18 8L22 12L18 16" />
                <path d="M2 12H22" />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </main>

    <div class="pg-footer">
      <footer class="footer">
        <svg
          class="footer-wave-svg"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 1200 100"
          preserveAspectRatio="none"
        >
          <path
            class="footer-wave-path"
            d="M851.8,100c125,0,288.3-45,348.2-64V0H0v44c3.7-1,7.3-1.9,11-2.9C80.7,22,151.7,10.8,223.5,6.3C276.7,2.9,330,4,383,9.8 c52.2,5.7,103.3,16.2,153.4,32.8C623.9,71.3,726.8,100,851.8,100z"
          ></path>
        </svg>
        <div class="footer-content">
          <div class="footer-content-column">
            <div class="footer-logo">
              <a class="footer-logo-link" href="#">
                <span class="hidden-link-text">LOGO</span>
                <h1>InterLink</h1>
              </a>
            </div>
            <div class="footer-menu">
              <h2 class="footer-menu-name">Get Started</h2>
              <ul id="menu-get-started" class="footer-menu-list">
                <li
                  class="menu-item menu-item-type-post_type menu-item-object-product"
                >
                  <a href="#">Start</a>
                </li>
                <li
                  class="menu-item menu-item-type-post_type menu-item-object-product"
                >
                  <a href="#">Documentation</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="footer-content-column">
            <div class="footer-menu">
              <h2 class="footer-menu-name">Company</h2>
              <ul id="menu-company" class="footer-menu-list">
                <li
                  class="menu-item menu-item-type-post_type menu-item-object-page"
                >
                  <a href="#">Contact</a>
                </li>
                <li
                  class="menu-item menu-item-type-taxonomy menu-item-object-category"
                >
                  <a href="#">News</a>
                </li>
                <li
                  class="menu-item menu-item-type-post_type menu-item-object-page"
                >
                  <a href="#">Careers</a>
                </li>
              </ul>
            </div>
            <div class="footer-menu">
              <h2 class="footer-menu-name">Legal</h2>
              <ul id="menu-legal" class="footer-menu-list">
                <li
                  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-170434"
                >
                  <a href="#">Privacy Notice</a>
                </li>
                <li
                  class="menu-item menu-item-type-post_type menu-item-object-page"
                >
                  <a href="#">Terms of Use</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="footer-content-column">
            <div class="footer-menu">
              <h2 class="footer-menu-name">Quick Links</h2>
              <ul id="menu-quick-links" class="footer-menu-list">
                <li
                  class="menu-item menu-item-type-custom menu-item-object-custom"
                >
                  <a target="_blank" rel="noopener noreferrer" href="#"
                    >Support Center</a
                  >
                </li>
                <li
                  class="menu-item menu-item-type-custom menu-item-object-custom"
                >
                  <a target="_blank" rel="noopener noreferrer" href="#"
                    >Service Status</a
                  >
                </li>
                <li
                  class="menu-item menu-item-type-post_type menu-item-object-page"
                >
                  <a href="#">Security</a>
                </li>
                <li
                  class="menu-item menu-item-type-post_type menu-item-object-page"
                >
                  <a href="#">Blog</a>
                </li>
                <li
                  class="menu-item menu-item-type-post_type_archive menu-item-object-customer"
                >
                  <a href="#">Customers</a>
                </li>
                <li
                  class="menu-item menu-item-type-post_type menu-item-object-page"
                >
                  <a href="#">Reviews</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="footer-content-column">
            <div class="footer-call-to-action">
              <h2 class="footer-call-to-action-title">Let's Chat</h2>
              <p class="footer-call-to-action-description">
                Have a support question?
              </p>
              <a
                class="footer-call-to-action-button button"
                href="#"
                target="_self"
              >
                Get in Touch
              </a>
            </div>
            <div class="footer-call-to-action">
              <h2 class="footer-call-to-action-title">You Call Us</h2>
              <p class="footer-call-to-action-link-wrapper">
                <a
                  class="footer-call-to-action-link"
                  href="tel:0124-64XXXX"
                  target="_self"
                >
                  +639511018949
                </a>
              </p>
            </div>
          </div>
          <div class="footer-social-links">
            <svg
              class="footer-social-amoeba-svg"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 236 54"
            >
              <path
                class="footer-social-amoeba-path"
                d="M223.06,43.32c-.77-7.2,1.87-28.47-20-32.53C187.78,8,180.41,18,178.32,20.7s-5.63,10.1-4.07,16.7-.13,15.23-4.06,15.91-8.75-2.9-6.89-7S167.41,36,167.15,33a18.93,18.93,0,0,0-2.64-8.53c-3.44-5.5-8-11.19-19.12-11.19a21.64,21.64,0,0,0-18.31,9.18c-2.08,2.7-5.66,9.6-4.07,16.69s.64,14.32-6.11,13.9S108.35,46.5,112,36.54s-1.89-21.24-4-23.94S96.34,0,85.23,0,57.46,8.84,56.49,24.56s6.92,20.79,7,24.59c.07,2.75-6.43,4.16-12.92,2.38s-4-10.75-3.46-12.38c1.85-6.6-2-14-4.08-16.69a21.62,21.62,0,0,0-18.3-9.18C13.62,13.28,9.06,19,5.62,24.47A18.81,18.81,0,0,0,3,33a21.85,21.85,0,0,0,1.58,9.08,16.58,16.58,0,0,1,1.06,5A6.75,6.75,0,0,1,0,54H236C235.47,54,223.83,50.52,223.06,43.32Z"
              ></path>
            </svg>
            <a class="footer-social-link linkedin" href="#" target="_blank">
              <span class="hidden-link-text">Linkedin</span>
              <svg
                class="footer-social-icon-svg"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 30 30"
              >
                <path
                  class="footer-social-icon-path"
                  d="M9,25H4V10h5V25z M6.501,8C5.118,8,4,6.879,4,5.499S5.12,3,6.501,3C7.879,3,9,4.121,9,5.499C9,6.879,7.879,8,6.501,8z M27,25h-4.807v-7.3c0-1.741-0.033-3.98-2.499-3.98c-2.503,0-2.888,1.896-2.888,3.854V25H12V9.989h4.614v2.051h0.065 c0.642-1.18,2.211-2.424,4.551-2.424c4.87,0,5.77,3.109,5.77,7.151C27,16.767,27,25,27,25z"
                ></path>
              </svg>
            </a>
            <a class="footer-social-link twitter" href="#" target="_blank">
              <span class="hidden-link-text">Twitter</span>
              <svg
                class="footer-social-icon-svg"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 26 26"
              >
                <path
                  class="footer-social-icon-path"
                  d="M 25.855469 5.574219 C 24.914063 5.992188 23.902344 6.273438 22.839844 6.402344 C 23.921875 5.75 24.757813 4.722656 25.148438 3.496094 C 24.132813 4.097656 23.007813 4.535156 21.8125 4.769531 C 20.855469 3.75 19.492188 3.113281 17.980469 3.113281 C 15.082031 3.113281 12.730469 5.464844 12.730469 8.363281 C 12.730469 8.773438 12.777344 9.175781 12.867188 9.558594 C 8.503906 9.339844 4.636719 7.246094 2.046875 4.070313 C 1.59375 4.847656 1.335938 5.75 1.335938 6.714844 C 1.335938 8.535156 2.261719 10.140625 3.671875 11.082031 C 2.808594 11.054688 2 10.820313 1.292969 10.425781 C 1.292969 10.449219 1.292969 10.46875 1.292969 10.492188 C 1.292969 13.035156 3.101563 15.15625 5.503906 15.640625 C 5.0625 15.761719 4.601563 15.824219 4.121094 15.824219 C 3.78125 15.824219 3.453125 15.792969 3.132813 15.730469 C 3.800781 17.8125 5.738281 19.335938 8.035156 19.375 C 6.242188 20.785156 3.976563 21.621094 1.515625 21.621094 C 1.089844 21.621094 0.675781 21.597656 0.265625 21.550781 C 2.585938 23.039063 5.347656 23.90625 8.3125 23.90625 C 17.96875 23.90625 23.25 15.90625 23.25 8.972656 C 23.25 8.742188 23.246094 8.515625 23.234375 8.289063 C 24.261719 7.554688 25.152344 6.628906 25.855469 5.574219 "
                ></path>
              </svg>
            </a>
            <a class="footer-social-link youtube" href="#" target="_blank">
              <span class="hidden-link-text">Youtube</span>
              <svg
                class="footer-social-icon-svg"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 30 30"
              >
                <path
                  class="footer-social-icon-path"
                  d="M 15 4 C 10.814 4 5.3808594 5.0488281 5.3808594 5.0488281 L 5.3671875 5.0644531 C 3.4606632 5.3693645 2 7.0076245 2 9 L 2 15 L 2 15.001953 L 2 21 L 2 21.001953 A 4 4 0 0 0 5.3769531 24.945312 L 5.3808594 24.951172 C 5.3808594 24.951172 10.814 26.001953 15 26.001953 C 19.186 26.001953 24.619141 24.951172 24.619141 24.951172 L 24.621094 24.949219 A 4 4 0 0 0 28 21.001953 L 28 21 L 28 15.001953 L 28 15 L 28 9 A 4 4 0 0 0 24.623047 5.0546875 L 24.619141 5.0488281 C 24.619141 5.0488281 19.186 4 15 4 z M 12 10.398438 L 20 15 L 12 19.601562 L 12 10.398438 z"
                ></path>
              </svg>
            </a>
            <a class="footer-social-link github" href="#" target="_blank">
              <span class="hidden-link-text">Github</span>
              <svg
                class="footer-social-icon-svg"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 32 32"
              >
                <path
                  class="footer-social-icon-path"
                  d="M 16 4 C 9.371094 4 4 9.371094 4 16 C 4 21.300781 7.4375 25.800781 12.207031 27.386719 C 12.808594 27.496094 13.027344 27.128906 13.027344 26.808594 C 13.027344 26.523438 13.015625 25.769531 13.011719 24.769531 C 9.671875 25.492188 8.96875 23.160156 8.96875 23.160156 C 8.421875 21.773438 7.636719 21.402344 7.636719 21.402344 C 6.546875 20.660156 7.71875 20.675781 7.71875 20.675781 C 8.921875 20.761719 9.554688 21.910156 9.554688 21.910156 C 10.625 23.746094 12.363281 23.214844 13.046875 22.910156 C 13.15625 22.132813 13.46875 21.605469 13.808594 21.304688 C 11.144531 21.003906 8.34375 19.972656 8.34375 15.375 C 8.34375 14.0625 8.8125 12.992188 9.578125 12.152344 C 9.457031 11.851563 9.042969 10.628906 9.695313 8.976563 C 9.695313 8.976563 10.703125 8.65625 12.996094 10.207031 C 13.953125 9.941406 14.980469 9.808594 16 9.804688 C 17.019531 9.808594 18.046875 9.941406 19.003906 10.207031 C 21.296875 8.65625 22.300781 8.976563 22.300781 8.976563 C 22.957031 10.628906 22.546875 11.851563 22.421875 12.152344 C 23.191406 12.992188 23.652344 14.0625 23.652344 15.375 C 23.652344 19.984375 20.847656 20.996094 18.175781 21.296875 C 18.605469 21.664063 18.988281 22.398438 18.988281 23.515625 C 18.988281 25.121094 18.976563 26.414063 18.976563 26.808594 C 18.976563 27.128906 19.191406 27.503906 19.800781 27.386719 C 24.566406 25.796875 28 21.300781 28 16 C 28 9.371094 22.628906 4 16 4 Z "
                ></path>
              </svg>
            </a>
          </div>
        </div>
        <div class="footer-copyright">
          <div class="footer-copyright-wrapper">
            <p class="footer-copyright-text">
              <a class="footer-copyright-link" href="#" target="_self">
                © 2024. | InterLink | All rights reserved.
              </a>
            </p>
          </div>
        </div>
      </footer>
    </div>
    <script src="burgermenu.js"></script>
  </body>
</html>
