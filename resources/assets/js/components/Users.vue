<template>
   
   <main>
       <LeftNav></LeftNav>
       <UsersDashboard></UsersDashboard>
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