<template>
  <div class="mt-2">
    <div class="p-2">
      <h5 class="text-primary">
        ទំព័រ / Pages បង្ហោះជារូបភាព
        <button class="btn btn-primary float-right" @click.prevent="backPage">
          <i class="bi bi-backspace-fill"></i> ត្រឡប់ថតក្រោយ
        </button>
      </h5>
    </div>
    <form @submit.prevent="onSubmit">
      <div class="shadow-none p-1 mb-5 bg-light rounded">
        <h5 class="pl-4">បង្ហោះជារូបភាព</h5>

        <div class="form-floating fix-floating-label form-custom">
          <textarea
            type="text"
            class="form-control"
            rows="10"
            v-model="text"
            placeholder="អត្ថបទ"
          ></textarea>
          <label for="floatingInputValue">អត្ថបទ</label>
        </div>

        <div class="form-floating fix-floating-label">
          <div class="row m-1">
            <label class="label-choose">ជ្រើសរើសរូបភាព</label>
            <div
              v-for="(data, index) in rawData"
              :key="index"
              class="image-input image-input-active d-flex"
            >
              <div class="image-preview">
                <img class="img-responsive h-100 img-preview" :src="data" />
                <button
                  class="btn btn-xs remove-file"
                  @click="removeFile(index)"
                >
                  <i class="bi bi-trash"></i>
                </button>
              </div>
            </div>

            <div
              class="image-input image-input-tbd d-flex"
              v-if="this.files.length < this.option.maxFileCount"
            >
              <div
                class="
                  image-preview
                  dropzone
                  d-flex
                  justify-content-center
                  align-items-center
                "
                @drop="loaddropfile"
                @click="openinput"
              >
                <i class="bi bi-plus-lg text-success"></i>
              </div>
              <input
                type="file"
                class="d-none"
                accept="image/*"
                id="vue-file-upload-input"
                @change="addImage"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="shadow-none p-3 mb-5 bg-light rounded">
        <h5>គោលដៅទំព័រ</h5>
        <div class="row justify-content-center" v-if="isLoadingPage">
          <button class="btn btn-lg" type="button" disabled>
            <h6><span class="spinner-border spinner-border" role="status" aria-hidden="true"></span>
            កំពុងដំណើរការ...</h6>
          </button>
        </div>
        <div class="row" v-else>
          <div
            class="col-sm-12 col-md-6 col-lg-6"
            v-for="(page, index) in pages"
            :key="index"
          >
            <div class="card mb-2">
              <div class="card-body">
                <div class="pull-left">ឈ្មោះផេក ៖​ <span class="text-primary">{{ page.name }}</span></div>
                <div class="form-check pull-right checked-custom">
                  <input type="checkbox" class="form-check" @click="check($event)" v-bind:id="page.id" v-bind:value="page.access_token">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="shadow-none p-3 mb-5 bg-light rounded" v-if="resultPost != ''">
        <h5>លទ្ធផល</h5>
        <div v-for="result in resultPost" :key="result.id">
          <a :href="'https://facebook.com/'+result.post_id" target="_blink">https://facebook/{{result.post_id}}</a>
        </div>
      </div>
      
      <div class="shadow-none p-3 mb-5 bg-light rounded">
          <button type="submit" class="btn btn-primary" :disabled="isLoading" @click="upload"> យល់ព្រម 
          <i class="bi bi-arrow-return-left" v-if="!isLoading"></i>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-else></span>
        </button>
      </div>
    </form>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      option: {
        maxFileCount: 1,
      },
      text: 'Hello Fun! #haha',
      files: [],
      rawData: [],
      images: [],
      isLoading: false,
      isLoadingPage: true,
      selectedPages: [],
      resultPost: ''
    };
  },
  created() {
    this.loadPage()
  },
  methods: {
    ...mapActions(["FetchPageList","PostToPage"]),
    backPage() {
      this.$nextTick(() => {
        this.$router.push("/pe-tools");
      });
    },
    loadPage(){
      let data ={
        facebook_access_token: this.$store.getters.facebook_access_token
      };

      let page = this.FetchPageList(data);

      page.then((response) => {
        this.pages = response.data;
        this.isLoadingPage = false;
      });
    },
    check (e) {
      if (e.target.checked) {
        var newCat = {
          'page_id': e.target.id,
          'access_token': e.target.value
        }
        this.selectedPages.push(newCat)
      } else {
        for (var i = 0; i < this.selectedPages.length; i++ ) {
          if (this.selectedPages[i].id == e.target.id) {
            this.selectedPages.splice(i, 1)
          }
        }
      }
    },
    onSubmit() {
      this.isLoading = true;
      let formData = new FormData();
      formData.append('text', this.text.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, ''));
      for( var i = 0; i < this.files.length; i++ ){
        let file = this.files[i];
        formData.append('images[' + i + ']', file);
      }
      formData.append('pages', JSON.stringify(this.selectedPages));
      formData.append('facebook_access_token', this.$store.getters.facebook_access_token);
      formData.append('post_type', 'picture');

      let result = this.PostToPage(formData);
      result.then((response) => {
        console.log(response);
        this.resultPost = response;
        this.isLoading = false;
        this.$message({
          title: "ជូនដំណឹង!",
          message: "ដំណើរការរបស់លោកទទួលជោគជ័យ!",
          iconImg: "https://image.flaticon.com/icons/png/512/189/189677.png",
        });
      });
    },
    loaddropfile: function (e) {
      e.preventDefault();
      e.stopPropagation();
      alert("ok");
      console.log(e);
    },
    openinput: function () {
      document.getElementById("vue-file-upload-input").click();
    },
    addImage: function (e) {
      const tmpFiles = e.target.files;
      if (tmpFiles.length === 0) {
        return false;
      }
      const file = tmpFiles[0];
      this.files.push(file);
      const self = this;
      const reader = new FileReader();
      reader.onload = function (e) {
        self.rawData.push(e.target.result);
      };
      reader.readAsDataURL(file);
    },
    removeFile: function (index) {
      this.files.splice(index, 1);
      this.rawData.splice(index, 1);
      document.getElementById("vue-file-upload-input").value = null;
    },
    upload: function () {
      // alert("Check console to see uploads");
      // console.log(this.files);
      
    },
  },
  mounted() {},
};
</script>
<style>
h2 {
  font-weight: bold;
  margin-bottom: 15px;
}

.m-1 {
  margin: -3px !important;
}
.form-custom {
  margin-bottom: -30px;
}

.label-choose {
  margin-left: -10px;
}
.image-input {
  padding: 3px;
  width: auto;
}

.image-preview {
  width: 96px;
  height: 96px;
  cursor: pointer;
  overflow: hidden;
}
.image-preview img {
  object-fit: cover;
  width: 100%;
  height: 100%;
}
.img-preview {
  border-radius: 7%;
}
.dropzone {
  width: 96px;
  height: 96px;
}
.dropzone {
  border: 1px dashed green;
  border-radius: 7%;
}
.remove-file {
  position: absolute;
  margin-top: 5px;
  margin-left: -36px;
  width: 30px !important;
  color: rgba(0, 0, 0, 0.5);
  padding: 1px 6px;
  background-color: #f4f5f7;
}
.remove-file:hover {
  color: rgb(255, 255, 255);
  background-color: #d60000;
}
</style>