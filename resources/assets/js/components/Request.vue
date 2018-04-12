<template>
    <main>
        
       
        
        <LeftNav></LeftNav>
        <div class="main_container">
            <div class="row">
                <div class="col-12"><h1>Equipment Request Form</h1></div>
            </div>
            
            <div class="row" v-if="request_submitted">
                <div class="col-12">
                    <h5>Thank you {{user.name}}, your Equipment Request was succesfully submitted</h5>
                </div>
            </div>
            
            
            <div class="row" v-if="!request_submitted">
                <div class="col-12">
                <form autocomplete="off" @submit.prevent="sendRequest" id="request" method="post">
                <h2 style="margin-top:0px;">Event</h2>
                
                <div class="form-group">
                            <select class="form-control" v-model="event" required>
                                <option disabled value="">Please select one</option>
                                <option 
                                v-for="event in events" 
                                :value="event.id" 
                                >
                                  {{event.title}}
                                </option>
                            </select>
                </div>
                               
                        
                <h2>Available Equipment</h2>
                  <div class="row" v-if="equipments">
                    
                        <div class="col-6" v-for="(equipmentcat, index) in equipments">
                            <div class="row">
                                <div class="col-12">
                                    <h3>{{equipmentcat.category}}</h3>
                                    <div class="form-group form-row align-items-center equipment" v-for="equipment in equipmentcat.equipments">
                                        <div class="quantity">
                                          <input class="qty" type="number" min="0" step="1">
                                        </div>
                                        <label class="form-check-label" for="serial">{{equipment.name}}</label>
                                        <input class="id" type="hidden" :value="equipment.id">
                                        <input class="name" type="hidden" :value="equipment.name">
                                        <input class="type" type="hidden" :value="equipment.type">
                                        <input class="category" type="hidden" :value="equipmentcat.category">
                                    </div>
                                </div>
                            </div>
                        </div>
                 </div>
                
                
        
                <button type="submit" class="btn btn-primary">Send Request</button>
                        
                        
                    </form>
                    
                    
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
                error: false,
                errors: {},
                equipments : '',
                event : '',
                events : '',
                user: '',
                error: false,
                errors: {},
                request_json : '',
                request_submitted : false,
            };
            
        },
        
        mounted() {
        
            this.loadEquipments()
            this.loadEvents()
            this.getUser()
        },
        
        
        
        
        methods : {
            
            
            getUser : function(){
               this.$http.get('auth/user').then(response => {
                    this.user = response.data.data;
                })
              
              
            },
            
            loadEquipments : function(){
                this.$http.get('v1/equipment/request/all').then(response => {
                    this.equipments = response.data.data;
                })
                
                
            },
            
            loadEvents : function(){
                this.$http.get('v1/events/all').then(response => {
                this.events = response.data.data;
                }) 
            },
            
            sendRequest : function (event){
                
                var request = [];
                $( ".equipment" ).each(function( index ) {
                  var qty = $(this).find(".qty").val();
                  var id = $(this).find(".id").val();
                  var type = $(this).find(".type").val();
                  var name = $(this).find(".name").val();
                  var category = $(this).find(".category").val();
                  
                  
                  if(qty>0){
                     
                     var request_id =  'id-' + Math.random().toString(36).substr(2, 16);
                     
                     var equipment = {"equipment_request" : request_id,  "qty" : qty , "equipment_id" : id , "type" : type, "name" : name, "category" : category}
                     
                     request.push(equipment);
                  }
                });
                
                
                this.request_json = JSON.stringify(request)
                
                console.log(this.request_json)
                
                this.$http.post(`v1/request/add`, {
                            equipment : this.request_json,
                            user : this.user.id,
                            event : this.event
                        }).then(response => {
                            
                            if(response.data.status == 'success'){
                                this.request_submitted = true;
                            }
                            else{
                                this.error = true;
                                this.errors = response.errors;
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
  
  h3{
    margin-bottom: 15px;
    font-size: 0.8em;
    text-transform: uppercase;
    background : $gray20;
    padding: 10px 5px 6px 10px;
        
  }
  
  h5{
      font-size: 1.3em;
      margin-bottom: 5px;
      color: $blue;
  }
  
  .form-group{
      margin-bottom: 30px;
  }
  
  label{
      margin-bottom: 5px;
  }
  
  .quantity {
      position: relative;
      margin-right: 15px;
      float: left;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button
    {
      -webkit-appearance: none;
      margin: 0;
    }
    
    input[type=number]
    {
      -moz-appearance: textfield;
    }
    
    .quantity input {
      width: 65px;
      height: 42px;
      line-height: 1.65;
      float: left;
      display: block;
      padding: 0;
      margin: 0;
      margin-left: 5px;
      border: 1px solid #eee;
      text-align: center;
    }
       
</style>