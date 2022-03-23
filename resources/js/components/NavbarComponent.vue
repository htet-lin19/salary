<template>
    <div class="container-fluid" id="navBar">	
		<div class="nav" id="navTitle">
			<h2>Salary Management System</h2>
		</div>
		<div class="nav justify-content-end" id="navUser">
			<div class="nav-item">
				<h4>Hello {{ user }} </h4>
				<button>Hello</button>
				</div>
			<!-- <div class="nav-item"> -->
						<!-- <a id="logoutBtn" class="sr-only dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						</a> -->
						<!-- <button>Hello</button> -->
						<!-- <div class="dropdown-menu">
							<a class="dropdown-item" @click="logout()" :href="'/'">Logout</a>
						</div> -->
			<!-- </div> -->
		</div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
  
		data(){
			return{
				user:null,
				csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			}
		},
		mounted() {
            //  console.log(this.$userId);
             console.log(this.$userName);
			 this.user = this.$userName;
        },
		  methods: {
			   logout(){
               axios.post('logout').then(response => {
					if (response.status === 302 || 401) {
							// this.login();
							console.log('logout');
						}
						else {
							// throw error and go to catch block
						}
						}).catch(error => {

					});
				},
				 login(){
               	 axios.get('/login').then(response => {
					if (response.status === 302 || 401) {
							console.log('login');
						}
						else {
							// throw error and go to catch block
						}
						}).catch(error => {

					});
				},
        
        }
    }
</script>
<style scoped>
#navBar{
	background-color: aqua;
}
#navTitle{
	padding-top: 20px;
}
#navUser{
	margin-top: -40px;
	margin-left: 100px;
}
#logoutBtn{
	margin-top: 50px;
}
</style>
