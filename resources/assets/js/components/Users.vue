<template>
   
   <main>
       
       <!-- Modal edit -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit User {{name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                  
                  <div class="modal-body">
                        <form autocomplete="off" @submit.prevent="edit" id="register" method="post">
                       
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
                            <label for="password">New Password</label>
                            <input type="text" id="password" class="form-control" v-model="password">
                            <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>
                        </div>


                            <div class="form-group">
                            <label for="exampleFormControlSelect1">Role</label>
                            <select class="form-control" v-model="selected" required>
                                <option disabled value="">Please select one</option>
                                <option 
                                v-for="role in roles"
                                v-bind:value="role.id"
                                >
                                  {{role.name}}
                                </option>
                            </select>
                        </div>
                    

                        <div class="modal-footer">
                           
                            <button type="button" 
                            class="btn btn-danger float-left"
                            data-dismiss="modal"
                            @click="delete_user">
                            Delete User</button>
                            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                            
                            
                        </div>



                        </form>
                        
                </div>
                  
                  
                  
                  
                 
                  
                  
                  
                </div>
              </div>
            </div>
        <!-- Modal edit -->
        
        
        <!-- Modal add -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                  <div class="modal-body">
                        <form autocomplete="off" @submit.prevent="register" id="register" method="post">
                       
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
                                :selected="role.id == role_check ? true : false">
                                  {{role.name}}
                                </option>
                            </select>
                        </div>
                        
                        
                        
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New User</button>
                        </div>
                    
                        </form>
                        
                </div>
      
                  
                  
                   
                  
                  
                  
                </div>
              </div>
            </div>
        <!-- Modal add -->
        
        
            
            
       <LeftNav></LeftNav>
       <div class="main_container">
       <UsersDashboard @add="addUser" @clicked="onClickChild"  ref="table"></UsersDashboard>
       </div>
   </main>
     
</template>


     
<script>
    import LeftNav from './LeftNav.vue'
    import UsersDashboard from './UsersDashboard.vue'

   
    export default {
        components: {
            LeftNav,
            UsersDashboard,
        },
        
        mounted() {
            this.$http.get('v1/roles-all').then(response => {
            this.roles = response.data.data;
            })  
        },
        
         data(){
            return {
                user_id: null,
                update: false,
                roles: null,
                error: false,
                errors: {},
                name: '',
                email: '',
                password: '',
                role:'',
                role_check: '',
                selected: '',
            };
        },
        

        methods: {
           delete_user : function(event){
                this.$http.post(`v1/delete-user`, {
                        id :  this.user_id,
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.$refs.table.reload_table()
                            }
                })
            },
            
           
            
            onClickChild (value) {
                this.user_id = value
                this.$http.post(`v1/get-user`, {
                        id :  value,
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.name = response.data.data.name
                                this.email = response.data.data.email
                                this.selected = response.data.data.role.id
                                this.password = response.data.data.password
                                
                                
                            }
                        })
                        
                
                
            },
            
            
            addUser(){
                this.$http.get('v1/roles-all').then(response => {
                this.roles = response.data.data;
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
                                this.$refs.table.reload_table()
                                $('#addModal').modal('hide');
                                event.target.reset();
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
            
            
            edit : function(event){
                var app = this
                var role = app.selected
                this.$http.post(`v1/edit-user`, {
                            id : this.user_id,
                            name : app.name,
                            email : app.email,
                            role : app.selected,
                            password : app.password
                            
                        }).then(response => {
                            
                            if(response.data.status == 'success'){
                                this.$refs.table.reload_table()
                                $('#editModal').modal('hide');
                            }
                        })
                
                 
                
            }
            
            
            
        }
  
    }
    
    
    
    
    
</script>

