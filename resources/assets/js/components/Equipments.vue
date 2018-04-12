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
                        
                       
                        <div class="form-group" v-if="groups.length > 0">
                            
                            <div class="form-check form-check-inline"  v-for="(group, index) in groups">
                              <input class="form-check-input" type="checkbox" v-bind:id="group.id" :value="group.id" v-model="group_assigned">
                              <label class="form-check-label" v-bind:for="group.id">{{group.name}}</label>
                            </div>
                            
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
            
            <div class="row">
                <div class="col-12">
                     <button 
                        type="button" 
                        class="btn btn-primary"
                        @click = "filterChecked"
                        >Filter by Checked Out
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
                        <th width="20%">Name</th>
                        <th width="10%">Serial</th>
                        <th class="text-center" width="25%">Checked Out</th>
                        <th width="30%">Event</th>
                        <th width="10%"></th>
                      </tr>
                    </thead>
                    <tbody>
                        
                     
                      <tr v-for="equipment in equipmentcat.equipments">
                        <td class="align-middle">{{ equipment.id }}</td>
                        <td class="align-middle">
                            {{ equipment.name }}
                            <span class="groups" v-if="equipment.group">
                                <span v-for="group in equipment.group">
                                     {{ group.name }}
                                </span>    
                            </span>
                        </td>
                        
                       
                            
                       
                        
                       
                        
                        <td class="align-middle">{{ equipment.serial }}</td>
                        <td class="align-middle text-center">
                        <span class="checkout" v-if="equipment.chekout > 0"><i class="fas fa-circle"></i></span></td>
                        <td class="align-middle">
                        
                        <router-link :to="{ name: 'event', params: { id: equipment.gearevent_id }}" v-if="equipment.chekout > 0">{{ equipment.gearevent_title }}</router-link>
                            
                        </td>
                        
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
                filtered_equipments: '',
                no_filtered_equipments: '',
                filtered: false,
                groups : '',
                group : '',
                
                group_assigned : []
                
            };
        },
        
        mounted() {
            this.refresTable()
        },
        
        watch: {
            category: function(){
                
                this.$http.post(`v1/categories/group/all`, {
                        id : this.category,
                        }).then(response => {
                            if(response.data.status == 'success'){
                               this.groups = response.data.data;
                            }
                        })
                
                
                
            },
            
          
        },
        
        
        methods : {
            
            addEquipment(){
                
                this.name = ''
                this.serial = ''
                this.id = ''
                this.category = ''
                this.groups = ''
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
                        group : app.group_assigned,
                        
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
                    this.no_filtered_equipments = response.data.data;
                    this.equipments = this.no_filtered_equipments;

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
                
            },
            
            filterChecked : function (){
                
                if(this.filtered == false){
                    this.filtered = true
                    
                    this.filtered_equipments = this.no_filtered_equipments;
                   
                    this.filtered_equipments.forEach(function(element) {
                        var equipments = element.equipments;
                        var newArray = equipments.filter(function (el) {
                        return el.chekout > 0;
                        });
                        element.equipments = newArray;
                    });
                    

                }else{
                    this.filtered = false
                    this.refresTable()
                }
                
                
                
                                                
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
   
   table{
       span.checkout{
           color: #ff0000;
       }
       
       span.groups{
           display: block;
           font-size: 0.8em;
           margin-top: 5px;
       }
   }
    
    @media print {
      #printableArea{
          display: block;
          
      }
    
    }
   
  
       
</style>