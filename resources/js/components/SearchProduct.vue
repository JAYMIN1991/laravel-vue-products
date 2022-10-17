<template>
    <!-- template for the modal component -->
    <div class="container">
        <div class="row justify-content-center">
            <!-- <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" v-on:input="fetch" id="title" v-model="title"
                               placeholder="title">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" v-on:input="fetch" id="price_from"
                               v-model="price_from"
                               placeholder="price from">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" v-on:input="fetch" id="price_up" v-model="price_up"
                               placeholder="price up">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" v-on:input="fetch" id="bedrooms" v-model="bedrooms"
                               placeholder="bedrooms">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" v-on:input="fetch" id="bathrooms" v-model="bathrooms"
                               placeholder="bathrooms">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" v-on:input="fetch" id="storeys" v-model="storeys"
                               placeholder="storeys">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" v-on:input="fetch" id="garages" v-model="garages"
                               placeholder="garages">
                    </div>
                </div>
            </div> -->
            <div class="col-md-12">
                <table class="table" v-if="!is_refresh && !is_null">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>authors</th>
                        <th>language</th>
                        <th>tool</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody v-if="products.length > 0">
                        <tr v-for="item in products" v-bind:key="item">
                            <td>{{item.id}}</td>
                            <td>{{item.title}}</td>
                            <td>{{item.categories}}</td>
                            <td>{{item.authors}}</td>
                            <td>{{item.language}}</td>
                            <td>{{item.tool}}</td>
                            <td><a href="/api/get-product-url?id={{item.id}}">View Details</a></td>
                        </tr>
                    </tbody>
                </table>
            
            <div v-if="is_refresh" class="text-center mt-5 mb-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="text-center mt-5 mb-5" v-if="is_null">
                <h2>no data</h2>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                products: [],
                title: null,
                price_from: null,
                price_up: null,
                bedrooms: null,
                bathrooms: null,
                storeys: null,
                garages: null,
                is_refresh: false,
                is_null:false
            }
        },
        components:{
            
        },
        mounted() {
            this.fetch();
        },
        methods: {
            fetch() {
                this.is_refresh = true;
                this.is_null = false;
                this.page = 1;
                axios.get('/api/get-products-list', {
                    params: {
                        name: this.name,
                        page: this.page
                    }
                })
                .then((response) => {
                    console.log(response);
                    this.is_null = response.data.data.length <= 0;
                    this.products = response.data.data;
                    this.is_refresh = false;
                });
            },
            getURL(){
                this.url = false;
                axios.get('/api/get-product-url', {
                    params: {
                        id: this.id
                    }
                })
                .then((response) => {
                    console.log(response);
                    this.is_null = response.data.data.length <= 0;
                    this.products = response.data.data;
                    this.is_refresh = false;
                });
            }
        }
    }
</script>
