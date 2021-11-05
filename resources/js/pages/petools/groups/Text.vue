<template>
  <div class="mt-2">
    <div class="p-2">
      <h5 class="text-primary">
        ក្រុម / Groups បង្ហោះជាអត្ថបទ
        <button class="btn btn-primary float-right" @click.prevent="backPage">
          <i class="bi bi-backspace-fill"></i> ត្រឡប់ថតក្រោយ
        </button>
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
            v-model="text"
            placeholder="អត្ថបទ ឬ តំណភ្ជាប់"
          ></textarea>
          <label for="floatingInputValue">អត្ថបទ</label>
        </div>
        <div class="input-group label-error">
          <div
            v-if="$v.text.$error"
            class="text-start mt-2"
          >
            <p class="text-danger" v-if="!$v.text.required">
              សូមបំពេញអត្ថបទសម្រាប់ការបង្ហោះ
            </p>
          </div>
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
        <h5>គោលដៅក្រុម / Groups</h5>
        <div class="row justify-content-center" v-if="isLoading">
          <button class="btn btn-lg" type="button" disabled>
            <h6>
              <span
                class="spinner-border spinner-border"
                role="status"
                aria-hidden="true"
              ></span>
              កំពុងដំណើរការ...
            </h6>
          </button>
        </div>
        <div class="row p-2" v-if="!isNulled">
          <div class="col">
            <h6 class="text-break fw-bold">ចំនូន៖ {{ groups.length }} ក្រុម</h6>
          </div>
          <div class="col">
            <paginate-links
              for="languages"
              class="label-count"
              :show-step-links="true"
              :limit="5"
              :step-links="{
                next: '   ​ បន្ត',
                prev: 'ត្រឡប់ក្រោយ   ​ ',
              }"
            ></paginate-links>
          </div>
        </div>
        <paginate name="languages" :list="groups" :per="10" ref="paginator">
          <div class="row mt-3" style="margin-left: -2.7rem;">
            <div
              class="col-sm-12 col-md-6 col-lg-6"
              v-for="(group, index) in paginated('languages')"
              :key="index"
            >
              <div class="card p-3 bg-white mb-4">
                <div class="d-flex justify-content-between mb-4">
                  <div class="user-info">
                    <div class="user-info__basic">
                      <h6 class="mt-2">{{ group.name }}</h6>
                      {{group.id}}
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" 
                    :value="group.id"
                    v-model="selectedGroups"
                    class="form-check" v-bind:id="group.id">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </paginate>
      </div>
      <div class="shadow-none p-3 mb-5 bg-light rounded">
        <button type="submit" class="btn btn-primary">
          យល់ព្រម <i class="bi bi-arrow-return-left"></i>
        </button>
      </div>
    </form>
  </div>
</template>
<script>
import { required } from "vuelidate/lib/validators";
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      text: '',
      link: '',
      access_token: [],
      fb_id: [],
      groups: [],
      isLoading: true,
      paginate: ["languages"],
      isNulled: true,
      selectedGroups: []
    };
  },
  computed: {
    authPetools: function () {
      return this.$store.getters.auth;
    },
  },
  created() {
    this.loadGroups();
  },
  validations: {
    text: {
      required,
    }
  },
  methods: {
    ...mapActions(["FetchGroupList","PostToGroup"]),
    backPage() {
      this.$nextTick(() => {
        this.$router.push("/pe-tools");
      });
    },

    loadGroups() {
      let data = {
        facebook_access_token: this.$store.getters.facebook_access_token,
      };

      let group = this.FetchGroupList(data);

      group.then((response) => {
        this.groups = response.data;
        this.isLoading = false;
        this.isNulled = false;
      });
    },

    onSubmit() {
      if(this.selectedGroups.length === 0) {
        this.$message({
          title: "ជូនដំណឹង!",
          message: "លោកអ្នកមិនទាន់ជ្រើសរើសក្រុមនៅឡើយទេ!",
          iconImg: "https://image.flaticon.com/icons/png/512/753/753345.png", // Error
        });
        return;
      }
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.isLoading = false;
        return;
      }

      let data = {
        post_type: 'text',
        message: this.text,
        link: this.link,
        group_id: this.selectedGroups,
        facebook_access_token: this.$store.getters.facebook_access_token
      };

      let group = this.PostToGroup(data);

      group.then((response) => {
        console.log(response)
      });


    },
  },
};
</script>
<style>
.image-page {
  height: 50px;
}
.loading {
}

.card-custom {
  height: 55px;
}

.card-header {
  background-color: transparent !important;
  border-bottom: transparent !important;
}

.label-count {
  line-height: 30px;
}

.languages {
  list-style: none;
  width: fit-content;
  float: right;
  display: inline-flex;
}
</style>