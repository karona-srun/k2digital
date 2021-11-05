<template>
  <div class="mt-2">
    <div class="p-2">
      <h5 class="text-primary">
        គណនី / Profiles បង្ហោះជាអត្ថបទ
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
          <label for="floatingInputValue">អត្ថបទ ឬ តំណភ្ជាប់</label>
        </div>
      </div>
      <div class="shadow-none p-3 mb-5 bg-light rounded">
        <h5>គោលដៅប្រវត្តិរូប</h5>
        <div class="row">
          <div
            class="col-sm-12 col-md-6 col-lg-4"
            v-for="(auth, index) in authPetools.petools"
            :key="index"
          >
            <div class="card p-3 bg-white mb-4">
              <div class="d-flex justify-content-between mb-4">
                <div class="user-info">
                  <div class="user-info__img me-2">
                    <img :src="auth.fb_picture" alt="User Img" />
                  </div>
                  <div class="user-info__basic">
                    <h6 class="mb-0">{{ auth.fb_name }}</h6>
                    <p class="text-muted mb-0">
                      បានធ្វើបច្ចុប្បន្នភាពចុងក្រោយនៅ {{ auth.updated_at }}
                    </p>
                  </div>
                </div>
                <div class="dropdown open">
                  <input
                    class="form-control"
                    type="text"
                    v-model="access_token"
                  />
                  <input
                    class="form-check-input"
                    type="checkbox"
                    :value="auth.fb_id"
                    v-model="fb_id"
                    id="flexCheckDefault"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="shadow-none p-3 mb-5 bg-light rounded">
        <button type="submit" class="btn btn-primary">យល់ព្រម</button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      text: "",
      access_token: [],
      fb_id: [],
    };
  },
  computed: {
    authPetools: function () {
      return this.$store.getters.auth;
    },
  },
  methods: {
    backPage() {
      this.$nextTick(() => {
        this.$router.push("/pe-tools");
      });
    },
    onSubmit() {
      let data = {
        fb_id: this.fb_id,
        access_token: this.access_token,
      };
      console.log(data);
    },
  },
};
</script>