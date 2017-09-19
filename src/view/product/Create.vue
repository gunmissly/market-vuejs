<template>
  <div id="create">
    <section class="container">
      <div class="row justify-content-md-center">
        <div class="col-md">
          <form-input></form-input>
        </div>
        <div class="col-md">
          <div class="row">
            <div class="col-md-12">
              <google-map></google-map>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>

/** TODO:
 *  
 * 
 * FIXME:
 * 
 */

import googlemap from '@/components/product/Map'
import form from '@/components/product/Form'

export default {
  name: 'create',
  components: {
    'google-map': googlemap,
    'form-input': form
  }
};
</script>

<style lang="scss">
@import '../../mq';
.jumbotron {
  border-radius: 0px;
}

.container {
  margin: 4em;
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