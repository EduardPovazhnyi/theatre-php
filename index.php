<!-- Create routing for application -->
<?php
// Get the requested URL from the 'url' query parameter
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

// Define available routes (URL => corresponding PHP file)
$routes = [
    '' => 'pages/index.php', // Home route
    'home' => 'pages/index.php', // Home route

    // public pages

    
    'blog' => 'pages/public/blog.php', // blog route
    'bloglist' => 'pages/public/bloglist.php', // blogList route
    'login' => 'pages/public/login.php', // login route
    'register' => 'pages/public/register.php', // register route
    'reviews' => 'pages/public/reviews.php', // reviews route
    'show' => 'pages/public/show.php', // show route

    // user pages

    'feedback' => 'pages/user/feedback.php', // feedback route

    // admin pages

    'addblog' => 'pages/admin/addblog.php', // addblog route
    'adminBloglist' => 'pages/admin/adminBloglist.php', // adminBloglist route
    'adminDashboard' => 'pages/admin/adminDashboard.php', // adminDashboard route
    'userlist' => 'pages/admin/userlist.php', // userlist route

    // config pages

    'registerController' => 'controller/registerController.php',
    'loginController' => 'controller/loginController.php',
    'logout' => 'controller/logoutController.php',
];

// check if the url matches a route
if(array_key_exists($url, $routes)) {
    require $routes[$url]; // Load the appropriate file for the route
} 
else {
    // if no page matches, show a 404 page
    require 'pages/error.php';
}
?>