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
                    
                    <form autocomplete="off" @submit.prevent="newEvent" id="register" method="post">
                       
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
                        
                      
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New Event</button>
                        
                        
                        </form>
                
                
                </div>
                
                
                
                </div>
              </div>
            </div>
        <!-- Modal add -->
        
        
        <LeftNav></LeftNav>
        <div class="main_container">
            <div class="row">
                <div class="col-6"><h1>Equipments</h1></div>
                <div class="col-6">
                    <button 
                    type="button" 
                    class="btn btn-primary float-right"
                    data-toggle="modal" data-target="#addEquipment"
                    
                    >Add New Equipment
                    </button>
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
                error: false,
                errors: {},
            };
        },
        
        mounted() {
        },
        
        
        methods : {
        }
        
        
        
    }
    
    
    
    
    
</script>