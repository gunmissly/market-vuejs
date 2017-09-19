<template>
  <div id="googlemap">
    <div class="container-fluid mt-2">
      <div class="row">
        <div class="col-md">
          <div class="form-group">
            <input type="text" v-model="textLat">
          </div>
          <div class="form-group">
            <input type="text" v-model="textLng">
          </div>
          <label for="">จุดรับ - ซื้อขาย ผลผลิต</label>
          <gmap-autocomplete @place_changed="updateCenter($event)" id="search-map" />
          <gmap-map class="gmap-map" :center="currentLocation" :zoom="12">
            <gmap-marker :position="markers" :clickable="false" :draggable="true" @drag="getPosition($event)" :animation="2" @click="currentLocation=markers"></gmap-marker>
          </gmap-map>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBHdovUZxzjIxZEKeOECAj0T2bH_l5Iw_0',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)
    callback: 'initAutocomplete'

  }
})
export default {
  name: 'googlemap',
  props: ['textLat', 'textLng'],
  data() {
    return {
      currentLocation: {
        lat: 0,
        lng: 0
      },
      markers: {
        lat: 0,
        lng: 0
      },
    }
  },
  mounted: function() {
    this.geolocation();
  },
  methods: {
    geolocation: function() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
          this.currentLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          }
          this.markers = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          }
        })
      } else {
        alert("Geolocation is not supported by this browser.")
      }
    },

    getPosition: function(place) {
      this.textLat = place.latLng.lat()
      this.textLng = place.latLng.lng()
      this.markers = {
        lat: place.latLng.lat(),
        lng: place.latLng.lng(),
      }
    },
    updateCenter: function(place) {
      this.currentLocation = {
        lat: place.geometry.location.lat(),
        lng: place.geometry.location.lng(),
      }
      this.markers = {
        lat: place.geometry.location.lat(),
        lng: place.geometry.location.lng(),
      }
      this.textLat = place.geometry.location.lat()
      this.textLng = place.geometry.location.lng()
    }
  }
}
</script>


<style lang="scss">
.gmap-map {
  width: 100%;
  height: 500px;
}

#search-map {
  display: inline-block;
  padding: 6px 11px;
  margin: 10px;
  width: 400px;
}
</style>