<template>
  <div class="text-center">
    <form class="form-signin" @submit.prevent="onSubmitSignUp" enctype="multipart/form-data">
      <h1 class="h3 mb-3 font-weight-normal">ចុះឈ្មោះប្រើប្រាស់</h1>
      <div class="mb-3">
        <input type="file" ref="onFileChange" accept="image/*" @change="onFileChange" hidden />
        <div id="preview">
          <img
            v-if="avatarURL"
            :src="avatarURL"
            class="img-thumbnail rounded rounded-100"
          />
        </div>
        <input
          value="ជ្រើសរើសរូប"
          readonly
          @click="onClickFile"
          class="btn btn-app mt-2 text-small"
        />
      </div>
      <div class="mb-3">
        <div class="form-row">
          <div class="col">
            <label class="float-left form-label">នាម</label>
            <input
              type="text"
              id="inputLastName"
              class="form-control"
              :class="{ 'is-invalid': submitted && $v.firstName.$error }" 
              placeholder="នាម"
              v-model="firstName"
              
              autofocus=""
            />
            <div v-if="submitted && !$v.firstName.required" class="invalid-feedback text-start">នាមត្រូវបានទាមទារ</div>
          </div>
          <div class="col">
            <label class="float-left form-label">នាមត្រកូល</label>
            <input
              type="text"
              id="inputFirstName"
              class="form-control"
              :class="{ 'is-invalid': submitted && $v.lastName.$error }" 
              placeholder="នាមត្រកូល"
              v-model="lastName"
              
              autofocus=""
            />
            <div v-if="submitted && !$v.lastName.required" class="invalid-feedback text-start">នាមត្រកូលត្រូវបានទាមទារ</div>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="float-left form-label">អាស័យ​ដ្ឋាន​អ៊ី​ម៉េ​ល</label>
        <input
          type="email"
          id="inputEmail"
          class="form-control"
          :class="{ 'is-invalid': submitted && $v.email.$error }"
          v-model.trim="email"
          placeholder="អាស័យ​ដ្ឋាន​អ៊ី​ម៉េ​ល"
        />
        <div v-if="submitted && $v.email.$error" class="invalid-feedback text-start">
          <span v-if="!$v.email.required">អាស័យ​ដ្ឋាន​អ៊ី​ម៉េ​លត្រូវបានទាមទារ</span>
          <span v-if="!$v.email.email">អាស័យ​ដ្ឋាន​អ៊ី​ម៉េ​លមិនត្រឹមត្រូវ</span>
        </div>
      </div>
      <div class="mb-3">
        <label class="float-left form-label">ពាក្យសម្ងាត់</label>
        <input
          type="password"
          id="inputPassword"
          class="form-control"
          :class="{ 'is-invalid': submitted && $v.password.$error }"
          v-model.trim="password"
          placeholder="ពាក្យសម្ងាត់"
        />
        <div v-if="submitted && $v.password.$error" class="invalid-feedback text-start">
            <span v-if="!$v.password.required">ពាក្យសម្ងាត់ត្រូវបានទាមទារ</span>
            <span v-if="!$v.password.minLength">ពាក្យសម្ងាត់ត្រូវមានយ៉ាងហោចណាស់ ៦ តួ</span>
        </div>
      </div>
      <div class="mb-3">
        <label class="float-left form-label"
          >បញ្ជាក់ពាក្យសម្ងាត់​ម្តង​ទៀត</label
        >
        <input
          type="password"
          id="inputConfirmPassword"
          class="form-control"
          :class="{ 'is-invalid': submitted && $v.confirmPassword.$error }" 
          v-model="confirmPassword"
          placeholder="បញ្ជាក់ពាក្យសម្ងាត់​ម្តង​ទៀត"
          
        />
        <div v-if="submitted && $v.confirmPassword.$error" class="invalid-feedback text-start">
            <span v-if="!$v.confirmPassword.required">បញ្ជាក់ពាក្យសម្ងាត់ត្រូវបានទាមទារ</span>
            <span v-else-if="!$v.confirmPassword.sameAsPassword">ពាក្យសម្ងាត់ត្រូវតែ​ដូចគ្នា</span>
        </div>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">
        ចុះឈ្មោះ
      </button>
    </form>
  </div>
</template>
<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import { mapActions } from "vuex";
export default {
  name: "SignUp",
  data() {
    return {
      avatarURL:
        "https://www.pngitem.com/pimgs/m/421-4212617_person-placeholder-image-transparent-hd-png-download.png",
      logoURL:
        "https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5",
      avatar: null,
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      confirmPassword: "",
      submitted: false,
    };
  },
  validations: {
    firstName: { required },
    lastName: { required },
    email: { required, email },
    password: { required, minLength: minLength(6) },
    confirmPassword: { required, sameAsPassword: sameAs("password") },
  },
  methods: {
    ...mapActions(["SignUp"]),
    onFileChange(e) {
      const file = e.target.files[0];
      this.avatar = file;
      if (file) this.avatarURL = URL.createObjectURL(file);
    },
    onClickFile() {
      const elem = this.$refs.onFileChange;
      elem.click();
    },
    onSubmitSignUp() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }

      let data = new FormData();
      data.append("first_name", this.firstName);
      data.append("last_name", this.lastName);
      data.append("email", this.email);
      data.append("password", this.password);
      data.append("avatar", this.avatar);

      let result = this.SignUp(data);
      result.then((response) => {
        if(response == 'success') {
          this.$message({
            title: "អមអរ!",
            message:
              "ការចុះឈ្មោះរបស់អ្នកបានដោយជោគជ័យ!",
            iconImg: 'https://image.flaticon.com/icons/png/512/189/189677.png', // Success
          });
          this.$nextTick(() => {
            this.$router.push("sign-in")
          })
        }else{
          this.$message({
            title: "ព្រមាន!",
            message:
              "អាស័យ​ដ្ឋាន​អ៊ី​ម៉ែ​លមួយនេះមានរួចហើយ!",
            // iconImg: 'https://image.flaticon.com/icons/png/512/189/189677.png', // Success
            iconImg: "https://image.flaticon.com/icons/png/512/753/753345.png", // Error
          });
        }
      })
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