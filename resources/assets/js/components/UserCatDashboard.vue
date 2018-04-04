<template>
    <div>
        <div class="row">
            <div class="col-6"><h1>User Roles</h1></div>
            <div class="col-6">
                
                <button 
                type="button" 
                class="btn btn-primary float-right"
                @click="add_category"
                
                >Add New
                </button>
                
            </div>
        </div>
        
        <!--categories table-->
        <table class="table" v-if="categories">
        <thead>
          <tr>
            <th>Role</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories">
            <td class="align-middle">{{category.name}}</td>
            <td class="align-middle">
                <button  
                @click="delete_role"
                :data-id="category.id"
                :data-check="0"
                class="btn btn-danger float-right">
                    Delete
                </button>
            </td>
          </tr>
        </tbody>
      </table>
      <!--categories table-->
      
      <div class="row" v-if="add_new">
          <div class="col-12">
            <h2>Add New User Role</h2>
            
            <form id="register" autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" v-model="name" required>
                    <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                    <label for="description">Description</label>
                    <input type="text" id="description" v-model="description" class="form-control" required>
                    <span class="help-block" v-if="error && errors.email">{{ errors.description }}</span>
                </div>
                
                <button type="submit" 
                class="btn btn-default">
                Submit
                </button>
                
                <button  
                @click="cancel"
                class="btn btn-danger">
                Cancel
                </button>
                
                
            </form>
        
        
            
        
            
                
                
          </div>
      </div>
      
      
        

    </div>
</template>




<script>
    export default {
        name: 'UsersCatDashboard',
        
        
        data(){
            return {
                categories: null,
                category_id : null,
                add_new : false,
                error: false,
                errors: {},
                success: false
            };
        },
        
        mounted() {
            this.$http.get('v1/user-categories').then(response => {
            this.categories = response.data.data;
          })
        },
        
        methods : {
           delete_role : function(event){
                
                var check = event.target.dataset.check
                
                if(check==0){
                    event.target.textContent = 'Sure?'
                    event.target.dataset.check = 1
                }else{
                    this.category_id =  event.target.dataset.id
                    this.$http.post(`v1/delete-role`, {
                    id : this.category_id,
                     }).then(response => {
                    
                    if(response.data.status == 'success'){
                        this.$http.get('v1/user-categories').then(response => {
                        this.categories = response.data.data;
                        })
                    }
                    })
                }

            },
            
            add_category : function(event){
                this.categories = null; 
                this.add_new = true;
            },
            
            cancel : function(event){
                document.getElementById("register").reset();
                this.add_new = false;
                this.$http.get('v1/user-categories').then(response => {
                this.categories = response.data.data;
                })
            },
            
            register : function(event){
            var app = this;
           
            this.$http.post(`v1/register-role`, {
                name : app.name,
                description : app.description,
            }).then(response => {
                
                if(response.data.status == 'success'){
                    document.getElementById("register").reset();
                    this.add_new = false;
                    this.$http.get('v1/user-categories').then(response => {
                    this.categories = response.data.data;
                    })
                }
                
                
                
            })
    
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