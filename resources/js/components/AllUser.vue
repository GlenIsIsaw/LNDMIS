
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




        <div v-if="keyword != null">
                <Pagination :data="users" @pagination-change-page="filter" />
            </div>
            <div v-else-if="search != null">
                <Pagination :data="users" @pagination-change-page="find" />
            </div>
            <div v-else>
                <Pagination :data="users" @pagination-change-page="getUser" />
            </div>
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
                
                <tr v-for="(value) in users.data" :key="value.id">
                    <td>{{ value.id }}</td>
                    <td>{{ value.name }}</td>
                    <td>{{ value.email }}</td>
                    <td>{{ value.teacher }}</td>
                    <td>{{ value.position }}</td>
                    <td>{{ value.yearinPosition }}</td>
                    <td>{{ value.yearJoined }}</td>
                    <td>{{ value.college }}</td>
                    <td>{{ value.supervisor }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'edit', params: { id: value.id }}" class="btn btn-success">Edit</router-link>
                            <button class="btn btn-danger" @click="deleteuser(value.id)">Delete</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-if="keyword != null">
                <Pagination :data="users" @pagination-change-page="filter" />
            </div>
            <div v-else-if="search != null">
                <Pagination :data="users" @pagination-change-page="find" />
            </div>
            <div v-else>
                <Pagination :data="users" @pagination-change-page="getUser" />
            </div>
                

        
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                keyword: null,
                search: null,
                users: {}
                
                
            } 
        },
        mounted() {
            this.getUser();
            console.log(this.users);
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
            getUser(page = 1) {
                this.axios
                    .get(`http://localhost:8000/api/users`, {params: { page: page }})
                    .then((res) => {
                            this.users = res.data;
                        });
            },
            deleteuser(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/users/${id}`)
                    .then(response => {
                        let i = this.users.map(data => data.id).indexOf(id);
                        this.users.splice(i, 1)
                    });
            },
            filter(page = 1) {
                this.axios
                    .get(`http://localhost:8000/api/filter_user`, {params: { keyword: this.keyword,page: page  }})
                    .then((res) => {
                            this.users = res.data;
                        });
                        console.log(this.users);
            },
            find(page = 1) {
                this.axios
                    .get(`http://localhost:8000/api/search_user`, {params: { search: this.search,page: page }})
                    .then((res) => {
                            this.users = res.data;
                        });
            }
        }
    }
</script>