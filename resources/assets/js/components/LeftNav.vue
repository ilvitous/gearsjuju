<template>
   
    <div class="main_nav_container">
        <img class="img-responsive" src="/assets/img/gearsjuju.svg">
        
        <ul>
            <li><router-link :to="{ name: 'events' }">Events</router-link></li>
            <li><a href="">Equipment</a></li>
            <li>
                <router-link :to="{ name: 'users' }">Users</router-link>
                    
                    <ul>
                        <li><router-link :to="{ name: 'user-categories' }">Roles</router-link></li>
                    </ul>
                
            </li>
            <li><a href="#" @click.prevent="$auth.logout()">Logout</a></li>
        </ul>
    
    </div>
    
</template>



<script>
    export default {
        name: 'LeftNav',
    }
</script>

<style lang="scss" scoped>
   @import '~@/_variables.scss';
   
   .main_nav_container{
       position: fixed;
       left:0px;
       top:0px;
       width: 300px;
       height: 100vh;
       background: $gray10;
       padding: 30px;
       
       img{
           margin-bottom: 30px;
       }
       
       ul{
           li{
               display: block;
               padding-top:15px;
               padding-bottom: 15px;
               border-bottom: solid 1px #ccc;
               text-transform: uppercase;
               
               ul{
                   li{
                        border-bottom: none;
                        font-size: 0.8em;
                        padding-bottom: 0px;
                        padding-left: 15px;
                   }
               }
               a{
                   display: block;
                   opacity: 1;
                   @include transition (opacity 0.3s ease);
                   &:hover{
                       opacity: 0.7;
                   }
               }
           }
       }
   }
   
   
</style>