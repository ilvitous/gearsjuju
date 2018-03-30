<template>
   	<div class="wrapper">
		   
		   	<form class="form-signin" autocomplete="off" @submit.prevent="login" method="post">
		    
		      	<img class="img-responsive" src="/assets/img/gearsjuju.svg" style="margin-top: 30px;">      


		    	<h2 class="form-signin-heading" style="margin-top: 60px; text-align: center">Please login</h2>
		      	
		      	<input type="email" id="email" class="form-control" placeholder="Email Address" v-model="email" required>
		      	
				<input type="password" id="password" class="form-control" v-model="password" placeholder="Password" required>
		      

		      	<button class="btn btn-lg btn-primary btn-block opacity_hover" type="submit">Login</button>
		      	
		      	<div class="alert alert-danger" v-if="error">
           		<p>There was an error, unable to sign in with those credentials.</p>
        		</div>
        
		   
		   
		   
		    </form>
	    
	    
	</div>
	    
	    
	    
</template>



<script>
  export default {
    data(){
      return {
        email: null,
        password: null,
        error: false
      }
    },
    methods: {
      login(){
        var app = this
        this.$auth.login({
            params: {
              email: app.email,
              password: app.password
            }, 
            success: function () {},
            error: function () {
            this.error = true;
            	
            },
            rememberMe: true,
            redirect: '/dashboard',
            fetchUser: true,
        });       
      },
    }
  } 
</script>