<?php get_header(); ?>
<div class="white-wrap">
    <div id="app">
        <router-view></router-view>
    </div>
</div>

<template id="post-list-template">
    <div class="container">
        <div class="row">
            <div class="post-list">
                <article v-for="post in posts" class="post">
    <div class="post-content">
       <img v-bind:src="post.mi_300x180" alt="{{post.title.rendered}}">
    <h2>{{post.title.rendered}}</h2>
    <small v-for="category in post.mi_category">{{category.name}}</small>
    </div>
     </article>
            </div>
        </div>
    </div>
</template>
<?php get_footer(); ?>