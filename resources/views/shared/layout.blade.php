@php

  $result =  App\Http\Controllers\ChartController::generate_activity();

   
@endphp

<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthWise</title>
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="assets/css/remixicon.css">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="assets/css/lib/bootstrap.min.css">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="assets/css/lib/apexcharts.css">
    <!-- Data Table css -->
    <link rel="stylesheet" href="assets/css/lib/dataTables.min.css">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="assets/css/lib/editor-katex.min.css">
    <link rel="stylesheet" href="assets/css/lib/editor.atom-one-dark.min.css">
    <link rel="stylesheet" href="assets/css/lib/editor.quill.snow.css">
    <!-- Date picker css -->
    <link rel="stylesheet" href="assets/css/lib/flatpickr.min.css">
    <!-- Calendar css -->
    <link rel="stylesheet" href="assets/css/lib/full-calendar.css">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="assets/css/lib/jquery-jvectormap-2.0.5.css">
    <!-- Popup css -->
    <link rel="stylesheet" href="assets/css/lib/magnific-popup.css">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="assets/css/lib/slick.css">
    <!-- prism css -->
    <link rel="stylesheet" href="assets/css/lib/prism.css">
    <!-- file upload css -->
    <link rel="stylesheet" href="assets/css/lib/file-upload.css">

    <link rel="stylesheet" href="assets/css/lib/audioplayer.css">
    <!-- main css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-G8UfaHHEu5S+kCmBb1eLg7HzKqjpmCy2e6uXCE4UdyGQ5+N3EOljMIx4CxtX9QZ4EvATYhdA4sS0bkFnbd5V1Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <aside class="sidebar">
        <button type="button" class="sidebar-close-btn">
            <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
        </button>
        <div>
            <a href="/" class="sidebar-logo">
                {{-- <img src="https://cdn.prod.website-files.com/6319b6d4b1d63276594daf25/6319c0f68861af101098bcce_medix-logo.svg"
                    alt="site logo" class="light-logo">
                <img src="https://cdn.prod.website-files.com/6319b6d4b1d63276594daf25/6319c0f68861af101098bcce_medix-logo.svg"
                    class="dark-logo">
                <img src="https://cdn.prod.website-files.com/6319b6d4b1d63276594daf25/6319c0f68861af101098bcce_medix-logo.svg"
                    alt="site logo" class="logo-icon"> --}}
                <svg data-v-0dd9719b="" version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="70px" viewBox="0 0 340.000000 250.000000" preserveAspectRatio="xMidYMid meet" color-interpolation-filters="sRGB" style="margin: auto;"> <rect data-v-0dd9719b="" x="0" y="0" width="100%" height="100%" fill="#fff0" fill-opacity="1" class="background"></rect> <rect data-v-0dd9719b="" x="0" y="0" width="100%" height="100%" fill-opacity="1" class="watermarklayer" fill="#fff0"></rect> <g data-v-0dd9719b="" fill="#e71d73" class="icon-text-wrapper icon-svg-group iconsvg" transform="translate(82.13500213623047,74.4127311706543)"><g class="iconsvg-imagesvg" transform="translate(57.86499786376953,0)"><g><rect fill="#e71d73" fill-opacity="0" stroke-width="2" x="0" y="0" width="60" height="60.28454304316373" class="image-rect"></rect> <svg x="0" y="0" width="60" height="60.28454304316373" filtersec="colorsb5674017537" class="image-svg-svg primary" style="overflow: visible;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.004471778869628906 -1.2069456425740185e-31 1228.30224609375 1234.1300048828125"><defs><linearGradient id="aaa96acaa-b85b-4e9a-8d6a-e5aefe4df62c" x1="1550.39" y1="1026.23" x2="394.31" y2="-240.69" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="b118d1dd8-0f28-44a0-9beb-911eb76505eb" x1="1467.3" y1="1104.12" x2="308.71" y2="-165.56" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="c75818bfd-9caa-4485-8975-22d747a889c6" x1="1368.93" y1="1199.86" x2="205.61" y2="-75.01" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="d4bb46274-8b74-45a1-adbd-8295bab74cd7" x1="1264.59" y1="1303.8" x2="94.92" y2="21.97" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="e1fd12f7a-51b3-4abb-aa43-e478a1046cbe" x1="1153.84" y1="1398.99" x2="-11.41" y2="122.01" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="f38342aa0-f05e-4fde-9c7b-c8a719d7540d" x1="1056.12" y1="1483.37" x2="-105.16" y2="210.73" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="g85f6dfd9-e8a4-4787-9e2e-7e98f83542c5" x1="980.34" y1="1550.47" x2="-178.69" y2="280.3" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="hd17cbf01-155a-4940-af27-a0a3d109a28f" x1="934.04" y1="1595.64" x2="-226.64" y2="323.65" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="i8c775ada-cd5c-411a-b26f-77db4c081f9e" x1="916.04" y1="1614.56" x2="-246.8" y2="340.22" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="j4eee6237-8c38-4b22-ae8a-24962435345d" x1="929.5" y1="1597.93" x2="-227.79" y2="329.67" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="k4f6b82e3-db95-4304-b5f2-5fa3d53fb310" x1="994.8" y1="1539.88" x2="-161.88" y2="272.28" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="l706d68f1-4847-4157-b731-0b714ec2f3e0" x1="1100.19" y1="1447.38" x2="-58.92" y2="177.12" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="m01902961-328d-47e0-9fbe-c938f6c39a34" x1="1234.96" y1="1330.87" x2="66.47" y2="50.34" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="n3084d484-5b6c-4516-9ca9-ce8a9072ae0f" x1="1370.87" y1="1199.84" x2="214.76" y2="-67.14" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="o43da1e2e-877d-4020-ae0f-16e324d69c31" x1="1494.34" y1="1080.95" x2="345.04" y2="-178.56" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="pe76d6ff0-6632-4295-a7c3-4a4366e7ddec" x1="1584.68" y1="995.96" x2="434.08" y2="-264.96" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="q19a3727e-1cd5-42ee-8156-a85bad8e4a64" x1="1627.35" y1="961.17" x2="469.13" y2="-308.11" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient><linearGradient id="r4bc0d66d-7c80-40c2-8aa3-e9233f133c49" x1="1609.51" y1="980.49" x2="447.79" y2="-292.62" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e71d73"></stop><stop offset="1" stop-color="#e94e1b"></stop></linearGradient></defs><g><g><path d="M863.71 58.67l-86.32 237.15a359.8 359.8 0 0 0-93.26 1.7l97.78-268.63a7 7 0 0 1 9-4.17l68.68 25a7 7 0 0 1 4.12 8.95z" fill="url(#aaa96acaa-b85b-4e9a-8d6a-e5aefe4df62c)"></path><path d="M657.66 302.46A365.77 365.77 0 0 0 570.61 334V7a7 7 0 0 1 7-7h73.07a7 7 0 0 1 7 7z" fill="url(#b118d1dd8-0f28-44a0-9beb-911eb76505eb)"></path><path d="M559.59 339.9a363.79 363.79 0 0 0-73.14 53.6L364.58 58.66a7 7 0 0 1 4.18-9l68.68-25a7 7 0 0 1 9 4.18z" fill="url(#c75818bfd-9caa-4485-8975-22d747a889c6)"></path><path d="M484.75 395.15a360.31 360.31 0 0 0-54.23 65.65c-.65.95-1.28 1.93-1.88 2.93l-6.47-7.73-233.51-278.3a7 7 0 0 1 .86-9.84l56-47a7 7 0 0 1 9.84.86z" fill="url(#d4bb46274-8b74-45a1-adbd-8295bab74cd7)"></path><path d="M428.64 463.72a366.57 366.57 0 0 0-34.49 70.37l-.49 2.73-1.19 2.06-.19.34-13.61-7.86L64 349.73a7 7 0 0 1-2.56-9.54L98 276.9a7 7 0 0 1 9.54-2.56L422.17 456l8.35 4.79c-.65.95-1.28 1.93-1.88 2.93z" fill="url(#e1fd12f7a-51b3-4abb-aa43-e478a1046cbe)"></path><path d="M374.25 619l-10.78-1.9L5.77 554a7 7 0 0 1-5.67-8.09l12.71-72a7 7 0 0 1 8.09-5.66l357.77 63.1 15.48 2.73-.49 2.73-1.19 2.06a364.32 364.32 0 0 0-17.78 76.21c-.17 1.3-.3 2.6-.44 3.92z" fill="url(#f38342aa0-f05e-4fde-9c7b-c8a719d7540d)"></path><path d="M374.76 703.44L20.89 765.86a7 7 0 0 1-8.09-5.67l-12.68-72a7 7 0 0 1 5.67-8.09l357.69-63.06 11.22-2c-.17 1.29-.3 2.59-.44 3.89a359.7 359.7 0 0 0 .5 84.51z" fill="url(#g85f6dfd9-e8a4-4787-9e2e-7e98f83542c5)"></path><path d="M397.36 792.5L107.57 959.8a7 7 0 0 1-9.57-2.56L61.47 894a7 7 0 0 1 2.53-9.59l310.94-179.52a363.66 363.66 0 0 0 22.42 87.61z" fill="url(#hd17cbf01-155a-4940-af27-a0a3d109a28f)"></path><path d="M448.3 882.42l-193 230a7 7 0 0 1-9.84.86l-56-47a7 7 0 0 1-.86-9.84l212.88-253.7a367.25 367.25 0 0 0 46.82 79.68z" fill="url(#i8c775ada-cd5c-411a-b26f-77db4c081f9e)"></path><path d="M534.57 963l-88.18 242.28a7 7 0 0 1-9 4.17l-68.68-25a7 7 0 0 1-4.17-9l99.64-273.75a359.8 359.8 0 0 0 70.39 61.3z" fill="url(#j4eee6237-8c38-4b22-ae8a-24962435345d)"></path><path d="M650.7 1234.13h-73.08a7 7 0 0 1-7-7v-243a366.69 366.69 0 0 0 87 31.51v211.51a7 7 0 0 1-6.92 6.98z" fill="url(#k4f6b82e3-db95-4304-b5f2-5fa3d53fb310)"></path><path d="M859.51 1184.42l-68.65 25a7 7 0 0 1-9-4.17l-66-181.38a360.89 360.89 0 0 0 90.48-5.91l57.33 157.53a7 7 0 0 1-4.16 8.93z" fill="url(#l706d68f1-4847-4157-b731-0b714ec2f3e0)"></path><path d="M1038.78 1066.28l-56 47a7 7 0 0 1-9.84-.86L876.22 997.1a366.48 366.48 0 0 0 77.29-43.32l86.13 102.66a7 7 0 0 1-.86 9.84z" fill="url(#m01902961-328d-47e0-9fbe-c938f6c39a34)"></path><path d="M1166.81 893.95l-36.52 63.29a7 7 0 0 1-9.54 2.56l-106.82-61.65a360.68 360.68 0 0 0 48.72-72.38l101.61 58.64a7 7 0 0 1 2.55 9.54z" fill="url(#n3084d484-5b6c-4516-9ca9-ce8a9072ae0f)"></path><path d="M1207.39 765.87l-114.93-20.27a359.9 359.9 0 0 0 10.5-86.53l119.56 21.08a7 7 0 0 1 5.67 8.09l-12.7 72a7 7 0 0 1-8.1 5.63z" fill="url(#o43da1e2e-877d-4020-ae0f-16e324d69c31)"></path><path d="M1222.52 554l-129 22.76a365.87 365.87 0 0 0-30.21-83.08l144.12-25.4a7 7 0 0 1 8.09 5.67l12.68 72a7 7 0 0 1-5.68 8.05z" fill="url(#pe76d6ff0-6632-4295-a7c3-4a4366e7ddec)"></path><path d="M1164.24 349.71l-141.1 81.46A361 361 0 0 0 958.52 368l162.21-93.65a7 7 0 0 1 9.54 2.56l36.52 63.27a7 7 0 0 1-2.55 9.53z" fill="url(#q19a3727e-1cd5-42ee-8156-a85bad8e4a64)"></path><path d="M1039.64 177.71l-132.4 157.78a366.31 366.31 0 0 0-86.58-32.22L973 121.75a7 7 0 0 1 9.84-.86l56 47a7 7 0 0 1 .8 9.82z" fill="url(#r4bc0d66d-7c80-40c2-8aa3-e9233f133c49)"></path></g></g></svg></svg> <!----></g></g> <g transform="translate(0,67.28454208374023)"><g data-gra="path-name" fill-rule="" class="tp-name iconsvg-namesvg"><g transform="scale(1)"><g><path d="M8.69 0L2.61 0 2.61-33.52 8.69-33.52 8.69-19.49 15.52-19.49 15.52-33.52 21.64-33.52 21.64 0 15.52 0 15.52-15.14 8.69-15.14 8.69 0ZM33.64 0.37L33.64 0.37Q30.95 0.37 29.26-0.64 27.56-1.66 26.75-3.62 25.94-5.59 25.94-8.36L25.94-8.36 25.94-15.56Q25.94-18.41 26.75-20.36 27.56-22.3 29.28-23.3 30.99-24.29 33.64-24.29L33.64-24.29Q36.5-24.29 38.09-23.21 39.68-22.14 40.37-20.09 41.05-18.04 41.05-15.1L41.05-15.1 41.05-11.71 31.53-11.71 31.53-6.99Q31.53-5.83 31.76-5.09 31.99-4.34 32.48-4.01 32.98-3.68 33.68-3.68L33.68-3.68Q34.43-3.68 34.88-4.03 35.34-4.39 35.54-5.07 35.75-5.75 35.75-6.79L35.75-6.79 35.75-8.77 41.01-8.77 41.01-7.16Q41.01-3.52 39.19-1.57 37.37 0.37 33.64 0.37ZM31.53-16.14L31.53-14.48 35.75-14.48 35.75-16.76Q35.75-18 35.54-18.77 35.34-19.53 34.88-19.88 34.43-20.23 33.6-20.23L33.6-20.23Q32.86-20.23 32.4-19.86 31.94-19.49 31.74-18.62 31.53-17.75 31.53-16.14L31.53-16.14ZM49.49 0.37L49.49 0.37Q47.88 0.37 46.72-0.48 45.56-1.32 44.94-2.63 44.32-3.93 44.32-5.34L44.32-5.34Q44.32-7.57 45.14-9.1 45.97-10.63 47.34-11.67 48.7-12.7 50.44-13.47 52.18-14.23 53.96-14.86L53.96-14.86 53.96-16.92Q53.96-17.96 53.81-18.66 53.67-19.37 53.28-19.74 52.88-20.11 52.06-20.11L52.06-20.11Q51.35-20.11 50.92-19.78 50.48-19.45 50.3-18.85 50.11-18.25 50.07-17.46L50.07-17.46 49.99-16.01 44.65-16.22Q44.77-20.36 46.7-22.32 48.62-24.29 52.55-24.29L52.55-24.29Q56.15-24.29 57.79-22.3 59.42-20.32 59.42-16.92L59.42-16.92 59.42-5.88Q59.42-4.55 59.48-3.48 59.54-2.4 59.65-1.53 59.75-0.66 59.83 0L59.83 0 54.79 0Q54.66-0.83 54.48-1.88 54.29-2.94 54.21-3.43L54.21-3.43Q53.79-1.99 52.63-0.81 51.48 0.37 49.49 0.37ZM51.56-3.81L51.56-3.81Q52.1-3.81 52.57-4.08 53.05-4.34 53.42-4.72 53.79-5.09 53.96-5.38L53.96-5.38 53.96-12.04Q53.05-11.5 52.24-10.97 51.43-10.43 50.83-9.79 50.23-9.14 49.92-8.4 49.61-7.66 49.61-6.66L49.61-6.66Q49.61-5.34 50.13-4.57 50.65-3.81 51.56-3.81ZM69.52 0L63.93 0 63.93-33.52 69.52-33.52 69.52 0ZM80.9 0.29L80.9 0.29Q78.62 0.29 77.32-0.46 76.01-1.2 75.48-2.61 74.94-4.01 74.94-5.96L74.94-5.96 74.94-20.19 72.54-20.19 72.54-23.92 74.94-23.92 74.94-31.08 80.61-31.08 80.61-23.92 84.25-23.92 84.25-20.19 80.61-20.19 80.61-6.46Q80.61-5.21 81.14-4.7 81.68-4.18 82.76-4.18L82.76-4.18Q83.21-4.18 83.65-4.22 84.08-4.26 84.5-4.3L84.5-4.3 84.5 0Q83.79 0.08 82.86 0.19 81.93 0.29 80.9 0.29ZM93.43 0L87.81 0 87.81-33.52 93.43-33.52 93.43-21.64Q94.68-22.88 96.14-23.59 97.61-24.29 99.35-24.29L99.35-24.29Q100.8-24.29 101.67-23.57 102.54-22.84 102.95-21.64 103.37-20.44 103.37-19.03L103.37-19.03 103.37 0 97.74 0 97.74-17.92Q97.74-18.99 97.41-19.57 97.08-20.15 96.12-20.15L96.12-20.15Q95.54-20.15 94.82-19.82 94.1-19.49 93.43-18.95L93.43-18.95 93.43 0ZM116.48 0L111.39 0 106.63-33.52 111.77-33.52 114.54-11.79 118.01-33.43 122.19-33.43 125.75-11.79 128.48-33.52 133.53-33.52 128.86 0 123.89 0 120.17-22.47 116.48 0ZM142.68 0L137.05 0 137.05-23.92 142.68-23.92 142.68 0ZM142.68-27.72L137.05-27.72 137.05-32.4 142.68-32.4 142.68-27.72ZM153.64 0.37L153.64 0.37Q150.62 0.37 148.68-1.24 146.73-2.86 145.9-5.96L145.9-5.96 150.08-7.57Q150.58-5.63 151.41-4.59 152.23-3.56 153.56-3.56L153.56-3.56Q154.55-3.56 155.05-4.06 155.54-4.55 155.54-5.42L155.54-5.42Q155.54-6.41 154.94-7.22 154.34-8.03 152.9-9.23L152.9-9.23 150-11.67Q148.43-13.03 147.46-14.46 146.48-15.89 146.48-18.04L146.48-18.04Q146.48-19.99 147.37-21.37 148.26-22.76 149.81-23.52 151.37-24.29 153.27-24.29L153.27-24.29Q156.17-24.29 157.92-22.57 159.68-20.86 160.18-18.08L160.18-18.08 156.5-16.51Q156.29-17.5 155.9-18.35 155.5-19.2 154.88-19.74 154.26-20.28 153.43-20.28L153.43-20.28Q152.57-20.28 152.05-19.74 151.53-19.2 151.53-18.37L151.53-18.37Q151.53-17.67 152.13-16.92 152.73-16.18 153.85-15.23L153.85-15.23 156.79-12.58Q157.74-11.75 158.61-10.8 159.48-9.85 160.06-8.67 160.63-7.49 160.63-5.96L160.63-5.96Q160.63-3.89 159.7-2.48 158.77-1.08 157.18-0.35 155.59 0.37 153.64 0.37ZM170.94 0.37L170.94 0.37Q168.25 0.37 166.55-0.64 164.86-1.66 164.05-3.62 163.24-5.59 163.24-8.36L163.24-8.36 163.24-15.56Q163.24-18.41 164.05-20.36 164.86-22.3 166.57-23.3 168.29-24.29 170.94-24.29L170.94-24.29Q173.79-24.29 175.39-23.21 176.98-22.14 177.66-20.09 178.34-18.04 178.34-15.1L178.34-15.1 178.34-11.71 168.83-11.71 168.83-6.99Q168.83-5.83 169.06-5.09 169.28-4.34 169.78-4.01 170.28-3.68 170.98-3.68L170.98-3.68Q171.72-3.68 172.18-4.03 172.63-4.39 172.84-5.07 173.05-5.75 173.05-6.79L173.05-6.79 173.05-8.77 178.3-8.77 178.3-7.16Q178.3-3.52 176.48-1.57 174.66 0.37 170.94 0.37ZM168.83-16.14L168.83-14.48 173.05-14.48 173.05-16.76Q173.05-18 172.84-18.77 172.63-19.53 172.18-19.88 171.72-20.23 170.9-20.23L170.9-20.23Q170.15-20.23 169.7-19.86 169.24-19.49 169.03-18.62 168.83-17.75 168.83-16.14L168.83-16.14Z" transform="translate(-2.609999895095825, 33.52000045776367)"></path></g> <!----> <!----> <!----> <!----> <!----> <!----> <!----></g></g> <!----></g></g><defs v-gra="od"></defs></svg>
                        
            </a>
        </div>
        <div class="sidebar-menu-area">
            <ul class="sidebar-menu" id="sidebar-menu">
                <li class="">
                    <a href="/dashboard">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/track-glucose">
                        <iconify-icon icon="fa-solid:stethoscope" class="menu-icon"></iconify-icon>
                        <span>Track Glucose</span>
                    </a>
                </li>
                <li>
                    <a href="/result">
                        <iconify-icon icon="mdi:heart-pulse" class="menu-icon"></iconify-icon>
                        <span>Health Plan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}">
                        <iconify-icon icon="mdi:logout" class="menu-icon"></iconify-icon>
                        <span>Logout</span>
                    </a>
                </li>


            </ul>
        </div>
    </aside>

    <main class="dashboard-main">
        <div class="navbar-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <button type="button" class="sidebar-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                            <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                        </button>
                        <button type="button" class="sidebar-mobile-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                        </button>

                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" data-theme-toggle
                            class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>
                       
                    
                        <div class="">
                            <button class="d-flex justify-content-center align-items-center rounded-circle"
                                type="button" data-bs-toggle="dropdown">
                                <img src="{{  asset(auth()?->user()?->image ?? 'assets/images/user.png') }}" alt="image"
                                    class="w-40-px h-40-px object-fit-cover rounded-circle">
                            </button>
                        
                        </div><!-- Profile dropdown end -->
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

        <footer class="d-footer">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <p class="mb-0">© 2024 HealthWiseer. All Rights Reserved.</p>
                </div>

            </div>
        </footer>
    </main>
    <!-- jQuery library js -->
    <script src="assets/js/lib/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Apex Chart js -->
    <script src="assets/js/lib/apexcharts.min.js"></script>
    <!-- Data Table js -->
    <script src="assets/js/lib/dataTables.min.js"></script>
    <!-- Iconify Font js -->
    <script src="assets/js/lib/iconify-icon.min.js"></script>
    <!-- jQuery UI js -->
    <script src="assets/js/lib/jquery-ui.min.js"></script>
    <!-- Vector Map js -->
    <script src="assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
    <!-- Popup js -->
    <script src="assets/js/lib/magnifc-popup.min.js"></script>
    <!-- Slick Slider js -->
    <script src="assets/js/lib/slick.min.js"></script>
    <!-- prism js -->
    <script src="assets/js/lib/prism.js"></script>
    <!-- file upload js -->
    <script src="assets/js/lib/file-upload.js"></script>
    <!-- audioplayer -->
    <script src="assets/js/lib/audioplayer.js"></script>

    <!-- main js -->
    <script src="assets/js/app.js"></script>

    <script>
    
    // ================================= Multiple Radial Bar Chart Start =============================
    var options = {
        series: [{{ $result[0] }}, {{ $result[1] }}],
        chart: {
            height: 300,
            type: 'radialBar',
        },
        colors: ['#3D7FF9', '#ff9f29'], 
        stroke: {
            lineCap: 'round',
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '10%',  // Adjust this value to control the bar width
                },
                dataLabels: {
                    name: {
                        fontSize: '16px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    // total: {
                    //     show: true,
                    //     formatter: function (w) {
                    //         return '82%'
                    //     }
                    // }
                },
                track: {
                    margin: 20, // Space between the bars
                }
            }
        },
        labels: ['Meal Plan', 'Strength Tranning '],
    };

    var chart = new ApexCharts(document.querySelector("#radialMultipleBar"), options);
    chart.render();
    // ================================= Multiple Radial Bar Chart End =============================

    </script>

</body>

</html>