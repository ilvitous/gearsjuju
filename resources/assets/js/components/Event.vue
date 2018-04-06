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
                
            </div>
            
            
            <div class="row">
                <div class="col-12"><h2>Assigned Equipments</h2></div>
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
                                
                                this.event =  {title:response.data.data.title, address:response.data.data.address, days:days, id:response.data.data.id};
                                

                                
                                
                                
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