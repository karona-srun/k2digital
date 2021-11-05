<template>
   <div class="mt-2">
    <div class="p-2">
      <h5 class="text-primary">
        ទំព័រ / Pages
        <button class="btn btn-primary float-right" @click.prevent="backPage"><i class="bi bi-backspace-fill"></i> ត្រឡប់ថតក្រោយ</button>
      </h5>
    </div>
    <form @submit.prevent="onSubmit">
      <div class="shadow-none p-3 mb-5 bg-light rounded">
        <h5>សរសេរបង្ហោះ</h5>
        <div class="form-floating mb-2 fix-floating-label">
          <textarea
            type="text"
            class="form-control"
            rows="10"
            v-model="message"
            placeholder="អត្ថបទ ឬ តំណភ្ជាប់"
          ></textarea>
          <label for="floatingInputValue">អត្ថបទ</label>
        </div>
        <div class="form-floating mb-2 fix-floating-label">
          <input
            type="text"
            class="form-control"
            rows="1"
            v-model="link"
            placeholder="អត្ថបទ ឬ តំណភ្ជាប់"
          />
          <label for="floatingInputValue">តំណភ្ជាប់</label>
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

            <!-- <div class="card card-custom-1 p-3 bg-white mb-4">
              <div class="d-flex justify-content-between mb-4">
                <div class="user-info">
                  <div class="user-info__img me-2">
                    <img :src="page.image" alt="User Img" class="image-page" />
                  </div>
                  <div class="user-info__basic">
                    <h6 class="mt-2">{{ page.name }}</h6>
                  </div>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check" @click="check($event)" v-bind:id="page.id" v-bind:value="page.access_token">
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
      <div class="shadow-none p-3 mb-5 bg-light rounded">
        <button type="submit" class="btn btn-primary"> យល់ព្រម 
          <i class="bi bi-arrow-return-left" v-if="!isLoading"></i>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-else></span>
        </button>
      </div>
    </form>
  </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
export default {
  data() {
    return {
      message: '',
      link: '',
      pages: [],
      isLoading: false,
      isLoadingPage: true,
      selectedCategories: []
    }
  },
  computed: {
    authPetools: function () {
      return this.$store.getters.auth;
    },
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
        this.selectedCategories.push(newCat)
      } else {
        for (var i = 0; i < this.selectedCategories.length; i++ ) {
          if (this.selectedCategories[i].id == e.target.id) {
            this.selectedCategories.splice(i, 1)
          }
        }
      }
    },

    onSubmit() {
      this.isLoading = true;
      let data = {
        post_type: 'text',
        pages: this.selectedCategories,
        message: this.message,
        link: this.link,
      };

      let result = this.PostToPage(data);

      result.then((response) => {
        this.isLoading = false;
        this.$message({
          title: "ជូនដំណឹង!",
          message: "ដំណើរការរបស់លោកទទួលជោគជ័យ!",
          iconImg: "https://image.flaticon.com/icons/png/512/189/189677.png",
        });
        console.log(response)
      });
    },
  },
};
</script>
<style>
.image-page{
  height: 50px;
}

.card-custom {
  height: 55px;
}

.card-header {
  background-color: transparent !important;
  border-bottom: transparent !important;
}

.label-count {
  line-height: 40px;
}

.languages {
  list-style: none;
  width: fit-content;
  float: right;
  display: inline-flex;
}
</style>