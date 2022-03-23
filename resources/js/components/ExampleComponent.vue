	<template>
    <div>
		<!-- overlay -->
		 <Loading :active.sync="isLoading"
                 :is-full-page="true"/>
		<!-- overlay -->
		<!-- nav -->
		<div class="container-fluid" id="navBar">	
		<nav class="navbar " id="navTitle">
			<h2>Salary Management System</h2>
		</nav>
		<nav class="navbar  justify-content-end" id="navUser">
			<div class="nav-item"><h4>{{ user }}</h4>
			</div>
			<div class="nav-item">
				    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					</button>
					<div class="dropdown-menu">
							<a class="dropdown-item" @click="logout()" :href="'/'">Logout</a>
					</div>
			</div>
		</nav>
    </div>

		<!-- <NavbarComponent></NavbarComponent> -->
		<!-- <LoadingScreen v-if="isLoading"></LoadingScreen> -->
		 <div>
        <div class="row justify-content-center">
            <div class="col-md-8"> 
				<div id="inputFile" class="row">
							<!-- <input type="file" id="fileInput" @change="onFilePicked"
							accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/> -->
							<input ref="file" type="file" @change="onFilePicked" hidden>
							<button @click="selectFile()" id="fileSelectBtn">Choose File</button>&nbsp; {{ filename }}
				</div>
				<div class="row">
							<!-- <input type="file" id="fileInput" @change="onFilePicked"
							accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/> -->
							<button id="uploadExcel" @click="uplodFile" :disabled="image == null">
							<font-awesome :icon="['fas','upload']"/>&nbsp;
							 Upload Excel
							</button>
				</div>
                <div class="table-responsive">
					<table style="margin-top:20px;" id="css-serial" class="table table-bordered text-center">
					<thead>
						<tr>
						<th></th>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody v-if="users && users.data.length > 0">
						<tr v-for="(user, index) in users.data" :key="index" :id="user.employee_name" >
						<td><input type="checkbox" v-model="selected" :value="user.id"></td>
						<!-- <td>{{ user.id }}</td> -->
						<td> {{ index+1 }} </td>
						<td>{{ user.employee_name }}</td>
						<td>{{ moment(user.created_at).format("DD-MM-YYYY") }}</td>
						<td><a :href="'/pdf/' + user.id">Preview</a></td>
						</tr>
					</tbody>
					<tbody v-else>
						<tr>
						<td align="center" colspan="3">No record found.</td>
						</tr>
					</tbody>
					</table>
                </div>
				 <pagination align="left" :data="users" @pagination-change-page="list">
					<template #prev-nav>
						<span>&lt;&lt; </span>
					</template>
					<template #next-nav>
						<span> &gt;&gt;</span>
					</template>
				</pagination>
				<a id="sendEmail" class="btn" @click="sendEmail">Send Email</a>
            </div>
        </div>
		</div>
    </div>
</template>

<script>
import pagination from 'laravel-vue-pagination';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import axios from 'axios';
import LoadingScreen from "../components/LoadTwoComponent.vue";
import NavbarComponent from "../components/NavbarComponent.vue";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import moment from "moment";
    export default {
		
		 components: {
			    "font-awesome": FontAwesomeIcon,
          	    pagination,
				LoadingScreen,
				NavbarComponent,
				Loading
    },
  data() {
    return {
		moment: moment,
		filename: null,
		image: null,
		selected: [],
		selectAll: false,
		userEmails: [],
		users: null,
		isLoading: false,
		user:null,
		num : 1,
				// csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			
		};
	},
		mounted() {
			// setTimeout(() => {
			// 	this.isLoading = false;
			// 	}, 3000);
			this.user = this.$userName;
			this.list();
		},
		methods: {
			async list(page = 1) {
			await axios
				.get(`/api/photo?page=${page}`)
				.then(({ data }) => {
				this.users = data;
				})
				.catch(({ response }) => {
				console.error(response);
				});
			},
			getIndex(index){
					this.num = this.num + index;
					return this.num;
			},
			 sendEmail() {
				let formData = new FormData();
				 formData.append('selectedItems',this.selected);
				 axios
                    .post('/api/photo',formData)
                    .then( response => {
						console.log(response);
					})
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
        	},
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
			 uplodFile(){
				if(this.image){
					console.log("File Exit");
					this.isLoading = true;
					let formData = new FormData();
					formData.append('file',this.image);
					 axios
						.post('/api/photo',formData)
						.then( response => {
							this.list();
							this.isLoading = false;
							console.log(response);
						})
						.catch(err => console.log(err))
				}else{
					// this.$refs.fileInput.click()
				}
			},
			selectFile(){
				let fileInputElement = this.$refs.file;
				fileInputElement.click();

				// const files = event.target.files
				// this.onFilePicked(fileInputElement);

				// Do something with chosen file 
			},
			onFilePicked (event) {
				const files = event.target.files
				this.filename = files[0].name
				const fileReader = new FileReader()
				fileReader.addEventListener('load', () => {
					this.imageUrl = fileReader.result
				})
				fileReader.readAsDataURL(files[0])
				this.image = files[0]
			}
		}
    }
</script>
<style>
#fileSelectBtn{
	width: 120px;
}
#inputFile{
	padding-left: 5px;
	width: auto;
}
.container{
	background-color: #f5f5f0;
}
#uploadExcel {
	text-decoration: none;
	color: black;
	background-color: white;
	padding: 2px;
	margin-left: 5px;
	margin-top: 10px;
	width: auto;
}

#sendEmail {
	text-decoration: none;
	float: right;
	color: white;
	background-color: rgb(81, 110, 238);
	padding: 5px;
	margin-bottom: 10px;
}
#navBar{
	/* background-color: aqua; */
	padding: 0px;
	margin-bottom: 50px;
	/* background-color: gray; */
	height: 90px;
}
#navTitle{
	padding-top: 20px;
	margin-left: 100px;
}
#navUser{
	margin-top: -40px;
	margin-right: 200px;
}
#logoutBtn{
	margin-top: 50px;
}
/* Add Serial Number */
tr:nth-child(even) {
  background-color: rgb(245, 245, 245);
}
</style>
