<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h2 class="">សូមស្វាគមន៍ការចូលមកកាន់ PETools</h2>
        <h5 class="mt-5">ចូល​ទៅ​ក្នុង PETools</h5>
        <h5>សូមបំពេញ Facebook Access Token នៃគណនីហ្វេសប៊ុកដែលអ្នកចង់ប្រើ។</h5>
      </div>
      <form class="col-md-12 mt-2" @submit.prevent="onSubmit">
        <div class="input-group">
          <input
            type="text"
            v-model.trim="facebook_access_token"
            class="form-control"
            :class="{
              'is-invalid': submitted && $v.facebook_access_token.$error,
            }"
            id="FacebookAccessToken"
            placeholder="Facebook Access Token"
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
    <div class="row" :class="groups != '' ? 'p-2' : ''">
      <div class="col-md-6">
        <div
          class="list-group list-group-flush overflow-auto"
          :class="groups != '' ? 'group_list' : ''"
        >
          <a
            v-if="groups != ''"
            class="list-group-item list-group-item-action mt-3 mb-3"
            aria-current="true"
          >
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">បញ្ជីឈ្មោះក្រុម</h5>
            </div>
            <p class="mb-1">ចំនួនក្រុម៖ {{ groups.length }}</p>
          </a>

          <a v-for="(group, i) in groups" :key="i" class="list-group-item">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <input
                  class="form-check-input me-1"
                  type="checkbox"
                  v-model="group_list"
                  :value="group.id"
                  aria-label="..."
                />
                <div class="d-flex w-100 justify-content-between">
                  <p class="">ឈ្មោះក្រុម៖ {{ group.name }}</p>
                </div>
                <p class="mb-1">លេខសំគាល់ក្រុម៖ {{ group.id }}</p>
                <p>ឯកជនភាពក្រុម៖ {{ group.privacy }}</p>
              </li>
            </ul>
          </a>
        </div>
      </div>
      <div
        v-if="groups != ''"
        class="col-md-6"
        :class="groups != '' ? 'p-2' : ''"
      >
        <h5>សរសេរអត្ថបទ</h5>
        <form class="row g-3">
          <div class="col-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input
              type="text"
              class="form-control"
              id="inputAddress"
              placeholder="1234 Main St"
            />
          </div>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Address 2</label>
            <input
              type="text"
              class="form-control"
              id="inputAddress2"
              placeholder="Apartment, studio, or floor"
            />
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">City</label>
            <input type="text" class="form-control" id="inputCity" />
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">យល់ព្រម</button>
          </div>
        </form>
      </div>
    </div>
    <div>
      <h5 class="mt-3 mb-3">របៀបប្រើប្រាស់ PE Tools</h5>
      <div class="row">
        <div class="col-md-4">
          <div class="embed-responsive embed-responsive-16by9">
            <!-- <iframe
              class="embed-responsive-item"
              height="200"
              src="https://www.youtube.com/embed/GjF3yxSLxMc"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; muted; encrypted-media; gyroscope;"
              allowfullscreen
            ></iframe> -->
          </div>
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
          <p>2. ជ្រើសរើសអត្ថបទទាំងអស់បន្ទាប់មកចម្លង</p>
          <p class="mb-3">
            3. បិទភ្ជាប់ទៅប្រអប់ 'Facebook Access Token'
            បន្ទាប់មកចុចប៊ូតុងបញ្ជូន
          </p>
        </div>
        <div class="col-md-4">
          <div class="embed-responsive embed-responsive-16by9">
            <!-- <iframe
              class="embed-responsive-item"
              height="200"
              src="https://www.youtube.com/embed/GjF3yxSLxMc"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; muted; encrypted-media; gyroscope;"
              allowfullscreen
            ></iframe> -->
          </div>
          <p class="mt-3 mb-3">របៀបប្រើនៅលើទូរស័ព្ទដៃ</p>
        </div>
        <div class="col-md-4">
          <div class="embed-responsive embed-responsive-16by9">
            <!-- <iframe
              class="embed-responsive-item"
              height="200"
              src="https://www.youtube.com/embed/GjF3yxSLxMc"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; muted; encrypted-media; gyroscope;"
              allowfullscreen
            ></iframe> -->
          </div>
          <p class="mt-3 mb-3">របៀបប្រើនៅលើកុំព្យូទ័រ</p>
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
      groups: [],
      group_list: [],
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
  methods: {
    ...mapActions(["FetchGroupList"]),
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

      let result = this.FetchGroupList(data);

      result.then((response) => {
        if (response.status == "error") {
          this.isLoading = false;
          this.groups = "";
          this.$message({
            title: "ព្រមាន!",
            message: "Facebook Access Token ដែលបានផ្តល់មិនត្រឹមត្រូវទេ!",
            // iconImg: 'https://image.flaticon.com/icons/png/512/189/189677.png', // Success
            iconImg: "https://image.flaticon.com/icons/png/512/753/753345.png", // Error
          });
        }
        if (response.status == "success") {
          this.groups = response.data.data;
          this.isLoading = false;
        }
      });
    },
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
