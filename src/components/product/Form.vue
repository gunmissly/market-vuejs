<template>
  <div id="form">
    <form v-on:submit.prevent="addProduct">
      <div class="row">
        <div class="form-group col-md-12">
          <label for="" style="margin-right: 40px">คุณคือ ?</label>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="userradio" id="inlineRadio1" v-model="products.userradio" value="buyer"> ผู้สั่งซื้อ
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="userradio" id="inlineRadio2" v-model="products.userradio" value="farmer"> ผู้เสนอขาย
            </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="">ชื่อผลผลิต</label>
          <input type="text" class="form-control" data-validation="required" v-model="products.ProductName">
        </div>
        <div class="form-group col-md-6">
          <label for="">สายพันธุ์</label>
          <input type="text" class="form-control" data-validation="required" v-model="products.Species">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="">รายละเอียด <br>
            <small>** โปรดให้รายละเอียดเพิ่มเติม อาทิ รูปแบบผลผลิต จุดเด่น มาตรฐานที่ได้รับรอง เป็นต้น</small>
          </label>
          <textarea maxlength="300" rows="6" class="form-control" data-validation="required" v-model="products.Detail"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="">ราคา ต่อ กิโลกรัม</label>
          <input type="number" class="form-control" data-validation="number" v-model="products.Price">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="">ปริมาณต่อการเก็บเกี่ยว (กิโลกรัม)</label>
          <input type="number" class="form-control" data-validation="number" v-model="products.Quantity">
        </div>
        <div class="form-group col-md-6">
          <label for="">วันเก็บเกี่ยว</label>
          <input type="date" data-validation="date" data-validation-format="yyyy-mm-dd" class="form-control" v-model="products.HarvestDay">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="" style="margin-right: 40px">สถานที่เพาะปลูก</label>
          <div class="form-check form-check-inline">
            <label class="form-check-label"></label>
            <input class="form-check-input" type="radio" id="oldAddress" v-model="products.addressradio" value="oldAddress"> ใช้ที่อยู่เดียวกับประวัติ
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label"></label>
            <input class="form-check-input" type="radio" id="newAddress" v-model="products.addressradio" value="newAddress"> ระบุที่อยู่ใหม่
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="">เลขที่</label>
          <input type="text" class="newAddress form-control" v-model="products.Address">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="">ตำบล</label>
          <input type="text" class="newAddress form-control" v-model="products.SubDistrict">
        </div>
        <div class="form-group col-md-6">
          <label for="">อำเภอ</label>
          <input type="text" class="newAddress form-control" v-model="products.District">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="">จังหวัด</label>
          <input type="text" class="newAddress form-control" v-model="products.Province">
        </div>
        <div class="form-group col-md-6">
          <label for="">รหัสไปรษณีย์</label>
          <input type="text" class="newAddress form-control" v-model="products.Zipcode">
        </div>
      </div>
      <input type="text" v-model="products.Latitude">
      <input type="text" v-model="products.Longitude">
      <button class="btn btn-lg pull-right" style="border-radius: 0px;background-color: #6495ed;color:#fff" type="submit" id="submit">
        <span>Save</span>
      </button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'form',
  data: () => ({
    products: [],
  }),
  beforeCreate: function() {
    if (!this.$session.exists()) {
      this.$router.push('/login')
    }
  },
  methods: {
    addProduct: function(e) {
      const data = {
        UserID: 'D1230',
        ProductName: this.products.ProductName,
        Species: this.products.Species,
        Detail: this.products.Detail,
        Price: this.products.Price,
        Quantity: this.products.Quantity,
        HarvestDay: this.products.HarvestDay,
        Address: this.products.Address,
        SubDistrict: this.products.SubDistrict,
        District: this.products.District,
        Province: this.products.Province,
        Zipcode: this.products.Zipcode,
        Latitude: this.products.Latitude,
        Longitude: this.products.Longitude,
        UserType: this.products.userradio
      }
      axios.post('https://api.farmerspace.co/dev/postProduct.php', (data))
        .then(function(response) {
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        })
    }
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>

</style>
