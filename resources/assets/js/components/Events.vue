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
                    
                    <input data-provide="datepicker" name="daterange">
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                  
                  
                </div>
              </div>
            </div>
        <!-- Modal add -->
        
        
        
        <LeftNav></LeftNav>
        <div class="main_container">
           
            <div class="row">
                <div class="col-6"><h1>Events</h1></div>
                <div class="col-6">
                    <button 
                    type="button" 
                    class="btn btn-primary float-right"
                    data-toggle="modal" data-target="#addEvent"
                    >Add New Event
                    </button>
                </div>
            </div>
        
        
        
            <table class="table" v-if="events">
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
                    <td class="align-middle">{{ event.title }}</td>
                    <td class="align-middle">{{ event.dates }}</td>
                    <td class="align-middle">{{ event.address }}</td>
                    <td class="align-middle">
                        <button  
                       
                        class="btn float-right">
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
            };
        },
        
        mounted() {
            this.$http.get('v1/events/all').then(response => {
            this.events = response.data.data;
            })  
            
            $('input[name="daterange"]').daterangepicker();
        },
        
        
    }
    
    
    
    
    
</script>