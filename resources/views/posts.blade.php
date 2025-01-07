<!-- resources/views/posts.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        /* Background Color */
        body {
            background-color: #f3f4f6; /* Light gray background like Telegram */
            font-family: 'Roboto', sans-serif;
        }

        .container {
            background-color: #ffffff; /* White background for the posts container */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #0088cc; /* Telegram-like blue color */
            font-size: 24px;
            margin-bottom: 20px;
        }

        .alert {
            background-color: #e1f5fe; /* Light blue background for success messages */
            color: #01579b; /* Blue text */
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 20px;
            border: 1px solid #ddd; /* Light border for text areas */
            padding: 12px;
            background-color: #f9f9f9; /* Light gray background */
        }

        .form-control:focus {
            border-color: #0088cc; /* Focus border in Telegram blue */
            background-color: #ffffff;
        }

        .btn-primary {
            background-color: #0088cc; /* Telegram blue for buttons */
            border-color: #0088cc;
            border-radius: 20px;
            padding: 10px 30px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #0077b6; /* Darker blue on hover */
            border-color: #0077b6;
        }

        .btn {
            border-radius: 20px;
        }

        ul {
            margin-top: 30px;
            padding-left: 0;
            list-style: none;
        }

        li {
            background-color: #f0f5f5; /* Light gray background for each post */
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        li p {
            color: #333;
            font-size: 16px;
            margin-bottom: 10px;
        }

        small {
            color: #0077b6;
            font-size: 12px;
        }

        /* Add some spacing around the page */
        .mt-5 {
            margin-top: 50px;
        }
    </style>
</head>

<body ng-controller="PostController">
<div class="container mt-5">
    <h1>Create Post</h1>
    <br>
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Post Creation Form -->
    <form ng-submit="createPost()" class="mb-4">
        <div class="mb-3">
            <textarea ng-model="newPost.content" class="form-control" placeholder="Write something..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
    </form>

    <ul>
        <li ng-repeat="post in posts">
            <p>{{ post.content }}</p>
            <small>BY {{ post.user.name }} on {{ post.created_at }}</small>
        </li>
    </ul>

<!-- AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script src="js/angular.js"></script>
<script>
    angular.module('social-media').controller('PostController', function($scope, $http) {
    $scope.posts = [];
    $scope.newPost = {};

    // Function to create a new post
    $scope.createPost = function() {
        $http.post('/api/posts', $scope.newPost)
        .then(function(response) {
            $scope.posts.unshift(response.data);
            $scope.newPost = {}; // Clear the form
        }, function(error) {
            alert('Error creating post');
        });
    };

    // Function to get all posts
    $scope.getPost = function() {
        $http.get('/api/posts').then(function(response) { 
            $scope.posts = response.data;
        }, function(error) {
            alert('Error fetching posts');
        });
    };

    // Fetch posts on controller initialization
    $scope.getPost();
});

</script>

</body>
</html>
