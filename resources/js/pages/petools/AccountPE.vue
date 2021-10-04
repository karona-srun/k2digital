<template>
  <div class="container mt-5">
    <h5>ព័ត៌មានរបស់គណនី PE Tools</h5>
    <div class="jumbotron mt-2">
      <h5>កែប្រែព័ត៌មានរបស់គណនី</h5>
      <div class="row">
        <div
          class="col-sm-12 col-md-4 col-lg-4"
          v-for="(auth, index) in authPetools.petools"
          :key="index"
        >
          <div class="card bg-white p-3 mb-4 shadow">
            <div class="d-flex justify-content-between mb-4">
              <div class="user-info">
                <div class="user-info__img me-2">
                  <img :src="auth.fb_picture" alt="User Img" />
                </div>
                <div class="user-info__basic">
                  <h5 class="mb-0">{{ auth.fb_name }}</h5>
                  <p class="text-muted mb-0">
                    បានធ្វើបច្ចុប្បន្នភាពចុងក្រោយនៅ {{ auth.updated_at }}
                  </p>
                </div>
              </div>
              <div class="dropdown open">
                <a
                  href="#!"
                  class="px-2"
                >
                  <i
                    class="bi bi-trash text-danger"
                    @click.prevent="toggleModalConfirmDelete"
                  ></i>
                </a>
              </div>
            </div>
          </div>
          <div
            ref="modal"
            class="modal fade"
            :class="{ show, 'd-block': active }"
            tabindex="-1"
            role="dialog"
          >
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">លុបគណនី</h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                    @click.prevent="toggleModalConfirmDelete"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>តើអ្នកប្រាកដចង់លុបដែរឬទេ?</p>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-sm btn-danger text-small"
                    data-dismiss="modal"
                    @click.prevent="toggleModalConfirmDelete"
                  >
                    បោះបង់
                  </button>
                  <button
                    type="button"
                    data-dismiss="modal"
                    class="btn btn-sm btn-primary text-small"
                    @click.prevent="deleteAccessToken(auth.id)"
                  >
                    បាទ ឬ ចាស
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  name: "AccountPE",
  data() {
    return {
      avatar: "/favicon.png",
      active: false,
      show: false,
    };
  },
  computed: {
    authPetools: function () {
      return this.$store.getters.auth;
    },
  },
  methods: {
    ...mapActions(["DeleteAccessToken"]),
    toggleModalConfirmDelete() {
      const body = document.querySelector("body");
      this.active = !this.active;
      this.active
        ? body.classList.add("modal-open")
        : body.classList.remove("modal-open");
      setTimeout(() => (this.show = !this.show), 10);
    },
    deleteAccessToken(id){
      let result = this.DeleteAccessToken(id);
      result.then((response) => {
        this.$nextTick(() => {
          this.$router.go('!#/pe-tools')
        });
      })
    },
    closeModal() {
      $("#toggleModal").modal("toggle");
    },
  },
};
</script>
<style>
.user-info__basic {
  margin-top: -14px;
}
</style>