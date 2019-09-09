var App = Vue.extend({});

var postList = Vue.extend({
    template:"#post-list-template",
    data:function(){
        return {
            posts:''
        }
    },
    ready:function(){
        posts = this.$resource('/payment_wp/wp-json/wp/v2/posts?per_page=20');
        posts.get(function(posts){
            this.$set('posts',posts)
        })
    }
})

var router = new VueRouter();

router.map({
    '/':{
        component: postList
    }
  
    
});

router.start(App, '#app');