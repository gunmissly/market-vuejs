<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Vue |</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
  
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <router-link to="/" class="nav-link r-item">Profile</router-link>
          </li>
          <li class="nav-item ">
            <router-link to="market" class="nav-link r-item">Market</router-link>
          </li>
        </ul>
        <router-link to="login" class="btn btn-outline-danger my-2 my-sm-0">Login</router-link>
      </div>
    </nav>
    <router-view></router-view>
  
  </div>
</template>

<script>
  export default {
    name: 'app',
    data: function() {
      return {
        isActive: false
      }
    },
    methods: {
      toggleNav: function() {
        this.isActive = !this.isActive;
      }
    }
  }
</script>

<style lang='scss'>
  //@import '../node_modules/bulma/bulma.sass';
  @import "../node_modules/sweetalert2/dist/sweetalert2";
  @import '../node_modules/bootstrap/scss/bootstrap';
  @import '../node_modules/bootstrap/scss/bootstrap-grid';
  @import 'mq';
  @import url('https://fonts.googleapis.com/css?family=Quicksand:300,400');
  @import url('http://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css');
  
  body {
    font-family: Quicksand;
  }
  
  .card {
    margin-top: 10px;
    margin-bottom: 10px;
  }
  
  .nav {
    a:hover {
      color: gray;
    }
  }
  
  .r-item {
    font-weight: 400;
    padding: 0.5rem 1.75rem;
    &:hover {
      color: red !important;
    }
    @include mobile {
      color: #000 !important;
      &:hover {
        background: #f1f1f1;
      }
    }
  }
  
  .navbar-burger span {
    background-color: $primary;
  }
  
  footer {
    background-color: $primary !important;
    color: #f1f1f1;
    .icon {
      color: #f1f1f1;
      margin-left: 20px;
    }
  }
</style>
