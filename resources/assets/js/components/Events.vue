<template>

    <main>
        
        
        <!-- Modal add -->
            <div class="modal fade" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="addEvent" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add New Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                <div class="modal-body">
                    
                    <form autocomplete="off" @submit.prevent="newEvent" id="register" method="post">
                       
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control" v-model="title" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        
                        
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="dates">Dates</label>
                            
                            
                            <m-date-picker v-model="dates" :multi="multi"></m-date-picker>
                            <span class="help-block" v-if="error && errors.name">{{ errors.dates }}</span>
                            
                            
                        </div>
                        
                        
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                            <label for="address">Address</label>
                            <input id="address" type="text" class="form-control" v-model="address" required>
                            <span class="help-block" v-if="error && errors.email">{{ errors.address }}</span>
                        </div>
                        
                      
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New Event</button>
                        </form>
                
                
                </div>
                </div>
              </div>
            </div>
        <!-- Modal add -->
        
        
        <!-- Modal edit -->
            <div class="modal fade" id="editEvent" tabindex="-1" role="dialog" aria-labelledby="editEvent" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Event {{title}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                <div class="modal-body">
                  
                   
                   
                   <form autocomplete="off" @submit.prevent="editEventSubmit" id="edit" method="post">
                       
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control" v-model="title" required>
                            <span class="help-block" v-if="error && errors.name">{{ errors.title }}</span>
                        </div>
                        
                        
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                            <label for="dates">Dates</label>

                            <m-date-picker v-model="dates" :multi="multi"></m-date-picker>
                            <span class="help-block" v-if="error && errors.name">{{ errors.dates }}</span>

                        </div>
                        
                        
                        <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                            <label for="address">Address</label>
                            <input id="address" type="text" class="form-control" v-model="address" required>
                            <span class="help-block" v-if="error && errors.email">{{ errors.address }}</span>
                        </div>
                        
                      
                        
                       
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                       
                        <button  
                            class="btn btn-danger"
                            @click="deleteEvent">
                            Delete
                        </button>
                        
                         <button  
                            type="button"
                            class="btn btn-warning"
                            @click="archiveEvent">
                            Archive
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
                <div class="col-6"><h1>Events</h1></div>
                <div class="col-6">
                    <button 
                    type="button" 
                    class="btn btn-primary float-right"
                    data-toggle="modal" data-target="#addEvent"
                    @click="clearVar"
                    >Add New Event
                    </button>
                </div>
            </div>
        
         
                        
        
            <table class="table table-striped" v-if="events">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Dates</th>
                    <th>Address</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="event in events">
                    <td class="align-middle">
                        
                    {{ event.title }}
                    </td>
                    <td class="align-middle">{{ event.days }}</td>
                    <td class="align-middle">{{ event.address }}</td>
                    <td class="align-middle">
                        
                        <router-link :to="{ name: 'event', params: { id: event.id }}"><button class="btn btn-secondary float-right" style="margin-left: 15px;">Open</button></router-link>
                        
                        <button  
                        @click="editEvent"
                        :data-id="event.id"
                        :data-title="event.title"
                        :data-dates="event.dates"
                        :data-address="event.address"
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
                events: null,
                title: '',
                address: '',
                error: false,
                errors: {},
                multi: true,
                dates: [],
                event_id: null,
            };
        },
        
        mounted() {
            this.refresTable()
            $('#dates').daterangepicker();
        },
        
        
        
        
        
        methods : {
            
            
            clearVar : function(){
                this.title = ''
                this.address = ''
                this.dates= []
                this.event_id = null
            },
            
            
            refresTable : function(){
                
                var arrayOfEvents = [];
                this.$http.get('v1/events/all').then(response => {
                arrayOfEvents = response.data.data;
                
                    
                    var array_filtered = [];
                
                    var arrayLength = arrayOfEvents.length;
                    var first_day = '';
                    var last_day = '';
                    var days = '';
                    for (var i = 0; i < arrayLength; i++) {

                        var dates_array =  JSON.parse(arrayOfEvents[i].dates); 


                        if(dates_array.length>1){
                           first_day = moment(dates_array[0]).format('LL');
                           last_day = moment(dates_array[dates_array.length-1]).format('LL');
                           days = first_day + " to " + last_day
                        }else{
                            first_day = moment(dates_array[0]).format('LL');
                            days = first_day
                        }
                        
                        
                        
                        var event_edited = {title:arrayOfEvents[i].title, address:arrayOfEvents[i].address, days:days, dates:arrayOfEvents[i].dates,  id:arrayOfEvents[i].id};
                        
                        array_filtered.push(event_edited);
                        

                    }
                    
                    this.events = array_filtered
                    
                    
                    
                })  
                
              
                
           
                
            },    
                
            
            
            newEvent : function (event){
            var app = this
            var title = app.title
            var dates = app.dates
            var address = app.address

            this.$http.post(`v1/events/add`, {
                            title : title,
                            dates : dates,
                            address : address
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.refresTable()
                                $('#addEvent').modal('hide');
                               
                            }
                            else{
                                app.error = true;
                                app.errors = response.errors;
                            }
                        })
           
          
           
           },
           
           editEventSubmit : function(event){
            var app = this
            var title = app.title
            var dates = app.dates
            var address = app.address
            var id = this.event_id
            
            this.$http.post(`v1/events/edit`, {
                            title : title,
                            dates : dates,
                            address : address,
                            id : id
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.refresTable()
                                $('#editEvent').modal('hide');
                               
                            }
                            else{
                                app.error = true;
                                app.errors = response.errors;
                            }
                        })
               
               
           },
           
           editEvent : function(event){
                this.event_id =  event.target.dataset.id
                this.title = event.target.dataset.title
                this.dates = JSON.parse(event.target.dataset.dates);
                this.address = event.target.dataset.address

                var array_of_dates = [];
                var arrayLength = this.dates.length;
                
                for (var i = 0; i < arrayLength; i++) {
                    var date =  new Date(this.dates[i]);
                    array_of_dates.push(date);
                }
                
                
                this.dates = array_of_dates
                
                
           },
           
           deleteEvent : function (event){
                var app = this
                this.$http.post(`v1/events/delete`, {
                            id : this.event_id,
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.refresTable()
                                $('#editEvent').modal('hide');
                               
                            }
                        })
           },
           
           archiveEvent : function (event){
                var app = this
                this.$http.post(`v1/events/archive`, {
                            id : this.event_id,
                        }).then(response => {
                            if(response.data.status == 'success'){
                                this.refresTable()
                                $('#editEvent').modal('hide');
                            }
                        })
           },
           
           
          
           
           
           
            
        }
        
    }
    
    
    
    
    
</script>


<style lang="scss" scoped>
   @import '~@/_variables.scss';
   
   
   
   tbody{
       
       tr{
       cursor: pointer;
       @include transition (background 0.3s ease);
           &:hover{
               background: $gray30;
           }
       
       }
   }
   
   
  
       
</style>