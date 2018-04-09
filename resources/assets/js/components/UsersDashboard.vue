<template>
    <div>
        <div class="row">
            <div class="col-6"><h1>Users</h1></div>
            <div class="col-6">
                <button 
                type="button" 
                class="btn btn-primary float-right"
                data-toggle="modal" data-target="#addModal"
                @click="add_user"
                >Add New
                </button>
            </div>
        </div>
        
        
    
    
        <table class="table table-striped" v-if="users">
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
                    data-toggle="modal" data-target="#editModal"
                    class="btn btn-secondary float-right">
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
            
            reload_table() {
                this.$http.get('v1/users').then(response => {
                this.users = response.data.data;
                })
            },
            
           edit_user : function(event){
              const user_id =  event.target.dataset.id
              this.$emit('clicked', user_id)
            },
            
            add_user : function(event){
                this.$emit('add')
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