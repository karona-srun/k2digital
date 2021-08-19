<template>
  <div class="text-center">
    <form class="form-signin">
      <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
      <div class="mb-3">
        <input type="file" ref="onFileChange" @change="onFileChange" hidden />
        <div id="preview">
          <img
            v-if="imageURL"
            :src="imageURL"
            class="img-thumbnail rounded rounded-100"
          />
        </div>
        <input
          value="ជ្រើសរើសរូប"
          @click="onClickFile"
          class="btn btn-app mt-2 text-small"
        />
      </div>
      <div class="mb-3">
        <div class="form-row">
    <div class="col">
          <label class="float-left form-label">First Name</label>
          <input
            type="email"
            id="inputEmail"
            class="form-control"
            placeholder="First Name"
            required=""
            autofocus=""
          />
        </div>
        <div class="col">
          <label class="float-left form-label">Last Name</label>
          <input
            type="email"
            id="inputEmail"
            class="form-control"
            placeholder="Last Name"
            required=""
            autofocus=""
          />
        </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="float-left form-label">Email address</label>
        <input
          type="email"
          id="inputEmail"
          class="form-control"
          placeholder="Email address"
          required=""
          autofocus=""
        />
      </div>
      <div class="mb-3">
        <label class="float-left form-label">Password</label>
        <input
          type="password"
          id="inputPassword"
          class="form-control"
          placeholder="Password"
          required=""
        />
      </div>
      <div class="mb-3">
        <label class="float-left form-label">Re-type Password</label>
        <input
          type="password"
          id="inputPassword1"
          class="form-control"
          placeholder="Re-type Password"
          required=""
        />
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">
        Sign Up
      </button>
    </form>
  </div>
</template>
<script>
export default {
  name: "SignUp",
  data() {
    return {
      imageURL:
        "https://www.pngitem.com/pimgs/m/421-4212617_person-placeholder-image-transparent-hd-png-download.png",
      logoURL:
        "https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5",
    };
  },
  methods: {
    onFileChange(e) {
      const file = e.target.files[0];
      if (file) this.imageURL = URL.createObjectURL(file);
    },
    onClickFile() {
      const elem = this.$refs.onFileChange;
      elem.click();
    },
  },
};
</script>
<style>
#preview {
  display: flex;
  justify-content: center;
  align-items: center;
}

#preview img {
  width: 150px !important;
  height: 150px !important;
}
</style>