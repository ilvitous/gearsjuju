<template>
    <div>
        <div class="row">
            <div class="col-6"><h1>Users</h1></div>
            <div class="col-6">
                <button 
                type="button" 
                class="btn btn-primary float-right"
                 @click="add"
                >Add New
                </button>
            </div>
        </div>
        
        <!--add new user-->
        <div class="row" v-if="add_user">
            <div class="col-12">
                <h2>Add New User</h2>
                
                <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                    
                    <div class="alert alert-danger" v-if="error && !success">
                        <p>There was an error, unable to complete registration.</p>
                    </div>
                   
                    <div class="alert alert-success" v-if="success">
                        <p>Registration completed. You can now <router-link :to="{name:'login'}">sign in.</router-link></p>
                    </div>
                    
                    <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" v-model="name" required>
                        <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
                    </div>
                    
                    <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                        <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
                    </div>
                    
                    <div class="form-group" v-bind:class="{ 'has-error': error && errors.password }">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="password" required>
                        <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>
                    </div>
                    
                    
                    <div class="form-group">
                       
                        <label for="exampleFormControlSelect1">Role</label>
                        <select class="form-control" v-model="role" required>
                            <option 
                            v-for="role in roles" 
                            :value="role.id" 
                            :selected="role.name == 'employee' ? true : false">
                              {{role.name}}
                            </option>
                        </select>
                                                                    
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add New User</button>
                    
                    <button  
                    @click="cancel"
                    class="btn btn-danger">
                    Cancel
                    </button>
                    
                
                
                    </form>
                
            
            
            
            
            </div>
        </div>
        <!--add new user-->
        
    
    
    
        <table class="table" v-if="users">
            <thead>
              <tr>
                <th>Username</th>
                <th>Emails</th>
                <th>Role</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users">
                <td class="align-middle">{{ user.name }}</td>
                <td class="align-middle">{{ user.email }}</td>
                <td class="align-middle">{{ user.role }}</td>
                <td class="align-middle">
                    <button  
                    @click="edit_user"
                    :data-id="user.id" 
                    class="btn float-right">
                        Edit
                    </button>
                    </td>
              </tr>
            </tbody>
        </table>

    </div>
</template>




<script>
    export default {
        name: 'UsersDashboard',
        
        data(){
            return {
                users: null,
                roles:null,
                add_user:false,
                name: '',
                email: '',
                password: '',
                role: '',
                error: false,
                errors: {},
                success: false
            };
        },
        
        mounted() {
            this.$http.get('v1/users').then(response => {
            this.users = response.data.data;
            })
        },
        
        methods : {
           edit_user : function(event){
             const user_id =  event.target.dataset.id
              alert(user_id)
            },
            
            add : function(event){
                this.users = null
                this.add_user = true
                this.$http.get('v1/roles-all').then(response => {
                this.roles = response.data.data;
                })
                
                
            },
            
            cancel : function(event){
                this.add_user = false
                this.$http.get('v1/users').then(response => {
                this.users = response.data.data;
                })
              
            },
            
            register : function(event){
                var app = this
                var role = app.role

                this.$auth.register({
                    params: {
                        name: app.name,
                        email: app.email,
                        password: app.password,
                    }, 
                    
                    success: function (resp) {
                        app.success = true
                        var new_user = resp.data.data.id
                        
                        this.$http.post(`v1/set-role`, {
                            role : role,
                            user : new_user,
                        }).then(response => {
                            
                            if(response.data.status == 'success'){
                                this.add_user = false
                                this.$http.get('v1/users').then(response => {
                                this.users = response.data.data;
                                })
                            }
                        })
                                    
                        
                
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                }); 
                
            },
        }
        
        
    }
    
    
    
</script>

<style lang="scss" scoped>
    
   thead{
       font-weight: 700;
       text-transform: uppercase;
   }
    
</style>