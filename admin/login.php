<?php  
 session_start();  
 if(isset($_SESSION["user"]))  
 {  
      header("location: http://localhost:8080/admin/login.php");  
 }  
 
 ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>ADMIN - login</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom CSS -->
</head>

<body class="bg-gray-300 h-screen flex items-center justify-center">
 
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-4">Admin Login</h2>
        <form action="/admin/action/login.php" method="post">
          <div class="mb-4">
                <label for="email" class="block text-gray-600 text-sm font-medium mb-2">Email Address</label>
                <input type="email" id="email" name="email"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                    placeholder="Your email address" required>
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label for="password" class="block text-gray-600 text-sm font-medium mb-2">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                    placeholder="Your password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="login"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Login
            </button>
        </form>
      </div> <!-- end login -->
    <!-- <div class="bottom">  <h3><a href="../index.php">SUN RISE HOMEPAGE</a></h3></div> -->
  
</body>
</html>

