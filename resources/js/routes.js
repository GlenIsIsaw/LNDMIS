import AllUser from './components/AllUser.vue';
import CreateUser from './components/CreateUser.vue';
import EditUser from './components/EditUser.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/users',
        component: AllUser
    },
    {
        name: 'create',
        path: '/users/create',
        component: CreateUser
    },
    {
        name: 'edit',
        path: '/users/edit/:id',
        component: EditUser
    }
];