<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    @include('home.header')

    @include('home.about')

    <!--  gallary Section  -->
    @include('home.gallary')

    <!-- BLOG Section  -->
    @include('home.blog')

    @include('home.food')

    <!-- REVIEWS Section  -->
    @include('home.reviews')


    <!-- CONTACT Section -->
    @include('home.contact')

    @include ('home.footer')
</html>
