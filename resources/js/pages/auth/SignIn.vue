<template>
  <div class="text-center">
    <form class="form-signin" @submit.prevent="onSubmitSignIn">
      <h1 class="h3 mt-2 mb-4 font-weight-normal">ចូលប្រើប្រាស់គណនី</h1>
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
        <div
          v-if="submitted && $v.email.$error"
          class="invalid-feedback text-start"
        >
          <span v-if="!$v.email.required"
            >អាស័យ​ដ្ឋាន​អ៊ី​ម៉េ​លត្រូវបានទាមទារ</span
          >
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
        <div
          v-if="submitted && $v.password.$error"
          class="invalid-feedback text-start"
        >
          <span v-if="!$v.password.required">ពាក្យសម្ងាត់ត្រូវបានទាមទារ</span>
          <span v-if="!$v.password.minLength"
            >ពាក្យសម្ងាត់ត្រូវមានយ៉ាងហោចណាស់ ៦ តួ</span
          >
        </div>
      </div>
      <div class="checkbox mb-3">
        <label class="float-left">
          <input type="checkbox" value="remember-me" /> ចងចាំខ្ញុំ
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">
        ចូលគណនី
      </button>
      <label class="mt-2"> ​ឬ </label>
            <div class="mb-3">
        <button class="btn btn-link text-small text-start" type="submit">
        បាត់ពាក្យសម្ងាត់របស់អ្នក?
      </button>
            </div>
    </form>
  </div>
</template>
<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import { mapActions } from "vuex";
export default {
  name: "SignIn",
  data() {
    return {
      submitted: false,
      email: "",
      password: "",
    };
  },
  validations: {
    email: { required, email },
    password: { required, minLength: minLength(6) },
  },
  methods: {
    ...mapActions(["SignIn"]),
    async onSubmitSignIn() {
      this.submitted = true;
      // stop here if form is invalid
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }

      let data = {
        email: this.email,
        password: this.password,
      };
      let result = this.SignIn(data);
      result.then((response) => {
        if (response == "success") {
          // this.$nextTick(() => {
            this.$router.push("/");
            this.$router.go()
          // });
        } else {
          this.$message({
            title: "ព្រមាន!",
            message:
              "អាស័យ​ដ្ឋាន​អ៊ី​ម៉ែលឬពាក្យសម្ងាត់ដែលបានផ្តល់មិនត្រឹមត្រូវ!",
            // iconImg: 'https://image.flaticon.com/icons/png/512/189/189677.png', // Success
            iconImg: "https://image.flaticon.com/icons/png/512/753/753345.png", // Error
          });
        }
      });
    },
  },
};
</script>