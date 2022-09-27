
<template>
    <div>
        <h2 class="text-center">Users List</h2>
        <h4 class="text-center" v-if="search != null && search != ''">Search Results for "{{search}}"</h4>
        
        <div class="d-flex flex-row-reverse bd-highlight">
        <div class="p-2 bd-highlight">
            <input type="text" v-model="search" placeholder="Search"/> 
        </div>
        <div class="p-2 bd-highlight"></div>
        <div class="p-2 bd-highlight"></div>
        </div>

        <div class="d-flex flex-row bd-highlight mb-3">
        <div class="p-2 bd-highlight">
            <router-link to="/users/create"><button class="btn btn-success">Create</button></router-link>
        </div>
        <div class="p-2 bd-highlight"></div>
        <div class="p-2 bd-highlight"></div>
        </div>

        <div class="d-flex flex-row bd-highlight mb-3">
        <div class="p-2 bd-highlight">
            <label>Filter By Teacher:</label>
                    <select v-model="keyword">
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
        </div>
        <div class="p-2 bd-highlight"></div>
        <div class="p-2 bd-highlight"></div>
        </div>



        <div v-if="users.length > 0">
            
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Teaching</th>
                    <th scope="col">Position</th>
                    <th scope="col">Year In Position</th>
                    <th scope="col">Year Joined</th>
                    <th scope="col">College</th>
                    <th scope="col">Supervisor</th>
                    <th scope="col">Actions</th>
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
        <div v-else>
            <h1 class="text-center">No Results</h1>
        </div>
        
    </div>
</template>
 
<script>
    export default {

        data() {
            return {
                keyword: null,
                search: null,
                users: []
                
            } 
        },
        mounted() {
            this.axios
                .get(`http://localhost:8000/api/users/`)
                .then(response => {
                    this.users = response.data
                });
        },
        watch: {
            keyword(after, before) {
                this.filter();
            },
            search(after, before) {
                this.find();
            }
        },
        methods: {
            deleteuser(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/users/${id}`)
                    .then(response => {
                        let i = this.users.map(data => data.id).indexOf(id);
                        this.users.splice(i, 1)
                    });
            },
            filter() {
                this.axios
                    .get(`http://localhost:8000/api/filter_user`, {params: { keyword: this.keyword }})
                    .then((res) => {
                            this.users = res.data;
                        });
            },
            find() {
                this.axios
                    .get(`http://localhost:8000/api/search_user`, {params: { search: this.search }})
                    .then((res) => {
                            this.users = res.data;
                        });
            }
        }
    }
</script>