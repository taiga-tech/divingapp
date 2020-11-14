import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from './components/Auth/Login';
import Register from './components/Auth/Register';
import ProfilesShow from './components/Profile/ProfilesShow';
import ProfilesEdit from './components/Profile/ProfilesEdit';
import PostsIndex from './components/Post/PostsIndex';
import PostsCreate from './components/Post/PostsCreate';
import PostsShow from './components/Post/PostsShow';
import PostsEdit from './components/Post/PostsEdit';
import SearchIndex from './components/Search/SearchIndex';
import store from './store';


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/register',
            name: 'auth.register',
            component: Register,
            beforeEnter (to, from, next) {
                if (store.getters['auth/check']) {
                    next('/')
                } else {
                    next()
                }
            }
        },
        {
            path: '/login',
            name: 'auth.login',
            component: Login,
            beforeEnter (to, from, next) {
                if (store.getters['auth/check']) {
                    next('/')
                } else {
                    next()
                }
            }
        },
        {
            path: '/auth/:provider/callback',
            component: {
                template: '<div class="auth-component"></div>'
            }
        },
        {
            path: '/profiles/:profileId',
            name: 'profiles.show',
            component: ProfilesShow,
            props: true
        },
        {
            path: '/profiles/:profileId/edit',
            name: 'profiles.edit',
            component: ProfilesEdit,
            props: true,
            beforeEnter (to, from, next) {
                if (store.getters['auth/check']) {
                    next()
                } else {
                    next('/login')
                }
            }
        },
        {
            path: '/',
            name: 'posts.index',
            component: PostsIndex
        },
        {
            path: '/posts/create',
            name: 'posts.create',
            component: PostsCreate,
            beforeEnter (to, from, next) {
                if (store.getters['auth/check']) {
                    next()
                } else {
                    next('/login')
                }
            }
        },
        {
            path: '/posts/:postId',
            name: 'posts.show',
            component: PostsShow,
            props: true
        },
        {
            path: '/posts/:postId/edit',
            name: 'posts.edit',
            component: PostsEdit,
            props: true,
            beforeEnter (to, from, next) {
                if (store.getters['auth/check']) {
                    next()
                } else {
                    next('/login')
                }
            }
        },
        {
            path: '/search',
            name: 'search',
            component: SearchIndex,
            props: true,
        },
        {
            path: '/search/:params',
            name: 'search.index',
            component: SearchIndex,
            props: true,
        }
    ]
});
