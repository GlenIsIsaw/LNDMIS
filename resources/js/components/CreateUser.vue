<template>
    <div>
        <h3 class="text-center">Create User</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="adduser">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label>Teacher</label>
                        <input type="text" class="form-control" v-model="user.teacher">
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" class="form-control" v-model="user.position">
                    </div>
                    <div class="form-group">
                        <label>Year In Position</label>
                        <input type="date" class="form-control" v-model="user.yearinPosition">
                    </div>
                    <div class="form-group">
                        <label>Year Joined</label>
                        <input type="date" class="form-control" v-model="user.yearJoined">
                    </div>
                    <div class="form-group">
                        <label>College</label>
                        <input type="text" class="form-control" v-model="user.college">
                    </div>
                    <div class="form-group">
                        <label>Supervisor</label>
                        <input type="text" class="form-control" v-model="user.supervisor">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" v-model="user.password">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                user: {}
            }
        },
        methods: {
            adduser() {
                this.axios
                    .post('http://localhost:8000/api/users', this.user)
                    .then(response => (
                        this.$router.push({ name: 'home' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>