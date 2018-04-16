<template>
   
   <main class="container-fluid">
       
       <!-- Modal ckeckin -->
            <div class="modal fade" id="checkIn" tabindex="-1" role="dialog" aria-labelledby="checkIn" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Check In</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                   
                    <form autocomplete="off" @submit.prevent="checkIn" method="post">
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="equipment_id">Equipment ID</label>
                            <input type="text" id="equipment_id" class="form-control" v-model="equipment_id" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Check In</button>
                    </form>
                </div>
                
                
                
                </div>
              </div>
            </div>
         <!-- Modal ckeckin -->
         
         
         <!-- Modal error -->
            <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="modalError" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Error!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <div class="modal-body">
                    <p style="margin-bottom: 30px;">{{error_message}}</p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
              </div>
            </div>
         <!-- Modal error -->
         
         
       
       <div class="row">
            <LeftNav></LeftNav>
             
            <div class="main_container">
                <div class="main_wrapper">
                    <div class="row">
                        <div class="col-12">
                            <button 
                            class="btn btn-warning btn-lg btn-block"
                            data-toggle="modal" 
                            data-target="#checkIn"                            
                            >Check In
                            </button>
                        </div>
                        
                        <div class="col-12" v-if="response">
                            <h2>Check In Report</h2>
                            
                            <ul class="list-group">
                              <li class="list-group-item">Equipment successfully removed from: <strong>{{response.gearevent_name}}</strong></li>
                              <li class="list-group-item">Equipment successfully unassigned from: <strong>{{response.user}}</strong></li>
                              <li class="list-group-item" v-if="response.assigned_to">Equipment successfully retired from: <strong>{{response.assigned_to}}</strong></li>
                            </ul>
                                                        
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            
       </div>
   </main>
     
</template>


     
<script>
    import LeftNav from './LeftNav.vue'
    import MainDashboard from './MainDashboard.vue'

   
   
    export default {
        components: {
            LeftNav,
        },
        
         data(){
            return {
               
                error: false,
                errors: {},
                equipment_id : '',
                response : '',
                error_message : ''
            };
        },
    
        
        methods : {
        
            checkIn : function (event){
                    var app = this
                    
                    this.$http.post(`v1/equipment/unassign`, {
                            equipment_id : this.equipment_id,
                        }).then(response => {
                            if(response.data.status == 'success'){
                                 this.response = response.data.data
                                 $('#checkIn').modal('hide');
                            }else if(response.data.status == 'error'){
                                this.error_message = response.data.data.message
                                $('#checkIn').modal('hide');
                                $('#modalError').modal('show');
                               
                                
                            }
                        })
                    
                    
              
                
            },
            
        },
    
    }
    
    
    
    
    
</script>



<style lang="scss" scoped>
   @import '~@/_variables.scss';
   
   h2{
       margin-top: 30px;
       border-bottom: solid 1px $blue;
       padding-bottom: 5px;
   }
   
</style>