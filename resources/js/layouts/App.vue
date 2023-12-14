<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container-fluid">
        <router-link :to="{ path: '/' }" class="navbar-brand text-dark">
          <img
            class="img-responsive"
            width="40"
            :src="logo"
            alt="logo"
            srcset=""
          />
          K2 Digital
        </router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarScroll"
          aria-controls="navbarScroll"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="bi bi-list navbar-toggler-icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0">
            <li class="nav-item">
              <router-link
                class="nav-link"
                data-toggle="collapse"
                :to="{ path: '/' }"
              >
                ទំព័រដើម
              </router-link>
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link"
                data-toggle="collapse"
                :to="{ path: 'chong-banghoh' }"
              >
                ចង់បង្ហោះ
              </router-link>
            </li>
            <li class="nav-item" v-if="!isLoggedInFB">
              <router-link
                class="nav-link"
                data-toggle="collapse"
                :to="{ path: '/pe-tools' }"
              >
                <strong>PE Tools</strong>
              </router-link>
            </li>

            <li class="nav-item dropdown" v-else>
              <button
                :to="{}"
                class="nav-link btn btn-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
              >
                <strong>PE Tools</strong>
              </button>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <router-link
                  class="dropdown-item"
                  :to="{ path: '/pe-tools' }">
                  <strong>PE Tools</strong>
                </router-link>
                <router-link
                  class="dropdown-item"
                  :to="{ path: '/account' }">
                  គណនីរបស់អ្នក
                </router-link>
                <router-link
                  class="dropdown-item"
                  :to="{ path: '/pe-tools/account' }">
                  គណនី Facebook
                </router-link>
                <!-- <div class="dropdown-divider"></div>
                <a
                  class="dropdown-item"
                  href="#"
                  @click.prevent="onSubmitSignOutPE"
                  >ចាកចេញពី PE Tools</a
                > -->
                </div>
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link"
                data-toggle="collapse"
                :to="{ path: '/tiktok-tools' }"
              >
                <strong>TikTok Tools</strong>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link"
                data-toggle="collapse"
                :to="{ path: 'about' }"
              >
                អំពីពួកយើង
              </router-link>
            </li>
          </ul>
          <div class="d-flex">
            <button
              v-if="isLoggedIn"
              class="btn btn-outline-app me-2"
              type="button"
              data-toggle="modal"
              data-target="#staticBackdrop"
            >
              <i class="bi bi-plus"></i> បង្ហោះ
            </button>
            <button
              v-if="!isLoggedIn"
              class="btn btn-outline-app me-2"
              type="button"
              @click.prevent="alertMessage"
            >
              <i class="bi bi-plus"></i> បង្ហោះ
            </button>
            <span v-if="isLoggedIn">
              <img
                :src="auth.avatar"
                class="rounded-100 avatar ml-3"
                width="20px"
                alt="avatar"
                srcset=""
              />
              <span class="mr-3 text-blod"
                >{{ auth.first_name }} {{ auth.last_name }}</span
              >

              <button
                @click.prevent="onSubmitSignOut"
                class="btn btn-app me-2"
                type="button"
              >
                <i class="bi bi-arrow-bar-left"></i>ចាកចេញ
              </button>
            </span>
            <span v-else>
              <button
                @click.prevent="onClickSignIn"
                class="btn btn-default me-2"
                type="button"
              >
                <i class="bi bi-arrow-bar-right"></i> ចូលគណនី
              </button>
              <button
                @click.prevent="onClickSignUp"
                class="btn btn-app"
                type="button"
              >
                <i class="bi bi-person-plus"></i> ចុះឈ្មោះ
              </button>
            </span>
          </div>
        </div>
      </div>
    </nav>
    <div class="container mb-5">
      <keep-alive>
        <router-view></router-view>
      </keep-alive>
    </div>
    <div class="mb-10">
      
    </div>
    <div class="fixed-bottom">
      <footer class="border-top">
        <p class="text-center mb-3 mt-3">© K2 ឌីជីថល. រក្សា​រ​សិទ្ធ​គ្រប់យ៉ាង.</p>
      </footer>
    </div>
    <div
      class="modal fade"
      id="staticBackdrop"
      data-backdrop="static"
      data-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <form @submit.prevent="onClickSubmit" ref="formPost">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">បង្ហោះអត្ថបទ</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="md-3">
                <label for="">ឯកជនភាព</label>
                <select class="form-control text-small" v-model="privacy">
                  <option value="0">ឃើញតែខ្ញុំឯងប៉ុណ្ណោះ</option>
                  <option value="1">សាធារណៈ</option>
                </select>
              </div>
              <div class="md-3">
                <label for="">អត្ថបទ</label>
                <textarea
                  rows="5"
                  v-model="post"
                  required
                  class="form-control text-small"
                ></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-sm btn-app text-small"
                data-dismiss="modal"
              >
                បោះបង់
              </button>
              <button type="submit" class="btn btn-sm btn-primary text-small">
                បង្ហោះ
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
  data() {
    return {
      logo: "/favicon.png",
      post: "",
      privacy: 1,
    };
  },
  computed: {
    ...mapGetters(["auth"]),
    isLoggedIn: function () {
      return this.$store.getters.isAuthenticated;
    },
    isLoggedInFB: function () {
      if(this.$store.getters.isAuthenticated){
        return this.$store.getters.hasPetools == null ? false : true;
      }
      return false;
    },
  },
  watch: {
    $route() {
      $("#navbarCollapse").collapse("hide");
    },
  },
  created() {
    this.Me();
  },
  methods: {
    ...mapActions(["AddNewPost", "SignOut", "Me", "SignOutPE"]),
    onClickSignIn() {
      this.$router.push("sign-in");
    },
    onClickSignUp() {
      this.$router.push("sign-up");
    },
    alertMessage() {
      this.$message({
        title: "ជូនដំណឹង!",
        message: "សូមចូលប្រើប្រាស់ជាមុនសិន ទើបអនុញ្ញាតលោកអ្នកបង្ហោះអត្ថបទបាន!",
        iconImg: "https://image.flaticon.com/icons/png/512/753/753345.png", // Error icon
      });
    },
    onClickSubmit() {
      var post = {
        post: this.post,
        privacy: this.privacy,
      };
      var result = this.AddNewPost(post);
      result.then((response) => {
        if (response == "success") {
          console.log(response);
          this.$message({
            title: "អមអរ!",
            message: "ការបង្ហោះអត្ថបទរបស់អ្នកបានដោយជោគជ័យ!",
            iconImg: "https://image.flaticon.com/icons/png/512/189/189677.png", // Success
          });
          this.clearForm();
        }
      });
    },
    onSubmitSignOut() {
      this.SignOut();
      this.$nextTick(() => {
        this.$router.go();
      });
    },
    clearForm() {
      (this.post = ""), (this.privacy = 0);
    },
  },
};
</script>
<style>
footer {
  bottom: 0;
}
.mb-10{
  margin-bottom: 10rem !important;
}
.fixed-bottom{
  background-color: #fff !important;
}
</style>