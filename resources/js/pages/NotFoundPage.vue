<template>
    <div class="jumbotron container text-center">
        <h1 class="display-4">Page not found</h1>
        <p class="lead">Sorry, the page you are looking for does not exist.</p>
        <router-link :to="{name: 'home'}" class="btn btn-outline-info btn-lg">Home Page</router-link>
    </div>
</template>
