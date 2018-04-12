<template>
    <main>
        
        <!-- Modal add -->
            <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategory" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add New Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                <div class="modal-body">
                    
                    <form autocomplete="off" @submit.prevent="newCategory" id="register" method="post">
                       
                       <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="title">Name</label>
                            <input type="text" id="name" class="form-control" v-model="name" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New Category</button>
                        </form>
                        

                
                
                </div>
                </div>
              </div>
            </div>
        <!-- Modal add -->
        
        
        <!-- Modal add group -->
            <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="addGroup" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add New Group</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                <div class="modal-body">
                    
                    <form autocomplete="off" @submit.prevent="newGroup" id="register" method="post">
                       
                       <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="group_name">Name</label>
                            <input type="text" id="group_name" class="form-control" v-model="group_name" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        
                        
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New Group</button>
                        </form>
                        

                
                
                </div>
                </div>
              </div>
            </div>
        <!-- Modal add group -->
        
        
           <!-- Modal edit -->
            <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="editCategory" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Category {{name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>


                <div class="modal-body">
                    
                    <form autocomplete="off" @submit.prevent="editCategorySubmit" id="edit" method="post">
                       <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="title">Name</label>
                            <input type="text" id="name" class="form-control" v-model="name" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                       
                       
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        <button  
                            type="button"
                            class="btn btn-danger"
                            @click="deleteCategory">
                            Delete
                        </button>
                        
                     
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                       
                       
                        </form>
                        
                        
                        
                        

                
                
                </div>
                </div>
              </div>
            </div>
        <!-- Modal edit -->
        
        
        <!-- Modal edit group -->
            <div class="modal fade" id="editGroup" tabindex="-1" role="dialog" aria-labelledby="editGroup" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Group {{group_name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>


                <div class="modal-body">
                    
                    <form autocomplete="off" @submit.prevent="editGroupSubmit" id="edit" method="post">
                       
                       <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="group_name">Name</label>
                            <input type="text" id="group_name" class="form-control" v-model="group_name" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                       
                       
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        <button  
                            type="button"
                            class="btn btn-danger"
                            @click="deleteGroup">
                            Delete
                        </button>
                        
                     
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                       
                       
                        </form>
                        
                        
                        
                        

                
                
                </div>
                </div>
              </div>
            </div>
        <!-- Modal edit group -->
        
       
        <LeftNav></LeftNav>
        
        
        <div class="main_container">
            <div class="row">
                <div class="col-6"><h1>Equipment Categories</h1></div>
                <div class="col-6">
                    <button 
                    type="button" 
                    class="btn btn-primary float-right"
                    data-toggle="modal" data-target="#addCategory"
                    >Add New Category
                    </button>
                </div>
            </div>
            
            
            <table class="table table-striped" v-if="categories">
                <thead>
                  <tr>
                    <th width="10%">Name</th>
                    <th width="20%">Assigned Equipments</th>
                    <th width="55%">Groups</th>
                    <th width="15%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="category in categories">
                    <td class="align-middle">{{ category.name }}</td>
                    <td class="align-middle">{{category.category_count}}</td>
                    
                    <td class="align-middle">
                        <button v-for="group in category.groups"
                        v-on:click="editGroup(group)"
                        style="margin-right: 5px;"
                        data-toggle="modal" data-target="#editGroup"
                        class="btn btn-secondary btn-sm"
                        >
                        {{group.name}}
                        </button>
                    </td>
                    
                    
                    
                    <td class="align-middle">
                        
                        
                    
                        <button  
                        data-toggle="modal" data-target="#editCategory"
                        :data-id="category.id"
                        :data-name="category.name"
                        @click="editCategory"
                        class="btn btn-secondary float-right"
                        >
                        Edit
                        </button>
                        
                        
                        <button  style="margin-right: 15px;"
                        type="button"
                        @click ="addGroup(category)"
                        class="btn btn-secondary float-right"
                        data-toggle="modal" 
                        data-target="#addGroup"
                        >Add New Group
                        </button>
                        
                        

                        </td>
                  </tr>
                </tbody>
            </table>
            
        </div>
    </main>
</template>



<script>
    import LeftNav from './LeftNav.vue'

   
    export default {
        components: {
            LeftNav
        },
        
        data(){
            return {
                name: '',
                error: false,
                errors: {},
                categories: null,
                category_id : '',
                group_name : '',
                group_id : '',
                categories: '',
                category: '',
            };
        },
        
        mounted() {
            this.refresTable()
        },
        
        
        methods : {
            refresTable : function(){
                var arrayOfEvents = [];
                this.$http.get('v1/categories/all').then(response => {
                    this.categories = response.data.data;
                })  
            },    
            
            addGroup : function(category){
                this.category_id = category.id
            },
            
            newGroup : function (event){
                 var id = this.category_id
                 var app = this
                 this.$http.post(`v1/categories/group/add`, {
                        name : this.group_name,
                        category : id
                        }).then(response => {
                            if(response.data.status == 'success'){
                                $('#addGroup').modal('hide');
                                this.refresTable()
                            }
                            else{
                                app.error = true;
                                app.errors = response.errors;
                            }
                        })
            },
            
            editGroup : function(group){
                this.group_name = group.name
                this.group_id = group.id
            },
            
            
            editGroupSubmit : function (event){
                
            },
            
            
            deleteGroup : function(event){
                
            this.$http.post(`v1/categories/group/delete`, {
                            id : this.group_id,
                            name : this.group_name
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.refresTable()
                                $('#editGroup').modal('hide');
                            }
                        })
               
           },
           
            
            
            newCategory : function (event){
            var app = this
            var name = app.name
            this.$http.post(`v1/categories/add`, {
                        name : name,
                        }).then(response => {
                            if(response.data.status == 'success'){
                                $('#addCategory').modal('hide');
                                this.refresTable()
                            }
                            else{
                                app.error = true;
                                app.errors = response.errors;
                            }
                        })
           },
           
           
           editCategory : function(event){
                this.category_id =  event.target.dataset.id
                this.name = event.target.dataset.name
           },
           
           editCategorySubmit : function(event){
            var app = this
            this.$http.post(`v1/categories/edit`, {
                            name : app.name,
                            id : this.category_id
                            
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.refresTable()
                                $('#editCategory').modal('hide');
                               
                            }
                            else{
                                app.error = true;
                                app.errors = response.errors;
                            }
                        })
               
               
           },
           
           
           deleteCategory : function(event){
            this.$http.post(`v1/categories/delete`, {
                            name : this.name,
                            id : this.category_id
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.refresTable()
                                $('#editCategory').modal('hide');
                            }
                        })
               
           }
           
           
        }
        
        
        
    }
    
    
    
    
    
</script>