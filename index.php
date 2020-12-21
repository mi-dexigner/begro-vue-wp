<?php get_header(); ?>
<div class="white-wrap">
    <div id="app">
        <router-view></router-view>
    </div>
</div>

<template id="post-list-template">
<div class="container">
<h4>Filter By Name</h4>
<input type="text" name="" v-model="nameFilter" />
<div class="by-category clearfix">
<h4>Filter By Category</h4>
<!-- <div class="radio-wrap">
<input type="radio" v-model="categoryFilter">
<label>Some Category</label>
</div> -->
<div class="radio-wrap" v-for="category in categories" v-if="category.name != 'Uncategorized'">
                <input type="radio" value="{{ category.id }}" v-model="categoryFilter">
                <label>{{ category.name }}</label>
</div>
</div>
</div>

    <div class="container">
        <div class="row">
            <div class="post-list">
                <article v-for="post in posts | filterBy nameFilter in 'title' | filterBy categoryFilter in 'categories'" class="post">
    <div class="post-content">
       <img v-bind:src="post.mi_300x180" alt="{{post.title.rendered}}">
    <h2>{{post.title.rendered}}</h2>
    <small v-for="category in post.mi_category" v-html="category.name"></small>
    </div>
     </article>
            </div>
        </div>
    </div>
</template>
<?php get_footer(); ?>