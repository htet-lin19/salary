<template>
     <div id="loading">
    <img
      class="img"
      :src="getPhoto()"
      alt="loading..."
      width="200"
    />
  </div>
</template>

<script>
    export default {
  data() {
    return {
		image:null,
		};
	},
		mounted() {
			
		},
		methods: {
			getPhoto() {
				return "images/R.gif";
			},
		}
    }
</script>
<style scoped>
#loading {
  position: absolute;
  z-index: 1000;
  background-color: white;
  height: 100vh;
  width: 100vw;
  text-align: center;
  line-height: 100vh;
}
.img {
  position: relative;
  margin: auto;
}
</style>
