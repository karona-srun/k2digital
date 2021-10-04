<template>
  <div class="container mt-1">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h2 class="">សូមស្វាគមន៍ការចូលមកកាន់ TikTok Downloader</h2>
      </div>
      <form class="col-md-12 mt-2" @submit.prevent="onSubmit">
        <div class="input-group">
          <input
            type="text"
            v-model="name"
            class="form-control"
            :class="{
              'is-invalid': submitted && $v.name.$error,
            }"
            placeholder="TikTok Username"
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
      </form>
      <h6 class="mt-3">របៀបប្រើប្រាស់</h6>
      <p for="">
        ១. ចូលទៅ <span class="fw-bold">TikTok</span> បន្ទាប់មកចូលមកចូលទៅ
        <span class="fw-bold">Link</span> របស់អ្នកប្រើប្រាស់
      </p>
      <p class="ml-5">ឧទាហរណ៍៖ https://www.tiktok.com/@<span class="fw-bold">Username</span></p>
      <p for="">
        ២. ចូលទៅ <span class="fw-bold">Copy</span> យកឈ្មោះរបស់អ្នកប្រើប្រាស់
      </p>
      <p for="">
        ៣. មកចូលទៅ <span class="fw-bold">Paste</span> នៅក្នុងប្រអប់ចូលទៅ
        <span class="fw-bold">TikTok Username</span> ហើយចុចប៊ូតុងបញ្ជូន
      </p>
      <div class="row p-2">
        <div class="col-md-12 mt-2" v-for="item in items" :key="item.id">
          <div class="media">
            <!-- <div
              class="embed-responsive embed-responsive-1by1 video_origin_cover"
              disable
            >
              <video controls id="my_iframe" class="embed-responsive-item">
                <source :src="item.video.playAddr[2]" type="video/mp4"/>
              </video>
            </div> -->
            <img
              :src="item.video.cover"
              class="video_origin_cover mr-3"
              alt="video_origin_cover"
            />
            <div class="media-body">
              <h6 class="mt-0 fw-bold">{{ item.desc }}</h6>
              <!-- <p for="video" class="text-break">{{ item.video.playAddr[2] }}</p> -->
              <button type="button" class="btn btn-primary" @click.prevent="Download(item.video.downloadAddr[2])">Download</button>
              <button type="button" class="btn btn-primary" @click.prevent="DownloadWithoutWatermark(item.video.playAddr[2])">
                Download without watermark
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { required } from "vuelidate/lib/validators";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      name: "",
      items: [],
      isLoading: false,
      submitted: false,
    };
  },
  validations: {
    name: {
      required,
    },
  },
  methods: {
    ...mapActions(["Index","SubmitLink"]),
    onSubmit() {
      this.submitted = true;
      this.isLoading = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.isLoading = false;
        this.$message({
          title: "ព្រមាន!",
          message: "Username ដែលបានផ្តល់មិនត្រឹមត្រូវទេ!",
          iconImg: "https://image.flaticon.com/icons/png/512/753/753345.png", // Error
        });
        return;
      }
      
      var options = {
        method: "GET",
        url: "https://tik-tok-feed.p.rapidapi.com/",
        params: { search: this.name, type: "user-feed-no-watermark", max: "0" },
        headers: {
          "x-rapidapi-host": "tik-tok-feed.p.rapidapi.com",
          "x-rapidapi-key":
            "c1abb63253msh21a61937483ee9ap131d55jsn9a1324fc4ce4",
        },
      };

      let data = axios
        .request(options)
        .then(function (response) {
          console.log(response.data.items);
          return response.data.items;
        })
        .catch(function (error) {
          console.error(error);
        });
      data.then((response) => {
        this.items = response;
        this.isLoading = false;
      });
    },
    DownloadWithoutWatermark(url){
      window.open(url, "_blank"); 
      // var data = {
      //   url: url
      // };
      // this.SubmitLink(data);
      this.$message({
          title: "ជូនដំណឹង!",
          message: "សាកល្បង Download Without Watermark!",
          iconImg: "https://image.flaticon.com/icons/png/512/189/189677.png",
        });
    },
    Download(url){
      window.open(url, "_blank"); 
      this.$message({
          title: "ជូនដំណឹង!",
          message: "សាកល្បង Download!",
          iconImg: "https://image.flaticon.com/icons/png/512/189/189677.png",
        });
    },
  }
};
</script>
<style scoped>
.video_origin_cover {
  height: 150px;
  width: 95px;
}
</style>