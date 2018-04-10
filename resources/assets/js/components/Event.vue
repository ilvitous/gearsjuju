<template>

    <main>
      
    <LeftNav></LeftNav>
        <div class="main_container">
           
            <div class="row" v-if="event">
                
                <div class="col-6">
                    <h1>{{event.title}}</h1>
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
                
                
                <div class="col-12">
                   <h2>Add Equipment</h2>
                   
                   <form autocomplete="off" @submit.prevent="chechIn" id="chechIn" method="post">
                       
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="equipment_id">Equipment ID</label>
                            <input type="text" id="equipment_id" class="form-control" v-model="equipment_id" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="assigned_to">Assigned To</label>
                            <input type="text" id="assigned_to" class="form-control" v-model="assigned_to" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>

                        <button type="submit" class="btn btn-primary">Check In</button>
                    </form>
                        
                        
                </div>
                
                
                
            </div>
            
            
            <div class="row" v-if="equipments" v-for="equipmentcat in equipments">
                
                <div class="col-12">
                    
                    <h2>{{equipmentcat.category}}</h2>
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th width="5%">ID</th>
                        <th width="25%">Name</th>
                        <th width="20%">Serial</th>
                        <th width="20%">Checked In</th>
                        <th width="20%">Assigned To</th>
                        <th width="10%"></th>
                      </tr>
                    </thead>
                    <tbody>
                        
                     
                      <tr v-for="equipment in equipmentcat.equipments">
                        <td class="align-middle">{{ equipment.id }}</td>
                        <td class="align-middle">{{ equipment.name }}</td>
                        <td class="align-middle">{{ equipment.serial }}</td>
                        <td class="align-middle">{{ equipment.chekout_date }}</td>
                         <td class="align-middle">{{ equipment.assigned_to }}</td> 
                        <td class="align-middle">
                            <button  
                            v-on:click="checkOut(equipment)"
                            class="btn btn-warning float-right">
                            Check Out
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
                event_id: null,
                event: [],
                equipment_id:'',
                assigned_to: '',
                error: false,
                errors: {},
                equipments : null
            };
        },
        
        mounted() {
            this.event_id = this.$route.params.id
            this.retrieve_event()
        },
        
        methods : {
            
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
                                this.event =  {title:response.data.data.title, address:response.data.data.address, days:days, id:response.data.data.id, archived : response.data.data.archived };
                                
                            }
                        })

            },
            
            
            
            
            
            chechIn : function (event){
                event = this.event_id
                var app = this
                this.$http.post(`v1/equipment/checkin`, {
                                event : event,
                                id : this.equipment_id,
                                assigned_to : this.assigned_to,
                            }).then(response => {
                                if(response.data.status == 'success'){
                                    this.retrieve_event();
                                }
                                else{
                                    app.error = true;
                                    app.errors = response.errors;
                                }
                            })
            },
            
            checkOut : function (equipment){
                 this.$http.post(`v1/equipment/checkout`, {
                                id : equipment.id,
                            }).then(response => {
                                if(response.data.status == 'success'){
                                    this.retrieve_event();
                                }
                            })
               
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
   
   ul{
      li{
        margin-bottom: 15px;
        &:last-child{
          margin-bottom: 0px;
        }
      }
    }
       
</style>