<template>
  <div class="container mt-1">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h2 class="">សូមស្វាគមន៍ការចូលមកកាន់ PETools</h2>
        <h5 class="mt-5" v-if="!isLoggedIn">ចូល​ទៅ​ក្នុង PETools</h5>
        <h5 v-if="!isLoggedIn">សូមបំពេញ Access Token នៃគណនីហ្វេសប៊ុកដែលអ្នកចង់ប្រើ។</h5>
      </div>
      <form class="col-md-12 mt-2" @submit.prevent="onSubmit" v-if="!isLoggedIn">
        <div class="input-group">
          <input
            type="text"
            v-model.trim="facebook_access_token"
            class="form-control"
            :class="{
              'is-invalid': submitted && $v.facebook_access_token.$error,
            }"
            id="FacebookAccessToken"
            placeholder="Access Token"
          />
          <button type="submit" class="btn btn-primary" :disabled="isLoading">
            <i v-if="!isLoading" class="bi bi-arrow-up-right-square"></i>
            <span
              v-if="isLoading"
              class="spinner-border spinner-border-sm"
              role="status"
              aria-hidden="true"
            ></span>
            ​{{ isLoading ? " កំពុងស្វែងរក" : " បញ្ជូន" }}
          </button>
        </div>
        <div class="input-group">
          <div
            v-if="submitted && $v.facebook_access_token.$error"
            class="text-start mt-2"
          >
            <p class="text-danger" v-if="!$v.facebook_access_token.required">
              សូមបំពេញ Facebook Access Token សម្រាប់ដំណើរការ
            </p>
          </div>
        </div>
      </form>
    </div>
    <FeaturePETools v-if="isLoggedInFB || hasPETools"></FeaturePETools>
    <div>
      <h6 class="mt-3 mb-3">របៀបប្រើប្រាស់ PE Tools</h6>
      <div class="row">
        <div class="col-md-4">
          <!-- <div class="embed-responsive embed-responsive-16by9">
            <iframe
              class="embed-responsive-item"
              height="200"
              src="https://www.youtube.com/embed/GjF3yxSLxMc"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; muted; encrypted-media; gyroscope;"
              allowfullscreen
            ></iframe>
          </div> -->
          <p class="mt-3">តើធ្វើដូចម្តេចដើម្បីទទួលបាន Access Token</p>
          <p>
            1. បើកតំណនេះ​
            <a
              href="https://mobile.facebook.com/composer/ocelot/async_loader/?publisher=feed"
              target="_blink"
              >https://mobile.facebook.com/composer/ocelot/async_loader/?publisher=feed</a
            >
            នៅក្នុងកម្មវិធី browser
            អ្នកបានចូលទៅក្នុងគណនីហ្វេសប៊ុកដែលអ្នកចង់ប្រើ។
          </p>
          <p>2. ជ្រើសរើសអត្ថបទទាំងអស់បន្ទាប់មកចម្លង (copy) Access Token</p>
          <p class="mb-3">
            3. បិទភ្ជាប់(Paste) ទៅប្រអប់ ' Access Token'
            បន្ទាប់មកចុចប៊ូតុងបញ្ជូន
          </p>
        </div>
        <div class="col-md-4">
          <!-- <div class="embed-responsive embed-responsive-16by9">
            <iframe
              class="embed-responsive-item"
              height="200"
              src="https://www.youtube.com/embed/GjF3yxSLxMc"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; muted; encrypted-media; gyroscope;"
              allowfullscreen
            ></iframe>
          </div> -->
          <p class="mt-3 mb-3">របៀបប្រើនៅលើទូរស័ព្ទដៃ</p>
        </div>
        <div class="col-md-4">
          <!-- <div class="embed-responsive embed-responsive-16by9">
            <iframe
              class="embed-responsive-item"
              height="200"
              src="https://www.youtube.com/embed/GjF3yxSLxMc"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; muted; encrypted-media; gyroscope;"
              allowfullscreen
            ></iframe>
          </div> -->
          <p class="mt-3 mb-3">របៀបប្រើនៅលើកុំព្យូទ័រ</p>
        </div>
      </div>
    </div>
    <div class="row">
      <Plans></Plans>
    </div>
  </div>
</template>
<script>
import { required } from "vuelidate/lib/validators";
import { mapActions } from "vuex";
import FeaturePETools from "../../components/FeaturePETools.vue";
import Plans from "../../components/Plans.vue";
export default {
  components:{
    FeaturePETools,
    Plans
  },
  data() {
    return {
      facebook_access_token: "",
      submitted: false,
      isLoading: false,
    };
  },
  validations: {
    facebook_access_token: {
      required,
    },
  },
  created() {
    this.facebook_access_token = '';
  },
  computed : {
    isLoggedInFB: function(){ return this.$store.getters.isAuthenticatedFacebook },
    hasPETools: function(){ 
      if(this.$store.getters.isAuthenticated){
        return this.$store.getters.auth.has_petools 
      }
      return false;
    },
    isLoggedIn: function (){
      return this.$store.getters.isAuthenticated == '' ? true : false;
    },
  },
  methods: {
    ...mapActions(["SubmitAccessToken"]),
    onSubmit() {
      this.submitted = true;
      this.isLoading = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.isLoading = false;
        return;
      }

      let data = {
        facebook_access_token: this.facebook_access_token,
      };

      let result = this.SubmitAccessToken(data);

      result.then((response) => {
        console.log(response)
        if (response.mode == "2") {
          this.isLoading = false;
          this.$message({
            title: "ព្រមាន!",
            message: "Facebook Access Token ដែលបានផ្តល់មិនត្រឹមត្រូវទេ!",
            iconImg: "https://image.flaticon.com/icons/png/512/753/753345.png", // Error
          });
        }
        else if (response.status == "1") {
          this.isLoading = false;
          this.$message({
            title: "អមអរ!",
            message: "ការបញ្ជូន Access Token របស់អ្នកបានដោយជោគជ័យ!",
            iconImg: "https://image.flaticon.com/icons/png/512/189/189677.png", // Success
          });
        }else {
          this.isLoading = false;
          this.reloadPage()
          this.$message({
            title: "ព្រមាន!",
            message: "Facebook Access Token មានរួចហើយ!",
            iconImg: "https://image.flaticon.com/icons/png/512/753/753345.png", // Error
          });
        }
      });
    },
    reloadPage(){
      this.$nextTick(() => {
        this.$router.go('!#/pe-tools');
      });
    }
  },
};
</script>
<style>
.group_list {
  height: 500px;
}
.group_list::-webkit-scrollbar {
  width: 7px !important; /* width of the entire scrollbar */
}
.group_list::-webkit-scrollbar-track {
  background: transparent !important; /* color of the tracking area */
}
.group_list::-webkit-scrollbar-thumb {
  background-color: rgb(
    182,
    182,
    182
  ) !important; /* color of the scroll thumb */
  border-radius: 10px !important; /* roundness of the scroll thumb */
  border: 3px solid transparent !important; /* creates padding around scroll thumb */
}
</style>
