import {createRouter, createWebHashHistory} from 'vue-router';
import EditUser from '../components/EditUser.vue';
import CreateUser from '../components/CreateUser.vue';
import AllUser from '../components/AllUser.vue';
import notFound from '../components/notFound.vue';

const routes = [

    {
        path:'/users',
        name: 'home',
        component: AllUser
    },
    {
        path:'/users:pathMatch(.*)*',
        component: notFound
    },
    {
        path:'/users/create',
        name: 'create',
        component: CreateUser
    },
    {
        path:'/edit:id',
        name: 'edit',
        component: EditUser
    },
   
    
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router