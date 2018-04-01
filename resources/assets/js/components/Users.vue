<template>
   
   <main>
       <LeftNav></LeftNav>
       <div class="main_container">
       <UsersDashboard></UsersDashboard>
       </div>
   </main>
     
</template>


     
<script>
    import LeftNav from './LeftNav.vue'
    import UsersDashboard from './UsersDashboard.vue'

   
   
    export default {
        components: {
            LeftNav,
            UsersDashboard,
        },
        
        

    }
    
    
    
    
    
</script>