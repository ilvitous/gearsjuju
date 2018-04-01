<template>
   
   <main class="container-fluid">
       <div class="row">
             <LeftNav></LeftNav>
            <MainDashboard></MainDashboard>
       </div>
   </main>
     
</template>


     
<script>
    import LeftNav from './LeftNav.vue'
    import MainDashboard from './MainDashboard.vue'

   
   
    export default {
        components: {
            LeftNav,
            MainDashboard,
        },

    }
    
    
    
    
    
</script>