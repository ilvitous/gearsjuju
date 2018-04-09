<template>
    <main>
        
        <!-- Modal add -->
            <div class="modal fade" id="addEquipment" tabindex="-1" role="dialog" aria-labelledby="addEquipment" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add New Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                <div class="modal-body">
                    
                    <form autocomplete="off" @submit.prevent="newEquipment" id="register" method="post">
                       
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="title">Name</label>
                            <input type="text" id="name" class="form-control" v-model="name" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        
                       
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                            <label for="serial">Serial</label>
                            <input id="serial" type="text" class="form-control" v-model="serial">
                            <span class="help-block" v-if="error && errors.email">{{ errors.address }}</span>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Category</label>
                            <select class="form-control" v-model="category" required>
                                <option disabled value="">Please select one</option>
                                <option 
                                v-for="category in categories" 
                                :value="category.id" 
                                >
                                  {{category.name}}
                                </option>
                            </select>
                        </div>
                      
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New Equipment</button>
                        
                        
                        </form>
                
                
                </div>
                
                
                
                </div>
              </div>
            </div>
        <!-- Modal add -->
        
        
        <!-- Modal edit -->
            <div class="modal fade" id="editEquipment" tabindex="-1" role="dialog" aria-labelledby="editEquipment" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">{{name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                <div class="modal-body">
                    
                    <form autocomplete="off" @submit.prevent="editEquipmentSubmit" id="register" method="post">
                       
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="title">Name</label>
                            <input type="text" id="name" class="form-control" v-model="name" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        
                       
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                            <label for="serial">Serial</label>
                            <input id="serial" type="text" class="form-control" v-model="serial">
                            <span class="help-block" v-if="error && errors.email">{{ errors.address }}</span>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Category</label>
                            <select class="form-control" v-model="selected" required>
                                <option disabled value="">Please select one</option>
                                <option 
                                v-for="category in categories" 
                                v-bind:value="category.id"
                                >
                                  {{category.name}}
                                </option>
                            </select>
                        </div>
                        
                        
                        <div class="form-group">
                             <img width="100%" height="auto" class="img-responsive" :src="'/qrcodes/qrcode_'+id+'.svg'">
                             
                             <div id="printableArea">
                                <div style="width:45mm; text-align: center; border: solid 1px #000">
                                     <img width="100%" height="auto" class="img-responsive" :src="'/qrcodes/qrcode_'+id+'.svg'">
                                     <h1 style="font-size: 8px; font-family: sans-serif">{{name}}</h1>
                                </div>
                            
                             </div>
                             
                        </div>
                        
                        
                        
                      
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        
                        <button  
                            type="button"
                            class="btn btn-danger"
                            @click="deleteEquipment">
                            Delete
                        </button>
                        
                        <button  
                            type="button"
                            class="btn btn-secondary"
                            @click="printQr">
                            Print
                        </button>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                        
                        
                        
                        
                        
                        </form>
                
                
                </div>
                
                
                
                </div>
              </div>
            </div>
        <!-- Modal edit -->
        
        <LeftNav></LeftNav>
        <div class="main_container">
            <div class="row">
                <div class="col-6"><h1>Equipments</h1></div>
                <div class="col-6">
                    <button 
                    type="button" 
                    class="btn btn-primary float-right"
                    data-toggle="modal" data-target="#addEquipment"
                    @click = "addEquipment"
                    >Add New Equipment
                    </button>
                </div>
            </div>
            
            <div class="row" v-if="equipments" v-for="equipmentcat in equipments">
                
                <div class="col-12">
                    
                    <h2>{{equipmentcat.category}}</h2>
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th width="5%">ID</th>
                        <th width="45%">Name</th>
                        <th width="15%">Serial</th>
                        <th width="35%">Checked Out</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        
                     
                      <tr v-for="equipment in equipmentcat.equipments">
                        <td class="align-middle">{{ equipment.id }}</td>
                        <td class="align-middle">{{ equipment.name }}</td>
                        <td class="align-middle">{{ equipment.serial }}</td>
                        <td class="align-middle">{{ equipment.chekout }}</td>
                        <td class="align-middle">
                            <button  
                            v-on:click="editEquipment(equipment)"
                            data-toggle="modal" data-target="#editEquipment"
                            class="btn btn-secondary float-right">
                            Open
                            </button>
                        </td>
                      </tr>
                     
                      
                      
                    </tbody>
                    </table>
                    
                </div>
                
                    
                
            </div>
            
            
            
            
            
            
            
            
            
            
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
                serial: '',
                id: '',
                error: false,
                errors: {},
                categories: '',
                category: '',
                equipments: '',
                selected: '',
                
            };
        },
        
        mounted() {
            
            this.refresTable()
        },
        
        
        methods : {
            
            addEquipment(){
                this.$http.get('v1/categories/all').then(response => {
                this.categories = response.data.data;
                })
                
            },
            
            newEquipment : function(event){
                var app = this
                 this.$http.post(`v1/equipment/add`, {
                        name : app.name,
                        serial : app.serial,
                        category : app.category,
                        }).then(response => {
                            if(response.data.status == 'success'){
                                $('#addEquipment').modal('hide');
                                this.refresTable()
                            }
                            else{
                                app.error = true;
                                app.errors = response.errors;
                            }
                        })
            },
            
            
            editEquipmentSubmit : function(event){
                 var id = this.id
                 var app = this
                 this.$http.post(`v1/equipment/edit`, {
                        id : id,
                        name : app.name,
                        serial : app.serial,
                        category : app.selected,
                        }).then(response => {
                            if(response.data.status == 'success'){
                                $('#editEquipment').modal('hide');
                                this.refresTable()
                            }
                            else{
                                app.error = true;
                                app.errors = response.errors;
                            }
                        })
                
            },
            
            
            
            refresTable : function(){

                this.$http.get('v1/equipment/all').then(response => {
                    this.equipments = response.data.data;
                })  
                
            }, 
            
            
            editEquipment : function(equipment){
                this.$http.get('v1/categories/all').then(response => {
                this.categories = response.data.data;
                })
                this.name = equipment.name
                this.id = equipment.id
                this.serial = equipment.serial
                this.selected = equipment.category_id
                
                
                

            }, 
            
            deleteEquipment : function(event){
                    
                    this.$http.post(`v1/equipment/delete`, {
                            id : this.id,
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.refresTable()
                                $('#editEquipment').modal('hide');
                            }
                        })

            },
            
            printQr : function(event){
                var w = window.open();
                
                w.document.write($('#printableArea').html());
                w.print();
                w.close();
                
            }
          
                        
            
            
                
                
        }
        
        
        
    }
    
    
    
    
    
</script>

<style lang="scss" scoped>
   @import '~@/_variables.scss';
   
   h2{
       margin-top: 60px;
       border-bottom: solid 1px $blue;
       padding-bottom: 5px;
   }
   
   #printableArea{
      display: none;
    }
   
    
    @media print {
      #printableArea{
          display: block;
          
      }
    
    }
   
  
       
</style>