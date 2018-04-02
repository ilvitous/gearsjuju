<template>
   
   <main>
       <LeftNav></LeftNav>
       <div class="main_container">
       <UsersCatDashboard></UsersCatDashboard>
       </div>
   </main>
     
</template>


     
<script>
    import LeftNav from './LeftNav.vue'
    import UsersCatDashboard from './UserCatDashboard.vue'

   
   
    export default {
        components: {
            LeftNav,
            UsersCatDashboard,
        },
        
        

    }
    
    
    
    
    
</script>