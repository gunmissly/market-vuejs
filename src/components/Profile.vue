<template>
  <div id="profile" v-if="profiles">
    <section class="jumbotron">
      <h1 class="title">
        Hello, {{profiles.FirstName}} {{profiles.LastName}}!!
      </h1>
      <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
      <hr class="my-4">
      <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
      </p>
    </section>
    <section class="container">
      <div class="row" >
      
      </div>
    </section>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'profile',
  data: () => ({
    profiles: [],
    errors: [],
  }),
  beforeCreate: function () {
    if (!this.$session.exists()) {
      this.$router.push('/login')
    }
  },
  created: function () {
    this.getProfile()
  },
  methods: {
    getProfile: function() {
        axios.post('https://api.farmerspace.co/market/getProfile', {
          Phone: this.$session.get('phone'),
          PWD: this.$session.get('pwd')
        })
          .then(response => {
            // console.log(response.status); // ex.: 200
            this.profiles = response.data;
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

.jumbotron {
  border-radius: 0px;
}

.container{
  margin:4em;
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
