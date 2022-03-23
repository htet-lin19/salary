<template>
  <main>
	  <div id="loadBody">
		<h1>Data Loading...</h1>
		<div class="loader" v-if="loading">
		</div>
	</div>
    <!-- <div>
		<ul>
			<li v-for="(tod,index) in todo" :key="index">
				{{ tod.id }}
			</li>
		</ul>
		</div> -->
  </main>
</template>

<script>
export default {
  data() {
    return {
      loading: true,
      todo: ''
    };
  },
//   mounted() {
// 			setTimeout(() => {
// 				this.loading = false;
// 				}, 3000);
// 		},
//   async created () {
//     this.loading = true
//     try {
//       const res = await fetch('https://jsonplaceholder.typicode.com/todos')
//       this.todo = await res.json()
//       this.loading = false
//     } catch (error) {
//       console.log(error)
//       this.loading = false
//     }
//   }
};
</script>

<style lang="scss" scoped>
#loadBody{
	background-color: #3498db;
	width: 100%;
	height: 100%;
}
h1{
	position: absolute;
	left: 30%;
	top: 50%;
}
.loader {
	position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    text-align: center;


  border: 16px solid #f3f3f3;
  border-top: 16px solid #3498db;
  border-radius: 50%;
  width: 80px;
  height: 80px;
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