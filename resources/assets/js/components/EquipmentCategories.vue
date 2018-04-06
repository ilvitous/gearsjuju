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
            
            
            <table class="table" v-if="categories">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Assigned Equipments</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="category in categories">
                    <td class="align-middle">{{ category.name }}</td>
                    <td class="align-middle">25</td>
                    <td class="align-middle">
                        
                        <button  
                        data-toggle="modal" data-target="#editEvent"
                        class="btn btn-secondary float-right">
                        Edit
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
           
           
           
           
           
        }
        
        
        
    }
    
    
    
    
    
</script>