<template>
    <div>
        <div class="row">
            <div class="col-6"><h1>Users</h1></div>
            <div class="col-6"><button type="button" class="btn btn-primary float-right">Add New</button></div>
        </div>
        

    <table class="table">
        <thead>
          <tr>
            <th>Username</th>
            <th>Emails</th>
            <th>Role</th>
            <th></th>
          </tr>
        </thead>
       
        <tbody>
          <tr v-for="user in users">
            <td class="align-middle">{{ user.name }}</td>
            <td class="align-middle">{{ user.email }}</td>
            <!--<td class="align-middle">{{ user.role }}</td>-->
            <td class="align-middle">
                <button  
                @click="edit_user"
                :data-id="user.id" class="btn float-right">Edit</button></td>
          </tr>
        </tbody>
        
      </table>

    </div>
</template>




<script>
    export default {
        name: 'UsersDashboard',
        
        data(){
            return {
                users: null,
            };
        },
        
        mounted() {
            this.$http.get('v1/users').then(response => {
            this.users = response.data.data;
          })
        },
        
        methods : {
           edit_user : function(event){
             const user_id =  event.target.dataset.id
              alert(user_id)
            }
        }
        
        
    }
    
    
    
</script>

<style lang="scss" scoped>
    
   thead{
       font-weight: 700;
       text-transform: uppercase;
   }
    
</style>