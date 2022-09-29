
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



        <div class="container d-flex align-items-center justify-content-center">
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

            <table class="table">
                
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
                <tbody v-for="(value, key) in users.data" :key="key">
                    <tr v-if="value.id != 'deleted'">
                        
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
                                    <button class="btn btn-danger" @click="deleteuser(value.id,key)" >Delete</button>
                                </div>
                            </td>
                    </tr>
                </tbody>
            </table>
            <div class="container d-flex align-items-center justify-content-center">
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
            deleteuser(id,key) { 
                if(confirm("Do you really want to delete?")){
                    this.axios
                        .delete(`http://localhost:8000/api/users/${id}`)
                        .then(response => {
                            this.users['data'][key]['id'] = 'deleted';
                            console.log(this.users['data'][key]);

                        });
                }
            },
            filter(page = 1) {
                this.axios
                    .get(`http://localhost:8000/api/filter_user`, {params: { keyword: this.keyword,page: page  }})
                    .then((res) => {
                            this.users = res.data;
                        });
            },
            find(page = 1) {
                this.axios
                    .get(`http://localhost:8000/api/search_user`, {params: { search: this.search,page: page }})
                    .then((res) => {
                            this.users = res.data;
                        });
            },
            check(){
                console.log(this.users);
            }
        }
    }
</script>