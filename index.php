<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Hospital</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .banner {
            max-width: 100%;
            height: 100vh;
            background: linear-gradient(to bottom, #1e3c72, #2a5298);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .navbar {
            width: 90%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.2);
            margin-top: 20px;
        }

        .logo {
            width: 100px;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .logo:hover {
            transform: scale(1.1);
        }

        .navbar h1 {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
            text-align: center;
        }

        .home-btn {
            width: 120px;
            padding: 10px;
            border-radius: 25px;
            font-weight: bold;
            border: 2px solid white;
            background: transparent;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }

        .home-btn:hover {
            background: white;
            color: #1e3c72;
        }

        .container {
            width: 100%;
            height: 75vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .img-container {
            width: 100%;
            display: flex;
            animation-name: slide;
            animation-duration: 12s;
            animation-iteration-count: infinite;
        }

        .img-container img {
            width: 100%;
            height: 85vh;
            object-fit: cover;
        }

        @keyframes slide {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-25%); }
            50% { transform: translateX(-50%); }
            75% { transform: translateX(-75%); }
        }

        @media (max-width: 768px) {
            .welcome-bar {
                flex-direction: column;
                text-align: center;
            }
        }
        .short-bar {
            width: 100%;
            display: flex;
            color: white;
        }
    </style>
</head>
<body>
    <div class="banner">
        <div class="short-bar">
           <div class="call-img">
            <img src="images\call-logo.png" alt="call logo" class="call">
           </div>
           <div class="channeling-content">
            <p>Contact No</p>
            <p>+94362247955</p>
           </div> 
        </div>
        <div class="navbar">
            <img src="images\hospitallogo.jpeg" alt="Hospital Logo" class="logo">
            <h1>Welcome Care Compass Hospital</h1>
            <button class="home-btn" onclick="window.location.href='loginusers.html';">LOGIN</button>
        </div>
        <div class="short-bar">

        </div>
        <div class="container">
            <div class="img-container">
                <img src="images/5.webp" alt="Image 1">
                <img src="images/6.webp" alt="Image 2">
                <img src="images/7.jpg" alt="Image 3">
            </div>
        </div>
    </div>
</body>
</html>