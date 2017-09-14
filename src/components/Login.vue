<template>
  <div id="login">
    <section class="container-fluid is-medium">
      <div class="row justify-content-md-center">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <form v-on:submit.prevent="login">
                <div class="form-group">
                  <label for="username">username:</label>
                  <input type="text" class="form-control" id="username" v-model="logins.username">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="pwd" v-model="logins.password">
                </div>
                <div class="checkbox">
                  <label><input type="checkbox"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-block">Submit</button>
              </form>
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
    name: 'login',
    data: () => ({
      logins: [],
      errors: [],
    }),
    beforeCreate: function () {
      /* check session login */
      if (this.$session.exists()) {
        this.$router.push('/market')
      }
    },
    methods: {
      login(e) {
        var app = this;
        const data = {
          Phone: this.logins.username,
          PWD: this.logins.password,
        }
        axios.post('https://api.farmerspace.co/market/login', (data))
          .then(function(response) {
            //console.log(response.data);
            //console.log(response.status); // ex.: 200
            if (response.data) {
              swal({
                title: 'Sign in Success!',
                text: '',
                type: 'success',
                timer: 2000,
              }).then(function() {
                // window.location.href = 'profile';
                app.$session.start()
                app.$session.set('phone', response.data.phone)
                app.$session.set('pwd', response.data.pwd)
                app.$session.set('userid', response.data.userid)
                app.$router.push({path: '/market'}) // It's works!!  
              }, function(dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                app.$router.push({path: '/market'}) // It's works!!  
              });
            } else {
              swal('Sign in Failed' ,'Username or password do not match','error',);
            }
          })
          .catch(function(error) {
            console.log(error);
          })
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
  @import '../mq';
  .container-fluid {
    background-color: #222;
    padding-top: 4em;
    padding-bottom: 4em;
    height: 100vh;
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
