import {createRouter, createWebHashHistory} from 'vue-router';
import AllUser from '../components/AllUser.vue';
import notFound from '../components/notFound.vue';

const routes = [

    {
        path:'/users',
        component: AllUser
    },
    {
        path:'/users:pathMatch(.*)*',
        component: notFound
    }
    
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router