<template>
    <div >
      <!-- <b-button v-b-modal.modal-center>Vue Bootstrap Modal Example</b-button> -->

     <b-modal header-class="my-class" centered v-model="isLoading" hide-footer="true" hide-header="true" no-close-on-backdrop>
		   <p class="my-4">Hello <span class="loader"></span></p>
		  
	 </b-modal>
    </div>    
</template>

<script>
  export default {
    data() {
      return {
		  isLoading:true
	   }
    },
	mounted() {
			// setTimeout(() => {
			// 	this.isLoading = false;
			// 	}, 3000);
		},
  }
</script>
<style scoped>
 
.loader {
	position: absolute;
    top: 3%;
    left: 50%;
    text-align: center;

  border: 10px solid #f3f3f3;
  border-top: 10px solid #3498db;
  border-radius: 20%;
  width: 30px;
  height: 30px;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>