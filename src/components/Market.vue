<template>
  <div id="market">
    <section class="container" v-if="products && products.length">
      <div class="row">
        <div class="col-md-3 d-flex align-items-stretch" v-for="(product,key) in products">
          <div class="card" style="width: 20rem;">
            <div class="card-body">
              <div class="row ">
                <div class="col-12">
                  <h4 class="card-title">{{ product.ProductName}}</h4>
                </div>
              </div>
              <div class="row" style="margin-top: 0rem;">
                <div class="col-12">
                  <h6 class="card-subtitle mb-2 text-muted"> {{product.Species}} </h6>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class="card-text"> {{ product.Detail }} </p>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <a href="#" class="card-link"> {{ product.Price }} </a>
                </div>
                <div class="col-6">
                  <a href="#" class="card-link">{{ product.Quantity }}</a>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-6">
                  <div class="btn btn-outline-danger" v-on:click="deleteProduct(product)">
                    Delete
                  </div>
                </div>
                <div class="col-6">
                  <router-link class="btn btn-outline-dark" v-bind:to="'/market/'+product.RequestID">Detail</router-link>
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-center">
                  <p>{{ product.CreateDate | formatDate }}</p>
                  <p>{{ product.HarvestDay | harvestDate }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-items-stretch">
          <div class="card" style="width: 20rem;">
            <div class="card-body">
              <router-link to="create" style="text-decoration:none">
                <h3 class="text-center">Create</h3>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
  import axios from 'axios';
  import swal from 'sweetalert2'
  
  export default {
    name: 'market',
    data: () => ({
      products: [],
      errors: [],
      active: false,
      id: ''
    }),
    beforeCreate: function () {
      /* check session login */
      if (!this.$session.exists()) {
        this.$router.push('/login')
      }
    },
    created: function() {
      this.getProduct();
    },
    updated: function() {
      this.getProduct();
    },
    methods: {
      deleteProduct: function(product) {
        swal({
          title: 'Are you sure?',
          text: "Do you want to delete " + product.ProductName,
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then(function() {
          axios.delete('https://api.farmerspace.co/market/deleteProduct/' + product.RequestID)
            .then(response => {
              // console.log(response.status); // ex.: 200
              swal(
                'Deleted!',
                product.ProductName + ' has been deleted.',
                'success'
              )
            })
            .catch(e => {
              this.errors.push(e);
            })
        }, function(dismiss) {
          // dismiss can be 'cancel', 'overlay',
          // 'close', and 'timer'
          if (dismiss === 'cancel') {
            swal('Cancelled', 'Your imaginary file is safe :D', 'error')
          }
        })
      },
      getProduct: function() {
        axios.get('https://api.farmerspace.co/market/getProduct/buyer')
          .then(response => {
            this.products = response.data.slice(0, 10);
            // console.log(response.status); // ex.: 200
          })
          .catch(e => {
            this.errors.push(e);
          })
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
  @import '../mq';
  .container {
    margin: 4em;
  }
  
  .row {
    margin-top: 1rem;
  }
  
  .card {
    cursor: pointer;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
    border: none;
    &:hover {
      background-color: #DDDDDD;
    }
  }
  
  .card-footer {
    background-color: #03AF25;
    border-color: #03AF25;
  }
  
  .title {
    @include mobile {
      font-weight: bold;
    }
    @include tablet {
      font-size: 2.5rem;
    }
    @include desktop {
      font-size: 5rem;
      margin-top: 2 rem;
    }
  }
</style>
