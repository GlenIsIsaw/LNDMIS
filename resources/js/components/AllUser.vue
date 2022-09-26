
<template>
    <div>
        <h2 class="text-center">Users List</h2>
 
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Teaching</th>
                <th>Position</th>
                <th>Year In Position</th>
                <th>Year Joined</th>
                <th>College</th>
                <th>Supervisor</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.teacher }}</td>
                <td>{{ user.position }}</td>
                <td>{{ user.yearinPosition }}</td>
                <td>{{ user.yearJoined }}</td>
                <td>{{ user.college }}</td>
                <td>{{ user.supervisor }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: user.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteuser(user.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                users: []
            }
        },

        created() {
            this.axios
                .get(`http://localhost:8000/api/users/`)
                .then(response => {
                    this.users = response.data
                });
        },
        
        methods: {
            deleteuser(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/users/${id}`)
                    .then(response => {
                        let i = this.users.map(data => data.id).indexOf(id);
                        this.users.splice(i, 1)
                    });
            }
        }
    }
</script>