<template>

    <main>
        
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
       
       <!-- Modal assign -->
            <div class="modal fade" id="assignEquipment" tabindex="-1" role="dialog" aria-labelledby="assignEquipment" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Assign Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <form autocomplete="off" @submit.prevent="assignEquipment" method="post">
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="equipment_id">Equipment ID</label>
                            <input type="text" id="equipment_id" class="form-control" v-model="equipment_id" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </form>
                </div>
                </div>
              </div>
            </div>
         <!-- Modal assign -->
         
         
          <!-- Modal unassign -->
            <div class="modal fade" id="unassignEquipment" tabindex="-1" role="dialog" aria-labelledby="unassignEquipment" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Unassign Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <form autocomplete="off" @submit.prevent="unassignEquipmentSubmit" method="post">
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="equipment_id">Equipment ID</label>
                            <input type="text" id="equipment_id" class="form-control" v-model="equipment_id" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Unassign</button>
                    </form>
                </div>
                </div>
              </div>
            </div>
         <!-- Modal unassign -->
         
         
         
         <!-- Modal consign -->
            <div class="modal fade" id="consignEquipment" tabindex="-1" role="dialog" aria-labelledby="consignEquipment" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Consign Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <form autocomplete="off" @submit.prevent="consignEquipment" method="post">
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="equipment_id">Equipment ID</label>
                            <input type="text" id="equipment_id" class="form-control" v-model="equipment_id" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="assigned_to">Associate Name</label>
                            <input type="text" id="assigned_to" class="form-control" v-model="assigned_to" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                       
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Consign</button>
                    </form>
                </div>
                </div>
              </div>
            </div>
         <!-- Modal consign -->
         
         
         <!-- Modal retire -->
            <div class="modal fade" id="retireEquipment" tabindex="-1" role="dialog" aria-labelledby="retireEquipment" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Retire Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <form autocomplete="off" @submit.prevent="retireEquipment" method="post">
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="equipment_id">Equipment ID</label>
                            <input type="text" id="equipment_id" class="form-control" v-model="equipment_id" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Retire</button>
                    </form>
                </div>
                </div>
              </div>
            </div>
         <!-- Modal retire -->
        
        
        
    <LeftNav></LeftNav>
        <div class="main_container">
           <div class="main_wrapper">
               
           
            <div class="row" v-if="event">
                
                <div class="col-6">
                    <h1>{{event.title}} - P#:{{event.p_number}}</h1>
                </div>

                <div class="col-6">
                     <router-link :to="{ name: 'events'}"> <button type="button" class="btn btn-primary float-right" >Back</button></router-link>
                </div>
                
                <div class="col-12">
                    <ul>
                        <li>Dates: <strong>{{event.days}}</strong></li>
                        <li>Address: <strong>{{event.address}}</strong></li>
                    </ul>
                </div>
                
                
            </div>
            
            
            
            <div class="row" v-if="requests.length > 0 && role.name != 'Event Manager'">
                <div class="col-12">
                    <h2>Requests</h2>
                </div>
                
                <!--request wrapper-->
                <div class="col-12" v-for="request in requests">
                    <div class="request_wrapper">
                        <div class="request_title">
                             <h3>Requested by: {{request.user.name}} @ {{request.created_at}}</h3>
                              <button 
                                class="btn btn-danger float-right"
                                v-on:click="deleteRequest(request)"  
                                >Delete
                                </button>
                        </div>
                        
                         
                         
                         <div class="row" v-for="equipment in request.equipment">
                             
                             <div class="col-12">
                                 <div class="single_request_wrapper">
                                     <div class="row">
                                        <div class="col-6" style="border-right: solid 1px #ccc;">
                                            <h5>Requested {{equipment.qty}}</h5>
                                            <ul>
                                                <li>Name: <strong>{{equipment.name}}</strong></li>
                                                <li>Category: <strong>{{equipment.category}}</strong></li>
                                            </ul>
                                            
                                            <button 
                                            class="btn btn-primary"
                                            data-toggle="modal" 
                                            data-target="#assignEquipment"
                                            v-on:click="assignEquipmentPrepare(equipment, request)"
                                            >Assign
                                            </button>
                                            
                                        </div>
                                        
                                        <div class="col-6">
                                            <h5 v-bind:class="checkAssigned(equipment)">Assigned {{ calculateAssigned(equipment) }}</h5>
                                               <table class="table table-striped">
                                                   <thead>
                                                    <tr>
                                                        <th width="5%"></th>
                                                        <th width="5%">ID</th>
                                                        <th width="30%">Name</th>
                                                        <th width="30%">Date</th>
                                                        <th width="30%"></th>
                                                    </tr>
                                                   
                                                   </thead>
                                                   
                                                   <tbody>
                                                    <tr v-for="(assigned, index) in request.assigned"  v-if="assigned.equipment_request == equipment.equipment_request">
                                                        <td class="align-middle">{{doMath(index)}}</td>
                                                        <td class="align-middle">{{assigned.id}}</td>
                                                        <td class="align-middle">{{assigned.name}}</td>
                                                        <td class="align-middle">{{assigned.assign_date.date | formatDate}}</td>
                                                        <td class="align-middle">
                                                        <button type="button" 
                                                        class="btn btn-warning btn-sm float-right"
                                                        data-toggle="modal" 
                                                        data-target="#unassignEquipment"
                                                        v-on:click="unassignEquipment(assigned)"
                                                        >Unassign</button>   
                                                        </td>
                                                   </tr>
                                                   </tbody>
                                                   
                                                   
                                               </table>
                                        </div>
                                        
                                        
                                        
                                     </div>
                                 </div>
                             </div>
                             
                             
                         </div>
                             
                                 
                        
                         
                        
                        
                         
                    </div>
                </div>
                <!--request wrapper-->
            </div>
            
            
            <!--device wrapper-->
            <div class="row" v-if="equipments && equipments.length > 0 && role.name != 'Equipment Manager'">
                
                <div class="col-12">
                    <h2>Event Assigned Equipment</h2>
                </div>
                
                <div class="col-12" style="margin-bottom: 60px;"  v-for="equipmentcat in equipments">
                    <h2 class="small">{{equipmentcat.category}}</h2>
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th width="5%">ID</th>
                        <th width="25%">Name</th>
                        <th width="20%">Assigned To</th>
                        <th width="20%">Consigned @</th>
                        <th width="25%">Consigned To</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="equipment in equipmentcat.equipments">
                        <td class="align-middle">{{ equipment.id }}</td>
                        <td class="align-middle">{{ equipment.name }}</td>
                        <td class="align-middle">{{ equipment.user.name }}</td>
                        <td class="align-middle">{{ equipment.chekout_date }}</td>
                         <td class="align-middle">{{ equipment.assigned_to }}</td> 
                       
                      </tr>
                    </tbody>
                    </table>
                </div>
                
                
                
                <div class="col-6">
                    <button type="button" 
                    class="btn btn-primary btn-block btn-lg"
                    data-toggle="modal" 
                    data-target="#consignEquipment"
                    >Consign</button>   
                </div>
                
                
                <div class="col-6">
                    <button type="button" 
                    class="btn btn-warning btn-block btn-lg"
                    data-toggle="modal" 
                    data-target="#retireEquipment"
                    >Retire</button>   
                </div>
                
                
                
                
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
                event_id: null,
                event: [],
                equipment_id:'',
                assigned_to: '',
                error: false,
                errors: {},
                equipments : null,
                requests: '',
                request_id : '',
                request_type: '',
                user_id: '',
                assign_id: '',
                equipment_request: '',
                gear_request : '',
                error_message : '',
                logged_user : '',
                role: '',
                
                equipment_id_unassign: '',
                
            };
        },
        
        mounted() {
            
            this.getLoggedUser();
            this.event_id = this.$route.params.id
            this.retrieve_event()
            this.reloadRequests()
        },
        
        methods : {
            
            doMath: function (index) {
            return index+1
            },
            
            
            getLoggedUser : function(){
               this.$http.get('v1/get-user').then(response => {
                   this.logged_user = response.data.data;
                   this.role = response.data.data.role;
                }) 
            },
            
            
            checkAssigned : function (equipment){
                
                let count = this.calculateAssigned(equipment);
                
                if(count < equipment.qty){
                    return  'active';
                }else{
                    
                    return  'noactive';
                }
                
                
            },
            
            calculateAssigned : function (equipment){

              let arrayLength = this.requests.length;
              let count = 0;
              let assignedCount = 0;
              
              for (var i = 0; i < arrayLength; i++) {
                
                let assigned = this.requests[i].assigned;
                
                if(assigned){
                    let assignedCount = assigned.length;
                    for (var n = 0; n < assignedCount; n++) {
                      if(assigned[n].equipment_request == equipment.equipment_request){
                          count++
                      }
                    }
                }
               
                
                
                   
              }
                
                    
              return count;  
              
              
            },
            
            
            
            
            retrieve_event : function(){
                this.$http.post(`v1/events/event`, {
                            id : this.event_id,
                            }).then(response => {
                            if(response.data.status == 'success'){
                                this.equipments = response.data.equipments
                                var first_day = '';
                                var last_day = '';
                                var days = '';
                                var dates_array =  JSON.parse(response.data.data.dates);
                                if(dates_array.length>1){
                                   first_day = moment(dates_array[0]).format('LL')
                                   last_day = moment(dates_array[dates_array.length-1]).format('LL')
                                   days = first_day + " to " + last_day
                                }else{
                                    first_day = moment(dates_array[0]).format('LL');
                                    days = first_day
                                }
                                this.event =  {title:response.data.data.title, p_number:response.data.data.p_number, address:response.data.data.address, days:days, id:response.data.data.id, archived : response.data.data.archived };
                                
                            }
                        })

            },
            
            
            reloadRequests : function(){
                
                 this.$http.post(`v1/request/all`, {
                            event_id : this.event_id,
                            }).then(response => {
                           
                           let requests = response.data.data;
                            let array_parsed = []
                   
                    let arrayLength = requests.length;
                    for (var i = 0; i < arrayLength; i++) {
                        
                        let equipments =  requests[i].equipment
                        let assigned =  requests[i].assigned

                        requests[i].equipment = JSON.parse(equipments)
                        
                        if(assigned){
                            requests[i].assigned = JSON.parse(assigned)
                        }
                        
                        
                        

                    }
                    
                    this.requests = requests
                    
                        })
                        
                        
                
               
                
            },
            
            deleteRequest : function (request){
                this.$http.post(`v1/request/delete`, {
                                id : request.id,
                    }).then(response => {
                        if(response.data.status == 'success'){
                            this.reloadRequests();
                            }
                    })
            
                
            },
            
            assignEquipmentPrepare : function(equipment, request){
                this.equipment_request = equipment.equipment_request;
                this.gear_request = request.id;
                this.user_id = request.user.id;
                this.equipment_id = null;
            },
            
            
            assignEquipment : function(event){
                
                let equipment_request =  this.equipment_request;
                let gearevent = this.event_id;
                let user = this.user_id;
                let gear_request = this.gear_request;
                var app = this
                
                
                this.$http.post(`v1/equipment/assign`, {
                                event : gearevent,
                                equipment_id : this.equipment_id,
                                user : user,
                                equipment_request : equipment_request,
                                gear_request : gear_request
                                
                            }).then(response => {
                                
                                if(response.data.status == 'success'){
                                    this.reloadRequests();
                                    this.retrieve_event();
                                    $('#assignEquipment').modal('hide');
                                }
                                
                                else if(response.data.status == 'fail'){
                                    $('#assignEquipment').modal('hide');
                                    $('#modalError').modal('show');
                                    this.error_message = response.data.message
                                }
                                
                                
                            })
                            
                            
            },
            
            
            unassignEquipment : function (assigned){
                this.equipment_id_unassign = assigned.id;
                this.equipment_request = assigned.equipment_request;

            },
                
            
              
            unassignEquipmentSubmit: function (event){
                    var app = this
                    
                    if(this.equipment_id_unassign == this.equipment_id){
                       
                        this.$http.post(`v1/equipment/unassign`, {
                            equipment_id : this.equipment_id,
                            equipment_request : this.equipment_request
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.reloadRequests();
                                this.retrieve_event();
                                 $('#unassignEquipment').modal('hide');
                                }
                        })
                        
                    }else{
                        $('#unassignEquipment').modal('hide');
                        $('#modalError').modal('show');
                        this.error_message = 'Wrong Equipment ID'
                    }
                    
                    
              
                
            },
            
            
            
            
            consignEquipment : function (event){
                let event_id = this.event_id
                var app = this
                this.$http.post(`v1/equipment/consign`, {
                                event_id : event_id,
                                id : this.equipment_id,
                                assigned_to : this.assigned_to,
                            }).then(response => {
                                if(response.data.status == 'success'){
                                    this.retrieve_event();
                                    $('#consignEquipment').modal('hide');
                                    
                                }else if(response.data.status == 'fail'){
                                    $('#consignEquipment').modal('hide');
                                    $('#modalError').modal('show');
                                    this.error_message = response.data.message
                                }
                                
                            })
            },
            
            retireEquipment : function (equipment){
                var app = this
                 this.$http.post(`v1/equipment/retire`, {
                                id : this.equipment_id,
                            }).then(response => {
                                if(response.data.status == 'success'){
                                    this.retrieve_event();
                                    $('#retireEquipment').modal('hide');
                                }
                            })
               
            },
            
           
            
            
        }
        
        
    }
</script>


<style lang="scss" scoped>
   @import '~@/_variables.scss';
   
   h2{
       margin-top: 60px;
       border-bottom: solid 1px $blue;
       padding-bottom: 5px;
       
       &.small{
           font-size: 1.25em;
           border-bottom: none;
           padding: 8px;
           background: $blue;
           color: #fff;
           font-weight: 300;
           text-transform: uppercase;
           -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-top: 30px;
            
            &:first-child{
                margin-top: 0px;
            }
       }
   }
   
   h3{
     font-size: 1em;
     font-weight: 300;
      margin-bottom: 0px;
      color: #fff;
   }
   
   .request_title{
    padding: 15px;
    text-transform: uppercase;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    background: $blue;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
   }
   
   h5{
       font-weight: 700;
       margin-bottom: 15px;
       font-size: 1.1em;
        
        &.active{
            color: #c82333;
        }
        
        &.noactive{
            color: #438e00;
        }
   }
   
   ul{
      li{
        margin-bottom: 15px;
        &:last-child{
          margin-bottom: 0px;
        }
      }
    }
    
    
    .request_wrapper{
        margin-bottom: 30px;
        padding: 0px 0px 15px 0px;
        border-bottom: solid 1px $gray20;
        margin-bottom: 15px;
       
    }
    
    .single_request_wrapper{
        margin-bottom: 15px;
        border: solid 1px $gray30;
        padding: 15px;
        background: rgba(255,255,255,0.7);
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        
        button{
            margin-top: 15px;
        }
    }
       
</style>