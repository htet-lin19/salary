<template>
  <div>
    <div v-if="awesome" class="alert alert-success" role="alert">
      <strong>Success!</strong> Indicates a successful or positive action.
      <a href="" id="close" @click.prevent="alertClose">X</a>
    </div>
    <h2 class="text-center">Products List</h2>
    <center>
      <div class="table-responsive">
        <router-link class="routerLink" to="/create">Create Brand</router-link>
        <router-link class="productList" to="/product"
          >Products List</router-link
        >
        <form @submit.prevent="list">
          <div class="input-group">
            <div class="row">
              <div class="col-8">
                <input
                  type="text"
                  class="form-control"
                  v-model="search"
                  placeholder="Search Brand Name"
                />
              </div>
              <div class="col">
                <button class="btn btn-primary" id="searchButton" type="submit">
                  Search
                </button>
              </div>
            </div>
          </div>
        </form>
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Brand Code</th>
              <th>Name</th>
              <th>Logo</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="brands && brands.data.length > 0">
            <tr v-for="(brand, index) in brands.data" :key="index">
              <td>{{ brand.id }}</td>
              <td>{{ brand.brand_code }}</td>
              <td>{{ brand.brand_name }}</td>
              <td><img :src="getPhoto() + brand.brand_logo_image" /></td>
              <td>{{ brand.brand_description }}</td>
              <td>
                <router-link
                  :to="{ name: 'edit', params: { id: brand.id } }"
                  class="btn btn-success"
                  >Edit</router-link
                >
                <button
                  type="button"
                  class="btn btn-danger"
                  @click="deleteBrand(brand.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td align="center" colspan="3">No record found.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <pagination
        align="center"
        :data="brands"
        @pagination-change-page="list"
      ></pagination>
    </center>
  </div>
</template>
 
<script>
import pagination from "laravel-vue-pagination";
export default {
  components: {
    pagination,
  },
  data() {
    return {
	  page: "",
      search: "",
      awesome: "",
      imgPath: "",
      brands: {
        type: Object,
        default: null,
      },
    };
  },
  mounted() {
    this.list();
  },
  computed: {
    filteredBrands() {
      return this.brands.filter((p) =>
        p.brand_name.includes(this.search.toLowerCase())
      );
    },
  },
  // created() {
  // 	axios.get('/api/brand',)
  // 	.then(res => {
  // 		this.brands = res.data;
  // 	})
  // 	.catch(error =>{
  // 		console.log(error);
  // 	});
  // },
  methods: {
    async list(page = 1) {
      await axios
        .get(`/api/excel?page=${page}&search=${this.search}`)
        .then(({ data }) => {
          this.brands = data;
        })
        .catch(({ response }) => {
          console.error(response);
        });
    },
    getPhoto() {
      return "images/";
    },
    alertClose() {
      this.awesome = "";
    },
    deleteBrand(id) {
      Swal.fire({
        title: "Are you Sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete",
      }).then((result) => {
        if (result.isConfirmed) {
          this.axios
            .delete(`http://localhost:8000/api/brand/${id}`)
            .then((response) => {
              this.$router.go(0);
              this.$router.push({ name: "home" });
              // Toast.fire({icon: 'success', title: 'Deleted successfully'})
            });
        }
      });
    },
  },
};
</script>